@extends('layouts.template')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card card-statistic-2 d-flex flex-column" style="height: 250px; ">
                    <div class="card-stats-title text-center" style="padding-top: 15px;">
                        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
                        <h4>Sensor 1</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left: 80px;">
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-temperature.png')}}" alt="Thermometer Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-wrap">
                                <div class="card-body" style="font-size: 2rem;">
                                    29°C
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
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-humidity.png')}}" alt="Humidity Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-body" style="font-size: 2rem;">
                                59%
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
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card card-statistic-2 d-flex flex-column" style="height: 250px; ">
                    <div class="card-stats-title text-center" style="padding-top: 15px;">
                        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
                        <h4>Sensor 1</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left: 80px;">
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-temperature.png')}}" alt="Thermometer Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-wrap">
                                <div class="card-body" style="font-size: 2rem;">
                                    29°C
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
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-humidity.png')}}" alt="Humidity Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-body" style="font-size: 2rem;">
                                59%
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
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card card-statistic-2 d-flex flex-column" style="height: 250px; ">
                    <div class="card-stats-title text-center" style="padding-top: 15px;">
                        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
                        <h4>Sensor 1</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left: 80px;">
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-temperature.png')}}" alt="Thermometer Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-wrap">
                                <div class="card-body" style="font-size: 2rem;">
                                    29°C
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
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-humidity.png')}}" alt="Humidity Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-body" style="font-size: 2rem;">
                                59%
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
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="card card-statistic-2 d-flex flex-column" style="height: 250px; ">
                    <div class="card-stats-title text-center" style="padding-top: 15px;">
                        <img src="{{asset('assets/img/logo.png')}}" alt="Logo" style="width: 50px; height: 50px;">
                        <h4>Sensor 1</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6" style="padding-left: 80px;">
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-temperature.png')}}" alt="Thermometer Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-wrap">
                                <div class="card-body" style="font-size: 2rem;">
                                    29°C
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
                            <div class="card-icon shadow-primary bg-dark" style="border-radius: 100px; width: 70px; height: 60px;">
                                <img src="{{asset('assets/img/cloud-humidity.png')}}" alt="Humidity Icon" style="width: 35px; height: 35px;">
                            </div>
                            <div class="card-body" style="font-size: 2rem;">
                                59%
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
        </div>
    </section>
</div>

@endsection