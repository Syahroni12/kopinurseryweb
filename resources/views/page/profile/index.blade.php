@extends('layouts.template')

@section('content')
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, {{ auth()->user()->pengguna->nama }}</h2>
                <p class="section-lead">
                    Edit tentang dirimu di halaman ini.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            @if (auth()->user()->pengguna->foto == "avatar.png")
                            <div class="profile-widget-header">
                                <img alt="image" src="assets/img/avatar/avatar-1.png"
                                    class="rounded-circle profile-widget-picture">
                            </div>
                            @else
                            <img alt="image" src="{{ asset('foto_profil/' . auth()->user()->pengguna->foto) }}"
                            class="rounded-circle profile-widget-picture" height="100">
                            @endif

                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ auth()->user()->pengguna->nama }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> {{ auth()->user()->akses }}
                                    </div>
                                </div>
                              <p>  {{ auth()->user()->pengguna->deskripsi }}</p>
                            </div>
                            <div class="card-footer text-center">
                                <div class="font-weight-bold mb-2">Follow Kopi Nursery On</div>
                                <a href="#" class="btn btn-social-icon btn-facebook mr-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-twitter mr-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-github mr-1">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#" class="btn btn-social-icon btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" action="{{ route('simpanprofile') }}" class="needs-validation" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12 col-12">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" value="{{ auth()->user()->pengguna->nama }}" required="" name="nama">
                                            <div class="invalid-feedback">
                                                {{-- Please fill in the first name --}}
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-7 col-12">
                                            <label>nomor handphone</label>
                                            <input type="number" class="form-control" value="{{ auth()->user()->no_telfon }}"
                                                required="" name="no_telfon">
                                            <div class="invalid-feedback">
                                            Harap Masukkan Nomor Handphone
                                            </div>
                                        </div>
                                        <div class="form-group col-md-5 col-12">
                                            <label>Password</label>
                                            <input type="tel" class="form-control" value="" name="password">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Bio</label>
                                            <textarea class="form-control summernote-simple" name="deskripsi">{{ auth()->user()->pengguna->deskripsi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>alamat</label>
                                            <textarea class="form-control summernote-simple" name="alamat">{{ auth()->user()->pengguna->alamat }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>ubah Foto</label>
                                        <div id="image-preview" class="image-preview">
                                            <label for="image-upload" id="image-label">Choose File</label>
                                            <input type="file" name="foto" id="image-upload" accept="image/*"  />
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
