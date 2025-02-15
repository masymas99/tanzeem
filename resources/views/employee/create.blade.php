
<x-layout title="Employee">
    <form action="{{ route('employees.store') }}" method="POST" class="container mt-5">
        @csrf
        @method('POST')

        <div class="card p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="name" class="form-label">الـأسم</label>
                    <input dir="rtl" type="text" id="name" name="name" class="form-control" placeholder="ادخل الاسم" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="email" class="form-label">البريد الالكتروني</label>
                    <input dir="rtl" type="email" id="email" name="email" class="form-control" placeholder="البريد الالكتروني" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="phone" class="form-label">رقم الـتلفون</label>
                    <input dir="rtl" type="tel" id="phone" name="phone" class="form-control" placeholder="0123456789" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="address" class="form-label">الـعنوان</label>
                    <input dir="rtl" type="text" id="address" name="address" class="form-control" placeholder="ادخل العنوان" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="nationality" class="form-label">الـجنسية</label>
                    <input dir="rtl" type="text" id="nationality" name="nationality" class="form-control" placeholder="ادخل الجنسية" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="nid_number" class="form-label">الـرقم القومي</label>
                    <input dir="rtl" type="text" id="nid_number" name="nid_number" class="form-control" placeholder="01234567890123" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="dob" class="form-label">تاريخ الميلاد</label>
                    <input dir="rtl" id="dob" name="dob" type="date" class="form-control" placeholder="تاريخ الميلاد" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" dir="rtl" class="form-label">الـنوع</label>
                    <select id="gender" dir="rtl" name="gender" class="form-select">
                        <option selected>الـنوع</option>
                        <option value="male">ذكر</option>
                        <option value="female">أنثي</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="joining_date" class="form-label">تاريخ التعاقد</label>
                    <input dir="rtl" id="joining_date" name="joining_date" type="date" class="form-control" placeholder="تاريخ التعاقد" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="position" class="form-label">الوظيفة</label>
                    <input dir="rtl" type="text" id="position" name="position" class="form-control" placeholder="ادخل الوظيفة" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="salary" class="form-label">الراتب</label>
                    <input dir="rtl" type="number" id="salary" name="salary" class="form-control" placeholder="5000" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="work_start_time" class="form-label">وقت بداية العمل</label>
                    <input dir="rtl" type="time" id="work_start_time" name="work_start_time" class="form-control" value="09:00:00" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label dir="rtl" for="work_end_time" class="form-label">وقت إنتهاء العمل</label>
                    <input dir="rtl" type="time" id="work_end_time" name="work_end_time" class="form-control" value="16:00:00" required />
                </div>
            </div>
            <button type="submit" class="btn btn-primary">إضافة موظف</button>
        </div>
    </form>
</x-layout>
