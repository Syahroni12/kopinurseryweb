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
                    <th class=" pt-2">
                      <div class="custom-checkbox custom-checkbox-table custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                        <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                      </div>
                    </th>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">No. Hp</th>
                    <th class="text-center">Level</th>
                    <th class="text-center">Action</th>
                  </tr>
                  <tr>
                    <td>
                      <div class="custom-checkbox custom-control">
                        <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                        <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                      </div>
                    </td>
                    <td class="text-center">1</td>
                    <td class="text-center">Budiono Siregar</td>
                    <td class="text-center">08xxxxxxxxxxx</td>
                    <td class="text-center">Admin</td>
                    <td class="text-center">
                      <button class="btn btn-warning">
                        <i class="fas fa-pencil-alt"></i>
                      </button>
                      <button class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </table>
              </div>
              <div class="float-right">
                <nav>
                  <ul class="pagination">
                    <li class="page-item disabled">
                      <a class="page-link" href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <li class="page-item active">
                      <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                      <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection