<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Show the chat interface
     */
    public function showChat()
    {
        // Get the authenticated user
        $user = Auth::user();
        $employee = Employee::where('email', $user->email)->first();

        // Special case for mohamed@gmail.com - create employee if not exists
        if (!$employee && $user->email === 'mohamed@gmail.com') {
            $employee = Employee::create([
                'name' => 'Mohamed',
                'email' => 'mohamed@gmail.com',
                'phone' => '123456789',
                'address' => 'Cairo, Egypt',
                'gender' => 'male',
                'dob' => '1990-01-01',
                'nationality' => 'Egyptian',
                'position' => 'Developer',
                'nid_number' => '12345678901234',
                'joining_date' => now(),
                'salary' => 5000,
                'work_start_time' => '09:00:00',
                'work_end_time' => '17:00:00',
            ]);
        }

        // Get recent chat history for the employee
        $chatHistory = [];

        // If no employee record is found, add a system message to inform the user
        if (!$employee) {
            $chatHistory[] = [
                'role' => 'assistant',
                'content' => 'Welcome! I notice that your user account is not linked to an employee record. Please contact HR to ensure your email address is correctly linked to your employee profile in the system.'
            ];
        } else {
            $recentMessages = ChatMessage::where('employee_id', $employee->id)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get()
                ->reverse();

            foreach ($recentMessages as $message) {
                $chatHistory[] = [
                    'role' => $message->role,
                    'content' => $message->content
                ];
            }
        }

        return view('attendance.chat', ['chatHistory' => json_encode($chatHistory)]);
    }

    /**
     * Process a chat message and return a response
     */
    public function processMessage(Request $request)
    {
        try {
            // Validate request
            $request->validate([
                'message' => 'required|string',
                'history' => 'nullable|array',
            ]);

            // Get the authenticated user
            $user = Auth::user();
            $employee = Employee::where('email', $user->email)->first();

            // Special case for mohamed@gmail.com - create employee if not exists
            if (!$employee && $user->email === 'mohamed@gmail.com') {
                $employee = Employee::create([
                    'name' => 'Mohamed',
                    'email' => 'mohamed@gmail.com',
                    'phone' => '123456789',
                    'address' => 'Cairo, Egypt',
                    'gender' => 'male',
                    'dob' => '1990-01-01',
                    'nationality' => 'Egyptian',
                    'position' => 'Developer',
                    'nid_number' => '12345678901234',
                    'joining_date' => now(),
                    'salary' => 5000,
                    'work_start_time' => '09:00:00',
                    'work_end_time' => '17:00:00',
                ]);
            }

            // Even if no employee is found, we'll still allow the chat to work with company-wide data
            // We'll create a default employee object for context if needed
            if (!$employee) {
                $employee = new Employee([
                    'id' => 0,
                    'name' => $user->name ?? 'Guest User',
                    'email' => $user->email ?? 'guest@example.com',
                    'position' => 'Guest',
                    'work_start_time' => '09:00:00',
                    'work_end_time' => '17:00:00',
                ]);
            }

            // Get employee data for context
            $employeeData = $this->getEmployeeData($employee);

            // Save user message to database
            ChatMessage::create([
                'employee_id' => $employee->id,
                'role' => 'user',
                'content' => $request->input('message')
            ]);

            // Get API key from config
            $apiKey = config('services.openai.key');
            $apiUrl = config('services.openai.url');
            $model = config('services.openai.model');

            // Validate API key exists
            if (empty($apiKey)) {
                Log::error('OpenAI API key is missing');
                return response()->json([
                    'error' => 'API configuration error. Please contact the administrator.',
                ], 500);
            }

            // Check if the message contains attendance or HR-related queries
            $userMessage = $request->input('message');
            $additionalContext = $this->getAdditionalContextForQuery($userMessage, $employee);

            // Create system message with employee context and any additional context
            $systemMessage = $this->createSystemMessage($employeeData);

            // Add any additional context from database queries
            if (!empty($additionalContext)) {
                $systemMessage .= "\n\nAdditional context for your query: " . json_encode($additionalContext);
            }

            // Get user message and history
            $userMessage = $request->input('message');
            $history = $request->input('history', []);

            // If history is empty, try to get from database
            if (empty($history)) {
                $dbHistory = ChatMessage::where('employee_id', $employee->id)
                    ->orderBy('created_at', 'desc')
                    ->take(10)
                    ->get()
                    ->reverse();

                foreach ($dbHistory as $message) {
                    $history[] = [
                        'role' => $message->role,
                        'content' => $message->content
                    ];
                }
            }

            // Prepare messages for API
            $messages = [
                ['role' => 'system', 'content' => $systemMessage],
            ];

            // Add history messages (limited to last 5 for context)
            $historyMessages = array_slice($history, -5);
            foreach ($historyMessages as $historyMessage) {
                $messages[] = [
                    'role' => $historyMessage['role'],
                    'content' => $historyMessage['content']
                ];
            }

            // Add current user message
            $messages[] = ['role' => 'user', 'content' => $userMessage];

            // Call OpenAI API
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'model' => $model,
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 1000
            ]);

            // Log request details for debugging
            Log::info('API Request', [
                'model' => $model,
                'message_count' => count($messages)
            ]);

            if ($response->successful()) {
                $result = $response->json();

                // Log the full response for debugging
                Log::info('API Response', ['result' => $result]);

                // Extract the AI response from the OpenAI API result
                if (isset($result['choices'][0]['message']['content'])) {
                    // Standard OpenAI format
                    $aiResponse = $result['choices'][0]['message']['content'];
                } else {
                    // Log the actual response structure for debugging
                    Log::error('Unknown OpenAI API Response Structure', [
                        'result' => $result,
                        'response_keys' => isset($result) ? (is_array($result) ? array_keys($result) : gettype($result)) : [],
                        'model' => $model
                    ]);
                    $aiResponse = 'I apologize, but I encountered an issue processing your request. Please try again.';
                }

                // Save AI response to database
                ChatMessage::create([
                    'employee_id' => $employee->id,
                    'role' => 'assistant',
                    'content' => $aiResponse
                ]);

                return response()->json([
                    'response' => $aiResponse,
                ]);
            } else {
                // Enhanced error logging with more details
                $responseBody = $response->body();
                $statusCode = $response->status() ?? 500; // Add null coalescing operator to handle potential null
                // Fix type error: Get headers without calling all() to avoid array to object conversion issue
                $headers = $response->headers();

                Log::error('API Error', [
                    'status' => $statusCode,
                    'response' => $responseBody,
                    'headers' => $headers,
                    'request_payload' => [
                        'model' => $model,
                        'message_count' => count($messages)
                    ]
                ]);

                // Check for specific error cases
                $errorMessage = 'Failed to get a response from the AI service. Please try again later.';

                // Check for rate limiting
                if ($statusCode === 429) {
                    Log::warning('OpenAI API rate limit exceeded');
                    $errorMessage = 'The AI service is currently busy. Please try again in a few moments.';
                }
                // Check for authentication errors
                else if ($statusCode === 401 || $statusCode === 403) {
                    Log::critical('OpenAI API authentication failed', ['status' => $statusCode]);
                    $errorMessage = 'API authentication error. Please contact the administrator.';
                }
                // Check for model-specific errors
                else if ($statusCode === 404) {
                    Log::error('OpenAI API model not found', ['model' => $model]);
                    $errorMessage = 'The requested AI model is currently unavailable. Please try again later.';
                }
                // Check for server errors
                else if ($statusCode >= 500) {
                    Log::error('OpenAI API server error', ['status' => $statusCode]);
                    $errorMessage = 'The AI service is experiencing technical difficulties. Please try again later.';
                }

                // Try to parse response body for more specific error messages
                try {
                    $jsonResponse = json_decode($responseBody, true);
                    if (isset($jsonResponse['error']['message'])) {
                        Log::error('OpenAI API error message', ['message' => $jsonResponse['error']['message']]);
                    }
                } catch (\Exception $e) {
                    Log::warning('Failed to parse API error response', ['error' => $e->getMessage()]);
                }

                return response()->json([
                    'error' => $errorMessage,
                ], 500);
            }
        } catch (\Exception $e) {
            // General error handling
            Log::error('Error processing message', [
                'error' => $e->getMessage(),
                'stack' => $e->getTraceAsString(),
            ]);
            return response()->json([
                'error' => 'An error occurred while processing your request. Please try again later.',
            ], 500);
        }
    }

    /**
     * Generate system message with employee context and database access
     */
    private function createSystemMessage($employeeData)
    {
        // Get current date information for context
        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentMonthName = date('F');

        // Get attendance data for the current month
        $attendanceData = $this->getEmployeeAttendanceData($employeeData['employee_id'], $currentMonth, $currentYear);

        // Get company-wide statistics
        $companyStats = $this->getCompanyStatistics($currentMonth, $currentYear);

        // Get all employees basic information
        $allEmployees = $this->getAllEmployeesBasicInfo();

        // Get company-wide attendance data
        $companyAttendanceData = $this->getCompanyAttendanceData($currentMonth, $currentYear);

        // Get company-wide absence data
        $companyAbsenceData = $this->getCompanyAbsenceData($currentMonth, $currentYear);

        // Create a comprehensive system message with employee and company-wide data
        return "You are a virtual assistant for Tanzeem HR system. You have full access to the company's database and can provide accurate information about attendance records, leave, and other HR-related data for ALL employees.\n\n" .
            "Current user details: " . json_encode($employeeData) . "\n\n" .
            "Current user's attendance data for $currentMonthName $currentYear: " . json_encode($attendanceData) . "\n\n" .
            "Company-wide statistics for $currentMonthName $currentYear: " . json_encode($companyStats) . "\n\n" .
            "All employees basic information: " . json_encode($allEmployees) . "\n\n" .
            "Company-wide attendance data for $currentMonthName $currentYear: " . json_encode($companyAttendanceData) . "\n\n" .
            "Company-wide absence data for $currentMonthName $currentYear: " . json_encode($companyAbsenceData) . "\n\n" .
            "When answering questions, use ALL the provided data to give accurate responses. You have access to information about ALL employees in the company, not just the current user. If asked about specific employees, company-wide statistics, or trends, provide the information from the database. You can compare employees' performance, attendance patterns, and other metrics across the company.";
    }

    /**
     * Get employee data for context
     */
    private function getEmployeeData($employee)
    {
        return [
            'employee_id' => $employee->id,
            'name' => $employee->name,
            'email' => $employee->email,
            'phone' => $employee->phone,
            'address' => $employee->address,
            'gender' => $employee->gender,
            'dob' => $employee->dob,
            'nationality' => $employee->nationality,
            'position' => $employee->position,
            'nid_number' => $employee->nid_number,
            'joining_date' => $employee->joining_date,
            'salary' => $employee->salary,
            'work_start_time' => $employee->work_start_time,
            'work_end_time' => $employee->work_end_time,
        ];
    }

    /**
     * Get employee attendance data for a specific month
     */
    private function getEmployeeAttendanceData($employeeId, $month, $year)
    {
        try {
            // Get all attendance records for the employee in the specified month
            $attendances = Attendance::where('employee_id', $employeeId)
                ->whereMonth('date', $month)
                ->whereYear('date', $year)
                ->orderBy('date', 'asc')
                ->get();

            // Calculate total days worked
            $totalDaysWorked = $attendances->count();

            // Get list of dates attended
            $datesAttended = $attendances->pluck('date')->map(function ($date) {
                return date('Y-m-d', strtotime($date));
            })->toArray();

            // Calculate total work hours
            $totalWorkHours = 0;
            foreach ($attendances as $attendance) {
                $checkInTime = strtotime($attendance->check_in_time);
                $checkOutTime = strtotime($attendance->check_out_time);

                if ($checkInTime && $checkOutTime) {
                    $hoursWorked = ($checkOutTime - $checkInTime) / 3600; // Convert seconds to hours
                    $totalWorkHours += $hoursWorked;
                }
            }

            // Get the total number of working days in the month (excluding weekends)
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $workingDays = 0;

            for ($day = 1; $day <= $totalDaysInMonth; $day++) {
                $date = "$year-$month-$day";
                $dayOfWeek = date('N', strtotime($date));

                // Assuming 6 and 7 are weekend days (Saturday and Sunday)
                if ($dayOfWeek < 6) {
                    $workingDays++;
                }
            }

            // Calculate absence days (working days - attended days)
            $absenceDays = $workingDays - $totalDaysWorked;
            if ($absenceDays < 0) $absenceDays = 0;

            return [
                'total_days_worked' => $totalDaysWorked,
                'total_working_days' => $workingDays,
                'absence_days' => $absenceDays,
                'attendance_percentage' => $workingDays > 0 ? round(($totalDaysWorked / $workingDays) * 100, 2) : 0,
                'total_work_hours' => round($totalWorkHours, 2),
                'dates_attended' => $datesAttended,
                'month' => $month,
                'year' => $year
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving attendance data', [
                'error' => $e->getMessage(),
                'employee_id' => $employeeId,
                'month' => $month,
                'year' => $year
            ]);

            return [
                'error' => 'Unable to retrieve attendance data',
                'total_days_worked' => 0,
                'total_working_days' => 0,
                'absence_days' => 0,
                'attendance_percentage' => 0,
                'total_work_hours' => 0,
                'dates_attended' => [],
                'month' => $month,
                'year' => $year
            ];
        }
    }

    /**
     * Analyze user query and get additional context from database
     */
    private function getAdditionalContextForQuery($query, $employee)
    {
        $context = [];
        $query = strtolower($query);

        // Extract date information from query
        $dateInfo = $this->extractDateInfoFromQuery($query);
        $month = $dateInfo['month'] ?? date('m');
        $year = $dateInfo['year'] ?? date('Y');
        $monthName = date('F', mktime(0, 0, 0, $month, 1, $year));

        // Check for attendance-related queries
        if (
            strpos($query, 'attendance') !== false ||
            strpos($query, 'present') !== false ||
            strpos($query, 'absent') !== false ||
            strpos($query, 'days worked') !== false ||
            strpos($query, 'attended') !== false
        ) {
            // Get attendance data for the current employee
            $context['employee_attendance_data'] = $this->getEmployeeAttendanceData($employee->id, $month, $year);

            // Get company-wide attendance data
            $context['company_attendance_data'] = $this->getCompanyAttendanceData($month, $year);

            $context['query_period'] = [
                'month' => $month,
                'year' => $year,
                'month_name' => $monthName
            ];
        }

        // Check for leave-related queries
        if (
            strpos($query, 'leave') !== false ||
            strpos($query, 'off') !== false ||
            strpos($query, 'vacation') !== false ||
            strpos($query, 'holiday') !== false ||
            strpos($query, 'absent') !== false
        ) {
            // Get absence data for all employees
            $context['company_absence_data'] = $this->getCompanyAbsenceData($month, $year);

            $context['query_period'] = [
                'month' => $month,
                'year' => $year,
                'month_name' => $monthName
            ];
        }

        // Check for employee-specific queries
        if (
            strpos($query, 'employee') !== false ||
            strpos($query, 'staff') !== false ||
            strpos($query, 'team') !== false ||
            strpos($query, 'who') !== false
        ) {
            // Extract employee name from query if present
            $employeeName = $this->extractEmployeeNameFromQuery($query);

            // Get all employees data
            $context['employees'] = $this->getAllEmployeesBasicInfo();

            // If a specific employee is mentioned, get more details
            if ($employeeName) {
                $specificEmployee = Employee::where('name', 'like', '%' . $employeeName . '%')->first();
                if ($specificEmployee) {
                    $context['specific_employee'] = [
                        'id' => $specificEmployee->id,
                        'name' => $specificEmployee->name,
                        'position' => $specificEmployee->position,
                        'attendance' => $this->getEmployeeAttendanceData($specificEmployee->id, $month, $year)
                    ];
                }
            }
        }

        return $context;
    }

    /**
     * Extract date information from a query
     */
    private function extractDateInfoFromQuery($query)
    {
        $dateInfo = [];

        // Extract month information
        $months = [
            'january' => 1,
            'february' => 2,
            'march' => 3,
            'april' => 4,
            'may' => 5,
            'june' => 6,
            'july' => 7,
            'august' => 8,
            'september' => 9,
            'october' => 10,
            'november' => 11,
            'december' => 12,
            'jan' => 1,
            'feb' => 2,
            'mar' => 3,
            'apr' => 4,
            'jun' => 6,
            'jul' => 7,
            'aug' => 8,
            'sep' => 9,
            'oct' => 10,
            'nov' => 11,
            'dec' => 12
        ];

        foreach ($months as $monthName => $monthNumber) {
            if (strpos($query, $monthName) !== false) {
                $dateInfo['month'] = $monthNumber;
                break;
            }
        }

        // Extract year information
        if (preg_match('/\b(20\d{2})\b/', $query, $matches)) {
            $dateInfo['year'] = $matches[1];
        }

        // Check for relative time references
        if (strpos($query, 'this month') !== false) {
            $dateInfo['month'] = date('m');
            $dateInfo['year'] = date('Y');
        } else if (strpos($query, 'last month') !== false) {
            $lastMonth = date('m') - 1;
            $year = date('Y');
            if ($lastMonth == 0) {
                $lastMonth = 12;
                $year--;
            }
            $dateInfo['month'] = $lastMonth;
            $dateInfo['year'] = $year;
        }

        return $dateInfo;
    }

    /**
     * Extract employee name from a query
     */
    private function extractEmployeeNameFromQuery($query)
    {
        // This is a simple implementation - in a real system, you might use NLP
        // or more sophisticated techniques to extract names

        // Get all employees
        $employees = Employee::all();

        foreach ($employees as $employee) {
            if (strpos(strtolower($query), strtolower($employee->name)) !== false) {
                return $employee->name;
            }
        }

        return null;
    }

    /**
     * Get company-wide statistics for a specific month
     */
    private function getCompanyStatistics($month, $year)
    {
        try {
            // Get all employees
            $employees = Employee::all();
            $totalEmployees = $employees->count();

            // Get attendance data for the month
            $attendances = Attendance::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->get();

            // Calculate total attendance records
            $totalAttendanceRecords = $attendances->count();

            // Calculate average attendance per employee
            $avgAttendancePerEmployee = $totalEmployees > 0 ? round($totalAttendanceRecords / $totalEmployees, 2) : 0;

            // Get unique employees who have attendance records
            $employeesWithAttendance = $attendances->pluck('employee_id')->unique()->count();

            // Calculate percentage of employees with attendance
            $attendancePercentage = $totalEmployees > 0 ? round(($employeesWithAttendance / $totalEmployees) * 100, 2) : 0;

            // Get the total number of working days in the month (excluding weekends)
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $workingDays = 0;

            for ($day = 1; $day <= $totalDaysInMonth; $day++) {
                $date = "$year-$month-$day";
                $dayOfWeek = date('N', strtotime($date));

                // Assuming 6 and 7 are weekend days (Saturday and Sunday)
                if ($dayOfWeek < 6) {
                    $workingDays++;
                }
            }

            return [
                'total_employees' => $totalEmployees,
                'employees_with_attendance' => $employeesWithAttendance,
                'attendance_percentage' => $attendancePercentage,
                'total_attendance_records' => $totalAttendanceRecords,
                'avg_attendance_per_employee' => $avgAttendancePerEmployee,
                'working_days_in_month' => $workingDays,
                'month' => $month,
                'year' => $year,
                'month_name' => date('F', mktime(0, 0, 0, $month, 1, $year))
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving company statistics', [
                'error' => $e->getMessage(),
                'month' => $month,
                'year' => $year
            ]);

            return [
                'error' => 'Unable to retrieve company statistics',
                'total_employees' => 0,
                'employees_with_attendance' => 0,
                'attendance_percentage' => 0,
                'month' => $month,
                'year' => $year
            ];
        }
    }

    /**
     * Get company-wide attendance data for a specific month
     */
    private function getCompanyAttendanceData($month, $year)
    {
        try {
            // Get all attendance records for the specified month
            $attendances = Attendance::whereMonth('date', $month)
                ->whereYear('date', $year)
                ->orderBy('date', 'asc')
                ->get();

            // Group attendance by employee
            $attendanceByEmployee = [];
            foreach ($attendances as $attendance) {
                $employeeId = $attendance->employee_id;
                if (!isset($attendanceByEmployee[$employeeId])) {
                    $employee = Employee::find($employeeId);
                    $attendanceByEmployee[$employeeId] = [
                        'employee_id' => $employeeId,
                        'name' => $employee ? $employee->name : 'Unknown',
                        'position' => $employee ? $employee->position : 'Unknown',
                        'attendance_count' => 0,
                        'dates' => []
                    ];
                }

                $attendanceByEmployee[$employeeId]['attendance_count']++;
                $attendanceByEmployee[$employeeId]['dates'][] = date('Y-m-d', strtotime($attendance->date));
            }

            // Get the total number of working days in the month (excluding weekends)
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $workingDays = 0;

            for ($day = 1; $day <= $totalDaysInMonth; $day++) {
                $date = "$year-$month-$day";
                $dayOfWeek = date('N', strtotime($date));

                // Assuming 6 and 7 are weekend days (Saturday and Sunday)
                if ($dayOfWeek < 6) {
                    $workingDays++;
                }
            }

            // Calculate attendance percentage for each employee
            foreach ($attendanceByEmployee as &$data) {
                $data['attendance_percentage'] = $workingDays > 0 ?
                    round(($data['attendance_count'] / $workingDays) * 100, 2) : 0;
            }

            return [
                'employees' => array_values($attendanceByEmployee),
                'working_days' => $workingDays,
                'month' => $month,
                'year' => $year,
                'month_name' => date('F', mktime(0, 0, 0, $month, 1, $year))
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving company attendance data', [
                'error' => $e->getMessage(),
                'month' => $month,
                'year' => $year
            ]);

            return [
                'error' => 'Unable to retrieve company attendance data',
                'employees' => [],
                'working_days' => 0,
                'month' => $month,
                'year' => $year
            ];
        }
    }

    /**
     * Get company-wide absence data for a specific month
     */
    private function getCompanyAbsenceData($month, $year)
    {
        try {
            // Get all employees
            $employees = Employee::all();

            // Get the total number of working days in the month (excluding weekends)
            $totalDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $workingDays = 0;
            $workingDates = [];

            for ($day = 1; $day <= $totalDaysInMonth; $day++) {
                $date = "$year-$month-$day";
                $dayOfWeek = date('N', strtotime($date));

                // Assuming 6 and 7 are weekend days (Saturday and Sunday)
                if ($dayOfWeek < 6) {
                    $workingDays++;
                    $workingDates[] = $date;
                }
            }

            // Get attendance data for each employee
            $absenceData = [];
            foreach ($employees as $employee) {
                $attendances = Attendance::where('employee_id', $employee->id)
                    ->whereMonth('date', $month)
                    ->whereYear('date', $year)
                    ->get();

                $datesAttended = $attendances->pluck('date')->map(function ($date) {
                    return date('Y-m-d', strtotime($date));
                })->toArray();

                // Calculate absence days
                $absenceDays = $workingDays - count($datesAttended);
                if ($absenceDays < 0) $absenceDays = 0;

                // Calculate absence dates
                $absenceDates = array_diff($workingDates, $datesAttended);

                if ($absenceDays > 0) {
                    $absenceData[] = [
                        'employee_id' => $employee->id,
                        'name' => $employee->name,
                        'position' => $employee->position,
                        'absence_days' => $absenceDays,
                        'absence_percentage' => $workingDays > 0 ? round(($absenceDays / $workingDays) * 100, 2) : 0,
                        'absence_dates' => array_values($absenceDates)
                    ];
                }
            }

            // Sort by absence days (highest first)
            usort($absenceData, function ($a, $b) {
                return $b['absence_days'] - $a['absence_days'];
            });

            return [
                'employees' => $absenceData,
                'working_days' => $workingDays,
                'month' => $month,
                'year' => $year,
                'month_name' => date('F', mktime(0, 0, 0, $month, 1, $year))
            ];
        } catch (\Exception $e) {
            Log::error('Error retrieving company absence data', [
                'error' => $e->getMessage(),
                'month' => $month,
                'year' => $year
            ]);

            return [
                'error' => 'Unable to retrieve company absence data',
                'employees' => [],
                'working_days' => 0,
                'month' => $month,
                'year' => $year
            ];
        }
    }

    /**
     * Get basic information about all employees
     */
    private function getAllEmployeesBasicInfo()
    {
        try {
            $employees = Employee::all();
            $employeeData = [];

            foreach ($employees as $employee) {
                $employeeData[] = [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'position' => $employee->position,
                    'email' => $employee->email,
                    'phone' => $employee->phone,
                    'address' => $employee->address,
                    'gender' => $employee->gender,
                    'nationality' => $employee->nationality,
                    'salary' => $employee->salary,
                    'joining_date' => $employee->joining_date,
                    'work_start_time' => $employee->work_start_time,
                    'work_end_time' => $employee->work_end_time
                ];
            }

            return $employeeData;
        } catch (\Exception $e) {
            Log::error('Error retrieving all employees data', [
                'error' => $e->getMessage()
            ]);

            return [];
        }
    }
}
