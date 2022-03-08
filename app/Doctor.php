<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'name','address','image','about','experience','nmc_no','qualification','specialist_id','hospital_id','is_active','date_np','date','time','created_by','updated_by'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\User','created_by','id');
    }
}
