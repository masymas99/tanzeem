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
<<<<<<< HEAD
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
=======
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-cta">
          <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-indigo-400 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-indigo-400 dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
            <li>
              <a href="#" class="font-bold block py-2 px-3 md:p-0 text-white bg-blue-700 rounded-sm md:bg-transparent md:text-blue-700 md:dark:text-blue-500" aria-current="page">المرتبات</a>
            </li>
            <li>
              <a href="#" class="font-bold  block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">الحضور</a>
            </li>
            <li>
              <a href="#" class="font-bold  block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">الأجازات</a>
            </li>
            <li>
              <a href="#" class="font-bold  block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">الإعدادات</a>
            <li>
                <a href="#" class="font-bold  block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">الموظفين</a>
              </li>
          </ul>
        </div>
        </div>
      </nav>
      <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleButton = document.querySelector("[data-collapse-toggle='navbar-cta']");
            const navMenu = document.getElementById("navbar-cta");
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)





