@extends('layouts.template')

@section('content')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Rekam Data</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Tab</div>
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
          <div class="d-flex justify-content-center">
            <ul class="nav nav-pills" id="myTab3" role="tablist" style="width: 100%; max-width: 600px;">
              <li class="nav-item" style="flex: 1;">
                <a class="nav-link active text-center font-weight-bold" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true" style="border-radius: 15px;">Data Kelembapan</a>
              </li>
              <li class="nav-item" style="flex: 1;">
                <a class="nav-link text-center font-weight-bold" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false" style="border-radius: 15px;">Data Suhu</a>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="myTabContent2">
            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
              quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
              consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
              cillum dolore eu fugiat nulla pariatur.
            </div>
            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
              Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices. Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui.
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection