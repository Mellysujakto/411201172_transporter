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

    public function lokasiPengirimanLebihDari100BulanIni()
    {
        $year = Carbon::now()->year();
        $month = Carbon::now()->month();

        //bulan ini
        $listPengirimanBulanIni = Pengiriman::all()->where('tanggal', '<=', now()->format('Y-m-d'))->where('tanggal', '>=', "$year-$month-1")->toArray();

        //counts barang
        $countsBarang = [];
        foreach ($listPengirimanBulanIni as $item) {
            $barangId = $item['barang_id'];
            if (isset($countsBarang[$barangId])) {
                $countsBarang[$barangId]++;
            } else {
                $countsBarang[$barangId] = 1;
            }
        }

        //cari lokasi yang barangnya lebih dari 100
        $counts = [];
        foreach ($listPengirimanBulanIni as $item) {
            if ($countsBarang[$item['barang_id']] > 100) {
                $lokasiId = $item['lokasi_id'];
                if (isset($counts[$lokasiId])) {
                    $counts[$lokasiId]++;
                } else {
                    $counts[$lokasiId] = 1;
                }
            }
        }

        $filteredCounts = array_filter($counts, function ($value) {
            return $value > 100;
        });

        return response()->json($filteredCounts, 200);
    }

    public function totalPengiriman3BulanTerakhir()
    {
        $currentDate = Carbon::now();

        $threeMonthsAgo = $currentDate->subMonths(3)->format('Y-m-d');

        $listPengiriman3BulanIni = Pengiriman::all()->where('tanggal', '>=', $threeMonthsAgo);

        return response()->json($listPengiriman3BulanIni, 200);
    }

    //expect 1 lokasi_id
    public function bestLokasiLastMonth()
    {
        $currentDate = Carbon::now();
        $oneMonthAgo = $currentDate->subMonths(1)->format('Y-m-d');

        $list = Pengiriman::all()->where('tanggal', '>=', $oneMonthAgo);

        $counts = [];
        foreach ($list as $item) {
            $lokasiId = $item['lokasi_id'];
            if (isset($counts[$lokasiId])) {
                $counts[$lokasiId]++;
            } else {
                $counts[$lokasiId] = 1;
            }
        }

        $bestOne = null;
        foreach ($counts as $key => $value) {
            if ($bestOne == null || $bestOne < $value) {
                $bestOne = $key;
            }
        }

        return response()->json($bestOne, 200);
    }


    //expect number of jumlah barang
    public function bestTotalItemTerbanyakLastYear()
    {
        $currentDate = Carbon::now();
        $oneYearAgo = $currentDate->subYears(1)->format('Y-m-d');

        $list = Pengiriman::all()->where('tanggal', '>=', $oneYearAgo);

        $counts = [];
        foreach ($list as $item) {
            $barangId = $item['barang_id'];
            if (isset($counts[$barangId])) {
                $counts[$barangId]++;
            } else {
                $counts[$barangId] = 1;
            }
        }

        $bestOneNumber = null;
        $bestKey = null;
        foreach ($counts as $key => $value) {
            if ($bestOneNumber == null || $bestOneNumber < $value) {
                $bestOneNumber = $value;
                $bestKey = $key;
            }
        }
        $result = ['id' => $bestKey, 'value'=> $bestOneNumber];

        return response()->json($result, 200);
    }

    //expect barang_id dan jumlahnya
    public function barangDenganHargaLebihDari1000TahunIni()
    {
        $year = Carbon::now()->year();

        $list = Pengiriman::all()->where('harga_barang', '>', 1000)->where('tanggal', '>=', "$year-1-1");

        $counts = [];
        foreach ($list as $item) {
            $barangId = $item['barang_id'];
            if (isset($counts[$barangId])) {
                $counts[$barangId]++;
            } else {
                $counts[$barangId] = 1;
            }
        }
        return response()->json($counts, 200);
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
