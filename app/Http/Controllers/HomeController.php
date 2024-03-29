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
        //listLokasiNameTerbanyakLebihDari100BulanIni
        $lokasiTerbanyakLebihDari100BulanIniResponse = HttpClient::get('api/pengiriman/lokasi/lebihDariSeratusKali/thisMonth');
        $lokasiTerbanyakLebihDari100BulanIni = json_decode($lokasiTerbanyakLebihDari100BulanIniResponse->getContent(), true);
        $total100PercentLokasi = array_sum($lokasiTerbanyakLebihDari100BulanIni);
        $listLokasiNameTerbanyakLebihDari100BulanIni = [];
        foreach ($lokasiTerbanyakLebihDari100BulanIni as $key => $value) {
            $val = $value / $total100PercentLokasi * 100;
            $lokasiResponse = HttpClient::get("api/lokasi/$key");
            $lokasiName = json_decode($lokasiResponse->getContent(), true)['nama_lokasi'];
            array_push($listLokasiNameTerbanyakLebihDari100BulanIni, ['label' => $lokasiName, 'symbol' => $lokasiName, 'y' => $val]);
        }

        //listBarangTerbanyakDenganHargaLebihDari1000TahunIni
        $barangTerbanyakDenganHargaLebihDari1000TahunIniResponse = HttpClient::get('api/pengiriman/barang/hargaLebihDari1000/thisYear');
        $barangTerbanyakDenganHargaLebihDari1000TahunIniJson = json_decode($barangTerbanyakDenganHargaLebihDari1000TahunIniResponse->getContent(), true);
        $total100PercentBarang = array_sum($barangTerbanyakDenganHargaLebihDari1000TahunIniJson);
        $listBarangTerbanyakDenganHargaLebihDari1000TahunIni = [];
        foreach ($barangTerbanyakDenganHargaLebihDari1000TahunIniJson as $key => $value) {
            $val = $value / $total100PercentBarang * 100;
            $barangResponse = HttpClient::get("api/barang/$key");
            $barangName = json_decode($barangResponse->getContent(), true)['nama_barang'];
            array_push($listBarangTerbanyakDenganHargaLebihDari1000TahunIni, ['label' => $barangName, 'symbol' => $barangName, 'y' => $val]);
        }

        //lokasiTerbanyakLastMonth
        $lokasiTerbanyakLastMonthResponse = HttpClient::get('api/pengiriman/lokasi/best/lastMonth');
        $lokasiIdTerbanyak = json_decode($lokasiTerbanyakLastMonthResponse->getContent(), true);
        $lokasiNameTerbanyakResponse = HttpClient::get("api/lokasi/$lokasiIdTerbanyak");
        $lokasiNameTerbanyak = json_decode($lokasiNameTerbanyakResponse->getContent(), true)['nama_lokasi'];

        //jumlah Pengiriman ThreeMonthsAgo
        $pengirimanThreeMonthsAgo = HttpClient::get('api/pengiriman/threeMonthsAgo');
        $threeMonthsAgo = count(json_decode($pengirimanThreeMonthsAgo->getContent(), true));

        //jumlah barang terbanyak 1 tahun terakhir
        $jumlahBarangTerbanyakOneYearResponse = HttpClient::get('api/pengiriman/barang/bestNumber/lastYear');
        $jumlahBarangTerbanyakOneYearJson = json_decode($jumlahBarangTerbanyakOneYearResponse->getContent(), true);
        $jumlahBarangTerbanyakOneYear = $jumlahBarangTerbanyakOneYearJson['value'];
        $barangId = $jumlahBarangTerbanyakOneYearJson['id'];

        //nama barang terbanyak 1 tahun terakhir
        $namaBarangTerbanyakOneYearResponse = HttpClient::get("api/barang/$barangId");
        $namaBarangTerbanyakOneYear =  json_decode($namaBarangTerbanyakOneYearResponse->getContent(), true)['nama_barang'];
        return view('home', compact('listLokasiNameTerbanyakLebihDari100BulanIni', 'listBarangTerbanyakDenganHargaLebihDari1000TahunIni', 'threeMonthsAgo', 'lokasiNameTerbanyak', 'jumlahBarangTerbanyakOneYear', 'namaBarangTerbanyakOneYear'));
    }
}
