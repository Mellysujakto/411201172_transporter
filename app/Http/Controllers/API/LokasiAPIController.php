<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lokasi;
use App\Models\Pengiriman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class LokasiAPIController extends Controller
{
    public function list()
    {
        $list = Lokasi::all();
        return response()->json($list, 200);
    }

    public function availableList()
    {
        $currentDate = Carbon::now()->format('Y-m-d');

        $pengirimanHariIni = Pengiriman::all()->where('tanggal', '==', $currentDate);

        $counts = [];
        foreach ($pengirimanHariIni as $item) {
            $lokasiId = $item['lokasi_id'];
            if (isset($counts[$lokasiId])) {
                $counts[$lokasiId]++;
            } else {
                $counts[$lokasiId] = 1;
            }
        }

        $filteredCounts = array_filter($counts, function ($value) {
            return $value > 5;
        });

        $realCounts = [];
        foreach ($filteredCounts as $key => $value) {
            array_push($realCounts, $key);
        }

        $list = Lokasi::all();

        $filteredlist = [];
        if (count($realCounts) != 0) {
            foreach ($list as $item) {
                if (!in_array($item['id'], $realCounts)) {
                    array_push($filteredlist, $item);
                }
            }
        } else {
            $filteredlist = $list;
        }

        return response()->json($filteredlist, 200);
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
