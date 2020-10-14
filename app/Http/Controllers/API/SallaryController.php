<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Sallary;

class SallaryController extends Controller
{
    public function paid(Request $request, $id)
    {
        $validator = $request->validate([
            'sallaryMonth' => 'required',
            'sallary' => 'required',
        ]);

        $data = Sallary::where('employee_id', $id)->where('sallaryMonth', $request->sallaryMonth['month'])->where('sallaryYear', $request->sallaryMonth['year'])->first();

        if($data != null){
            return response()->json(['msg' => 'Gaji telah dibayarkan sebelumnya!']);
        } else {
            $sallary = new Sallary;
            $sallary->employee_id = $request->id;
            $sallary->amount = $request->sallary;
            $sallary->sallaryDate = date('Y-m-d');
            $sallary->sallaryMonth = $request->sallaryMonth['month'];
            $sallary->sallaryYear = $request->sallaryMonth['year'];
            $sallary->save();
            
            return response()->json(['msg' => 'Gaji berhasil dibayarkan!']);
        }
    } 

    public function index()
    {
        $data = Sallary::select('sallaryMonth')->groupBy('sallaryMonth')->get();
        return response()->json($data);
    }

    public function showData($id)
    {
        $data = Sallary::with('employee')->where('sallaryMonth', $id)->get();
        return response()->json($data);
    }

    public function edit($id)
    {
        $data = Sallary::with('employee')->where('id', $id)->first();
        return response()->json([
            'employee_id' => $data->employee_id,
            'name' => $data->employee->name,
            'ktp' => $data->employee->ktp,
            'sallaryMonth' => $data->sallaryMonth,
            'sallaryYear' => $data->sallaryYear,
            'amount' => $data->amount
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'sallaryMonth' => 'required',
            'amount' => 'required'
        ]);

        $request['sallaryYear'] = date('Y');

        $data = Sallary::find($id);
        $data->update($request->all());

        return response()->json(['msg' => 'Data pembayaran gaji berhasil diupdate!']);
    }
}
