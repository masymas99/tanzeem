<nav class="navbar navbar-expand-lg shadow-lg" style="background: linear-gradient(135deg, #6A5DCF, #4B46A6); font-family: 'Cairo', sans-serif;">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white font-bold text-2xl tracking-wide hover:scale-105 transition-transform duration-300" href="{{ route('employees.index') }}">T A N Z E E M</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-4">
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('dashboard') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('dashboard') }}">لوحة التحكم</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('salaries.index') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('salaries.index') }}">المرتبات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('attendance.index') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('attendance.index') }}">الحضور</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('holidays.index') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('holidays.index') }}">الأجازات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('settings.index') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('settings.index') }}">الإعدادات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white text-lg font-medium {{ request()->routeIs('employees.index') ? 'active' : '' }} hover:text-indigo-200 transition-colors duration-300" href="{{ route('employees.index') }}">الموظفين</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="btn bg-red-600 text-white px-4 py-2 rounded-full hover:bg-red-700 transition-colors duration-300 flex items-center gap-2" type="submit">
                            <i class="fa fa-sign-out" aria-hidden="true"></i> تسجيل الخروج
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: all 0.3s ease;
    }

    .nav-link {
        position: relative;
        padding: 10px 15px !important;
    }

    .nav-link:hover {
        transform: translateY(-2px);
    }

    .active {
        background: linear-gradient(135deg, #38B2AC, #2C7A7B);
        border-radius: 8px;
        font-weight: 600;
        animation: slideIn 0.5s ease-in-out;
    }

    .active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 50%;
        height: 3px;
        background: #ffffff;
        border-radius: 2px;
    }

    @keyframes slideIn {
        0% {
            transform: translateX(-10px);
            opacity: 0;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .navbar-brand:hover {
        color: #E0E7FF !important;
    }

    @media (max-width: 992px) {
        .navbar-nav {
            padding: 1rem;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-top: 10px;
        }
        .nav-item {
            margin-bottom: 10px;
        }
        .nav-link {
            font-size: 1.1rem;
        }
    }
</style>

<!-- Loader Styles -->
<style>
    #page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        display: none;
        z-index: 9999;
        backdrop-filter: blur(8px);
        transition: opacity 0.5s ease;
        opacity: 0;
    }

    #page-loader.visible {
        opacity: 1;
    }

    .sunspot-loader-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .sunspotloader {
        position: relative;
        width: 140px;
        height: 140px;
    }

    .sunspotloader .sunspot {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 70%;
        height: 70%;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366F1, #A5B4FC);
        box-shadow: 0 0 50px 15px rgba(99, 102, 241, 0.4);
        animation: pulse 1.3s ease-in-out infinite;
    }

    .sunspotloader::before,
    .sunspotloader::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #6366F1, #A5B4FC);
        transform: translate(-50%, -50%) scale(0);
        animation: ripple 2.8s ease-out infinite;
        opacity: 0;
    }

    .sunspotloader::after {
        animation-delay: 1.4s;
    }

    @keyframes ripple {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 0.8; }
        100% { transform: translate(-50%, -50%) scale(1.7); opacity: 0; }
    }

    @keyframes pulse {
        0% { transform: translate(-50%, -50%) scale(0.85); opacity: 0.6; }
        50% { transform: translate(-50%, -50%) scale(1.05); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(0.85); opacity: 0.6; }
    }

    .loader-text {
        position: absolute;
        bottom: -50px;
        left: 0;
        right: 0;
        text-align: center;
        color: #E0E7FF;
        font-size: 20px;
        font-weight: 600;
        font-family: 'Cairo', sans-serif;
        animation: fadeInOut 1.8s ease-in-out infinite;
    }

    @keyframes fadeInOut {
        0% { opacity: 0.4; }
        50% { opacity: 1; }
        100% { opacity: 0.4; }
    }

    @media (max-width: 768px) {
        .sunspotloader {
            width: 100px;
            height: 100px;
        }
        .loader-text {
            font-size: 16px;
            bottom: -40px;
        }
    }
</style>

<!-- Loader Element -->
<div id="page-loader">
    <div class="sunspot-loader-container">
        <div class="sunspotloader">
            <div class="sunspot"></div>
        </div>
        <div class="loader-text mt-5">جاري التحميل...</div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- Loader Script -->
<script>
    $(document).ready(function() {
        const $pageLoader = $('#page-loader');
        let pageTransitionInProgress = false;

        // Show loader on page load
        $pageLoader.show();

        $(window).on('load', function() {
            setTimeout(function() {
                $pageLoader.fadeOut(500);
                pageTransitionInProgress = false;
            }, 300);
        });

        // Handle navigation links
        $('nav a').on('click', function(e) {
            if (pageTransitionInProgress || !$(this).attr('href') || $(this).attr('href').includes('#') || $(this).closest('form').length) {
                return;
            }

            e.preventDefault();
            pageTransitionInProgress = true;
            $pageLoader.fadeIn(300).addClass('visible');

            setTimeout(() => {
                window.location.href = $(this).attr('href');
            }, 600);
        });

        // Handle logout form submission
        $('form[action$="logout"]').on('submit', function(e) {
            e.preventDefault();
            if (!pageTransitionInProgress) {
                pageTransitionInProgress = true;
                $pageLoader.fadeIn(300).addClass('visible');
                setTimeout(() => this.submit(), 600);
            }
        });

        // Handle all form submissions
        $('form:not(.no-loader)').on('submit', function(e) {
            e.preventDefault();
            if (!pageTransitionInProgress) {
                pageTransitionInProgress = true;
                $pageLoader.fadeIn(300).addClass('visible');
                setTimeout(() => this.submit(), 600);
            }
        });

        // Handle AJAX requests
        $(document).ajaxStart(function() {
            if (!pageTransitionInProgress) {
                pageTransitionInProgress = true;
                $pageLoader.fadeIn(300).addClass('visible');
            }
        }).ajaxStop(function() {
            pageTransitionInProgress = false;
            $pageLoader.fadeOut(500);
        });
    });
</script>