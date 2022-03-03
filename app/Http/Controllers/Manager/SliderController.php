<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slider;
use Auth;
use File;
use Response;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::where('created_by', Auth::user()->id)->get();
        return view('manager.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uppdf = $request->file('image');
        if($uppdf != ""){
            $destinationPath = 'images/slider/';
            // $destinationPath = 'images/slider/'.$request->name;
            $extension = $uppdf->getClientOriginalExtension();
            $fileName = md5(mt_rand()).'.'.$extension;
            $uppdf->move($destinationPath, $fileName);
            $file_path = $destinationPath.'/'.$fileName;

        }else{
            $fileName = Null;
        }
       $sliders = Slider::create([
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
        return redirect()->route('manager.slider.index')->with($pass)->withInput();
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
        $sliders = Slider::find($id);
        return view('manager.slider.edit',compact('sliders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Slider $slider)
    {
        $this->validate($request, [
          'name' => 'required',
        ]);
        $all_data = $request->all();
        $uppdf = $request->file('image');
        if($uppdf != ""){
          $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg|max:1024',
          ]);
          // $destinationPath = 'images/slider/'.$slider->name;
          $destinationPath = 'images/slider/';
          $oldFilename = $destinationPath.'/'.$slider->image;

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
        $slider->update($all_data);
        $slider->update();
        $pass = array(
            'message' => 'Data updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.slider.index')->with($pass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sliders = Slider::find($id);

        $destinationPath = 'images/slider/';
        $oldFilename = $destinationPath.'/'.$sliders->image;

        if($sliders->delete()){
            if(File::exists($oldFilename)) {
                File::delete($oldFilename);
                // File::deleteDirectory($destinationPath);
            }
            $notification = array(
              'message' => $sliders->name.' is deleted successfully!',
              'status' => 'success'
          );
        }else{
            $notification = array(
              'message' => $sliders->name.' could not be deleted!',
              'status' => 'error'
          );
        }
        return Response::json($notification);
    }

    public function isActive(Request $request,$id)
    {
        $get_is_active = Slider::where('id',$id)->value('is_active');
        $isactive = Slider::find($id);
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
