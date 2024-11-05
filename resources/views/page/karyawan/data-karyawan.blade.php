@extends('layouts.template')

@section('content')

<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <img src="{{ asset('assets/img/karyawan-icon.png') }}" alt="Icon" style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
      <h1 style="display: inline;">Data Karyawan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Data Karyawan</a></div>
      </div>
    </div>
    <div class="section-body">
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="float-left">
                <a href="{{ route('create-karyawan') }}" class="btn btn-primary">Add New</a>
              </div>
              <div class="float-right">
                <form>
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                      <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>

              <div class="clearfix mb-3"></div>

              <div class="table-responsive">
                <table class="table table-striped">
                  <tr>

                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">No. Hp</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Action</th>
                  </tr>
                  @foreach ($data as $item)


                  <tr>

                    <td class="text-center">{{ $data->firstItem() + $loop->index }}</td>
                    <td class="text-center">{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->user->no_telfon }}</td>
                    <td class="text-center">{{ $item->user->role }}</td>
                    <td class="text-center">
                      <button class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <button class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                  @endforeach
                </table>
              </div>
              <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection
