<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Supplier;
use Image;
use File;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Supplier::all();
        return response()->json($data);
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
            'email' => 'required|unique:suppliers',
            'phone' => 'required',
            'address' => 'required'
        ]);

        if($request->photo){
            $position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->photo)->resize(400, 400);
            $uploadPath = 'images/suppliers/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $request['photo'] = $imageURL;
            Supplier::create($request->all());
        } else {
            $request['photo'] = 'images/shop.png';
            Supplier::create($request->all());
        }

        return response()->json(['msg' => 'Data supplier berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Supplier::find($id);
        return response()->json($data);
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
            'email' => 'required|unique:suppliers,email,'.$id,
            'phone' => 'required',
            'address' => 'required'
        ]);

        $data = Supplier::find($id);
        
        if($request->newphoto){
            $position = strpos($request->newphoto, ';');
            $sub = substr($request->newphoto, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->newphoto)->resize(400, 400);
            $uploadPath = 'images/suppliers/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $image_path = public_path().'/'.$data->photo;
            if(File::exists($image_path) && $image_path != public_path().'/images/shop.png'){
                unlink($image_path);
            }

            $request['photo'] = $imageURL;
            $data->update($request->all());

        } else {
            $request['photo'] = $data->photo;
            $data->update($request->all());
        }

        return response()->json(['msg' => 'Data supplier berhasi diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $image_path = public_path().'/'.$supplier->photo;
        if(File::exists($image_path) && $image_path != public_path().'/images/shop.png'){
            unlink($supplier->photo);
            $supplier->delete();
        } else {
            $supplier->delete();
        }
        return response()->json(['msg' => 'Data berhasil dihapus!']);
    }
}
