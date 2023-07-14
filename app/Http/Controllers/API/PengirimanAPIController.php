<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PengirimanAPIController extends Controller
{
    public function list()
    {
        $list = Pengiriman::all();
        return response()->json($list, 200);
    }

    public function listByKurirId($kurirId)
    {
        $list = Pengiriman::all()->where('kurir_id', $kurirId);
        return response()->json($list, 200);
    }

    public function input(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_pengiriman' => 'required',
            'barang_id' => 'required',
            'lokasi_id' => 'required',
            'kurir_id' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json('no_pengiriman, barang_id, kurir_id, and lokasi_id are required', 400);
        }
        $jumlahBarang = 0;
        if ($request->input('jumlah_barang') != "") {
            $jumlahBarang = $request->input('jumlah_barang');
        }

        $hargaBarang = 0;
        if ($request->input('harga_barang') != "") {
            $hargaBarang = $request->input('harga_barang');
        }

        $result = Pengiriman::create([
            'no_pengiriman' => $request->input('no_pengiriman'),
            'tanggal'  => Carbon::now()->toDateTimeLocalString(),
            'lokasi_id'  => $request->input('lokasi_id'),
            'barang_id'  => $request->input('barang_id'),
            'jumlah_barang'  => $jumlahBarang,
            'harga_barang'  => $hargaBarang,
            'is_approved'  => false,
            'kurir_id'  => $request->input('kurir_id'),
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
