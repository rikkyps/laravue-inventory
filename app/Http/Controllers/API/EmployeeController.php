<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use Image;
use File;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|min:3',
            'sim' => 'required|unique:employees',
            'ktp' => 'required|unique:employees',
            'gender' => 'required',
            'umur' => 'required',
            'phone' => 'required',
            'joindate' => 'required',
            'address' => 'required'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(400, 400);
            $uploadPath = 'images/employees/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $request['photo'] = $imageURL;
            Employee::create($request->all());
        } else {
            $request['photo'] = 'images/user-icon.png';
            Employee::create($request->all());
        }

        return response()->json(['msg' => 'Karyawan berhasil ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employee::find($id);
        return response()->json($employees);
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
        $validator = $request->validate([
            'name' => 'required|min:3',
            'sim' => 'required|unique:employees,sim,'.$id,
            'ktp' => 'required|unique:employees,ktp,'.$id,
            'gender' => 'required',
            'umur' => 'required',
            'phone' => 'required',
            'joindate' => 'required',
            'address' => 'required'
        ]);
        
        $data = Employee::find($id);

        if($request->newphoto){
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->newphoto)->resize(400, 400);
            $uploadPath = 'images/employees/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $image_path = public_path().'/'.$data->photo;
            if(File::exists($image_path) && $image_path != public_path().'/images/user-icon.png'){
                unlink($data->photo);
            }
            
            $request['photo'] = $imageURL;
            $data->update($request->all());

        } else {
            $request['photo'] = $data->photo;
            $data->update($request->all());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $image_path = public_path().'/'.$employee->photo;
        if(File::exists($image_path) && $image_path != public_path().'/images/user-icon.png'){
            unlink($employee->photo);
            $employee->delete();
        } else {
            $employee->delete();
        }
        return response()->json(['msg' => 'Data berhasil dihapus!']);
    }
}
