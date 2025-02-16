<?php

namespace App\Http\Controllers;
<<<<<<< HEAD

=======
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
use App\Models\Setting;
use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;

class SettingController extends Controller
{
<<<<<<< HEAD
    public function index(){

        $settings = Setting::all();
        $weeklyHolidays = WeeklyHoliday::all();
        return view('settings.index', compact('settings', 'weeklyHolidays'));
    }

    public function create(){


        return view('settings.create');
    }
    public function store(Request $request){
        $request->validate([
            'desD' => 'required',
            'desH' => 'required',
            'addH' => 'required',

        ]);
        Setting::create($request->all());
        return redirect()->route('settings.index')->with('success', 'Setting has been created successfully.');
    }
    public function edit(Setting $setting)
    {

        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'desD' => 'required',
            'desH' => 'required',
            'addH' => 'required',
        ]);

        $setting->update($request->all());
        return redirect()->route('settings.index')->with('success', 'Setting has been updated successfully.');
    }
    public function destroy(Setting $setting){
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'Setting has been deleted successfully.');
    }




=======
    public function index()
    {
        $settings = Setting::all(); 
        $weeklyHolidays = WeeklyHoliday::all();
        return view('settings.index', compact('settings', 'weeklyHolidays'));
    }    
public function create()
{
    return view('settings.create');
}
public function edit($id)
{
    $setting = Setting::findOrFail($id);
    return view('settings.edit', compact('setting'));
}

public function update(Request $request, Setting $setting)
{
    $setting->update([
        'addH' => $request->addH,
        'desH' => $request->desH,
        'desD' => $request->desD,
    ]);
    return redirect()->route('settings.index')->with('success', 'تم تحديث الإعدادات بنجاح!');
}
public function store(Request $request)
{
    $request->validate([
        'desD' => 'required|string',
        'desH' => 'required|string',
        'addH' => 'required|string',
    ]);

    Setting::create([
        'desD' => $request->desD,
        'desH' => $request->desH,
        'addH' => $request->addH,
    ]);

    return redirect()->route('settings.index')->with('success', 'تمت إضافة الإعدادات بنجاح!');
}
public function destroy(Setting $setting)
{
    $setting->delete();
    return redirect()->route('settings.index')->with('success', 'تم حذف الإعدادات بنجاح!');
}
    
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
}
