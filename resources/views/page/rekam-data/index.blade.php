@extends('layouts.template')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <img src="{{ asset('assets/img/rekam-data-icon.png') }}" alt="Icon"
                    style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
                <h1 style="display: inline;">Rekam Data</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Rekam Data</div>
                </div>
            </div>

            <div class="section-body">
                <!-- <h2 class="section-title">Tabs</h2>
                      <p class="section-lead">The tab component for dividing parts of content.</p> -->

                <div class="card">
                    <!-- <div class="card-header">
                          <h4>Tab <code>.nav-pills</code></h4>
                        </div> -->
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            <ul class="nav nav-pills" id="myTab3" role="tablist" style="width: 100%; max-width: 600px;">
                                <li class="nav-item" style="flex: 1;">
                                    <a class="nav-link active text-center font-weight-bold" id="home-tab3" data-toggle="tab"
                                        href="#home3" role="tab" aria-controls="home" aria-selected="true"
                                        style="border-radius: 15px;">Data Kelembapan</a>
                                </li>
                                <li class="nav-item" style="flex: 1;">
                                    <a class="nav-link text-center font-weight-bold" id="profile-tab3" data-toggle="tab"
                                        href="#profile3" role="tab" aria-controls="profile" aria-selected="false"
                                        style="border-radius: 15px;">Data Suhu</a>
                                </li>
                            </ul>
                        </div>

                        <div class="d-flex justify-content-start align-items-center">
                            <span
                                style="width: 20px; height: 20px; background-color: #333333; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
                            <p class="font-weight-bold mb-0">Arahkan Kursor untuk melihat nilai suhu & kelembapan</p>
                        </div>

                        <div class="d-flex justify-content-start align-items-center mt-2">
                            <span
                                style="width: 20px; height: 20px; background-color: #BFFA01; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
                            <p class="font-weight-bold mb-0">Nilai Kelembapan & Suhu</p>
                        </div>

                        <div class="d-flex justify-content-end align-items-center">
                            <!-- date range picker -->

                            <div class="input-group rounded"
                                style="flex: 1; max-width: 300px; margin-right: 10px; border-radius: 15px; overflow: hidden; background-color: #f0f8ff;">
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                    placeholder="Masukkan tanggal awal" value="{{ $tgl_awal }}" required> - <input
                                    type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                    placeholder="Masukkan tanggal akhir" value="{{ $tgl_akhir }}" required>
                            </div>
                            <button class="btn btn-success mr-2 " style="border-radius: 12px; height: 38px;"
                                onclick="filterData()">
                                <i class="fas fa-search"></i> cek
                            </button>
                            <!-- button cetak -->
                            <button class="btn btn-primary" style="border-radius: 12px; height: 38px;" onclick="exportData()">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>

                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                aria-labelledby="home-tab3">
                                <div class="row">
                                    <div class="col-10 col-md-6 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h4>Line Chart</h4> -->
                                            </div>
                                            <div class="card-body">
                                                <div id="kelembapanChart"></div>
                                                <!-- Ganti canvas dengan div untuk ApexCharts -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <div class="row">
                                    <div class="col-10 col-md-6 col-lg-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h4>Line Chart</h4> -->
                                            </div>
                                            <div class="card-body">
                                                <div id="temperaturChart"></div>
                                                <!-- Ganti canvas dengan div untuk ApexCharts -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> --}}



    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        function filterData() {
            var tanggalAwal = document.getElementById('tanggal_awal').value;
            var tanggalAkhir = document.getElementById('tanggal_akhir').value;
            console.log(
                tanggalAwal
            );


            window.location.href = `/monitoring/` + tanggalAwal + `/` + tanggalAkhir;
        }

        function exportData() {
            var tanggalAwal = document.getElementById('tanggal_awal').value;
            var tanggalAkhir = document.getElementById('tanggal_akhir').value;
            // Check the active tab
            const activeTab = document.querySelector('.nav-link.active').id;

            // Redirect based on the active tab
            if (activeTab === 'home-tab3') {
                // Redirect to export humidity data
                window.location.href = `/cetak_humidity/` + tanggalAwal + `/` + tanggalAkhir;
            } else if (activeTab === 'profile-tab3') {
                // Redirect to export temperature data

                window.location.href = `/cetak_temperature/` + tanggalAwal + `/` + tanggalAkhir;
            }
        }









        // Data dari controller

        // Data dari controller
        var categories = @json($categories);
        var suhuData = @json($suhuData);

        // Konversi angka suhuData agar titik diganti dengan koma
        suhuData = suhuData.map(value => value.toLocaleString('id-ID'));

        // Mendapatkan nilai maksimum dari suhuData
        var maxTemperature = Math.max(...@json($suhuData));

        // Konfigurasi grafik ApexCharts untuk temperatur
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Average Temperature',
                data: suhuData
            }],
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: '#666', // Warna label di sumbu x
                        fontSize: '12px'
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#cccccc', // Warna border sumbu x
                    height: 1.5
                },
                axisTicks: {
                    show: true,
                    color: '#cccccc' // Warna ticks sumbu x
                }
            },
            yaxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString('id-ID');
                    },
                    style: {
                        colors: '#666', // Warna label di sumbu y
                        fontSize: '12px'
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#cccccc', // Warna border sumbu y
                    width: 1.5
                },
                axisTicks: {
                    show: true,
                    color: '#cccccc' // Warna ticks sumbu y
                },
                tickAmount: 5, // Menentukan jumlah gridlines (jumlah step di sumbu y)
                min: 0, // Memulai dari 0
                max: Math.ceil(maxTemperature / 100) *
                    100, // Maksimum sesuai data tertinggi, dibulatkan ke ratusan terdekat
                forceNiceScale: true
            },
            grid: {
                borderColor: '#cccccc', // Warna gridlines
                strokeDashArray: 5, // Membuat garis putus-putus
                xaxis: {
                    lines: {
                        show: true // Menampilkan garis grid di sumbu x
                    }
                },
                yaxis: {
                    lines: {
                        show: true // Menampilkan garis grid di sumbu y
                    }
                }
            },
            colors: ['#c4ff00'], // Warna untuk grafik suhu
            title: {
                text: ' Average Temperature',
                align: 'center'
            }
        };

        // Inisialisasi dan render grafik
        var chart = new ApexCharts(document.querySelector("#temperaturChart"), options);
        chart.render();







        var categories = @json($categories);
        var kelembabanData = @json($kelembabanData);

        // Konversi angka kelembabanData agar titik diganti dengan koma
        kelembabanData = kelembabanData.map(value => value.toLocaleString('id-ID'));

        // Mendapatkan nilai maksimum dari kelembabanData
        var maxHumidity = Math.max(...@json($kelembabanData));

        // Konfigurasi grafik ApexCharts untuk temperatur
        var options = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Average Humidity',
                data: kelembabanData
            }],
            xaxis: {
                categories: categories,
                labels: {
                    style: {
                        colors: '#666', // Warna label di sumbu x
                        fontSize: '12px'
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#cccccc', // Warna border sumbu x
                    height: 1.5
                },
                axisTicks: {
                    show: true,
                    color: '#cccccc' // Warna ticks sumbu x
                }
            },
            yaxis: {
                title: {
                    text: 'Humidity (°C)'
                },
                labels: {
                    formatter: function(value) {
                        return value.toLocaleString('id-ID');
                    },
                    style: {
                        colors: '#666', // Warna label di sumbu y
                        fontSize: '12px'
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#cccccc', // Warna border sumbu y
                    width: 1.5
                },
                axisTicks: {
                    show: true,
                    color: '#cccccc' // Warna ticks sumbu y
                },
                tickAmount: 5, // Menentukan jumlah gridlines (jumlah step di sumbu y)
                min: 0, // Memulai dari 0
                max: Math.ceil(maxHumidity / 100) *
                    100, // Maksimum sesuai data tertinggi, dibulatkan ke ratusan terdekat
                forceNiceScale: true
            },
            grid: {
                borderColor: '#cccccc', // Warna gridlines
                strokeDashArray: 5, // Membuat garis putus-putus
                xaxis: {
                    lines: {
                        show: true // Menampilkan garis grid di sumbu x
                    }
                },
                yaxis: {
                    lines: {
                        show: true // Menampilkan garis grid di sumbu y
                    }
                }
            },
            colors: ['#c4ff00'], // Warna untuk grafik suhu
            title: {
                text: ' Average Humidity',
                align: 'center'
            }
        };

        // Inisialisasi dan render grafik
        var chart = new ApexCharts(document.querySelector("#kelembapanChart"), options);
        chart.render();
    </script>
@endsection
