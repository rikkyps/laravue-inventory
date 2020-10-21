<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;

class OrderController extends Controller
{
    public function getTodayOrder()
    {
        $date = date('Y-m-d');
        $sales = Sale::with('customer')->where('orderDate', $date)->orderBy('id', 'DESC')->get();
        return response()->json($sales);
    }

    public function getOrderDetail($id)
    {
        return Sale::with('customer')->where('id', $id)->first();
    }
    
    public function getOrderDetailAll($id)
    {
        return Sale::with('items')->where('id', $id)->first();
    }

    public function getSearchOrder(Request $request)
    {
        $data = Sale::with('customer')->where('orderDate', $request->date)->orderBy('id', 'DESC')->get();
        if($data->isEmpty()){
            return response()->json(['msg' => 'Data penjualan tidak ditemukan!'], 404);
        } else {
            return response()->json($data);
        }
    }
}
