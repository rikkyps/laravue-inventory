<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pos;
use App\Item;
use DB;

class CartController extends Controller
{
    public function addToCart($id)
    {
        $data = Item::find($id);
        $posData = Pos::where('item_id', $id)->first();

        if($posData){

            if($posData->qty >= $data->qty){
                return response()->json(['msg' => 'Kuantitas melebihi stok produk'], 422);
            } else {
                $posData->increment('qty');
                return response()->json(['data' => $data, 'msg' => 'Produk berhasil ditambahkan!']);
            }

        } else {

            $pos = new Pos;
            $pos->item_id = $data->id;
            $pos->name = $data->name;
            $pos->qty = 1;
            $pos->price = $data->sellPrice;
            $pos->subTotal = $data->sellPrice;
            $pos->save();

            return response()->json(['data' => $data, 'msg' => 'Produk berhasil ditambahkan!']);
        }

    }

    public function getCart()
    {
        return Pos::with('item')->get();
    }

    public function destroy($id)
    {
        Pos::destroy($id);
        return response()->json(['msg' => 'Item berhasil dihapus']);
    }

    public function addQty($id)
    {
        $lastPos = Pos::find($id);

        if($lastPos->item->qty > $lastPos->qty)
        {
            Pos::where('id', $id)->increment('qty');
            $newPost = Pos::find($id);
            $subTotal = ($newPost->qty * $newPost->price);
            $lastPos->update(['subTotal' => $subTotal]);
        }
    }

    public function delQty($id)
    {
        Pos::where('id', $id)->decrement('qty');

        $lastPos = Pos::find($id);

        if($lastPos->qty < 1){
            Pos::destroy($id);
        } else {
            $subTotal = ($lastPos->qty * $lastPos->price);
            $lastPos->update(['subTotal' => $subTotal]);
        }
        
    }

    public function getVat()
    {
        $data = DB::table('extras')->select('vat')->first();
        return response()->json($data);
    }
}
