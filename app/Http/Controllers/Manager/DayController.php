<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Day;
use Auth;
use Response;


class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $days = Day::where('created_by',Auth::user()->id)->get();
        return view('manager.day.index', compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.day.create');
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
        ]);
        $day = Day::create([
            'name' => $request['name'],
            'is_active' => '1',
            'date' => date("Y-m-d"),
            'date_np' => $this->helper->date_np_con_parm(date("Y-m-d")),
            'time' => date("H:i:s"),
            'created_by' => Auth::user()->id,
        ]);
       /* $pass = array(
            'message' => 'Data added successfully!',
            'alert-type' => 'success'
        );*/
        return redirect()->route('manager.day.index')->with('success', 'Day added successfully.');
    
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
        $day = Day::find($id);
        return view('manager.day.edit',compact('day'));
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
        $this->validate($request, [
          'name' => 'required',
        ]);
        $day = Day::find($id);
        $all_data = $request->all();
        $all_data['updated_by'] = Auth::user()->id;
        if($day->update($all_data)){
            $pass = array(
                'message' => 'Data updated successfully!',
                'alert-type' => 'success'
            );
        }else{
            $pass = array(
                'message' => 'Data cannot be updated successfully!',
                'alert-type' => 'danger'
            );
        }
        return redirect()->route('manager.day.index')->with($pass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $days = Day::find($id);

        $destinationPath = 'images/slider/';
        $oldFilename = $destinationPath.'/'.$days->image;

        if($days->delete()){
            $notification = array(
                'message' => $days->name.' is deleted successfully!',
                'status' => 'success'
            );
        }else{
            $notification = array(
                'message' => $days->name.' could not be deleted!',
                'status' => 'error'
            );
        }
        return Response::json($notification);
    }

    public function isActive(Request $request,$id)
    {
        $get_is_active = Day::where('id',$id)->value('is_active');
        $isactive = Day::find($id);
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
