@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">تقرير الرواتب</h2>

    <table class="table table-bordered text-center">
        <thead class="table-dark">
            <tr>
                <th>اسم الموظف</th>
                <th>عدد أيام الحضور</th>
                <th>عدد أيام الغياب</th>
                <th>الإضافي بالساعات</th>
                <th>الخصم بالساعات</th>
                <th>إجمالي الإضافي</th>
                <th>إجمالي الخصم</th>
                <th>الصافي</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salaries as $salary)
                <tr>
                    <td>{{ $salary->employee->name }}</td>
                    <td>{{ $salary->total_attendance }}</td>
                    <td>{{ $salary->total_absence }}</td>
                    <td>{{ $salary->total_overtime_hours }}</td>
                    <td>{{ $salary->total_deduction_hours }}</td>
                    <td>{{ $salary->total_overtime }}</td>
                    <td>{{ $salary->total_deduction }}</td>
                    <td><strong>{{ $salary->net_salary }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
