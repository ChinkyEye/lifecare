<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorHasDay extends Model
{
    protected $fillable = [
        'doctor_id','day_id','is_active','date_np','date','time','created_by','updated_by'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User','created_by','id');
    }

    public function getDoctorName()
    {
        return $this->belongsTo('App\Doctor','doctor_id','id');
    }

    public function getDayName()
    {
        return $this->belongsTo('App\Day','day_id','id');
    }
    public function getDoctorDayTime()
    {
        return $this->hasMany('App\DoctorHasDayTime','doctor_has_day_id','id');
    }
}
