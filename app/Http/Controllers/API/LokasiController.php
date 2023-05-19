<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    public function list()
    {
        $list = Lokasi::all();
        return response()->json($list, 200);
    }

    public function getById($id)
    {
        $detail = Lokasi::find($id);
        return response()->json($detail, 200);
    }


    public function create(Request $request)
    {
        $result = Lokasi::create($request->all());
        return response()->json($result, 201);
    }


    public function update(Request $request)
    {
        $id = $request->input('id');
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('id is required', 400);
        }

        Lokasi::where('id', $id)
            ->update($request->all());
        $result = Lokasi::find($id);

        return response()->json($result, 200);
    }


    public function delete($id)
    {
        Lokasi::where('id', $id)->delete();
        return response()->json("Data Lokasi with id $id already deleted", 200);
    }
}
