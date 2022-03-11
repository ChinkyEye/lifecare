<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Specialist;
use Auth;
use File;
use Response;


class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specialists = Specialist::where('created_by',Auth::user()->id)->paginate(100);
        return view('manager.specialist.index', compact('specialists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.specialist.create');
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
            'image' => 'required'
             ]);
        $uppdf = $request->file('image');
        if($uppdf != ""){
            $destinationPath = 'images/specialist/';
            $extension = $uppdf->getClientOriginalExtension();
            $fileName = md5(mt_rand()).'.'.$extension;
            $uppdf->move($destinationPath, $fileName);
            $file_path = $destinationPath.'/'.$fileName;

        }else{
            $fileName = Null;
        }
       $specialists = Specialist::create([
            'name' => $request['name'],
            'image'=> $fileName,
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
        return redirect()->route('manager.specialist.index')->with($pass)->withInput();
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
        $specialists = Specialist::find($id);
        return view('manager.specialist.edit',compact('specialists'));
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
        $uppdf = $request->file('image');
        $this->validate($request, [
          'name' => 'required',
        ]);
        $specialists= Specialist::find($id);

        $all_data = $request->all();
        if($uppdf != ""){
          $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg|max:1024',
          ]);
          $destinationPath = 'images/category/';
          $oldFilename = $destinationPath.'/'.$specialists->image;

          $extension = $uppdf->getClientOriginalExtension();
          $fileName = md5(mt_rand()).'.'.$extension;
          $uppdf->move($destinationPath, $fileName);
          $file_path = $destinationPath.'/'.$fileName;
          $all_data['image'] = $fileName;
          if(File::exists($oldFilename)) {
            File::delete($oldFilename);
          }
        }
        $all_data['updated_by'] = Auth::user()->id;
        $specialists->update($all_data);
        $pass = array(
            'message' => 'Data updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.specialist.index')->with($pass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialists = Specialist::find($id);
        $destinationPath = 'images/specialist/';
        $oldFilename = $destinationPath.'/'.$specialists->image;
        if($specialists->delete()){
            if(File::exists($oldFilename)) {
                File::delete($oldFilename);
            }
            $notification = array(
                'message' => $specialists->name.' is deleted successfully!',
                'status' => 'success'
            );
        }else{
            $notification = array(
                'message' => $specialists->name.' could not be deleted!',
                'status' => 'error'
            );
        }
        return Response::json($notification);
    }

    public function isActive(Request $request,$id)
    {
        $get_is_active = Specialist::where('id',$id)->value('is_active');
        $isactive = Specialist::find($id);
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
