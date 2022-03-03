<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use Auth;
use File;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::where('created_by', Auth::user()->id)->get();
        return view('manager.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manager.category.create');
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
            $destinationPath = 'images/category/';
            // $destinationPath = 'images/category/'.$request->name;
            $extension = $uppdf->getClientOriginalExtension();
            $fileName = md5(mt_rand()).'.'.$extension;
            $uppdf->move($destinationPath, $fileName);
            $file_path = $destinationPath.'/'.$fileName;

        }else{
            $fileName = Null;
        }
       $categories = Category::create([
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
        return redirect()->route('manager.category.index')->with($pass)->withInput();
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
        $categories = Category::find($id);
        return view('manager.category.edit',compact('categories'));
        

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
        $categories= Category::find($id);

        $all_data = $request->all();
        if($uppdf != ""){
          $this->validate($request, [
            'image' => 'required|mimes:jpeg,jpg|max:1024',
          ]);
          $destinationPath = 'images/category/';
          $oldFilename = $destinationPath.'/'.$categories->image;

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
        $categories->update($all_data);
        $pass = array(
            'message' => 'Data updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.category.index')->with($pass);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categories = Category::find($id);
        $destinationPath = 'images/category/';
        $oldFilename = $destinationPath.'/'.$categories->image;
        if($categories->delete()){
            if(File::exists($oldFilename)) {
                File::delete($oldFilename);
                // File::deleteDirectory($destinationPath);
            }
            $notification = array(
              'message' => $categories->name.' is deleted successfully!',
              'status' => 'success'
          );
        }else{
            $notification = array(
              'message' => $categories->name.' could not be deleted!',
              'status' => 'error'
          );
        }
        return Response::json($notification);
    }

    public function isActive(Request $request,$id)
    {
        $get_is_active = Category::where('id',$id)->value('is_active');
        $isactive = Category::find($id);
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
