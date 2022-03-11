<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Category;
use App\Product;
use App\Rules\MatchOldPassword;
use App\Rules\PasswordField;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;



class HomeController extends Controller
{
   

//sign up
public function register(Request $request) {

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email?$request->email:$request->phone_no;
    $user->password = Hash::make($request['password']);
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->date_np = '2078-11-19';
     $user->date = '2022-03-03';
    $user->is_active = '1';
    $user->user_type = 3;
    $user->created_by = '1';
    $user->time = '7:00 AM';
    // var_dump($request->name,$request->class);
    $user->save();

    return response()->json([[
        "message" => "user record created"
    ]], 201);
  }


 
}