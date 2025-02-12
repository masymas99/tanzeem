<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialHoliday extends Model
{
    /** @use HasFactory<\Database\Factories\OfficialHolidayFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'name',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
