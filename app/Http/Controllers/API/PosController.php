<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Category;
use App\Sale;
use App\Pos;
use DB;

class PosController extends Controller
{
    public function getItemByCategory($id)
    {
        return $data = Item::where('category_id', $id)->get();
    }

    public function getAllCategory()
    {
        return Category::where('status', 1)->get();
    }

    public function addSales(Request $request)
    {
        $validator = $request->validate([
            'customer_id' => 'required',
            'payMethod' => 'required',
            'amount' => 'required',
            'due' => 'required',
            'payMethod' => 'required'
        ]);
        
        $sale = new Sale;
        $sale->customer_id = $request->customer_id;
        $sale->qty = $request->qty;
        $sale->subTotal = $request->subTotal;
        $sale->vat = $request->vat;
        $sale->grandTotal = $request->grandTotal;
        $sale->amount = $request->amount;
        $sale->due = $request->due;
        $sale->payMethod = $request->payMethod;
        $sale->grandTotal = $request->grandTotal;
        $sale->orderDate = date('Y-m-d');
        $sale->orderMonth = date('F');
        $sale->orderYear = date('Y');
        $sale->save();

        $saleLast = Sale::latest()->first();
        $carts = Pos::get();
        $this->addItemSale($saleLast, $carts);
        $this->deleteCart();
        return response()->json(['msg' => 'Transaksi berhasil']);
        
    }

    private function addItemSale($saleLast, $carts)
    {
        foreach($carts as $cart){
            $saleLast->items()->attach($saleLast->id, [
                'item_id' => $cart->item_id,
                'qty' => $cart->qty,
                'price' => $cart->price,
                'subTotal' => $cart->subTotal
            ]);

            DB::table('items')->where('id', $cart->item_id)->update(['qty' => DB::raw('qty -' .$cart->qty)]);
        }
    }

    private function deleteCart()
    {
        Pos::query()->delete();
    }
}
