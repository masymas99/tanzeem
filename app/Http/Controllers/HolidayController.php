<?php

namespace App\Http\Controllers;

use App\Models\OfficialHoliday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = OfficialHoliday::paginate(10);
        return view('holidays.index', compact('holidays'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        OfficialHoliday::create([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return redirect()->route('holidays.index')->with('success', 'تم إضافة الإجازة بنجاح!');
    }

    public function edit($id)
    {
        $holiday = OfficialHoliday::findOrFail($id);
        return view('holidays.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $holiday = OfficialHoliday::findOrFail($id);
        $holiday->update([
            'name' => $request->name,
            'date' => $request->date,
        ]);

        return redirect()->route('holidays.index')->with('success', 'تم تعديل الإجازة بنجاح!');
    }

    public function destroy($id)
    {
        $holiday = OfficialHoliday::findOrFail($id);
        $holiday->delete();

        return redirect()->route('holidays.index')->with('success', 'تم حذف الإجازة بنجاح!');
    }
}
