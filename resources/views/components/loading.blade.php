<div id="loading-screen" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.7); z-index: 9999;">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
        <div class="spinner-border text-purple-600" style="width: 4rem; height: 4rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>

@push('styles')
<style>
    .blur-effect {
        filter: blur(2px);
        -webkit-filter: blur(2px);
        pointer-events: none;
    }

    /* تحسين أداء الانتقال */
    body {
        transition: filter 0.2s ease-out;
    }

    /* تحسين أداء اللودر */
    #loading-screen {
        transition: opacity 0.2s ease-out;
        opacity: 0;
    }

    #loading-screen.visible {
        opacity: 1;
    }
</style>
@endpush

@push('scripts')
<script>
    // تحسين أداء اللودر عند تحميل الصفحة
    window.addEventListener('load', function() {
        // تقليل وقت الانتظار قبل إظهار اللودر
        const loader = document.getElementById('loading-screen');
        loader.style.display = 'block';
        // استخدام requestAnimationFrame لتحسين الأداء
        requestAnimationFrame(() => {
            loader.classList.add('visible');
            document.body.classList.add('blur-effect');
        });
    });

    // تسريع إخفاء اللودر عند اكتمال تحميل الصفحة
    window.addEventListener('DOMContentLoaded', function() {
        // تقليل وقت الانتظار قبل إخفاء اللودر
        setTimeout(function() {
            const loader = document.getElementById('loading-screen');
            loader.classList.remove('visible');
            document.body.classList.remove('blur-effect');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 200); // وقت أقل للانتظار بعد إخفاء اللودر
        }, 300); // تقليل وقت الانتظار من 1000 إلى 300 مللي ثانية
    });

    // تحسين معالج النقر لجميع روابط التنقل
    document.addEventListener('DOMContentLoaded', function() {
        const navLinks = document.querySelectorAll('nav a[href]');

        // إضافة التحميل المسبق للصفحات
        navLinks.forEach(link => {
            const url = link.getAttribute('href');
            if (url && !url.includes('#')) {
                // إضافة تلميح للمتصفح لتحميل الصفحة مسبقًا
                const preloadLink = document.createElement('link');
                preloadLink.rel = 'prefetch';
                preloadLink.href = url;
                document.head.appendChild(preloadLink);
            }

            link.addEventListener('click', function(e) {
                if (this.getAttribute('href') && !this.getAttribute('href').includes('#')) {
                    e.preventDefault();
                    const url = this.getAttribute('href');

                    // إظهار اللودر بشكل أسرع
                    const loader = document.getElementById('loading-screen');
                    loader.style.display = 'block';

                    // استخدام requestAnimationFrame لتحسين الأداء
                    requestAnimationFrame(() => {
                        loader.classList.add('visible');
                        document.body.classList.add('blur-effect');

                        // تقليل وقت الانتظار قبل الانتقال
                        setTimeout(function() {
                            window.location.href = url;
                        }, 200); // تقليل وقت الانتظار من 500 إلى 200 مللي ثانية
                    });
                }
            });
        });
    });

    // تصدير الدوال للاستخدام اليدوي مع تحسينات الأداء
    window.showLoading = function() {
        const loader = document.getElementById('loading-screen');
        loader.style.display = 'block';
        requestAnimationFrame(() => {
            loader.classList.add('visible');
            document.body.classList.add('blur-effect');
        });
    }

    window.hideLoading = function() {
        const loader = document.getElementById('loading-screen');
        loader.classList.remove('visible');
        document.body.classList.remove('blur-effect');
        setTimeout(() => {
            loader.style.display = 'none';
        }, 200);
    }
</script>
@endpush
