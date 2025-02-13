<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attenndance extends Model
{
    /** @use HasFactory<\Database\Factories\AttenndanceFactory> */
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in_date',
        'check_out_date',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
