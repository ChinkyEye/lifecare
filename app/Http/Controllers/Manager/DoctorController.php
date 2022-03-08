<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Address;
use App\Hospital;
use App\Specialist;
use App\Doctor;
use Auth;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::orderBy('id','DESC')
                            ->where('created_by', Auth::user()->id)
                            ->with('getDoctorAddress')
                            ->get();
        return view('manager.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $addresses = Address::where('created_by', Auth::user()->id)->get();
        $specialists = Specialist::where('created_by', Auth::user()->id)->get();
        $hospitals = Hospital::where('created_by', Auth::user()->id)->get();
        return view('manager.doctor.create', compact('addresses','specialists','hospitals'));
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
          'name' => 'required',
          'address_id' => 'required',
          'image' => 'required',
          // 'about' => 'required',
          'specialist_id' => 'required',
          'hospital_id' => 'required',
          'experience' => 'required',
          'nmc_no' => 'required',
          'qualification' => 'required',
        ]);
        $uppdf = $request->file('image');
        if($uppdf != ""){
            $destinationPath = 'images/doctor/';
            $extension = $uppdf->getClientOriginalExtension();
            $fileName = md5(mt_rand()).'.'.$extension;
            $uppdf->move($destinationPath, $fileName);
            $file_path = $destinationPath.'/'.$fileName;

        }else{
            $fileName = Null;
        }
       $doctors = Doctor::create([
            'name' => $request['name'],
            'address_id'=> $request['address_id'],
            'image'=> $fileName,
            'specialist_id'=> $request['specialist_id'],
            'hospital_id'=> $request['hospital_id'],
            'experience'=> $request['experience'],
            'about'=> $request['about'],
            'nmc_no'=> $request['nmc_no'],
            'qualification'=> $request['qualification'],
            'is_active' => '1',
            'date' => date("Y-m-d"),
            'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
            'time' => date("H:i:s"),
            'created_by' => Auth::user()->id,
        ]);
        $pass = array(
          'message' => 'Data added successfully!',
          'alert-type' => 'success'
        );
        return redirect()->route('manager.doctor.index')->with($pass)->withInput();
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
        //
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
        //
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
