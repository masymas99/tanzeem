<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>سجل المرتبات</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
  <x-layout title="salaries">
    <div class="container mt-2">
   
      <div class="filter-container">
        <form method="GET" action="{{ route('salaries.index') }}" class="mb-5 w-75">
          <div class="row g-3 align-items-end justify-content-center">
            <div class="col-md-1 text-center">
             
              <a href="#" class="text-dark icon-print" style="font-size: 1.5rem;" onclick="window.print(); return false;">
                <i class="bi bi-printer"></i>
              </a>
            </div>
            <div class="col-md-3">
              <select name="employee_id" class="form-select">
                <option value="">اختر الموظف</option>
                @foreach ($employeeNames as $id => $name)
                  <option value="{{ $id }}" {{ request('employee_id') == $id ? 'selected' : '' }}>
                    {{ $name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-2">
              <select name="month" class="form-select">
                <option value="">اختر الشهر</option>
                @for ($i = 1; $i <= 12; $i++)
                  <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $i, 1)) }}
                  </option>
                @endfor
              </select>
            </div>
            <div class="col-md-2">
              <select name="year" class="form-select">
                <option value="">اختر السنة</option>
                @for ($i = date('Y'); $i >= date('Y')-5; $i--)
                  <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>
                    {{ $i }}
                  </option>
                @endfor
              </select>
            </div>
            <div class="col-md-1 text-center">
              <button type="submit" class="btn btn-search">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>

      <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addSalaryModal">إضافة مرتب</button>

      <table class="table table-bordered mt-3 printable">
        <thead>
          <tr>
            <th>العمليات</th>
            <th>اسم الموظف</th>
            <th>الشهر</th>
            <th>السنة</th>
            <th>عدد أيام الحضور</th>
            <th>عدد أيام الغياب</th>
            <th>الإضافي</th>
            <th>الخصم</th>
            <th>الصافي</th>
          </tr>
        </thead>
        <tbody>
          @if($salaries->count() > 0)
            @foreach ($salaries as $salary)
              <tr>
                <td>
                 
                  <a href="#" class="text-dark mx-2 edit-icon" data-bs-toggle="modal" data-bs-target="#editSalaryModal{{ $salary->id }}" style="font-size: 1.5rem;">
                    <i class="bi bi-pencil"></i>
                  </a>
                 
                  <a href="#" class="text-dark mx-2 icon-print" style="font-size: 1.5rem;" onclick="window.print(); return false;">
                    <i class="bi bi-printer"></i>
                  </a>
                </td>
                <td>{{ optional($salary->employee)->name ?? 'غير متوفر' }}</td>
                <td>{{ $salary->month }}</td>
                <td>{{ $salary->year }}</td>
                <td>{{ $salary->total_attendance }}</td>
                <td>{{ $salary->total_absence }}</td>
                <td>{{ $salary->total_overtime }}</td>
                <td>{{ $salary->total_deduction }}</td>
                <td>{{ $salary->net_salary }}</td>
              </tr>

              
              <div class="modal fade" id="editSalaryModal{{ $salary->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content modal-custom">
                    <div class="modal-header">
                      <h5 class="modal-title">تعديل المرتب</h5>
                      <button type="button" class="btn-close custom-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST" action="{{ route('salaries.update', $salary->id) }}">
                        @csrf
                        @method('PUT')
                        <label class="form-label">عدد أيام الحضور</label>
                        <input type="number" name="total_attendance" class="form-control mb-2" value="{{ $salary->total_attendance }}" required>
                        <label class="form-label">عدد أيام الغياب</label>
                        <input type="number" name="total_absence" class="form-control mb-2" value="{{ $salary->total_absence }}" required>
                        <label class="form-label">الإضافي</label>
                        <input type="number" name="total_overtime" class="form-control mb-2" value="{{ $salary->total_overtime }}" step="0.01" readonly required>
                        <label class="form-label">الخصم</label>
                        <input type="number" name="total_deduction" class="form-control mb-2" value="{{ $salary->total_deduction }}" step="0.01" readonly required>
                        <label class="form-label">الصافي</label>
                        <input type="number" name="net_salary" class="form-control mb-2" value="{{ $salary->net_salary }}" step="0.01" readonly required>
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

       <!--سابق والتالي -->
      <div class="pagination-custom">
        
        @if ($salaries->hasMorePages())
          <a class="btn btn-outline-dark" href="{{ $salaries->nextPageUrl() }}">التالي</a>
        @else
          <button class="btn btn-outline-dark" disabled>التالي</button>
        @endif
        @if ($salaries->onFirstPage())
          <button class="btn btn-outline-dark" disabled>السابق</button>
        @else
          <a class="btn btn-outline-dark" href="{{ $salaries->previousPageUrl() }}">السابق</a>
        @endif
      </div>
      
      
      <!-- مودال إضافة مرتب -->
      <div class="modal fade" id="addSalaryModal" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content modal-custom">
            <div class="modal-header">
              <h5 class="modal-title">إضافة مرتب</h5>
              <button type="button" class="btn-close custom-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('salaries.store') }}">
                @csrf
                <label class="form-label">الموظف</label>
                <select name="employee_id" class="form-select mb-2" required>
                  <option value="" disabled selected>اختر الموظف</option>
                  @foreach ($employeeNames as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                  @endforeach
                </select>
                <label class="form-label">الشهر</label>
                <select name="month" class="form-select mb-2" required>
                  <option value="" disabled selected>اختر الشهر</option>
                  @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}">{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                  @endfor
                </select>
                <label class="form-label">السنة</label>
                <select name="year" class="form-select mb-2" required>
                  <option value="" disabled selected>اختر السنة</option>
                  @for ($i = date('Y'); $i >= date('Y')-5; $i--)
                    <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
                <label class="form-label">عدد أيام الحضور</label>
                <input type="number" name="total_attendance" class="form-control mb-2" required>
                <label class="form-label">عدد أيام الغياب</label>
                <input type="number" name="total_absence" class="form-control mb-2" required>
                <label class="form-label">الإضافي</label>
                <input type="number" name="total_overtime" class="form-control mb-2" step="0.01" readonly required>
                <label class="form-label">الخصم</label>
                <input type="number" name="total_deduction" class="form-control mb-2" step="0.01" readonly required>
                <label class="form-label">الصافي</label>
                <input type="number" name="net_salary" class="form-control mb-2" step="0.01" readonly required>
                <button type="submit" class="btn btn-search w-100 mt-3">إضافة</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-layout>


  <style>
    body {
      font-family: 'Cairo', sans-serif;
    }
    .table {
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      background-color: white;
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
    }
    .table tbody tr:hover td {
      background-color: rgb(233, 231, 240) !important;
      transition: background-color 0.3s ease-in-out;
    }
    .btn-search,
    .btn-add {
      background-color: #6c5ce7;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 30px;
      transition: 0.3s;
    }
    .btn-search:hover,
    .btn-add:hover {
      background-color: #5a4ec7;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .btn-add {
      display: block;
      margin: 10px auto;
      width: 150px;
      font-weight: bold;
    }
    .pagination-arrows {
      display: flex;
      justify-content: center;
      gap: 15px;
      margin-top: 20px;
    }
    .btn-outline-dark {
      background-color: #6c5ce7;
      border-radius: 30px;
      color: white;
      width: 100px;
      border: none;
    }
    .btn-outline-dark:hover {
      background-color: #6c5ce7;
      transform: scale(1.1);
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }
    .btn-outline-dark:disabled {
      background-color: #d3d3d3 !important;
    }
    .filter-container {
      display: flex;
      justify-content: center;
    }
    .form-control,
    .form-select {
      border-radius: 30px;
    }
    .form-control[name="name"] {
      background-color: #e9ecef;
      border: none;
    }
    .date-input {
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .date-input label {
      margin-bottom: 0;
      margin-right: 5px;
    }
    .date-input input {
      flex: 1;
    }
    .delete-icon i,
    .edit-icon i,
    .icon-print i {
      display: inline-block;
      transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
    }
    .delete-icon:hover i {
      color: rgb(171, 21, 21);
      transform: scale(1.2);
    }
    .edit-icon:hover i,
    .icon-print:hover i {
      color: rgb(88, 71, 216);
      transform: scale(1.3);
    }
    .custom-input:focus {
      border-color: #6c5ce7 !important;
      box-shadow: 0 0 5px rgba(108, 92, 231, 0.8) !important;
    }
    .modal-custom {
      padding: 0;
      border: none;
      border-radius: 25px;
      overflow: hidden;
    }
    .modal-custom .modal-header {
      background-color: #6c5ce7;
      color: white;
      text-align: center;
      width: 100%;
    }
    .modal-custom .modal-title {
      font-weight: bold;
      width: 100%;
      text-align: center;
    }
    .custom-close {
      width: 35px;
      height: 30px;
      filter: invert(1);
      opacity: 1;
      box-shadow: none;
      outline: none;
      border: none;
      border-radius: 10px;
      font-size: 15px;
      padding: 12px;
      background-color: transparent;
    }
    .custom-close:hover {
      filter: invert(0);
      box-shadow: 0 0 15px rgba(137, 125, 229, 0.6);
      background-color: rgb(137, 125, 229);
    }
    @media print {
      body * {
        visibility: hidden;
      }
      .printable,
      .printable * {
        visibility: visible;
      }
      .printable {
        position: absolute;
        top: 0;
        left: 0;
      }
     
      .printable th:first-child,
      .printable td:first-child {
        display: none;
      }
    }
  </style>
</body>
</html>
