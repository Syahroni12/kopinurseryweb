@extends('layouts.template')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card card-statistic-2 d-flex flex-column" style="height: 250px; ">
                    <div class="card-stats-title text-center">
                        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
                        <h4>Sensor 1</h4>
                    </div>

                    <div class="card-stats">
                        <div class="card-stats-items">
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Suhu Ideal</div>
                                <div class="card-stats-item-count">18°C</div>
                            </div>
                            <div class="card-stats-item">
                                <!-- <div class="card-stats-item-count">12</div>
                                <div class="card-stats-item-label">Shipping</div> -->
                            </div>
                            <div class="card-stats-item">
                                <div class="card-stats-item-label">Kelembapan Ideal</div>
                                <div class="card-stats-item-count">50%</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-icon shadow-primary bg-dark">
                                    <img src="{{asset('assets/img/cloud-temperature.png')}}" alt="Thermometer Icon" style="width: 35px; height: 35px;">
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Suhu</h4>
                                    </div>
                                    <div class="card-body">
                                        29°C
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-icon shadow-primary bg-dark">
                                    <img src="{{asset('assets/img/cloud-humidity.png')}}" alt="Humidity Icon" style="width: 35px; height: 35px;">
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Kelembapan</h4>
                                    </div>
                                    <div class="card-body">
                                        59%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </section>
</div>

@endsection