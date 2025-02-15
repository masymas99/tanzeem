<x-layout title="Edit Employee">
    <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="container mt-5">
        @csrf
        @method('PUT')

        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="name" class="form-label">الـأسم</label>
                    <input dir="rtl" type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" placeholder="ادخل الاسم" required />
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="email" class="form-label">البريد الالكتروني</label>
                    <input dir="rtl" type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}" placeholder="البريد الالكتروني" required />
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="phone" class="form-label">رقم الـتلفون</label>
                    <input dir="rtl" type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}" placeholder="0123456789" required />
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="address" class="form-label">الـعنوان</label>
                    <input dir="rtl" type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $employee->address) }}" placeholder="ادخل العنوان" required />
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="nationality" class="form-label">الـجنسية</label>
                    <input dir="rtl" type="text" id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality', $employee->nationality) }}" placeholder="ادخل الجنسية" required />
                    @error('nationality')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="nid_number" class="form-label">الـرقم القومي</label>
                    <input dir="rtl" type="text" id="nid_number" name="nid_number" class="form-control @error('nid_number') is-invalid @enderror" value="{{ old('nid_number', $employee->nid_number) }}" placeholder="01234567890123" required />
                    @error('nid_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="dob" class="form-label">تاريخ الميلاد</label>
                    <input dir="rtl" id="dob" name="dob" type="date" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $employee->dob) }}" placeholder="تاريخ الميلاد" required />
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" dir="rtl" class="form-label">الـنوع</label>
                    <select id="gender" dir="rtl" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="male" {{ old('gender', $employee->gender) === 'male' ? 'selected' : '' }}>ذكر</option>
                        <option value="female" {{ old('gender', $employee->gender) === 'female' ? 'selected' : '' }}>أنثي</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="joining_date" class="form-label">تاريخ التعاقد</label>
                    <input dir="rtl" id="joining_date" name="joining_date" type="date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date', $employee->joining_date) }}" placeholder="تاريخ التعاقد" required />
                    @error('joining_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="position" class="form-label">الوظيفة</label>
                    <input dir="rtl" type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $employee->position) }}" placeholder="ادخل الوظيفة" required />
                    @error('position')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="salary" class="form-label">الراتب</label>
                    <input dir="rtl" type="number" id="salary" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $employee->salary) }}" placeholder="5000" required />
                    @error('salary')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="work_start_time" class="form-label">وقت بداية العمل</label>
                    <input dir="rtl" type="time" id="work_start_time" name="work_start_time" class="form-control @error('work_start_time') is-invalid @enderror" value="{{ old('work_start_time', $employee->work_start_time) }}" required />
                    @error('work_start_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="work_end_time" class="form-label">وقت إنتهاء العمل</label>
                    <input dir="rtl" type="time" id="work_end_time" name="work_end_time" class="form-control @error('work_end_time') is-invalid @enderror" value="{{ old('work_end_time', $employee->work_end_time) }}" required />
                    @error('work_end_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">تحديث بيانات الموظف</button>
        </div>
    </form>
</x-layout>

