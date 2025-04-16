<x-layout title="إضافة موظف جديد">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

        body {
            font-family: 'Cairo', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        .container {
            max-width: 900px;
            direction: rtl;
        }

        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
        }

        .card-header {
            background: linear-gradient(to right, #007bff, #00c4ff);
            padding: 20px;
            border-radius: 20px 20px 0 0;
        }

        .card-header h3 {
            font-weight: 700;
            margin: 0;
        }

        .form-control, .form-select {
            border-radius: 50px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 50px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 86, 179, 0.4);
        }

        .alert {
            border-radius: 10px;
            margin-top: 20px;
            padding: 15px;
        }

        .error-alert {
            position: relative;
            border-radius: 8px;
            margin-top: 8px;
            padding: 10px 35px 10px 15px;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 0.3s ease-in;
        }

        .error-alert i {
            font-size: 1.2rem;
        }

        .error-alert .close-btn {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #721c24;
            font-size: 1rem;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        .error-alert .close-btn:hover {
            color: #50141c;
        }

        .form-group {
            position: relative;
            margin-bottom: 2rem;
        }

        .form-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
            font-size: 1.1rem;
            pointer-events: none;
            z-index: 10;
        }

        .form-control.has-icon, .form-select.has-icon {
            padding-right: 40px;
            position: relative;
        }

        /* Transparent placeholder */
        .form-control::placeholder, .form-select option[disabled] {
            color: rgba(0, 0, 0, 0.3);
            opacity: 1;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .card {
                margin: 10px;
            }
            .form-control, .form-select {
                padding: 10px 15px 10px 35px;
            }
            .form-group i {
                right: 10px;
                font-size: 1rem;
            }
        }
    </style>

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success  fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger  fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">إضافة موظف جديد</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('employees.store') }}" method="POST" class="row g-4" novalidate>
                    @csrf

                    <div class="col-md-6 form-group">
                        <label for="name" class="form-label">الاسم</label>
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" class="form-control has-icon" placeholder="مثال: محمد أحمد" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="error-alert" id="error-name" data-input-id="name">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="form-control has-icon" placeholder="مثال: example@domain.com" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="error-alert" id="error-email" data-input-id="email">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="phone" class="form-label">رقم الهاتف</label>
                        <i class="fas fa-phone"></i>
                        <input type="tel" id="phone" name="phone" class="form-control has-icon" placeholder="مثال: 0123456789" value="{{ old('phone') }}" required>
                        @error('phone')
                            <div class="error-alert" id="error-phone" data-input-id="phone">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="address" class="form-label">العنوان</label>
                        <i class="fas fa-map-marker-alt"></i>
                        <input type="text" id="address" name="address" class="form-control has-icon" placeholder="مثال: القاهرة، مصر" value="{{ old('address') }}" required>
                        @error('address')
                            <div class="error-alert" id="error-address" data-input-id="address">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nationality" class="form-label">الجنسية</label>
                        <i class="fas fa-globe"></i>
                        <input type="text" id="nationality" name="nationality" class="form-control has-icon" placeholder="مثال: مصري" value="{{ old('nationality') }}" required>
                        @error('nationality')
                            <div class="error-alert" id="error-nationality" data-input-id="nationality">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="nid_number" class="form-label">الرقم القومي</label>
                        <i class="fas fa-id-card"></i>
                        <input type="text" id="nid_number" name="nid_number" class="form-control has-icon" placeholder="مثال: 12345678901234" value="{{ old('nid_number') }}" required>
                        @error('nid_number')
                            <div class="error-alert" id="error-nid_number" data-input-id="nid_number">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="dob" class="form-label">تاريخ الميلاد</label>
                        <i class="fas fa-calendar-alt"></i>
                        <input id="dob" name="dob" type="date" class="form-control has-icon" placeholder="مثال: 1990-01-01" value="{{ old('dob') }}" required>
                        @error('dob')
                            <div class="error-alert" id="error-dob" data-input-id="dob">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="gender" class="form-label">النوع</label>
                        <i class="fas fa-venus-mars"></i>
                        <select id="gender" name="gender" class="form-select has-icon" required>
                            <option value="" {{ old('gender') == '' ? 'selected' : '' }}>اختر النوع</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>ذكر</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>أنثى</option>
                        </select>
                        @error('gender')
                            <div class="error-alert" id="error-gender" data-input-id="gender">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="joining_date" class="form-label">تاريخ التعاقد</label>
                        <i class="fas fa-calendar-check"></i>
                        <input id="joining_date" name="joining_date" type="date" class="form-control has-icon" placeholder="مثال: 2023-01-01" value="{{ old('joining_date') }}" required>
                        @error('joining_date')
                            <div class="error-alert" id="error-joining_date" data-input-id="joining_date">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="department" class="form-label">القسم</label>
                        <i class="fas fa-building"></i>
                        <input type="text" id="department" name="department" class="form-control has-icon" placeholder="مثال: الموارد البشرية" value="{{ old('department') }}" required>
                        @error('department')
                            <div class="error-alert" id="error-department" data-input-id="department">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="position" class="form-label">الوظيفة</label>
                        <i class="fas fa-briefcase"></i>
                        <input type="text" id="position" name="position" class="form-control has-icon" placeholder="مثال: مدير" value="{{ old('position') }}" required>
                        @error('position')
                            <div class="error-alert" id="error-position" data-input-id="position">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="salary" class="form-label">الراتب</label>
                        <i class="fas fa-money-bill"></i>
                        <input type="number" id="salary" name="salary" class="form-control has-icon" min="0" placeholder="مثال: 5000" value="{{ old('salary') }}" required>
                        @error('salary')
                            <div class="error-alert" id="error-salary" data-input-id="salary">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="work_start_time" class="form-label">وقت بداية العمل</label>
                        <i class="fas fa-clock"></i>
                        <input type="time" id="work_start_time" name="work_start_time" class="form-control has-icon" value="{{ old('work_start_time', '09:00') }}" required>
                        @error('work_start_time')
                            <div class="error-alert" id="error-work_start_time" data-input-id="work_start_time">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="work_end_time" class="form-label">وقت انتهاء العمل</label>
                        <i class="fas fa-clock"></i>
                        <input type="time" id="work_end_time" name="work_end_time" class="form-control has-icon" value="{{ old('work_end_time', '16:00') }}" required>
                        @error('work_end_time')
                            <div class="error-alert" id="error-work_end_time" data-input-id="work_end_time">
                                <i class=" "></i>
                                <span>{{ $message }}</span>
                                <button type="button" class="close-btn">×</button>
                            </div>
                        @enderror
                    </div>
                    <div class="col-12 mt-4 text-center">
                        <button type="submit" class="btn btn-primary rounded-pill px-5">
                            <i class="fas fa-plus me-2"></i>إضافة موظف
                        </button>
                    </div>
                </form>
            </div>
        </div>


    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.close-btn').forEach(button => {
            button.addEventListener('click', () => {
                const errorAlert = button.parentElement;
                errorAlert.style.display = 'none';
            });
        });

        @if(session('success'))
            setTimeout(() => {
                const successAlert = document.querySelector('.alert-success');
                if(successAlert) {
                    successAlert.style.opacity = '0';
                    setTimeout(() => successAlert.remove(), 500);
                }
            }, 5000);
        @endif
    </script>
</x-layout>
