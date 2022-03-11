<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentHasUser extends Model
{
    protected $fillable = [
        'user_id', 'doctor_id','doctor_has_day_id','doctor_has_day_time_id','is_active','date_np','date','time','created_by','updated_by'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User','created_by','id');
    }

    public function getAppointmentUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
    public function getDoctor()
    {
        return $this->belongsTo('App\Doctor','doctor_id','id');
    }
}
