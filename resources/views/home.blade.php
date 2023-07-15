@extends('layouts.app')


@section('title', 'Dashboard')


@section('content')
    <div class="p-1 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5 text-center">
            @if (Auth::user()->role == 'admin')
                <p>
                    Total Pengiriman Selama 3 Bulan Terakhir:
                </p>
                <h3> {{ $threeMonthsAgo }} pengiriman.</h3><br>

                <p>
                    Lokasi Terbanyak yang Dituju dalam 1 Bulan Terakhir:
                </p>
                <h3> {{ $lokasiNameTerbanyak }}</h3><br>

                <p>
                    Jumlah Barang Terbanyak yang Dikirim dalam 1 Tahun Terakhir:
                </p>
                <h3> {{ $namaBarangTerbanyakOneYear }} ({{ $jumlahBarangTerbanyakOneYear }} barang)</h3><br>

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
            @else
                <h1 class="display-5 fw-bold ">Transporter</h1>
                <p><img src="https://www.locate2u.com/wp-content/uploads/A-1-47-1024x576.webp" height="250">
                </p>
                <h5 class="fs-4">Selamat datang di Transporter. Silakan akses menu Transaksi untuk melakukan input data
                    pengiriman!
                </h5>
            @endif
        </div>
    </div>
@endsection

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "Data Lokasi Pengiriman yang mempunyai lebih dari 100 Barang Dikirim di Bulan ini."
            },
            data: [{
                type: "doughnut",
                indexLabel: "{symbol} - {y}",
                yValueFormatString: "#,##0.0\"%\"",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: <?php echo json_encode($listLokasiNameTerbanyakLebihDari100BulanIni, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

        var chart2 = new CanvasJS.Chart("chartContainer2", {
            theme: "light2",
            animationEnabled: true,
            title: {
                text: "Data Barang yang Dikirim di Tahun ini dengan Harga Lebih Dari 1000."
            },
            data: [{
                type: "doughnut",
                indexLabel: "{symbol} - {y}",
                yValueFormatString: "#,##0.0\"%\"",
                showInLegend: true,
                legendText: "{label} : {y}",
                dataPoints: <?php echo json_encode($listBarangTerbanyakDenganHargaLebihDari1000TahunIni, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart2.render();

    }
</script>
