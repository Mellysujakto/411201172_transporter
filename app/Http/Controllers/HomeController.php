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
        $dataPoints = [];
        if (Auth::user()->role == 'admin') {
            $dataPoints = [['label' => 'Oxygen', 'symbol' => 'O', 'y' => 46.6], ['label' => 'Silicon', 'symbol' => 'Si', 'y' => 27.7]];
        }

        $pengirimanThreeMonthsAgo = HttpClient::get('api/pengiriman/threeMonthsAgo');
        $threeMonthsAgo = count(json_decode($pengirimanThreeMonthsAgo->getContent(), true));
        return view('home', compact('dataPoints', 'threeMonthsAgo'));
    }
}
