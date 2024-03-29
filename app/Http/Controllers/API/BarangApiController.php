<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Support\Facades\Validator;

class BarangApiController extends Controller
{
    public function list()
    {
        $list = Barang::all();
        return response()->json($list, 200);
    }

    public function getById($id)
    {
        $detail = Barang::find($id);
        return response()->json($detail, 200);
    }


    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('kode_barang is required', 400);
        }
        $result = Barang::create($request->all());
        return response()->json($result, 201);
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'kode_barang' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('id and kode_barang is required', 400);
        }

        Barang::where('id', $id)
            ->update($request->all());
        $result = Barang::find($id);

        return response()->json($result, 200);
    }


    public function delete($id)
    {
        Barang::where('id', $id)->delete();
        return response()->json("Data Barang with id $id already deleted", 200);
    }
}
