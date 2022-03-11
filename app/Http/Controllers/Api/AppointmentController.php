<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Slider;
use File;
use Auth;
use Image;

class AppointmentController extends Controller
{
  public function store_appointment(Request $request){
   
    return response()->json($response);
  } 
}