@extends('layouts.template')

@section('content')
<div class="main-wrapper main-wrapper-1">
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Blog</h1>
        <div class="section-header-button">
          <a href="{{ route('create-blog') }}" class="btn btn-primary">Tambah</a>
        </div>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Blog</a></div>
          <div class="breadcrumb-item">Semua Blog</div>
        </div>
      </div>
      <div class="section-body">
        <h2 class="section-title">Blog</h2>
        <p class="section-lead">
          Kamu bisa mengatur blog, merubah dan bahkan menghapus blog.
        </p>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Semua Blog</h4>
              </div> -->
              <div class="card-body">
                <div class="float-left">
                  <!-- <select class="form-control selectric">
                    <option>Action For Selected</option>
                    <option>Move to Draft</option>
                    <option>Move to Pending</option>
                    <option>Delete Pemanently</option>
                  </select> -->
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
                      <th class="pt-2">
                        <div class="custom-checkbox custom-checkbox-table custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                      </th>
                      <th>Title</th>
                      <th>Category</th>
                      <th>Author</th>
                      <th>Created At</th>
                      <th>Status</th>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                          <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td>Laravel 5 Tutorial: Introduction
                        <div class="table-links">
                          <a href="#">View</a>
                          <div class="bullet"></div>
                          <a href="#">Edit</a>
                          <div class="bullet"></div>
                          <a href="#" class="text-danger">Trash</a>
                        </div>
                      </td>
                      <td>
                        <a href="#">Web Developer</a>,
                        <a href="#">Tutorial</a>
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">Rizal Fakhri</div>
                        </a>
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-primary">Published</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-3">
                          <label for="checkbox-3" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td>Laravel 5 Tutorial: Installing
                        <div class="table-links">
                          <a href="#">View</a>
                          <div class="bullet"></div>
                          <a href="#">Edit</a>
                          <div class="bullet"></div>
                          <a href="#" class="text-danger">Trash</a>
                        </div>
                      </td>
                      <td>
                        <a href="#">Web Developer</a>,
                        <a href="#">Tutorial</a>
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">Rizal Fakhri</div>
                        </a>
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-primary">Published</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-4">
                          <label for="checkbox-4" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td>Laravel 5 Tutorial: MVC
                        <div class="table-links">
                          <a href="#">View</a>
                          <div class="bullet"></div>
                          <a href="#">Edit</a>
                          <div class="bullet"></div>
                          <a href="#" class="text-danger">Trash</a>
                        </div>
                      </td>
                      <td>
                        <a href="#">Web Developer</a>,
                        <a href="#">Tutorial</a>
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">Rizal Fakhri</div>
                        </a>
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-primary">Published</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-5">
                          <label for="checkbox-5" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td>Laravel 5 Tutorial: CRUD
                        <div class="table-links">
                          <a href="#">View</a>
                          <div class="bullet"></div>
                          <a href="#">Edit</a>
                          <div class="bullet"></div>
                          <a href="#" class="text-danger">Trash</a>
                        </div>
                      </td>
                      <td>
                        <a href="#">Web Developer</a>,
                        <a href="#">Tutorial</a>
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">Rizal Fakhri</div>
                        </a>
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-danger">Draft</div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-1">
                          <label for="checkbox-1" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td>
                      <td>Laravel 5 Tutorial: Deployment
                        <div class="table-links">
                          <a href="#">View</a>
                          <div class="bullet"></div>
                          <a href="#">Edit</a>
                          <div class="bullet"></div>
                          <a href="#" class="text-danger">Trash</a>
                        </div>
                      </td>
                      <td>
                        <a href="#">Web Developer</a>,
                        <a href="#">Tutorial</a>
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">Rizal Fakhri</div>
                        </a>
                      </td>
                      <td>2018-01-20</td>
                      <td>
                        <div class="badge badge-warning">Pending</div>
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
</div>


@endsection