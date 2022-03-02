<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Helper;
use App\Slider;
use File;
use Auth;
use Image;

class SliderController extends Controller
{
  public function index(Request $request){
    $posts = Slider::orderBy('id','DESC');
    $posts = $posts->take(5)->get();

    $response = [
    'sliders' => $posts
    ];
    return response()->json($response);
  } 
}