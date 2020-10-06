<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Image;
use File;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Item::with('category', 'supplier')->orderBy('id', 'DESC')->get();
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
            'name' => 'required|unique:items',
            'buyPrice' => 'required',
            'sellPrice' => 'required',
            'qty' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buyDate' => 'required',
        ]);

        if($request->image){
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->image)->resize(800, 800);
            $uploadPath = 'images/items/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $request['image'] = $imageURL;
            Item::create($request->all());
        } else {
            $request['image'] = 'images/product.png';
            Item::create($request->all());
        }

        return response()->json(['msg' => 'Data produk berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Item::find($id);
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
            'name' => 'required|unique:items,name,'.$id,
            'buyPrice' => 'required',
            'sellPrice' => 'required',
            'qty' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buyDate' => 'required',
        ]);

        $data = Item::find($id);
        if($request->new_image){
            $position = strpos($request->new_image, ';');
            $sub = substr($request->new_image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().'.'.$ext;
            $img = Image::make($request->new_image)->resize(800, 800);
            $uploadPath = 'images/items/';
            $imageURL = $uploadPath.$name;
            $img->save($imageURL);

            $image_path = public_path().'/'.$data->image;
            if(File::exists($image_path) && $image_path != public_path().'/images/product.png')
            {
                unlink($data->image);
            }

            $request['image'] = $imageURL;
            $data->update($request->all());

        } else {

            $request['image'] = $data->image;
            $data->update($request->all());
            
        }

        return response()->json(['msg' => 'Data produk berhasil diubah!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $image_path = public_path().'/'.$item->image;
        if(File::exists($image_path) && $image_path != public_path().'/images/product.png'){
            unlink($item->image);
            $item->delete();
        } else {
            $item->delete();
        }
        return response()->json(['msg' => 'Data berhasil dihapus!']);
    }
}
