<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all() ?? collect([]);
        $weeklyHolidays = WeeklyHoliday::all() ?? collect([]);

        return view('settings.index', compact('settings', 'weeklyHolidays'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'desD' => 'required|numeric',
            'desH' => 'required|numeric',
            'addH' => 'required|numeric',
           
        ]);

        Setting::create([
            'desD' => $request->desD,
            'desH' => $request->desH,
            'addH' => $request->addH,
    
        ]);

        return redirect()->route('settings.index')->with('success', 'تمت إضافة الإعدادات بنجاح.');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'desD' => 'required|numeric',
            'desH' => 'required|numeric',
            'addH' => 'required|numeric',
          
        ]);

        $setting->update($request->all());
        return redirect()->route('settings.index')->with('success', 'تم تحديث الإعدادات بنجاح.');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index')->with('success', 'تم حذف الإعدادات بنجاح.');
    }
}
