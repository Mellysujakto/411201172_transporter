<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurir;
use App\Models\Pengiriman;
use Illuminate\Support\Facades\Validator;

class PengirimanController extends Controller
{
    public function input(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_pengiriman' => 'required',
            'tanggal' => 'required|date',
            'jumlah_barang' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('no_pengiriman, tanggal, and jumlah_barang is required', 400);
        }

        $apiToken = $request->bearerToken();
        $kurirId = Kurir::all()->where('api_token', $apiToken)->first()->id;
        $result = Pengiriman::create([
            'no_pengiriman' => $request->input('no_pengiriman'),
            'tanggal'  => $request->input('tanggal'),
            'lokasi_id'  => $request->input('lokasi_id'),
            'barang_id'  => $request->input('barang_id'),
            'jumlah_barang'  => $request->input('jumlah_barang'),
            'harga_barang'  => $request->input('harga_barang'),
            'is_approved'  => false,
            'kurir_id'  => $kurirId,
        ]);

        return response()->json($result, 201);
    }

    public function approve(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('id is required', 400);
        }

        $id = $request->input('id');
        Pengiriman::where('id', $id)
            ->update([
                'is_approved' => true,
            ]);
        $result = Pengiriman::find($id);
        if ($result->empty) {
            return response()->json("ID pengiriman $id is not found", 404);
        }
        return response()->json($result, 201);
    }

    public function status($id)
    {
        $detail = Pengiriman::find($id);
        return response()->json($detail, 200);
    }
}
