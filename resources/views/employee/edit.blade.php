<x-layout title="Edit Employee">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="text-center font-bold card-header bg-primary text-white">
                <h3 class="card-title">تعديل بيانات الموظف </h3>
            </div>
            <div class="card-body">
                <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="form">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="name" class="form-label">الـأسم</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $employee->name) }}" placeholder="ادخل الاسم" required />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="email" class="form-label">البريد الالكتروني</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $employee->email) }}" placeholder="البريد الالكتروني" required />
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="phone" class="form-label">رقم الـتلفون</label>
                                <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $employee->phone) }}" placeholder="0123456789" required />
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="address" class="form-label">الـعنوان</label>
                                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $employee->address) }}" placeholder="ادخل العنوان" required />
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="nationality" class="form-label">الـجنسية</label>
                                <input type="text" id="nationality" name="nationality" class="form-control @error('nationality') is-invalid @enderror" value="{{ old('nationality', $employee->nationality) }}" placeholder="ادخل الجنسية" required />
                                @error('nationality')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="nid_number" class="form-label">الـرقم القومي</label>
                                <input type="text" id="nid_number" name="nid_number" class="form-control @error('nid_number') is-invalid @enderror" value="{{ old('nid_number', $employee->nid_number) }}" placeholder="01234567890123" required />
                                @error('nid_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="dob" class="form-label">تاريخ الميلاد</label>
                                <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob', $employee->dob) }}" placeholder="تاريخ الميلاد" required />
                                @error('dob')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="gender" class="form-label">الـنوع</label>
                                <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                                    <option value="male" {{ old('gender', $employee->gender) === 'male' ? 'selected' : '' }}>ذكر</option>
                                    <option value="female" {{ old('gender', $employee->gender) === 'female' ? 'selected' : '' }}>أنثي</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="joining_date" class="form-label">تاريخ التعاقد</label>
                                <input type="date" id="joining_date" name="joining_date" class="form-control @error('joining_date') is-invalid @enderror" value="{{ old('joining_date', $employee->joining_date) }}" placeholder="تاريخ التعاقد" required />
                                @error('joining_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="position" class="form-label">الوظيفة</label>
                                <input type="text" id="position" name="position" class="form-control @error('position') is-invalid @enderror" value="{{ old('position', $employee->position) }}" placeholder="ادخل الوظيفة" required />
                                @error('position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="salary" class="form-label">الراتب</label>
                                <input type="number" id="salary" name="salary" class="form-control @error('salary') is-invalid @enderror" value="{{ old('salary', $employee->salary) }}" placeholder="5000" required />
                                @error('salary')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="work_start_time" class="form-label">وقت بداية العمل</label>
                                <input type="time" id="work_start_time" name="work_start_time" class="form-control @error('work_start_time') is-invalid @enderror" value="{{ old('work_start_time', $employee->work_start_time) }}" required />
                                @error('work_start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <label for="work_end_time" class="form-label">وقت إنتهاء العمل</label>
                                <input type="time" id="work_end_time" name="work_end_time" class="form-control @error('work_end_time') is-invalid @enderror" value="{{ old('work_end_time', $employee->work_end_time) }}" required />
                                @error('work_end_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary">تحديث بيانات الموظف</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>

