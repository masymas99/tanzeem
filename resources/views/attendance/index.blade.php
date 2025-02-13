<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سجل الحضور</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <x-layout title="attendance">
    <style>
        body{
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
        .btn-search, .btn-add {
            background-color: #6c5ce7;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 30px;
            width: 70px;
            transition: 0.3s;
        }
        .btn-add{
            width: 150px;
            font-weight: bold;
        }
        .btn-search:hover, .btn-add:hover {
            background-color: #5a4ec7;
        }
        .pagination-arrows {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }
        .btn-outline-dark:hover {
            background-color: #6c5ce7;
            color: white;
        }
        .btn-add {
            display: block;
            margin: 10px auto;
        }
        .filter-container {
            display: flex;
            justify-content: center;
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
.delete-icon:hover i {
        color:rgb(171, 21, 21);
    }
    .edit-icon:hover i , .icon-print:hover i {
        color: #6c5ce7;
    }
@media print {
        body * {
            visibility: hidden;
        }
        .printable, .printable * {
            visibility: visible;
        }
        .printable {
            position: absolute;
            top: 0;
            left: 0;
        }
    }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="filter-container">
            <form method="GET" action="{{ route('attendance.index') }}" class="mb-5 w-75">
                <div class="row g-3 align-items-end justify-content-center">
                <div class="col-md-1 text-center">
                    <a href="#" class="text-dark icon-print" style="font-size: 1.5rem;" onclick="window.print(); return false;">
                        <i class="bi bi-printer"></i>
                    </a>
                </div>
        
                    <div class="col-md-4">
                        <input type="text" name="name" class="form-control search-input" placeholder="ابحث باسم الموظف" value="{{ request('name') }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-center date-input">
                      
                       <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                       <label for="end_date" class="form-label">إلى</label>
                        </div>
                    <div class="col-md-3 d-flex align-items-center date-input">
                      
                     <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                     <label for="start_date" class="form-label">من</label>
                        </div>

                    <div class="col-md-1 text-center">
                        <button type="submit" class="btn btn-search"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </form>
        </div>

        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addAttendanceModal">إضافة حضور</button>
        <table class="table table-bordered mt-3 printable">
            <thead>
                <tr>
                    <th>العمليات</th>
                    <th>التاريخ</th>
                    <th>وقت الانصراف</th>
                    <th>وقت الحضور</th>
                    <th>الاسم</th>
                    <th>مسلسل</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $index => $attendance)
                    <tr>
            <td>
    <a href="#" class="text-dark mx-2 delete-icon" style="font-size: 1.5rem"
       data-bs-toggle="modal" data-bs-target="#deleteAttendanceModal{{ $attendance->id }}"><i class="bi bi-trash"></i></a>
    <a href="#" class="text-dark mx-2 edit-icon" style="font-size: 1.5rem" 
       data-bs-toggle="modal" data-bs-target="#editAttendanceModal{{ $attendance->id }}"><i class="bi bi-pencil"></i></a>
    
</td>

                        <td>{{ $attendance->date }}</td>
                        <td>{{ $attendance->check_out_time }}</td>
                        <td>{{ $attendance->check_in_time }}</td>
                        <td>{{ $attendance->employee->name }}</td>
                        <td>{{ ($attendances->currentPage() - 1) * $attendances->perPage() + $loop->iteration }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-arrows">
       @if ($attendances->hasMorePages())
        <a href="{{ $attendances->appends(request()->query())->nextPageUrl() }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left-circle"></i> التالي
        </a>
       @else
        <button class="btn btn-outline-dark" disabled>
            <i class="bi bi-arrow-left-circle"></i> التالي
        </button>
        @endif

      <span>صفحة {{ $attendances->currentPage() }} من {{ $attendances->lastPage() }}</span>

      @if ($attendances->onFirstPage())
        <button class="btn btn-outline-dark" disabled>
            <i class="bi bi-arrow-right-circle"></i> السابق
        </button>
      @else
        <a href="{{ $attendances->appends(request()->query())->previousPageUrl() }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-right-circle"></i> السابق
        </a>
      @endif
   </div>
<div class="modal fade" id="addAttendanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center w-100">
                <h5 class="modal-title mx-auto">إضافة حضور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('attendance.store') }}">
                    @csrf
                    <label>اسم الموظف</label>
                    <select name="employee_id" class="form-select mb-2">
                        <option value="">اختر الموظف</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    
                    <label>التاريخ</label>
                    <input type="date" name="date" class="form-control mb-2" required>
                    
                    <label>وقت الحضور</label>
                    <input type="time" name="check_in_time" class="form-control mb-2" required>
                    
                    <label>وقت الانصراف</label>
                    <input type="time" name="check_out_time" class="form-control mb-2" required>
                    
                    <button type="submit" class="btn btn-search w-100 mt-3">إضافة</button>
                </form>
            </div>
        </div>
    </div>

</div>

@foreach($attendances as $attendance)
<div class="modal fade" id="deleteAttendanceModal{{ $attendance->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف هذا الحضور؟
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form method="POST" action="{{ route('attendance.destroy', $attendance->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">حذف</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ($attendances as $attendance)
<div class="modal fade" id="editAttendanceModal{{ $attendance->id }}" tabindex="-1" aria-labelledby="editAttendanceModalLabel{{ $attendance->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAttendanceModalLabel{{ $attendance->id }}">تعديل الحضور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('attendance.update', $attendance->id) }}">
                    @csrf
                    @method('PUT')

                    <label>اسم الموظف</label>
                    <select name="employee_id" class="form-select mb-2" required>
                        <option value="">اختر الموظف</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ $attendance->employee_id == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>

                    <label>التاريخ</label>
                    <input type="date" name="date" class="form-control mb-2" value="{{ $attendance->date }}" required>

                    <label>وقت الحضور</label>
                    <input type="time" name="check_in_time" class="form-control mb-2" value="{{ $attendance->check_in_time }}" required>

                    <label>وقت الانصراف</label>
                    <input type="time" name="check_out_time" class="form-control mb-2" value="{{ $attendance->check_out_time }}" required>

                    <button type="submit" class="btn btn-search w-100 mt-3">تعديل</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

</body>
</html>
</x-layout>