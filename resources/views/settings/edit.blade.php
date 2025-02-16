<x-layout title="Settings">
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>اضافه الإعدادات</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <form action="{{ route('settings.update',['setting' => $setting->id]) }}" method="POST">
    @csrf
    @method('PUT') 
    <div class="mb-3">
        <label for="addH" class="form-label">ساعة الإضافي</label>
        <input type="text" class="form-control" id="addH" name="addH" value="{{ $setting->addH }}">
    </div>
    <div class="mb-3">
        <label for="desH" class="form-label">ساعة الخصم</label>
        <input type="text" class="form-control" id="desH" name="desH" value="{{ $setting->desH }}">
    </div>
    <div class="mb-3">
        <label for="desD" class="form-label">يوم الخصم</label>
        <input type="text" class="form-control" id="desD" name="desD" value="{{ $setting->desD }}">
    </div>
    <button type="submit" class="btn btn-success">حفظ التعديلات</button>
    <a href="{{ route('settings.index') }}" class="btn btn-secondary">إلغاء</a>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-layout>
