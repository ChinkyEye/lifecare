<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorHasDayTime extends Model
{
    protected $fillable = [
        'doctor_has_day_id','from_time','to_time','is_active','date_np','date','time','created_by','updated_by'
    ];
}
