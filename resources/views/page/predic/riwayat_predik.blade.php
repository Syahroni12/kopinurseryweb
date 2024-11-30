@extends('layouts.template')

@section('content')
    <div class="main-wrapper main-wrapper-1">
        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <img src="{{ asset('assets/img/blog-icon.png') }}" alt="Icon"
                        style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
                    <h1 style="display: inline;">Riwayat Prediksi</h1>
                    <!-- <div class="section-header-button">
                                                  <a href="{{ route('create-blog') }}" class="btn btn-primary">Tambah</a>
                                                </div> -->
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item"><a href="#">Riwayat Prediksi</a></div>
                        <div class="breadcrumb-item">Semua Riwayat</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="float-left">
                                        <a href="{{ route('cek') }}" class="btn btn-primary">Kembali prediksi</a>
                                    </div>



                                    <div class="clearfix mb-3"></div>
                                    @foreach ($riwayat as $item)
                                        <div class="card mb-3" style="max-width: 540px;">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img src="{{ asset('diagnosa/' . $item->file) }}" alt="..."
                                                        style="max-width: 100%;">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Diagnosa: {{ $item->diagnosa }}</h5>
                                                        <h6>Tingkat keakuratan: {{ $item->keakuratan }}</h6>

                                                        <button class="btn btn-danger"
                                                            onclick="deleteData({{ $item->id }})">hapus data
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-center">
                                        {{ $riwayat->links() }}
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
                    window.location.href = `/hapus_riwayat_predik/` + id;
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
