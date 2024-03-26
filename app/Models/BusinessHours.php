<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    use HasFactory;


    protected $fillable = [
        'daysOfWeek',
        'startTime',
        'endTime'
    ];

    public function calender() {
        return $this->belongsTo(Calendar::class);
    }
}
