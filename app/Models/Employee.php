<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'gender',
        'dob',
        'nationality',
        'position',
        'nid_number',
        'joining_date',
        'salary',
        'work_start_time',
        'work_end_time',
        'created_at',
        'updated_at',
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
