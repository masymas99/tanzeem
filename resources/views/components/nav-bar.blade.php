<nav class="navbar navbar-expand-lg shadow-lg" style="background: linear-gradient(135deg, #6A5DCF, #4B46A6); font-family: 'Cairo', sans-serif; position: relative;">
    <div class="container-fluid px-4">
        <a class="navbar-brand text-white font-bold text-2xl tracking-wide hover:scale-105 transition-transform duration-300" href="{{ route('employees.index') }}">T A N Z E E M</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon text-white"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto gap-4">
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

    /* Loader Styles */
    .loader-container {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        backdrop-filter: blur(8px);
        background: rgba(0, 0, 0, 0.2);
        width: 100%;
        height: 100%;
        display: none;
        text-align: center;
    }

    .loader {
        position: relative;
        top: 50%;
        width: 120px;
        height: 14px;
        border-radius: 0 0 15px 15px;
        background-color: #3e494d;
        box-shadow: 0 -1px 4px #5d6063 inset;
        animation: panex 0.5s linear alternate infinite;
        transform-origin: 170px 0;
        z-index: 10;
        perspective: 300px;
        display: inline-block;
        margin: 0 auto;
    }
    

    .loader::before {
        content: '';
        position: absolute;
        left: calc(100% - 2px);
        top: 0;
        z-index: -2;
        height: 15px;
        width: 100px;
        border-radius: 0 5px 5px 0;
        background-repeat: no-repeat;
        background-image: linear-gradient(#6c4924, #4b2d21), linear-gradient(#4d5457 30px, transparent 0), linear-gradient(#9f9e9e 30px, transparent 0);
        background-size: 60px 15px, 5px 10px, 30px 5px;
        background-position: right center, 20px center, 0px center;
        transform: translateX(-50%);
    }

    .loader::after {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        z-index: -2;
        transform: translate(-50%, -25px) rotate3d(75, -2, 3, 78deg);
        width: 70px;
        height: 65px;
        background: #fff;
        background-image:
            radial-gradient(circle 4px, #fff6 90%, transparent 10%),
            radial-gradient(circle 15px, #ffc400 90%, transparent 10%),
            radial-gradient(circle 15px, #ffae00 100%, transparent 0);
        background-repeat: no-repeat;
        background-position: -5px -8px, -3px -3px, -2px -2px;
        box-shadow: -3px -4px #0002 inset, 0 0 5px #0003 inset;
        border-radius: 50% 45% 50% 50% / 55% 50% 45% 45%;
        animation: eggRst 1.2s ease-out infinite;
        transform-origin: center center;
    }

    @keyframes eggRst {
        0%, 100% { transform: translate(-50%, -25px) rotate3d(90, 0, 0, 90deg); opacity: 0; }
        10%, 90% { transform: translate(-50%, -35px) rotate3d(90, 0, 0, 90deg); opacity: 1; }
        25% { transform: translate(-50%, -50px) rotate3d(85, 17, 2, 70deg); }
        75% { transform: translate(-50%, -50px) rotate3d(75, -3, 2, 70deg); }
        50% { transform: translate(-55%, -60px) rotate3d(75, -8, 3, 50deg); }
    }
    
    @keyframes panex {
        0% { transform: rotate(-5deg); }
        100% { transform: rotate(10deg); }
    }

    @keyframes panex {
        0% { transform: rotate(-8deg); }
        100% { transform: rotate(12deg); }
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

<style>
 

   

    

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
<div class="loader-container">
    <span class="loader"></span>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loaderContainer = document.querySelector('.loader-container');
        let isLoading = false;

        // Show loader when navigation links are clicked
        document.querySelectorAll('nav a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (link.getAttribute('href').startsWith('#') || link.getAttribute('target') === '_blank') {
                    return;
                }
                
                if (!isLoading) {
                    isLoading = true;
                    loaderContainer.style.display = 'block';
                    
                    // Hide loader after 6 seconds
                    setTimeout(() => {
                        isLoading = false;
                        loaderContainer.style.display = 'none';
                    }, 10000);
                }
            });
        });

        // Hide loader when page is loaded
        window.addEventListener('load', function() {
            loaderContainer.style.display = 'none';
        });
    });
</script>
