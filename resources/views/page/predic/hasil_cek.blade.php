@extends('layouts.template')

@section('content')

    <body>
        <div class="main-wrapper main-wrapper-1">
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        {{-- <div class="section-header-back">
                            <a href="{{ route('blog') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                        </div> --}}
                        <h1>Klasifikasi penyakit</h1>
                        <div class="section-header-breadcrumb">
                            <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                            <div class="breadcrumb-item"><a href="#">Klasifikasi</a></div>
                            <div class="breadcrumb-item">Klasifikasi</div>
                        </div>
                    </div>

                    <div class="section-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="section-title">Cek Klasifikasi pada daun</h2>
                            <a href="{{ route('riwayat_predik') }}" class="btn btn-primary">Riwayat predik</a>
                        </div>



                        <div class="row">
                            <!-- Card kiri untuk form upload -->
                            <div class="col-6">
                                <form action="{{ route('predict') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Unggah Gambar</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <div id="image-preview" class="image-preview">
                                                        <label for="image-upload" id="image-label">Pilih File</label>
                                                        <input type="file" name="image" id="image-upload"
                                                            accept="image/*" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                                <div class="col-sm-12 col-md-7">
                                                    <button class="btn btn-primary" type="submit">Lakukan Prediksi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Card kanan untuk hasil prediksi -->
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Hasil Prediksi</h4>
                                    </div>
                                    <div class="card-body">
                                        @isset($hasil)
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kelas</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="predicted_class"
                                                        value="{{ $hasil->diagnosa }}" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-4">
                                                <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Deskripsi</label>
                                                <div class="col-sm-12 col-md-7">

                                                    <textarea name="" id="" cols="30" rows="15" disabled>{{ $hasil->deskripsi  }}</textarea>

                                                </div>
                                            </div>


                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kepercayaan</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <input type="text" class="form-control" name="confidence"
                                                        value="{{ $hasil->keakuratan }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-4">
                                                <label
                                                    class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar</label>
                                                <div class="col-sm-12 col-md-7">
                                                    <img src="{{ asset('diagnosa/' . $hasil->file) }}" alt="Gambar Hasil"
                                                        style="max-width: 100%;">
                                                </div>
                                            </div>
                                        @else
                                            <p>Tidak ada hasil prediksi.</p>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
@endsection
