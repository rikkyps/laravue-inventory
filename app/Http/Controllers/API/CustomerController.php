<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Image;
use File;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
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
            'name' => 'required',
            'phone' => 'required|unique:customers',
            'address' => 'required'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(400, 400);
            $uploadPath = 'images/customers/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $request['photo'] = $imageURL;
            Customer::create($request->all());
        } else {
            $request['photo'] = 'images/user-icon.png';
            Customer::create($request->all());
        }

        return response()->json(['msg' => 'Pelanggan berhasil ditambahkan!']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
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
            'name' => 'required',
            'phone' => 'required|unique:customers,phone,'.$id,
            'address' => 'required'
        ]);

        $data = Customer::find($id);

        if($request->newphoto){
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->newphoto)->resize(400, 400);
            $uploadPath = 'images/customers/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $image_path = public_path().'/'.$data->photo;
            if(File::exists($image_path) && $image_path != public_path().'/images/user-icon.png'){
                unlink($data->photo);
            }
            
            $request['photo'] = $imageURL;
            $data->update($request->all());

            return response()->json(['msg' => 'Data pelanggan berhasil diupdate']);

        } else {
            $request['photo'] = $data->photo;
            $data->update($request->all());

            return response()->json(['msg' => 'Data pelanggan berhasil diupdate']);
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
        $customer = Customer::find($id);
        $image_path = public_path().'/'.$customer->photo;
        if(File::exists($image_path) && $image_path != public_path().'/images/user-icon.png'){
            unlink($customer->photo);
            $customer->delete();
        } else {
            $customer->delete();
        }
        return response()->json(['msg' => 'Data berhasil dihapus!']);
    }
}
