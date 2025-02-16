<x-layout title="تعديل الإجازة">
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تعديل الإجازة</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('weeklyHolidays.update', ['weeklyHoliday' => $weeklyHoliday->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="day" class="form-label">اختر يوم الإجازة:</label>
        <select name="day" id="day" class="form-control mb-3">
            <option value="السبت" {{ $weeklyHoliday->day == 'السبت' ? 'selected' : '' }}>السبت</option>
            <option value="الأحد" {{ $weeklyHoliday->day == 'الأحد' ? 'selected' : '' }}>الأحد</option>
            <option value="الإثنين" {{ $weeklyHoliday->day == 'الإثنين' ? 'selected' : '' }}>الإثنين</option>
            <option value="الثلاثاء" {{ $weeklyHoliday->day == 'الثلاثاء' ? 'selected' : '' }}>الثلاثاء</option>
            <option value="الأربعاء" {{ $weeklyHoliday->day == 'الأربعاء' ? 'selected' : '' }}>الأربعاء</option>
            <option value="الخميس" {{ $weeklyHoliday->day == 'الخميس' ? 'selected' : '' }}>الخميس</option>
            <option value="الجمعة" {{ $weeklyHoliday->day == 'الجمعة' ? 'selected' : '' }}>الجمعة</option>
        </select>

        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        <a href="{{ route('settings.index') }}" class="btn btn-secondary">إلغاء</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-layout>
