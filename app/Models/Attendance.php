<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'work_day',
        'clock_in',
        'clock_out'
    ];

    protected $dates = [
        'clock_in',
        'clock_out'
    ];

    //restとのリレーション
    public function rests(){
        return $this->hasMany('App\Models\Rest');
    }
}
