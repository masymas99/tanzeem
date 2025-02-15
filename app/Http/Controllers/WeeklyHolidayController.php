<?php

namespace App\Http\Controllers;

use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;

class WeeklyHolidayController extends Controller
{
    public function index()
    {
        // $weeklyHolidays = WeeklyHoliday::all();
        // return view('settings.index', compact('weeklyHolidays'));
    }

    public function create()
    {
        return view('weeklyHolidays.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => 'required',
        ]);

        WeeklyHoliday::create($request->only('day'));

        return redirect()->route('settings.index')->with('success', 'Weekly Holiday has been created successfully.');
    }

    public function destroy(WeeklyHoliday $weeklyHoliday)
    {
        $weeklyHoliday->delete();
        return redirect()->route('settings.index')->with('success', 'Weekly Holiday has been deleted successfully.');
    }
}

