<?php

namespace App\Http\Controllers;

use App\Models\WeeklyHoliday;
use Illuminate\Http\Request;
use App\Models\WeeklyHoliday;
class WeeklyHolidayController extends Controller
{
<<<<<<< HEAD
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
=======
        public function index()
        {
            $weeklyHolidays = WeeklyHoliday::all(); 
            return view('settings.index', compact('weeklyHolidays'));
        }

        public function create()
        {
            return view('weeklyHolidays.create');
        }
    
        public function store(Request $request)
        {
            WeeklyHoliday::create([
                'day' => $request->day,
            ]);
    
            return redirect()->route('settings.index')->with('success', 'تمت إضافة الإجازة بنجاح');
        }
        
    
        public function edit($id)
        {
            $weeklyHoliday = WeeklyHoliday::findOrFail($id);
            return view('weeklyHolidays.edit', compact('weeklyHoliday'));
        }
        
        public function update(Request $request, $id)
            {
                $allowedDays = ['السبت', 'الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'];
            
                $newDay = trim($request->input('day'));
            
                if (!in_array($newDay, $allowedDays)) {
                    return redirect()->back()->withErrors(['day' => 'اليوم المحدد غير صالح.']);
                }
            
                $weeklyHoliday = WeeklyHoliday::findOrFail($id);
                $weeklyHoliday->update([
                    'day' => $newDay,
                ]);
            
                return redirect()->route('weeklyHolidays.index')->with('success', 'تم تعديل الإجازة بنجاح!');
            }
            
    
        public function destroy($id)
        {
            $weeklyHoliday = WeeklyHoliday::findOrFail($id);
            $weeklyHoliday->delete();
    
            return redirect()->route('settings.index')->with('success', 'تم حذف الإجازة بنجاح');
        }
    }
    
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)

