<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = Attendance::with('employee');

        if ($request->has('name') && !empty($request->name)) {
            $query->whereHas('employee', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        if ($request->has('start_date') && $request->start_date != '') {
            $query->where('date', '>=', $request->start_date);
        }


        if ($request->has('end_date') && $request->end_date != '') {
            $query->where('date', '<=', $request->end_date);
        }

        $attendances = $query->paginate(4);
        $employees = Employee::all();

        return view('attendance.index', compact('attendances', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'check_in_time' => 'required',
            'check_out_time' => 'required',
        ]);

        Attendance::create([
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'check_in_time' => $request->check_in_time,
            'check_out_time' => $request->check_out_time,
        ]);

        return redirect()->route('attendance.index')->with('success', 'تمت إضافة الحضور بنجاح');
    }

    public function update(Request $request, $id)
{
    $attendance = Attendance::find($id);

    if ($attendance) {
        $attendance->employee_id = $request->input('employee_id');
        $attendance->date = $request->input('date');
        $attendance->check_in_time = $request->input('check_in_time');
        $attendance->check_out_time = $request->input('check_out_time');

        $attendance->save();

        return redirect()->route('attendance.index');
    }

    return redirect()->route('attendance.index')->withErrors('Attendance not found');
}
public function destroy($id)
    {
        $attendance = Attendance::find($id);

        if (!$attendance) {
            return redirect()->back()->with('error', 'السجل غير موجود');
        }

        $attendance->delete();

        return redirect()->back()->with('success', 'تم حذف السجل بنجاح');
    }

}
