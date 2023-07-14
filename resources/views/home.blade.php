@extends('layouts.app')


@section('title', 'Dashboard')


@section('content')
    <div class="p-1 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-5 fw-bold ">Transporter</h1>
            <p><img src="https://www.locate2u.com/wp-content/uploads/A-1-47-1024x576.webp"
                    height="250">
            </p>
            @if (Auth::user()->role == 'admin')
                <h5 class="fs-4">Selamat datang di Transporter for Admin.
                </h5>
                <br>
                <button class="btn btn-primary btn-lg" type="button" onclick="window.location.href='#data'">Data Saat
                    Ini</button>
            @else
                <h5 class="fs-4">Selamat datang di Transporter. Silakan akses menu Transaksi untuk melakukan input data pengiriman!
                </h5>
            @endif
        </div>
    </div>

@endsection
