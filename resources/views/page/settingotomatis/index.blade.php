@extends('layouts.template')

@section('content')
<style>
    /* From Uiverse.io by andrew-demchenk0 */
    .switch {
        --input-focus: #4e93f6;
        /* Warna biru yang lebih cerah saat aktif */
        --bg-color: #333333;
        /* Warna latar belakang gelap */
        --bg-color-alt: #ccc;
        /* Warna latar belakang tidak aktif */
        --main-color: #fff;
        /* Warna putih untuk elemen utama */
        --input-out-of-focus: #ddd;
        /* Warna latar belakang saat tidak aktif */
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 90px;
        /* Lebar toggle lebih besar */
        height: 50px;
        /* Tinggi lebih besar untuk bentuk lebih proporsional */
        border-radius: 50px;
        /* Membuat toggle berbentuk bulat */
        background-color: var(--bg-color-alt);
        transition: background-color 0.3s, box-shadow 0.3s ease-in-out;
        /* Transisi halus */
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        /* Bayangan lebih lembut */
    }

    .toggle {
        opacity: 0;
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 50px;
        background-color: var(--input-out-of-focus);
        border: none;
        transition: 0.4s ease-in-out;
        /* Transisi lebih halus */
    }

    .slider:before {
        content: "OFF";
        position: absolute;
        top: 50%;
        left: 5px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--bg-color);
        color: var(--main-color);
        font-size: 16px;
        font-weight: 700;
        text-align: center;
        line-height: 40px;
        transform: translateY(-50%);
        transition: 0.4s ease-in-out;
        /* Efek animasi pada label */
    }

    /* Ketika toggle aktif */
    .toggle:checked+.slider {
        background-color: var(--input-focus);
        box-shadow: 0 4px 18px rgba(0, 143, 255, 0.5);
        /* Bayangan lebih kuat */
    }

    .toggle:checked+.slider:before {
        content: "ON";
        transform: translateY(-50%) translateX(40px);
        /* Geser tombol ke kanan */
        color: #fff;
        /* Ubah warna teks saat aktif */
    }
</style>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <img src="{{ asset('assets/img/rekam-data-icon.png') }}" alt="Icon"
                style="width: 40px; height: auto; margin-right: 10px; vertical-align: middle;">
            <h1 style="display: inline;">Atur Pompa</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Atur Pompa</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-4">
                                <ul class="nav nav-pills" id="myTab3" role="tablist" style="width: 100%; max-width: 600px;">
                                    <li class="nav-item" style="flex: 1;">
                                        <a class="nav-link active text-center font-weight-bold" id="home-tab3" data-toggle="tab"
                                            href="#home3" role="tab" aria-controls="home" aria-selected="true"
                                            style="border-radius: 15px;">Rata-Rata Hum/Temp</a>
                                    </li>
                                    <li class="nav-item" style="flex: 1;">
                                        <a class="nav-link text-center font-weight-bold" id="profile-tab3" data-toggle="tab"
                                            href="#profile3" role="tab" aria-controls="profile" aria-selected="false"
                                            style="border-radius: 15px;">Schedule</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content" id="myTabContent2">
                                <!-- Tab Data Kelembapan -->
                                <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                    aria-labelledby="home-tab3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Pengaturan Berdasarkan Rata - Rata Suhu dan Kelembapan</h4>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('otomatis_suhulembab') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <!-- Kelembapan -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="humidity_awal">Batas Aman Kelembapan (Dari)
                                                                        %</label>
                                                                    <input type="number" class="form-control"
                                                                        id="humidity_awal" name="humidity_awal"
                                                                        value="{{ $otomatis->humidity_awal ?? old('humidity_awal') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="humidity_akhir">Batas Aman Kelembapan
                                                                        (Sampai) %</label>
                                                                    <input type="number" class="form-control"
                                                                        id="humidity_akhir" name="humidity_akhir"
                                                                        value="{{ $otomatis->humidity_akhir ?? old('humidity_akhir') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Suhu -->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="temperature_awal">Batas Aman Suhu (Dari)
                                                                        Celcius</label>
                                                                    <input type="number" class="form-control"
                                                                        id="temperature_awal" name="temperature_awal"
                                                                        value="{{ $otomatis->temperature_awal ?? old('temperature_awal') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="temperature_akhir">Batas Aman Suhu (Sampai)
                                                                        Celcius</label>
                                                                    <input type="number" class="form-control"
                                                                        id="temperature_akhir" name="temperature_akhir"
                                                                        value="{{ $otomatis->temperature_akhir ?? old('temperature_akhir') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary">Set Pompa</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Tab Data Suhu -->
                                <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4>Pengaturan Berdasarkan Jam</h4>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('otomatis_waktu') }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <!-- Kelembapan -->
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="text-center">Pagi</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="waktu1_awal">Dari jam</label>
                                                                    <input type="time" class="form-control"
                                                                        id="waktu1_awal" name="waktu1_awal"
                                                                        value="{{ $otomatis->waktu1_awal ?? old('waktu1_awal') }}"
                                                                        required>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="waktu1_akhir">Sampai jam</label>
                                                                    <input type="time" class="form-control"
                                                                        id="waktu1_akhir" name="waktu1_akhir"
                                                                        value="{{ $otomatis->waktu1_akhir ?? old('waktu1_akhir') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <!-- Suhu -->
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="text-center">Sore</div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="waktu2_awal">Dari jam</label>
                                                                    <input type="time" class="form-control"
                                                                        id="waktu2_awal" name="waktu2_awal"
                                                                        value="{{ $otomatis->waktu2_awal ?? old('waktu2_awal') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="waktu2_akhir">Sampai Jam</label>
                                                                    <input type="time" class="form-control"
                                                                        id="waktu2_akhir" name="waktu2_akhir"
                                                                        value="{{ $otomatis->waktu2_akhir ?? old('waktu2_akhir') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-right">
                                                            <button type="submit" class="btn btn-primary">Set Pompa</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Kontrol Pompa Manual</h4>
                        </div>
                        <div class="card-body">
                            <label class="switch">
                                <input {{ $status == '1' ? 'checked' : '' }} type="checkbox" class="toggle"
                                    onclick="toggleSwitch({{ $status }}, this)" id="toggle">
                                <span class="slider"></span>
                                <span class="card-side"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    function toggleSwitch(status, element) {

        const status_awal = status;
        Swal.fire({
            title: "Are you sure?",
            text: "Apakah ingin mengubah status pompa",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya ubah!"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/control_state";
            } else {
                element.checked = status == '1';
            }
        });


    }
</script>
@endsection