<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Expense;
use App\Item;

class HomeController extends Controller
{
    public function getDataHome()
    {
        $date = date('Y-m-d');
        $data = Sale::where('orderDate', $date)->get();
        return response()->json([
            'todaySaleAmount' => $this->todaySaleAmount($data),
            'todayIncome' => $this->todaySaleIncome($data),
            'todaySales' => $data->count(),
            'todayExpenses' => $this->todayExpense($date)
        ]);
    }

    public function stockOut()
    {
        $data = Item::with('category')->where('qty', '<', '1')->get();
        return response()->json($data);
    }

    private function todaySaleAmount($data)
    {
        $total = 0;
        if($data->count() > 0)
        {
            $margin = $data->pluck('amount')->all();
            $total = array_sum($margin);
        }

        return $total;
    }

    private function todaySaleIncome($data)
    {
        $total = 0;
        if($data->count() > 0)
        {
            $margin = $data->pluck('grandTotal')->all();
            $total = array_sum($margin);
        }

        return $total;
    }

    private function todayExpense($date)
    {
        $total = 0;
        $data = Expense::where('date', $date)->get();
        if($data->count() > 0)
        {
            $margin = $data->pluck('amount')->all();
            $total = array_sum($margin);
        }

        return $total;
    }
}
