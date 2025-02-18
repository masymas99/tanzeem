<x-layout title="Settings">

    <div class="container d-flex flex-column align-items-between justify-content-center">
        <h1 class="text-center mt-5 text-2xl font-bold text-purple-600">إعدادات قيمة الخصومات والإضافات</h1>

        <div class="mt-8 d-flex flex-column align-center justify-center">
            {{-- زر لإضافة إعداد جديد --}}
            @if ($settings->count() > 0)
                @foreach ($settings as $setting)
                    <div class="card shadow-lg">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <p>يوم الخصم: {{ $setting->desD }}</p>
                            <p>ساعة الخصم: {{ $setting->desH }}</p>
                            <p>الساعة الإضافية: {{ $setting->addH }}</p>

                            <a href="{{ route('settings.edit', ['setting' => $setting->id]) }}" class="align-self-center m-3 btn btn-success">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            {{-- حذف الإعداد --}}
                            <form action="{{ route('settings.destroy', ['setting' => $setting->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="m-3 btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center mt-4"> لا يوجد إعدادات مضافة بعد.</p>
            @endif

            <div class="align-self-center d-flex justify-content-around">
                {{-- إضافة إعداد جديد --}}
                <a href="{{ route('settings.create') }}" class="align-self-center m-3 btn w-80 btn-primary">
                    إضافة إعدادات جديدة
                </a>
            </div>
        </div>

        <h1 class="text-center mt-5 text-2xl font-bold text-purple-600">الإجازات الأسبوعية</h1>

        <div class="mt-8 d-flex flex-column align-center justify-center">
            @if ($weeklyHolidays->count() > 0)
                @foreach ($weeklyHolidays as $weeklyHoliday)
                    <div class="card shadow-lg">
                        <div class="card-body d-flex justify-content-around align-items-center">
                            <p>يوم الإجازة: {{ $weeklyHoliday->day }}</p>
                            <form action="{{ route('weeklyHolidays.destroy', ['weeklyHoliday' => $weeklyHoliday->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="m-3 btn btn-danger">
                                    <i class="bi bi-trash-fill"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center mt-4">لا يوجد إجازات أسبوعية مضافة بعد.</p>
            @endif
        </div>

        <div class="align-self-center d-flex justify-content-around">
            {{-- إضافة إجازة جديدة --}}
            <a href="{{ route('weeklyHolidays.create') }}" class="align-self-center m-3 btn w-80 btn-primary">
                إضافة إجازة جديدة
            </a>
        </div>

    </div>

</x-layout>
