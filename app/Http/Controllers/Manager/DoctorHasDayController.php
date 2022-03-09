<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use App\Day;
use App\DoctorHasDay;
use App\DoctorHasDayTime;
use Auth;

class DoctorHasDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $doctors = Doctor::find($id);
        $datas = DoctorHasDay::where('doctor_id',$id)
                                ->with('getDoctorName','getDayName','getDoctorDayTime')
                                ->get();
                                // dd($datas);
        return view('manager.doctorhasday.index', compact('doctors','datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$id)
    {
        $doctors = Doctor::find($id);
        $days = Day::where('created_by', Auth::user()->id)->get();
        return view('manager.doctorhasday.create', compact('days','doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'day_id' => 'required',
          'from_time' => 'required',
          'to_time' => 'required',
        ]);
        $counts = DoctorHasDay::where('doctor_id',$request->doctor_id)
                                ->where('day_id',$request->day_id)
                                ->count();
        if($counts == 0){
            $doctorhasday = DoctorHasDay::create([
                'doctor_id'=> $request['doctor_id'],
                'day_id'=> $request['day_id'],
                'is_active' => '1',
                'date' => date("Y-m-d"),
                'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
                'time' => date("H:i:s"),
                'created_by' => Auth::user()->id,
            ]);
            $doctorhasdaytime = DoctorHasDayTime::create([
                'doctor_has_day_id'=> $doctorhasday->id,
                'from_time'=> $request['from_time'],
                'to_time'=> $request['to_time'],
                'is_active' => '1',
                'date' => date("Y-m-d"),
                'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
                'time' => date("H:i:s"),
                'created_by' => Auth::user()->id,
            ]);
            return redirect()->route('manager.doctorhasday.index',$request->doctor_id)->with('success', 'Data added successfully.');
        }else{
            $doctor_has_day_id = DoctorHasDay::where('doctor_id',$request->doctor_id)
                                ->where('day_id',$request->day_id)
                                ->value('id');
            $doctorhasdaytime = DoctorHasDayTime::create([
                'doctor_has_day_id'=> $doctor_has_day_id,
                'from_time'=> $request['from_time'],
                'to_time'=> $request['to_time'],
                'is_active' => '1',
                'date' => date("Y-m-d"),
                'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
                'time' => date("H:i:s"),
                'created_by' => Auth::user()->id,
            ]);
            return redirect()->route('manager.doctorhasday.index',$request->doctor_id)->with('success', 'Data added successfully.');


        }                      
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
        $doctor_id = DoctorHasDay::where('id',$id)->value('doctor_id');
        $doctors = Doctor::find($doctor_id);
        $days = Day::where('created_by',Auth::user()->id)->get();
        $doctorhasdays = DoctorHasDay::find($id);
        return view('manager.doctorhasday.edit', compact('doctors','days','doctorhasdays'));

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
        $doctorhasday = DoctorHasDay::find($id);
        $all_data = $request->all();
        $all_data['updated_by'] = Auth::user()->id;
        $doctorhasday->update($all_data);
        return redirect()->route('manager.doctorhasday.index',$request->doctor_id)->with('success','Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
