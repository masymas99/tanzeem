<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;

class SettingController extends Controller
{
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




}
