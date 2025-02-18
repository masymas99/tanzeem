<nav class="navbar navbar-expand-lg" style="background-color: #6A5DCF; font-family: 'Cairo', Courier, monospace;">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="{{ route('employees.index') }}">T A N Z E E M</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="navbar-nav ms-auto">
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item text-white">
                        <a class="nav-link text-white {{ request()->routeIs('salaries.index') ? 'active' : '' }}  aria-current="page" href="{{ route('salaries.index') }}">المرتبات</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('attendance.index') ? 'active' : '' }} ms-3">
                        <a href="{{ route('attendance.index') }}" class="nav-link text-white" >الحضور</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->routeIs('holidays.index') ? 'active' : '' }}  text-white" href="{{ route('holidays.index') }}">الأجازات</a>
                    </li>
                    <li class="nav-item ms-3 ">
                        <a class="nav-link {{request()->routeIs('settings.index')? 'active': ''}} text-white" href="{{ route('settings.index')}}">الإعدادات</a>
                    </li>
                    <li class="nav-item ms-3">
                        <a class="nav-link {{ request()->routeIs('employees.index') ? 'active' : '' }} text-white" href="{{ route('employees.index') }}">الموظفين</a>
                    </li>
                </ul>
            </div>
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn btn-danger ms-3" type="submit">
                            <i class="fa fa-sign-out" aria-hidden="true"> تسجيل الخروج</i>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    .active {
        border-radius: 5px;
        color: #fff;
        background: linear-gradient(to right, #107b59, #177594);
        font-weight: bold;
        border-bottom: 2px solid #080202;
        transform: scale(1.1);
        transition: all 0.3s ease;
    }
    .active {
        animation: sddd 1s cubic-bezier(0.215, 0.610, 0.355, 1);
    }


    @keyframes sddd {
        0% {
            transform: translateX(-10px);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }


</style>
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>





