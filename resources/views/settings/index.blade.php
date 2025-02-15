<x-layout title="Settings">

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




</x-layout>
