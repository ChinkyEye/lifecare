<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
      'epres_date', 'mimes_type', 'image', 'address', 'remarks', 'is_seen', 'hospital_id', 'user_id',  'is_active', 'date_np', 'date', 'time', 'created_by', 'updated_by',
    ];

	public function getDoctor()
    {
        return $this->belongsTo('App\Doctor', 'doctor_id', 'id');
    }
   public function getUser()
    {
        return $this->belongsTo('App\User','created_by','id');

    }public function getHospital()
    {
        return $this->belongsTo('App\Hospital','hospital_id','id');
    }
}
