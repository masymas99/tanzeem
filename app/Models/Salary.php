<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /** @use HasFactory<\Database\Factories\SalaryFactory> */
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'employee_id',
        'salary',
        'date',
        'total_attendance',
        'total_absence',
        'total_overtime_hours',
        'total_deduction_hours',
        'total_overtime',
        'total_deduction',
        'net_salary',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);

    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'employee_id', 'employee_id');


    }


}
