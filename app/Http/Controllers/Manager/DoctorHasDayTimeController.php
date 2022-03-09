<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DoctorHasDayTime;
use App\DoctorHasDay;
use App\Doctor;
use Response;
use Auth;

class DoctorHasDayTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $doctor_id = DoctorHasDay::where('id',$id)->value('doctor_id');
        $doctors = Doctor::find($doctor_id);
        $doctorhasdaytime = DoctorHasDayTime::where('doctor_has_day_id',$id)->get();
        return view('manager.doctorhasdaytime.index', compact('doctors','doctorhasdaytime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $doctorhasday_id = DoctorHasDayTime::where('id',$id)->value('doctor_has_day_id');
        $doctor_id = DoctorHasDay::where('id',$doctorhasday_id)->value('doctor_id');
        $doctors = Doctor::find($doctor_id);
        $doctorhasdaytime = DoctorHasDayTime::find($id);
        return view('manager.doctorhasdaytime.edit', compact('doctors','doctorhasdaytime','doctorhasday_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request,$id);
        $doctorhasdaytime = DoctorHasDayTime::find($id);
        $all_data = $request->all();
        $all_data['updated_by'] = Auth::user()->id;
        $doctorhasdaytime->update($all_data);
        return redirect()->route('manager.doctorhasdaytime.index',$request->doctorhasday_id)->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctorhasdaytime = DoctorHasDayTime::find($id);
        if($doctorhasdaytime->delete()){
            $notification = array(
              'message' => 'data is deleted successfully!',
              'status' => 'success'
          );
        }else{
            $notification = array(
              'message' => 'data could not be deleted!',
              'status' => 'error'
          );
        }
        return Response::json($notification);
    }
}
