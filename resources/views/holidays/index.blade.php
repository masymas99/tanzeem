


    <x-layout title="Employee">
        <div class="container">
            <h1 class="mt-5 text-center">الإجازات الرسمية</h1>
            <div class="d-flex justify-content-between mb-3">
                <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addHolidayModal">
                    إضافة إجازة رسمية
                </button>
                <button class="btn btn-custom" onclick="window.print()">طباعة</button>
            </div>

            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>اسم الإجازة</th>
                        <th>تاريخ الإجازة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($holidays as $holiday)
                        <tr>
                            <td>{{ $holiday->name }}</td>
                            <td>{{ $holiday->date }}</td>
                            <td>
                                <button class="btn btn-info btn-sm btn-custom" data-bs-toggle="modal"
                                    data-bs-target="#editHolidayModal{{ $holiday->id }}">
                                    تعديل
                                </button>
                                <form action="{{ route('holidays.destroy', $holiday->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm btn-custom">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item {{ $holidays->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $holidays->previousPageUrl() }}" aria-label="Previous">
                                <span aria-hidden="true">&laquo; السابق</span>
                            </a>
                        </li>

                        @for ($i = 1; $i <= $holidays->lastPage(); $i++)
                            <li class="page-item {{ $holidays->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $holidays->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor

                        <li class="page-item {{ $holidays->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $holidays->nextPageUrl() }}" aria-label="Next">
                                <span aria-hidden="true">التالي &raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- الاضافة  -->
            <div class="modal fade" id="addHolidayModal" tabindex="-1" aria-labelledby="addHolidayModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addHolidayModalLabel">إضافة إجازة رسمية</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('holidays.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">اسم الإجازة</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="date">تاريخ الإجازة</label>
                                    <input type="date" class="form-control" id="date" name="date" required>
                                </div>
                                <button type="submit" class="btn btn-custom mt-3">حفظ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!--   التعديل  -->
            @foreach ($holidays as $holiday)
                <div class="modal fade" id="editHolidayModal{{ $holiday->id }}" tabindex="-1"
                    aria-labelledby="editHolidayModalLabel{{ $holiday->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editHolidayModalLabel{{ $holiday->id }}">تعديل الإجازة
                                    الرسمية</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('holidays.update', $holiday->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">اسم الإجازة</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $holiday->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date">تاريخ الإجازة</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            value="{{ $holiday->date }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-custom mt-3">تحديث</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </x-layout>
<style>
    :root {
        --primary-color: rgba(186, 93, 207, 1);
        --secondary-color: rgba(106, 93, 207, 1);
    }

    body {
        font-family: 'Cairo', 'Arial', sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        padding: 2rem;
    }

    h1 {
        color: var(--primary-color);
        font-weight: bold;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 50%;
        transform: translateX(50%);
        width: 100px;
        height: 3px;
        background: linear-gradient(to left, var(--primary-color), var(--secondary-color));
    }

    .table {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
    }

    .table th {
        font-weight: 600;
        padding: 1rem;
        text-align: center;
        border: none;
    }

    .table td {
        padding: 1rem;
        text-align: center;
        border-color: #eee;
        vertical-align: middle;
    }

    .btn-custom {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 25px;
        transition: all 0.3s ease;
    }

    .btn-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(186, 93, 207, 0.3);
    }

    .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        border: none;
        flex-direction: row-reverse;
    }

    .modal-header .btn-close {
        margin: 0 !important;
        padding: 0.5rem !important;
        position: relative;
        right: auto;
        left: 0;
    }

    .modal-title {
        margin: 0 !important;
        font-weight: bold;
        color: white;
        flex-grow: 1;
        text-align: center;
    }

    .btn-close {
        background-color: transparent;
        opacity: 1;
        filter: brightness(0) invert(1);
        padding: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-close:hover {
        transform: rotate(90deg);
        opacity: 0.8;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem;
        margin: 0.5rem 0;
        border: 1px solid #ddd;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(186, 93, 207, 0.25);
    }

    .pagination {
        margin-top: 2rem;
    }

    .pagination .page-item .page-link {
        color: var(--primary-color);
        border-radius: 12px;
        margin: 0 5px;
        min-width: 100px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        transition: all 0.3s ease;
        background: white;
        position: relative;
        overflow: hidden;
        border: 2px solid var(--primary-color);
    }

    .pagination .page-item .page-link:hover {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(186, 93, 207, 0.3);
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
        color: white;
        font-weight: bold;
        min-width: 120px;
        border: none;
        position: relative;
        z-index: 1;
    }

    .pagination .page-item.disabled .page-link {
        background: #f0f0f0;
        color: #999;
        border: none;
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .btn-info {
        background-color: var(--secondary-color);
        border: none;
        color: white;
    }

    .btn-warning {
        background-color: var(--primary-color);
        border: none;
        color: white;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: white;
    }

    @media (max-width: 768px) {
        .container {
            padding: 1rem;
        }

        .table {
            font-size: 0.9rem;
        }

        .btn-custom {
            padding: 0.4rem 1rem;
            font-size: 0.9rem;
        }

        .pagination .page-item .page-link {
            min-width: 80px;
            font-size: 0.9rem;
            margin: 0 3px;
        }

        .pagination .page-item:first-child .page-link,
        .pagination .page-item:last-child .page-link {
            min-width: 100px;
        }
    }

