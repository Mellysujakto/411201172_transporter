@extends('layouts.app')


@section('title', 'Tambah Data Pengiriman')


@section('content')
    <div class="p-5 mb-3">
        <div class="container">
            <form action="{{ url('pengiriman') }}" method="post">
                {{ csrf_field() }}
                <div class="mb-3 row">
                    <label for="no_pengiriman" class="col-2 col-form-label">No Transaksi Pengiriman</label>
                    <div class="col-10">
                        <input type="text" value="{{ $noTransaksi }}" readonly=true class="form-control"
                            name="no_pengiriman" id="no_pengiriman">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col-10">
                        <input type="hidden" value="{{ Auth::user()->id }}" class="form-control"
                            name="kurir_id" id="kurir_id">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="barang_id" class="col-2 col-form-label">Nama Barang</label>
                    <div class="col-10">
                        <select class="form-select" name="barang_id" id="barang_id">
                            <option selected>Silakan Pilih</option>
                            @foreach ($barang as $brg)
                                <option value="{{ $brg['id'] }}">{{ $brg['nama_barang'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="lokasi_id" class="col-2 col-form-label">Tujuan Lokasi</label>
                    <div class="col-10">
                        <select class="form-select" name="lokasi_id" id="lokasi_id">
                            <option selected>Silakan Pilih</option>
                            @foreach ($lokasi as $lok)
                                <option value="{{ $lok['id'] }}">{{ $lok['nama_lokasi'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="harga_barang" class="col-2 col-form-label">Harga Barang (Optional)</label>
                    <div class="col-10">
                        <input type="number" min="0" step="1" oninput="validity.valid||(value='');"
                            class="form-control" name="harga_barang" id="harga_barang">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jumlah_barang" class="col-2 col-form-label">Jumlah Barang (Optional)</label>
                    <div class="col-10">
                        <input type="number" min="0" step="1" oninput="validity.valid||(value='');"
                            class="form-control" name="jumlah_barang" id="jumlah_barang">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="">
                        <button type="submit" class="btn btn-primary">Submit Pengiriman</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
