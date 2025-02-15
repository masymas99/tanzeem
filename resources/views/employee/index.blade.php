<x-layout title="قائمة الموظفين">
    <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">قائمة الموظفين</h1>


    <div class="flex flex-col items-center justify-center">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8 w-full">
            <div class="py-4 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow-lg overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200" dir="rtl">
                        <thead class="bg-gradient-to-r from-green-400 to-purple-500 text-white border-b border-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider">
                                    الإسم
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    البريد الإلكتروني
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    رقم الهاتف
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    العنوان
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    الراتب
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    الجنس
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    تاريخ الميلاد
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    رقم الهوية الوطنية
                                </th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-bold text-white uppercase tracking-wider">
                                    الجنسية
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="">تعديل</span>
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="">حذف</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($employees as $employee)
                            <tr class="hover:bg-gray-100 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->phone }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->address }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->salary }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->gender }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->dob }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->nid_number }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $employee->nationality }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="text-indigo-600 hover:text-indigo-900">تعديل</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">حذف</button>
                                    </form>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8 flex justify-center">
        <div class="flex items-center">
            {{ $employees->links() }}
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        <a href="{{ route('employees.create') }}">
            <button class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                إضافة موظف
            </button>
        </a>
    </div>

</x-layout>

