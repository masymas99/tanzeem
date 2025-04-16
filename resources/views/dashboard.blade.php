<x-layout title="لوحة التحكم">
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            لوحة التحكم
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Employees Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">إجمالي الموظفين</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ $stats['totalEmployees'] }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Salaries Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-orange-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">المرتبات الأساسية</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['basicSalaries'] ?? 0) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Salaries Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">المرتبات لهذا الشهر</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['totalSalaries']) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yearly Salaries Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">إجمالي المرتبات للسنة</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['yearlySalaries']) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Deductions Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">إجمالي الخصومات</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['totalDeductions']) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Yearly Deductions Card -->
                <div class="bg-gradient-to-br from-white to-gray-50 shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-yellow-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">إجمالي الخصومات للسنة</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-3xl font-bold text-gray-900">{{ number_format($stats['yearlyDeductions']) }}</div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Attendance Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Most Present Employee -->
                <div class="bg-gradient-to-br from-green-50 to-white shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">أكثر الموظفين حضوراً</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-bold text-green-700">
                                            @if($stats['mostPresent'])
                                                {{ $stats['mostPresent']->employee->name }}
                                                <span class="text-base text-gray-600">({{ $stats['mostPresent']->attendance_count }} يوم)</span>
                                            @else
                                                لا يوجد بيانات
                                            @endif
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Absent Employee -->
                <div class="bg-gradient-to-br from-red-50 to-white shadow-lg rounded-2xl overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-red-100 p-3 rounded-full">
                                <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="mr-5 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-600">أكثر الموظفين غياباً</dt>
                                    <dd class="flex items-baseline">
                                        <div class="text-2xl font-bold text-red-700">
                                            @if($stats['mostAbsent'])
                                                {{ $stats['mostAbsent']->employee->name }}
                                                <span class="text-base text-gray-600">({{ $stats['mostAbsent']->absence_count }} يوم)</span>
                                            @else
                                                لا يوجد بيانات
                                            @endif
                                        </div>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Monthly Attendance Stats -->
            <div class="bg-white shadow-2xl rounded-2xl overflow-hidden mt-8">
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">إحصائيات الحضور الشهرية</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-green-50 to-white p-6 rounded-xl shadow-sm">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">الحضور</h4>
                            <p class="text-3xl font-bold text-green-700">{{ $stats['presentCount'] }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-red-50 to-white p-6 rounded-xl shadow-sm">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">الغياب</h4>
                            <p class="text-3xl font-bold text-red-700">{{ $stats['absentCount'] }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-yellow-50 to-white p-6 rounded-xl shadow-sm">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">التأخير</h4>
                            <p class="text-3xl font-bold text-yellow-700">{{ $stats['lateCount'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
