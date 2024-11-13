@extends('layouts.template')

@section('content')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <img src="{{ asset('assets/img/rekam-data-icon.png') }}" alt="Icon" style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
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
                <a class="nav-link active text-center font-weight-bold" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true" style="border-radius: 15px;">Data Kelembapan</a>
              </li>
              <li class="nav-item" style="flex: 1;">
                <a class="nav-link text-center font-weight-bold" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false" style="border-radius: 15px;">Data Suhu</a>
              </li>
            </ul>
          </div>

          <div class="d-flex justify-content-start align-items-center">
            <span style="width: 20px; height: 20px; background-color: #333333; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
            <p class="font-weight-bold mb-0">Arahkan Kursor untuk melihat nilai suhu & kelembapan</p>
          </div>

          <div class="d-flex justify-content-start align-items-center mt-2">
            <span style="width: 20px; height: 20px; background-color: #BFFA01; border-radius: 50%; display: inline-block; margin-right: 8px;"></span>
            <p class="font-weight-bold mb-0">Nilai Kelembapan & Suhu</p>
          </div>

          <div class="d-flex justify-content-end align-items-center">
            <!-- date range picker -->

            <div class="input-group rounded" style="flex: 1; max-width: 300px; margin-right: 10px; border-radius: 15px; overflow: hidden; background-color: #f0f8ff;">

            </div>

            <!-- button cetak -->
            <button class="btn btn-primary" style="border-radius: 12px; height: 38px;">
              <i class="fas fa-print"></i> Cetak
            </button>
          </div>

          <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
              <div class="row">
                <div class="col-10 col-md-6 col-lg-12">
                  <div class="card">
                    <div class="card-header">
                      <!-- <h4>Line Chart</h4> -->
                    </div>
                    <div class="card-body">
                      <canvas id="humidityChart"></canvas>
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
                      <canvas id="temperatureChart"></canvas>
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

@endsection
