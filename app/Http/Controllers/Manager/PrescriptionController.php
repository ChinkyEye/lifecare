<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Prescription;
use App\Hospital;
use App\User;
use Auth;
use Response;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prescriptions = Prescription::orderBy('id','DESC')
                            ->with('getHospital')
                            ->paginate(100);

       return view('manager.prescription.index',compact('prescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //  $doctors = Doctor::where('created_by', Auth::user()->id)->get();
       // return view('manager.prescription.create',compact('doctors') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // $this->validate($request, [
        //     'doctor_id' => 'required',
        //     'clinical_note' => 'required',
        //     'examination_mse' => 'required',
        //      ]);
      
        // $file= Prescription::create([
              
        //         'doctor_id' => $request['doctor_id'],
        //         'examination_mse' => $request['examination_mse'],
        //         'clinical_note' => $request['clinical_note'],
        //         'is_active' => '1',
        //         'date' => date("Y-m-d"),
        //         'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
        //         'time' => date("H:i:s"),
        //         'created_by' => Auth::user()->id,       
                            
        // ]);
        // return redirect()->route('manager.prescription.index')->with('success', 'prescription added successfully.');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $prescriptions = Prescription::find($id);
        // dd($prescriptions);
      return view('manager.prescription.show',compact('prescriptions'));
	}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $prescriptions = Prescription::find($id);
        // $doctors = Doctor::where('created_by', Auth::user()->id)->get();
        // return view('manager.prescription.edit', compact('prescriptions', 'doctors'));
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
        // $this->validate($request, [
        //     'doctor_id' => 'required',
        //     'clinical_note' => 'required',
        //     'examination_mse' => 'required',
        //      ]);
        //  $prescriptions= Prescription::find($id);
        // $all_data = $request->all();
        // $all_data['updated_by'] = Auth::user()->id;
        // $prescriptions->update($all_data);
        //  return redirect()->route('manager.prescription.index')->with('success', 'Data updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  $hospitals = Prescription::find($id);
        // if($hospitals->delete()){
        //     $notification = array(
        //       'message' => $hospitals->name.' is deleted successfully!',
        //       'status' => 'success'
        //   );
        // }else{
        //     $notification = array(
        //       'message' => $hospitals->name.' could not be deleted!',
        //       'status' => 'error'
        //   );
        // }
        // return Response::json($notification);
    }

     public function isActive(Request $request,$id)
    {
        $get_is_active = Prescription::where('id',$id)->value('is_active');
        $isactive = Prescription::find($id);
        if($get_is_active == 0){
        $isactive->is_active = 1;
        $notification = array(
          'message' => $isactive->name.' is Active!',
          'alert-type' => 'success'
        );
        }
        else {
        $isactive->is_active = 0;
        $notification = array(
          'message' => $isactive->name.' is inactive!',
          'alert-type' => 'error'
        );
        }
        if(!($isactive->update())){
        $notification = array(
          'message' => $isactive->name.' could not be changed!',
          'alert-type' => 'error'
        );
        }
        return back()->with($notification)->withInput();
    }
   }

