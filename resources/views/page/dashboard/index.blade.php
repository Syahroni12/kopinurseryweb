@extends('layouts.template')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                @foreach ($data as $item)
                    <div class="col-lg-6 col-md-4 col-sm-12" id="alat-{{ $item['id'] }}">
                        <div class="card card-statistic-2 d-flex flex-column" style="height: 250px;">
                            <div class="card-stats-title text-center" style="padding-top: 15px;">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo"
                                    style="width: 50px; height: 50px;">
                                <h4> Alat {{ $item['id'] }}</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding-left: 80px;">
                                    <div class="card-icon shadow-primary bg-dark"
                                        style="border-radius: 100px; width: 70px; height: 60px;">
                                        <img src="{{ asset('assets/img/cloud-temperature.png') }}" alt="Thermometer Icon"
                                            style="width: 35px; height: 35px;">
                                    </div>
                                    <div class="card-wrap">
                                        <div class="card-body" style="font-size: 2rem;"
                                            id="temperature-{{ $item['id'] }}">
                                            {{ $item['nilai_temperature']->nilai_temperature ?? '-' }}
                                        </div>
                                        <div class="card-header">
                                            <h4 style="font-size: 1rem;">Suhu</h4>
                                        </div>
                                        <div class="card-body">
                                            <span style="font-size: 0.9rem;">Ideal :28-30°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-right: 80px;">
                                    <div class="card-icon shadow-primary bg-dark"
                                        style="border-radius: 100px; width: 70px; height: 60px;">
                                        <img src="{{ asset('assets/img/cloud-humidity.png') }}" alt="Humidity Icon"
                                            style="width: 35px; height: 35px;">
                                    </div>
                                    <div class="card-body" style="font-size: 2rem;" id="humidity-{{ $item['id'] }}">
                                        {{ $item['nilai_humidity']->nilai_humidity ?? '-' }}
                                    </div>
                                    <div class="card-header">
                                        <h4 style="font-size: 1rem;">Kelembapan</h4>
                                    </div>
                                    <div class="card-body">
                                        <span style="font-size: 0.9rem;">Ideal :50-70%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchData() {
                $.ajax({
                    url: '/fetch-data',
                    type: 'GET',
                    success: function(response) {
                        response.forEach(item => {
                            $('#temperature-' + item.id).text(item.nilai_temperature
                                .nilai_temperature);
                            $('#humidity-' + item.id).text(item.nilai_humidity.nilai_humidity);
                        });

                        // console.log(response);

                    }
                });
            }

            // Polling setiap 5 detik
            setInterval(fetchData, 5000);
        });
    </script>
@endsection
