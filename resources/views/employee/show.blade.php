<x-layout title="تفاصيل الموظف">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">تفاصيل الموظف</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">المعلومات الشخصية</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الإسم</span>
                                <span class="font-medium text-gray-900">{{ $employee->name }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">البريد الإلكتروني</span>
                                <span class="font-medium text-gray-900">{{ $employee->email }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">رقم الهاتف</span>
                                <span class="font-medium text-gray-900">{{ $employee->phone }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">العنوان</span>
                                <span class="font-medium text-gray-900">{{ $employee->address }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الجنس</span>
                                <span class="font-medium text-gray-900">{{ $employee->gender }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">تاريخ الميلاد</span>
                                <span class="font-medium text-gray-900">{{ $employee->dob }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">معلومات العمل</h2>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الوظيفة</span>
                                <span class="font-medium text-gray-900">{{ $employee->position }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الراتب</span>
                                <span class="font-medium text-gray-900">{{ $employee->salary }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">رقم الهوية الوطنية</span>
                                <span class="font-medium text-gray-900">{{ $employee->nid_number }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">الجنسية</span>
                                <span class="font-medium text-gray-900">{{ $employee->nationality }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">تاريخ الانضمام</span>
                                <span class="font-medium text-gray-900">{{ $employee->joining_date }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Work Schedule -->
                    <div class="col-span-2 bg-gray-50 p-6 rounded-lg">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">جدول العمل</h2>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">وقت بداية العمل</span>
                            <span class="font-medium text-gray-900">{{ $employee->work_start_time }}</span>
                        </div>
                        <div class="flex justify-between items-center mt-4">
                            <span class="text-gray-600">وقت نهاية العمل</span>
                            <span class="font-medium text-gray-900">{{ $employee->work_end_time }}</span>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex justify-end gap-4">
                    <a href="{{ route('employees.edit', $employee->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        تعديل
                    </a>
                    <a href="{{ route('employees.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>