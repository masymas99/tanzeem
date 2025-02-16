<x-layout title="Settings">
<<<<<<< HEAD

    <div class="container d-flex flex-column align-items-between justify-content-center ">
        <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600">إعدادات قيمة الخصومات والإضافات</h1>

        <div class="mt-8 d-flex flex-column align-center justify-center">
          {{-- botton to add the setting  --}}
          @foreach ($settings as $setting)
            <div class="card shadow-lg">

                <div class="card-body d-flex justify-content-around align-items-center  ">
                    <p>يوم الخصم :{{$setting->desD}}</p>
                    <p>ساعة الخصم : {{$setting->desH}}</p>
                    <p>الساعة الإضافية : {{$setting->addH}}</p>

                    <a href="{{route('settings.edit',['setting' => $setting->id])}}" class="align-self-center m-3 btn btn-success">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    {{-- delete setting --}}
                    <form action="{{route('settings.destroy',['setting' => $setting->id])}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class=" m-3 btn btn-danger">
                            <i class="bi bi-trash-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach

          <div class="align-self-center d-flex justify-content-around ">
            {{-- add settings --}}
            <a href="{{route('settings.create')}}" class="align-self-center m-3 btn w-80 btn-primary">
                إضافة إعدادات جديدة
            </a>
            {{-- edit settings --}}

          </div>


        </div>

        <h1 class="text-center mt-5 text-2xl font-bold  text-purple-600" >الأجازات الاسبوعية</h1>

        <div class="mt-8 d-flex flex-column align-center justify-center">
            @foreach ($weeklyHolidays as $weeklyHoliday)
                <div class="card shadow-lg">
                    <div class="card-body d-flex justify-content-around align-items-center  ">
                        <p> Day :{{$weeklyHoliday->day}}</p>
                        <form action="{{route('weeklyHolidays.destroy',['weeklyHoliday' => $weeklyHoliday->id])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" m-3 btn btn-danger">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- delete setting --}}


            @endforeach
        </div>
        <div class="align-self-center d-flex justify-content-around ">
            {{-- add settings --}}
            <a href="{{route('weeklyHolidays.create')}}" class="align-self-center m-3 btn w-80 btn-primary">
                إضافة أجازة جديدة
            </a>
            {{-- edit settings --}}

        </div>


    </div>




=======
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        
    <div class="container d-flex flex-column align-items-center justify-content-center py-5" dir="rtl">
        <h1 class="text-center mt-5 text-2xl font-bold text-purple-600">إعدادات قيمة الخصومات والإضافات</h1>
        <div class="mt-5 w-100 d-flex flex-column align-items-center">
            @if(isset($settings) && $settings->count() > 0)
                @foreach ($settings as $setting)
                    <div class="card shadow-lg mb-5 w-75"> 
                        <div class="card-body text-center p-3"> 
                            <p class="mb-2"><strong>يوم الخصم:</strong> {{ $setting->desD }}</p>
                            <p class="mb-2"><strong>ساعة الخصم:</strong> {{ $setting->desH }}</p>
                            <p class="mb-0"><strong>الساعة الإضافية:</strong> {{ $setting->addH }}</p>
                            <div class="d-flex justify-content-center gap-2 mt-3"> 
                                <a href="{{ route('settings.edit', ['setting' => $setting->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-pencil-square"></i> تعديل
                                </a>
                                <form action="{{ route('settings.destroy', ['setting' => $setting->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash-fill"></i> حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('settings.create') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-plus-circle"></i> إضافة إعدادات جديدة
                </a>
            </div>
        </div>

        <h1 class="text-center mt-5 text-2xl font-bold text-purple-600">الأجازات الأسبوعية</h1>
        <div class="mt-4 w-100 d-flex flex-column align-items-center">
            @foreach ($weeklyHolidays as $weeklyHoliday)
                <div class="card shadow-lg mb-3 w-75">
                    <div class="card-body text-center p-3"> 
                        <p class="mb-0"><strong>اليوم:</strong> {{ $weeklyHoliday->day }}</p>
                        <div class="d-flex justify-content-center gap-2 mt-3"> 
                            <a href="{{ route('weeklyHolidays.edit', ['weeklyHoliday' => $weeklyHoliday->id]) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil-square"></i> تعديل
                            </a>
                            <form action="{{ route('weeklyHolidays.destroy', ['weeklyHoliday' => $weeklyHoliday->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash-fill"></i> حذف
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="d-flex justify-content-center mt-3">
                <a href="{{ route('weeklyHolidays.create') }}" class="btn btn-success btn-lg">
                    <i class="bi bi-plus-circle"></i> إضافة أجازة جديدة
                </a>
            </div>
        </div>
    </div>
    </body>
    </html>
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
</x-layout>
