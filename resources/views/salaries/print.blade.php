<!--
@extends('layouts.app')

@section('content')
    <h2>تقرير راتب الموظف</h2>

    <table border="1">
        <tr>
            <td>اسم الموظف:</td>
            <td>{{ $salary->employee->name }}</td>
        </tr>
        <tr>
            <td>الراتب الأساسي:</td>
            <td>{{ $salary->basic_salary }}</td>
        </tr>
        <tr>
            <td>عدد أيام الحضور:</td>
            <td>{{ $salary->attendance_days }}</td>
        </tr>
        <tr>
            <td>عدد أيام الغياب:</td>
            <td>{{ $salary->absent_days }}</td>
        </tr>
        <tr>
            <td>الإضافي:</td>
            <td>{{ $salary->overtime }}</td>
        </tr>
        <tr>
            <td>الخصم:</td>
            <td>{{ $salary->deductions }}</td>
        </tr>
        <tr>
            <td>الصافي:</td>
            <td>{{ $salary->net_salary }}</td>
        </tr>
    </table>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
@endsection
