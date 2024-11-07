@extends('layouts.template')

@section('content')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Edit Karyawan</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ route('karyawan') }}">Data Karyawan</a></div>
        <div class="breadcrumb-item">Tambah Karyawan </div>
      </div>
    </div>

    <div class="section-body">
      <h2 class="section-title">Advance</h2>
      <p class="section-lead">We provide advanced input fields, such as date picker, color picker, and so on.</p>

      <div class="card">
        <div class="card-header">
          <!-- <h4>Input Text</h4> -->
        </div>
        <form action="{{ route('update_karyawan', $pengguna->id) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $pengguna->nama }}" placeholder="Masukkan nama karyawan" required>
          </div>
          <div class="form-group">
            <label for="no_hp">No HP</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <i class="fas fa-phone"></i>
                </div>
              </div>
              <input type="number" name="no_telfon" id="no_hp" class="form-control" value="{{ $pengguna->user->no_telfon }}" placeholder="Masukkan nomor HP" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email karyawan" value="{{ $pengguna->user->email ?? '' }}" >
          </div>
          <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea class="form-control summernote-simple" name="alamat" id="alamat" required>{{ $pengguna->alamat }}</textarea>
          </div>

          <div class="form-group">
            <label for="level">Level</label>
            <select name="role" id="level" class="form-control" required>
              {{-- <option value="">Pilih level</option> --}}
              <option value="admin" @if($pengguna->user->role == 'admin') selected @endif>Admin</option>
              <option value="pegawai" @if($pengguna->user->role == 'pegawai') selected @endif>Pegawai</option>
            </select>
          </div>
          <div class="form-group float-right">
            <button type="submit" class="btn btn-primary">Update data Karyawan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
