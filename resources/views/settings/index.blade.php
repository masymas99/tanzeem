<x-layout title="Settings">

    <div class="container py-12 px-4 min-h-screen bg-gray-50">
        <h1 class="text-center mb-10 text-3xl font-bold text-indigo-700 tracking-wide animate-fadeIn">إعدادات قيمة الخصومات والإضافات</h1>

        <div class="mt-8 max-w-4xl mx-auto">
            @if ($settings->count() > 0)
                @foreach ($settings as $setting)
                    <div class="card bg-white shadow-xl rounded-2xl mb-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="card-body flex flex-col md:flex-row justify-between items-center p-6">
                            <div class="flex flex-col md:flex-row gap-6 text-gray-700">
                                <p class="text-lg"><span class="font-semibold text-indigo-600">يوم الخصم:</span> {{ $setting->desD }}</p>
                                <p class="text-lg"><span class="font-semibold text-indigo-600">ساعة الخصم:</span> {{ $setting->desH }}</p>
                                <p class="text-lg"><span class="font-semibold text-indigo-600">الساعة الإضافية:</span> {{ $setting->addH }}</p>
                            </div>
                            <div class="flex gap-4 mt-4 md:mt-0">
                                <a href="{{ route('settings.edit', ['setting' => $setting->id]) }}" class="btn bg-green-500 text-white px-4 py-2 rounded-full hover:bg-green-600 transition-colors duration-300 flex items-center gap-2">
                                    <i class="bi bi-pencil-square"></i> تعديل
                                </a>
                                <form action="{{ route('settings.destroy', ['setting' => $setting->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 transition-colors duration-300 flex items-center gap-2">
                                        <i class="bi bi-trash-fill"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center mt-8 text-lg text-gray-600 bg-white py-6 rounded-xl shadow-md">لا يوجد إعدادات مضافة بعد.</p>
            @endif

            <div class="flex justify-center mt-8">
                <a href="{{ route('settings.create') }}" class="btn bg-indigo-600 text-white px-8 py-3 rounded-full hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105">
                    إضافة إعدادات جديدة
                </a>
            </div>
        </div>

        <h1 class="text-center mt-16 mb-10 text-3xl font-bold text-indigo-700 tracking-wide animate-fadeIn">الإجازات الأسبوعية</h1>

        <div class="mt-8 max-w-4xl mx-auto">
            @if ($weeklyHolidays->count() > 0)
                @foreach ($weeklyHolidays as $weeklyHoliday)
                    <div class="card bg-white shadow-xl rounded-2xl mb-6 transform hover:scale-105 transition-transform duration-300">
                        <div class="card-body flex flex-col md:flex-row justify-between items-center p-6">
                            <p class="text-lg text-gray-700"><span class="font-semibold text-indigo-600">يوم الإجازة:</span> {{ $weeklyHoliday->day }}</p>
                            <form action="{{ route('weeklyHolidays.destroy', ['weeklyHoliday' => $weeklyHoliday->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-700 transition-colors duration-300 flex items-center gap-2">
                                    <i class="bi bi-trash-fill"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center mt-8 text-lg text-gray-600 bg-white py-6 rounded-xl shadow-md">لا يوجد إجازات أسبوعية مضافة بعد.</p>
            @endif
        </div>

        <div class="flex justify-center mt-8">
            <a href="{{ route('weeklyHolidays.create') }}" class="btn bg-indigo-600 text-white px-8 py-3 rounded-full hover:bg-indigo-700 transition-colors duration-300 transform hover:scale-105">
                إضافة إجازة جديدة
            </a>
        </div>
    </div>

    <style>
        .animate-fadeIn {
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .card {
            transition: all 0.3s ease;
        }

        .btn {
            font-family: 'Cairo', sans-serif;
        }

        @media (max-width: 768px) {
            .card-body {
                flex-direction: column;
                text-align: center;
            }
            .card-body p {
                margin-bottom: 1rem;
            }
            .flex-col.md\:flex-row {
                flex-direction: column;
            }
        }
    </style>

</x-layout>