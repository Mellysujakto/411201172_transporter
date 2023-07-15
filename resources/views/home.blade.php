@extends('layouts.app')


@section('title', 'Dashboard')


@section('content')
    <div class="p-1 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5 text-center">
            @if (Auth::user()->role == 'admin')
                <div style="display: flex; justify-content: space-evenly">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">
                                    <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="padding: 20px">
                    <div class="p-5 mb-4 rounded-3" id="data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body" style="background-color:thistle">
                                        <blockquote class="blockquote mb-0">
                                            <h6>
                                                Total Pengiriman Selama 3 Bulan Terakhir:
                                            </h6>
                                            <footer class="blockquote-footer">{{ $threeMonthsAgo }} <cite
                                                    title="Source title">Pengiriman</cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body" style="background-color:bisque">
                                        <blockquote class="blockquote mb-0">
                                            <h6>
                                                Lokasi Terbanyak yang Dituju dalam 1 Bulan Terakhir:
                                            </h6>
                                            <footer class="blockquote-footer">{{ $lokasiNameTerbanyak }}<cite
                                                    title="Source title"></cite></footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body" style="background-color:aquamarine">
                                        <blockquote class="blockquote mb-0">
                                            <h6>
                                                Barang Terbanyak Dikirim dalam 1 Tahun Terakhir:
                                            </h6>
                                            <footer class="blockquote-footer">{{ $namaBarangTerbanyakOneYear }} <cite
                                                    title="Source title">({{ $jumlahBarangTerbanyakOneYear }} barang)</cite>
                                            </footer>
                                        </blockquote>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                text: "Data Lokasi Pengiriman yang mempunyai lebih dari 100 Barang Dikirim di Bulan ini",
                fontSize: 14
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
                text: "Data Barang yang Dikirim di Tahun ini dengan Harga Lebih Dari 1000",
                fontSize: 14
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
