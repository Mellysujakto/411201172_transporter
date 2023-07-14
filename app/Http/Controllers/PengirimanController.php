<?php

namespace App\Http\Controllers;

use App\Http\Client\HttpClient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengirimanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = null;
        if (Auth::user()->role == 'admin') {
            $response = HttpClient::get('api/pengiriman');
        } else {
            $kurirId = Auth::user()->id;
            $response = HttpClient::get("api/pengiriman/kurir/$kurirId");
        }
        $products = json_decode($response->getContent(), true);
        return view('pengiriman.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $randomNo =  Str::random(10);
        $noTransaksi = "TRX-$randomNo";

        $responseBarang = HttpClient::get('api/barang');
        $barang = json_decode($responseBarang->getContent(), true);
        $responseLokasi = HttpClient::get('api/lokasi');
        $lokasi = json_decode($responseLokasi->getContent(), true);
        return view('pengiriman.create', compact('barang', 'lokasi', 'noTransaksi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $this->validate(request(), [
            'barang_id' => 'required|not_in:Silakan Pilih',
            'lokasi_id' => 'required|not_in:Silakan Pilih',
        ]);
        
        $response = HttpClient::post('api/pengiriman', [], [], [], [], $request->getContent());
        if ($response->status() >= 400) {
            return redirect('pengiriman')->with('failed', 'Data pengiriman gagal ditambahkan');
        }
        return redirect('pengiriman')->with('success', 'Data pengiriman berhasil ditambahkan');;
    }
}
