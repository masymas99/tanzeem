<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /** @use HasFactory<\Database\Factories\SettingFactory> */
    use HasFactory;


    protected $fillable = [
        'desD',
        'desH',
        'addH',

=======
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'addH',
        'desH',
        'desD',
>>>>>>> 1a5b09c (Setting and WeeklyHoliday Done)
    ];
}
