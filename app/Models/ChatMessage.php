<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'role',
        'content',
    ];

    /**
     * Get the employee that owns the chat message.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
