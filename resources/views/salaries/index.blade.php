<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>سجل المرتبات</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    body {
      font-family: 'Cairo', sans-serif;
    }
    .table th {
      background-color: #9b59b6;
      color: white;
      text-align: center;
      vertical-align: middle;
    }
    .table td {
      text-align: center;
      vertical-align: middle;
      background-color: #f2f2f2 !important;
    }
    .btn-search {
      background-color: #6c5ce7;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 30px;
      transition: 0.3s;
    }
    .btn-search:hover {
      background-color: #5a4ec7;
    }
  </style>
</head>
<body>
  <x-layout title="salaries">
    <div class="container mt-4">
      <!-- نموذج الفلاتر -->
      <form method="GET" action="{{ route('salaries.index') }}" class="mb-4">
        <div class="row g-3 align-items-end justify-content-center">
          <div class="col-md-4">
            <select name="employee_id" class="form-control">
              <option value="">اختر الموظف</option>
              @foreach ($employeeNames as $id => $name)
                <option value="{{ $id }}" {{ request('employee_id') == $id ? 'selected' : '' }}>
                  {{ $name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3">
            <label class="form-label">من</label>
            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">إلى</label>
            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
          </div>
          <div class="col-md-1 text-center">
            <button type="submit" class="btn btn-search"><i class="bi bi-search"></i></button>
          </div>
        </div>
      </form>
      
      <table class="table table-bordered mt-3">
        <thead>
          <tr>
            <th>العمليات</th>
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
          @if($salaries->count() > 0)
            @foreach ($salaries as $salary)
              <tr>
                <td>
                  <a href="#" class="text-dark mx-2 edit-icon" data-bs-toggle="modal" data-bs-target="#editSalaryModal{{ $salary->id }}">
                    <i class="bi bi-pencil"></i>
                  </a>
                  <a href="{{ route('salaries.print', $salary->id) }}" class="text-dark mx-2" style="font-size: 1.5rem">
                    <i class="bi bi-printer"></i>
                  </a>
                </td>
                <td>{{ optional($salary->employee)->name ?? 'غير متوفر' }}</td>
                <td>{{ $salary->total_attendance }}</td>
                <td>{{ $salary->total_absence }}</td>
                <td>{{ $salary->total_overtime_hours }}</td>
                <td>{{ $salary->total_deduction_hours }}</td>
                <td>{{ $salary->total_overtime }}</td>
                <td>{{ $salary->total_deduction }}</td>
                <td>{{ $salary->net_salary }}</td>
              </tr>
              
              <!-- مودال تعديل المرتب لكل سجل -->
              <div class="modal fade" id="editSalaryModal{{ $salary->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">تعديل المرتب</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ route('salaries.update', $salary->id) }}">
                        @csrf
                        @method('PUT')
                        <label class="form-label">عدد أيام الحضور</label>
                        <input type="number" name="total_attendance" class="form-control mb-2" value="{{ $salary->total_attendance }}" required>
                        
                        <label class="form-label">عدد أيام الغياب</label>
                        <input type="number" name="total_absence" class="form-control mb-2" value="{{ $salary->total_absence }}" required>
                        
                        <label class="form-label">الإضافي بالساعات</label>
                        <input type="number" name="total_overtime_hours" class="form-control mb-2" value="{{ $salary->total_overtime_hours }}" step="0.01" required>
                        
                        <label class="form-label">الخصم بالساعات</label>
                        <input type="number" name="total_deduction_hours" class="form-control mb-2" value="{{ $salary->total_deduction_hours }}" step="0.01" required>
                        
                        <label class="form-label">إجمالي الإضافي</label>
                        <input type="number" name="total_overtime" class="form-control mb-2" value="{{ $salary->total_overtime }}" step="0.01" required>
                        
                        <label class="form-label">إجمالي الخصم</label>
                        <input type="number" name="total_deduction" class="form-control mb-2" value="{{ $salary->total_deduction }}" step="0.01" required>
                        
                        <label class="form-label">الصافي</label>
                        <input type="number" name="net_salary" class="form-control mb-2" value="{{ $salary->net_salary }}" step="0.01" required>
                        
                        <button type="submit" class="btn btn-search w-100 mt-3">تعديل</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <tr>
              <td colspan="9" class="text-center text-danger">لا توجد بيانات لعرضها</td>
            </tr>
          @endif
        </tbody>
      </table>
      
      <div class="d-flex justify-content-center">
        {{ $salaries->links() }}
      </div>
    </div>
  </x-layout>
</body>
</html>
