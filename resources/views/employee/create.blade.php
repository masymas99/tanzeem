<x-layout title="  Employee">
    <form action="{{ route('employees.store') }}" method="POST" class="container mt-5" dir="rtl">
        @csrf
        @method('POST')

        <div class="card p-4 shadow-sm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">  الـأسم</label>
                    <input type="text" id="name" name="name" class="form-control rounded-pill" placeholder="  الاسم" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">  البريد الالكتروني</label>
                    <input type="email" id="email" name="email" class="form-control rounded-pill" placeholder="  البريد الالكتروني" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="phone" class="form-label">  رقم الـتلفون</label>
                    <input type="tel" id="phone" name="phone" class="form-control rounded-pill" placeholder="0123456789" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="address" class="form-label">  العنوان</label>
                    <input type="text" id="address" name="address" class="form-control rounded-pill" placeholder="  العنوان" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nationality" class="form-label">  الـجنسية</label>
                    <input type="text" id="nationality" name="nationality" class="form-control rounded-pill" placeholder="  الجنسية" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nid_number" class="form-label">  الرقم القومي</label>
                    <input type="text" id="nid_number" name="nid_number" class="form-control rounded-pill" placeholder="01234567890123" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">  تاريخ الميلاد</label>
                    <input id="dob" name="dob" type="date" class="form-control rounded-pill" placeholder="  تاريخ الميلاد" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="gender" class="form-label">  الـنوع</label>
                    <select id="gender" name="gender" class="form-select rounded-pill">
                        <option selected>  الـنوع</option>
                        <option value="male">  ذكر</option>
                        <option value="female">  أنثي</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="joining_date" class="form-label">  تاريخ التعاقد</label>
                    <input id="joining_date" name="joining_date" type="date" class="form-control rounded-pill" placeholder="  تاريخ التعاقد" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="position" class="form-label">  الوظيفة</label>
                    <input type="text" id="position" name="position" class="form-control rounded-pill" placeholder="  الوظيفة" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="salary" class="form-label">  الراتب</label>
                    <input type="number" id="salary" name="salary" class="form-control rounded-pill" placeholder="5000" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="work_start_time" class="form-label">  وقت بداية العمل</label>
                    <input type="time" id="work_start_time" name="work_start_time" class="form-control rounded-pill" value="09:00:00" required />
                </div>
                <div class="col-md-6 mb-3">
                    <label for="work_end_time" class="form-label">  وقت إنتهاء العمل</label>
                    <input type="time" id="work_end_time" name="work_end_time" class="form-control rounded-pill" value="16:00:00" required />
                </div>
            </div>
            <button type="submit" class="btn btn-primary rounded-pill">  إضافة موظف</button>
        </div>
    </form>
</x-layout>

