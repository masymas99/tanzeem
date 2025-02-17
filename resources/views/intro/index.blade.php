<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>intro</title>
    <style>
        body {
            overflow: hidden;
        }

        .ball {
            width: 100px;
            height: 100px;
            background-color: rgb(255, 255, 255);
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            animation: scall 2s infinite cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        @keyframes scall {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.5);
            }
            100% {
                transform: scale(1);
            }
        }
        .ring1 {
            width: 100px;
            height: 100px;
            border: 2px solid #227A85FF;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            animation: ringscall 3s forwards cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        @keyframes ringscall {
            0% {
                transform: scale(1.5);
            }
            50% {
                transform: scale(3);
            }
            99% {
                transform: scale(50);
                opacity: 1;
                background-color: #227A85FF;
            }
            100% {
                transform: scale(0);
                opacity: 0;
                background-color: #000000FF;
            }
        }
        .ring2 {
            width: 100px;
            height: 100px;
            border: 2px solid #7116B2FF;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            animation: ringscall2 5s forwards cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        @keyframes ringscall2 {
            0% {
                transform: scale(1.5);
            }
            50% {
                transform: scale(2.5);
            }
            99% {
                transform: scale(50);
                opacity: 1;
                background-color: #7116B2FF;
            }
            100% {
                transform: scale(0);
                opacity: 0;
                background-color: #000000FF;
            }
        }
        .ring3 {
            width: 100px;
            height: 100px;
            background-color: #FFFFFFFF;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            animation: ringscall3 3s forwards cubic-bezier(0.68, -0.55, 0.265, 1.55);
            animation-delay: 3s;
        }
        @keyframes ringscall3 {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(15);
            }
            90% {
                transform: scale(50);
                opacity: 1;
                background-color: #FFFFFFFF;
            }
            100% {
                transform: scale(100);
                opacity: 0;
                background-color: #000000FF;}
        }
    </style>
</head>
<body>
    <p class="ball flex justify-center items-center"></p>
    <p class="ring1"></p>
    <p class="ring2"></p>
    <p class="ring3"></p>

    <script>
        const ball = document.querySelector('.ball');
        const rings = document.querySelectorAll('.ring1, .ring2, .ring3');

        rings.forEach(ring => {
            ring.addEventListener('animationend', () => {
                document.body.style.backgroundColor = ring.style.borderColor;
            });
        });
        document.querySelector('.ring3').addEventListener('animationend', () => {
            window.location.href = "{{ route('login') }}";
        });
    </script>
</body>
</html>



