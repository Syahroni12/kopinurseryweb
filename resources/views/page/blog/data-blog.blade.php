@extends('layouts.template')

@section('content')
<div class="main-wrapper main-wrapper-1">
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-header">
        <img src="{{ asset('assets/img/blog-icon.png') }}" alt="Icon" style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
        <h1 style="display: inline;">Blog</h1>
        <!-- <div class="section-header-button">
          <a href="{{ route('create-blog') }}" class="btn btn-primary">Tambah</a>
        </div> -->
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="#">Blog</a></div>
          <div class="breadcrumb-item">Semua Blog</div>
        </div>
      </div>
      <div class="section-body">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="float-left">
                  <a href="{{ route('create-blog') }}" class="btn btn-primary">Tambah</a>
                </div>
                <div class="float-right">
                  <form action="" method="GET">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search" name="cari" value="{{ request()->cari }}">
                      <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                          <i class="fas fa-search"></i>
                        </button>
                        <button class="btn btn-secondary" type="button" onclick="window.location.href='/blog'">
                          reresh
                        </button>
                      </div>
                    </div>
                  </form>
                </div>


                <div class="clearfix mb-3"></div>

                <div class="table-responsive">
                  <table class="table table-striped">
                    <tr>
                      {{-- <th class="text-center pt-2">
                        <div class="custom-checkbox custom-checkbox-table custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                          <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                        </div>
                      </th> --}}
                      <th>Title</th>
                      <th>Category</th>
                      <th>Author</th>
                      <th>Created At</th>
                      <th>Action</th>
                      {{-- <th>Status</th> --}}
                    </tr>
                    @foreach ($blog as $item)


                    <tr>
                      {{-- <td>
                        <div class="custom-checkbox custom-control">
                          <input type="checkbox" data-checkboxes="mygroup" class="custom-control-input" id="checkbox-2">
                          <label for="checkbox-2" class="custom-control-label">&nbsp;</label>
                        </div>
                      </td> --}}
                      <td>{{ $item->title }}
                        <!-- <div class="table-links">
                          <a href="{{ route('detail-blog', $item->id) }}">View</a>
                          <div class="bullet"></div>
                          <a href="{{ route('edit-blog', $item->id) }}">Edit</a>
                          <div class="bullet"></div>
                          <div class="text-danger" onclick="deleteData({{ $item->id }})">Trash</div>
                        </div> -->
                      </td>
                      <td>
                        {{ $item->category }}
                      </td>
                      <td>
                        <a href="#">
                          <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="title" title="">
                          <div class="d-inline-block ml-1">{{ $item->pengguna->nama }}</div>
                        </a>
                      </td>
                      <td>{{ $item->created_at }}</td>
                      {{-- <td>
                        <div class="badge badge-primary">Published</div>
                      </td> --}}
                      <td>
                        <a href="{{ route('detail-blog', $item->id) }}" class="btn btn-primary">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('edit-blog', $item->id) }}" class="btn btn-warning">
                          <i class="fas fa-pencil-alt"></i>
                        </a>
                        <button class="btn btn-danger" onclick="deleteData({{ $item->id }})">
                          <i class="fa fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                    @endforeach
                  </table>
                </div>
                <div class="d-flex justify-content-center">
                  {{ $blog->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>


<script>
  function deleteData(id) {

    event.preventDefault();
    Swal.fire({
      title: 'Hapus?',
      text: 'Apakah anda yakin ingin hapus data?',
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal',
    }).then((result) => {
      if (result.isConfirmed) {
        // console.log(id);
        window.location.href = `/delete_blog/` + id;
        // window.location.href = "/selesaikan/".itemId "";
        // Swal.fire({
        //     title: "Deleted!",
        //     text: "Your file has been deleted.",
        //     icon: "success"
        // });
      }
    })
  }
</script>


@endsection