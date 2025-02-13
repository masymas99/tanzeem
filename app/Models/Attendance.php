<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model // ✅ تصحيح اسم الكلاس
{
    use HasFactory;

    protected $table = 'attendances'; // ✅ تأكيد اسم الجدول الصحيح
    protected $fillable = [
        'employee_id',
        'check_in_time',
        'check_out_time',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
