<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'address',
        'joining_date',
        'name',
        'gender',
        'dob',
        'nationality',
        'position',
        'nid_number',
        'salary',
        'work_start_time',
        'work_end_time',
    ];

    public function attendances()
    {
        return $this->hasMany(Attenndance::class);
    }

    public function officialHolidays()
    {
        return $this->belongsToMany(OfficialHoliday::class);
    }

    public function salary()
    {
        return $this->hasMany(Salary::class);
    }

}
