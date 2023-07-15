<?php

namespace App\Http\Controllers;

use App\Http\Client\HttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $lokasiTerbanyakLebihDari100BulanIniResponse = HttpClient::get('api/pengiriman/lokasi/lebihDariSeratusKali/thisMonth');
        $lokasiTerbanyakLebihDari100BulanIni = json_decode($lokasiTerbanyakLebihDari100BulanIniResponse->getContent(), true);
        $total100Percent = array_sum($lokasiTerbanyakLebihDari100BulanIni);
        $listLokasiNameTerbanyakLebihDari100BulanIni = [];
        foreach ($lokasiTerbanyakLebihDari100BulanIni as $key => $value) {
            $val = $value / $total100Percent * 100;
            $lokasiNameResponse = HttpClient::get("api/lokasi/$key");
            $lokasiName = json_decode($lokasiNameResponse->getContent(), true)['nama_lokasi'];
            array_push($listLokasiNameTerbanyakLebihDari100BulanIni, ['label'=> $lokasiName, 'symbol'=> $lokasiName, 'y' => $val]);
        }




        $pengirimanThreeMonthsAgo = HttpClient::get('api/pengiriman/threeMonthsAgo');
        $threeMonthsAgo = count(json_decode($pengirimanThreeMonthsAgo->getContent(), true));
        return view('home', compact('listLokasiNameTerbanyakLebihDari100BulanIni', 'threeMonthsAgo'));
    }
}
