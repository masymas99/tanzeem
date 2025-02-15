@extends('layouts.app')

@section('content')
<!-- خلفية المودال (Backdrop) لإظهار طبقة الشفافية خلف المودال -->
<div class="modal-backdrop fade show"></div>

<!-- المودال نفسه في حالة عرض إجباري -->
<div class="modal fade show" style="display: block;" tabindex="-1" aria-modal="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- رأس المودال -->
      <div class="modal-header">
        <h5 class="modal-title">تعديل المرتب</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق" onclick="window.history.back();"></button>
      </div>
      <!-- جسم المودال -->
      <div class="modal-body">
        <form action="{{ route('salaries.update', $salary->id) }}" method="POST">
          @csrf
          @method('POST')
          
          <!-- عرض اسم الموظف (غير قابل للتعديل) -->
          <div class="mb-3">
            <label class="form-label">اسم الموظف</label>
            <input type="text" class="form-control" value="{{ optional($salary->employee)->name ?? 'غير متوفر' }}" disabled>
          </div>
          
          <!-- تعديل الراتب الأساسي -->
          <div class="mb-3">
            <label class="form-label">الراتب الأساسي</label>
            <input type="number" name="basic_salary" class="form-control" value="{{ $salary->salary }}" required>
          </div>
          
          <!-- تعديل عدد أيام الحضور -->
          <div class="mb-3">
            <label class="form-label">عدد أيام الحضور</label>
            <input type="number" name="attendance_days" class="form-control" value="{{ $salary->total_attendance }}" required>
          </div>
          
          <!-- تعديل ساعات الإضافي -->
          <div class="mb-3">
            <label class="form-label">الإضافي بالساعات</label>
            <input type="number" name="overtime" class="form-control" value="{{ $salary->total_overtime_hours }}" step="0.01">
          </div>
          
          <!-- تعديل ساعات الخصومات -->
          <div class="mb-3">
            <label class="form-label">الخصومات بالساعات</label>
            <input type="number" name="deductions" class="form-control" value="{{ $salary->total_deduction_hours }}" step="0.01">
          </div>
          
          <!-- أزرار الحفظ والإلغاء -->
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">💾 حفظ التعديلات</button>
            <button type="button" class="btn btn-secondary" onclick="window.history.back();">❌ إلغاء</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
