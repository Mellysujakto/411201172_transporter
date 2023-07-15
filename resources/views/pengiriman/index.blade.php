@extends('layouts.app')

@section('title', 'Data Pengiriman Anda')

@section('content')
    <div class="p-4 mb-3">
        <div style="display: flex; justify-content: space-between; padding-bottom: 20px;">
            <h2>Data Pengiriman Anda</h2>
            <a name="" id="" class="btn btn-primary" href="pengiriman/create" role="button">Tambah Data
                Pengiriman</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">No Transaksi Pengiriman</th>
                        <th scope="col">Tanggal Pengiriman</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah Barang</th>
                        <th scope="col">Harga Barang</th>
                        <th scope="col">Kurir</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Is Approved</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr>

                            <td>{{ $no++ }}</td>
                            <td>{{ $product['no_pengiriman'] }}</td>
                            <td>{{ $product['tanggal'] }}</td>
                            <td>{{ $product['lokasi_id'] }}</td>
                            <td>{{ $product['barang_id'] }}</td>
                            <td>{{ $product['jumlah_barang'] }}</td>
                            <td>{{ $product['harga_barang'] }}</td>
                            <td>{{ $product['kurir_id'] }}</td>
                            <td>{{ $product['created_at'] }}</td>
                            <td>{{ $product['is_approved'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
@endsection
