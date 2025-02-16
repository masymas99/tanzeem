<<<<<<< HEAD
<x-layout title="Weekly Holidays">
    <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">Weekly Holidays</h1>
    <!-- #region -->
    <div class="d-flex flex-column align-items-center  justify-content-center">
        <form action="{{ route('weeklyHolidays.store') }}" method="POST">
            @csrf
            <div class=" d-flex  mb-3 text-right">
                <label for="day" class="form-label">Day</label>
                <select id="day" name="day" class="form-select @error('day') is-invalid @enderror" required>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                </select>
                @error('day')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

            </div>
            <button type="submit" class="d-flex align-self-center btn btn-primary mt-3">Save</button>

        </form>
    </div>
=======
<x-layout title="إضافة إجازة">
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>إضافة إجازة جديدة</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('weeklyHolidays.store') }}" method="POST">
        @csrf
        <label for="day" class="form-label">اختر يوم الإجازة:</label>
        <select name="day" id="day" class="form-control mb-3">
            <option value="السبت">السبت</option>
            <option value="الأحد">الأحد</option>
            <option value="الإثنين">الإثنين</option>
            <option value="الثلاثاء">الثلاثاء</option>
            <option value="الأربعاء">الأربعاء</option>
            <option value="الخميس">الخميس</option>
            <option value="الجمعة">الجمعة</option>
        </select>
        <button type="submit" class="btn btn-success">إضافة</button>
        <a href="{{ route('weeklyHolidays.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
</x-layout>
