<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gardener - Gardening Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/landing-page/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/landing-page/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landing-page/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/landing-page/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/landing-page/css/style.css') }}" rel="stylesheet">
</head>

<style>
    .about-section {
        background-image: url('{{ asset("assets/landing-page/img/about-background.png") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ffffff;
        /* Menyesuaikan warna teks agar kontras dengan background */
        padding: 50px 0;
        /* Tambahkan padding jika perlu */
        min-width: 181vh;
    }

    .service-section {
        background-image: url('{{ asset("assets/landing-page/img/background_1.jpg") }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: #ffffff;
        /* Menyesuaikan warna teks agar kontras dengan background */
        padding: 50px 0;
        /* Tambahkan padding jika perlu */
        min-width: 181vh;
    }
</style>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="{{ asset('assets/landing-page/img/logo.png') }}" alt="Logo" class="me-3" style="width: 50px; height: 50px;">
            <h1 class="m-0">IQACS Kopi Nursery</h1>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('landing-page') }}" class="nav-item nav-link active">Beranda</a>
                <a href="{{ route('landing-page-about') }}" class="nav-item nav-link">Tentang</a>
                <a href="{{ route('landing-page-service') }}" class="nav-item nav-link">Layanan</a>
                <a href="{{ route('landing-page-contact') }}" class="nav-item nav-link">Kontak Kami</a>
            </div>
            <!-- <a href="" class="btn btn-primary py-4 px-lg-4 rounded-0 d-none d-lg-block">Get A Quote<i class="fa fa-arrow-right ms-3"></i></a> -->
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/landing-page/img/carousel-4.jpg') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Buat Lingkungan Ideal untuk Kopi Berkualitas Tinggi</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('assets/landing-page/img/carousel-5.png') }}" alt="Image">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-7">
                                    <h1 class="display-1 text-white mb-5 animated slideInDown">Lingkungan Ideal Untuk Menghasilkan Bibit Kopi Yang Berkualitas</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Top Feature Start -->
    <div class="container-fluid top-feature py-5 pt-lg-0">
        <div class="container py-5 pt-lg-0">
            <div class="row gx-0">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-times text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Pemantauan Otomatis</h4>
                                <span>Sistem monitoring otomatis untuk memantau suhu & kelembapan</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-users text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Bibit Kopi Berkualitas</h4>
                                <span>Bibit pilihan dan dibudidayakan dengan perawatan maksimal</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white shadow d-flex align-items-center h-100 px-5" style="min-height: 160px;">
                        <div class="d-flex">
                            <div class="flex-shrink-0 btn-lg-square rounded-circle bg-light">
                                <i class="fa fa-phone text-primary"></i>
                            </div>
                            <div class="ps-3">
                                <h4>Layanan Konsultasi</h4>
                                <span>Kami siap memberikan solusi & konsultasi tentang perawatan bibit kopi serta pemeliharaan greenhouse</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Feature End -->


    <!-- About Start -->
    <div class="container-xxl py-5 about-section">
        <div class="container">
            <div class="row g-5 align-items-end">
                <div class="col-lg-3 col-md-5 wow fadeInUp" data-wow-delay="0.1s">
                    <img class="img-fluid rounded" src="">
                </div>
                <div class="col-lg-6 col-md-7 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="display-5 mb-4 text-white">IQAS Kopi Nursery</h1>
                    <p class="mb-4">inovasi dan teknologi yang mendukung pertanian modern</p>
                    <h3 class="display mb-4 text-white">Mengubah Greenhouse Anda Menjadi Ekosistem Ideal</h3>
                    <p class="mb-4">IQAC System berkomitmen membantu petani kopi mengoptimalkan kondisi lingkungan greenhouse melalui teknologi cerdas. Kami berfokus pada kualitas udara dan kesehatan tanaman dengan sistem yang dapat diandalkan dan hemat energi.</p>
                </div>
                <div class="col-lg-3 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="row g-5">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <div class="mb-3">
                                    <img src="{{ asset ('assets/landing-page/img/automation-person.png') }}" alt="">
                                </div>
                                <h4 class="mb-3 text-white">Pemantauan Otomatis</h4>
                                <span>Dengan IQAC System, tidak perlu lagi mengkhawatirkan kondisi udara di greenhouse. Sistem ini secara otomatis memantau dan mengendalikan suhu & kelembaban yang optimal bagi pertumbuhan tanaman kopi. </span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="border-start ps-4">
                                <div class="mb-3">
                                    <img src="{{ asset ('assets/landing-page/img/security.png') }}" alt="">
                                </div>
                                <h4 class="mb-3 text-white">Keamanan Data dan Akses Terjamin</h4>
                                <span>Kami mengutamakan keamanan akses dengan teknologi verifikasi OTP berbasis nomor telepon. Hanya pengguna yang sah yang bisa mengakses dan mengelola data penting di dalam sistem.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Facts Start -->
    <!-- <div class="container-fluid facts my-5 py-5" data-parallax="scroll">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h3 class="text-black">Real-Time monitoring</h3>
                    <span class="fs-5 text-black">Data lingkungan greenhouse selalu up-to-date.</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h3 class="text-black">Otomatisasi Pengendalian</h3>
                    <span class="fs-5 text-black">Kontrol suhu dan kelembaban yang presisi tanpa intervensi manual.</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h3 class="text-black">Laporan Komprehensif</h3>
                    <span class="fs-5 text-black">Data lengkap yang bisa diekspor untuk analisis lebih lanjut.</span>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Facts End -->


    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Memudahkan </p>
                    <h1 class="display-5 mb-4">Pengelolaan greenhouse kopi</h1>
                    <p class="fs-5 fw-bold">Secara Cerdas & Efisien</p>
                </div>
                <div class="col-lg-6">
                    <div class="row g-4 align-items-center">
                        <div class="col-md-6">
                            <div class="row g-4">
                                <div class="col-12 wow fadeIn" data-wow-delay="0.3s">
                                    <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                            <img src="{{ asset ('assets/landing-page/img/iot.png') }}" alt="">
                                        </div>
                                        <h4 class="mb-0">Teknologi IoT</h4>
                                    </div>
                                </div>
                                <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
                                    <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                        <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                            <img src="{{ asset ('assets/landing-page/img/gear.png') }}" alt="">
                                        </div>
                                        <h4 class="mb-0">Otomatis</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 wow fadeIn" data-wow-delay="0.7s">
                            <div class="text-center rounded py-5 px-4" style="box-shadow: 0 0 45px rgba(0,0,0,.08);">
                                <div class="btn-square bg-light rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                                    <img src="{{ asset ('assets/landing-page/img/pemantauan-lingkungan.png') }}" alt="">
                                </div>
                                <h4 class="mb-0">Pemantauan Lingkungan</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->


    <!-- Service Start -->
    <div class="container-xxl py-5 service-section">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-5 text-white">Layanan Kami</h1>
                <p class="text-white">Kami menggunakan sensor IoT untuk memantau kelembaban dan suhu ruangan serta menerapkan algoritma pengolahan citra untuk mendeteksi tanda-tanda awal penyakit tanaman. Semua dikendalikan melalui dashboard berbasis web yang ramah pengguna.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-3.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pemantauan Real-Time dengan Sensor yang Akurat</h4>
                            <p class="mb-4">Sistem dilengkapi dengan sensor IoT berkualitas tinggi untuk memantau suhu, kelembaban, dan kualitas udara secara real-time. Data yang dihasilkan akurat dan dapat langsung diakses melalui dashboard, memungkinkan pengambilan keputusan yang cepat.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-6.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Deteksi Penyakit Tanaman Otomatis</h4>
                            <p class="mb-4">Menggunakan teknologi pengolahan citra, sistem ini dapat mendeteksi tanda-tanda awal penyakit pada tanaman kopi secara otomatis. Fitur ini membantu mencegah penyebaran penyakit lebih lanjut dengan identifikasi dini.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-5.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Pengendalian Suhu dan Kelembaban Secara Otomatis</h4>
                            <p class="mb-4">Sistem cerdas ini memungkinkan pengendalian otomatis atas suhu dan kelembaban di dalam greenhouse. Ini memastikan lingkungan yang optimal untuk pertumbuhan tanaman tanpa perlu pengawasan terus-menerus.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-4.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Laporan Data Lingkungan yang Lengkap</h4>
                            <p class="mb-4">IQAC System menyediakan laporan komprehensif mengenai kondisi lingkungan greenhouse yang bisa diekspor dalam format PDF atau Excel. Laporan ini bisa digunakan untuk analisis lebih lanjut dan perencanaan jangka panjang.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-8.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Manajemen Pengguna yang Fleksibel</h4>
                            <p class="mb-4">Sistem ini memungkinkan pengelolaan pengguna dengan berbagai level akses, mulai dari admin hingga user biasa. Setiap pengguna dapat diatur sesuai dengan tugas dan wewenang yang dimiliki, menjadikan sistem lebih aman dan terorganisir.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-2.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Keamanan dengan Verifikasi OTP</h4>
                            <p class="mb-4">Untuk meningkatkan keamanan, sistem menggunakan verifikasi nomor telepon dan kode OTP (One-Time Password) saat login. Ini memastikan bahwa hanya pengguna yang berwenang yang dapat mengakses sistem, melindungi data penting dari pihak yang tidak bertanggung jawab.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Team Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Our Team</p>
                <h1 class="display-5 mb-5">Dedicated & Experienced Team Members</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('assets/landing-page/img/bintang.jpg') }}" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Doris Jordan</h4>
                            <p class="text-primary">Landscape Designer</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('assets/landing-page/img/team-2.jpg') }}" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Johnny Ramirez</h4>
                            <p class="text-primary">Garden Designer</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="team-item rounded">
                        <img class="img-fluid" src="{{ asset('assets/landing-page/img/team-3.jpg') }}" alt="">
                        <div class="team-text">
                            <h4 class="mb-0">Diana Wagner</h4>
                            <p class="text-primary">Senior Gardener</p>
                            <div class="team-social d-flex">
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square rounded-circle me-2" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Team End -->


    <!-- Blog Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-bold text-primary">Blog</p>
                    <h1 class="display-5 mb-5">Apa yang sedang dibahas hari ini!</h1>
                    <p class="mb-4">Blog disini akan banyak membahas tentang perkemabangan teknologi, berita, agrikultur seputar greenhouse pembibitan kopi yang sedang kami kembangkan</p>
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item d-flex align-items-center">
                            <img class="img-fluid rounded me-3" style="width: 300px; height: 300px;" src="{{ asset('assets/landing-page/img/image-3.png') }}" alt="">
                            <div>
                                <p class="fs-5 mb-2">Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat.</p>
                                <h4 class="mb-0">Kategori</h4>
                                <span>Agrikultur</span>
                            </div>
                        </div>
                        <div class="testimonial-item d-flex align-items-center">
                            <img class="img-fluid rounded me-3" style="width: 300px; height: 300px;" src="{{ asset('assets/landing-page/img/image-3.png') }}" alt="">
                            <div>
                                <p class="fs-5 mb-2">Dolores sed duo clita tempor justo dolor et stet lorem kasd labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy et labore et tempor diam tempor erat.</p>
                                <h4 class="mb-0">Kategori</h4>
                                <span>Agrikultur</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer mt-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">IQACS Kopi Nursery</h4>
                    <p>IQAC System berkomitmen membantu petani kopi mengoptimalkan kondisi lingkungan greenhouse melalui teknologi cerdas. Kami berfokus pada kualitas udara dan kesehatan tanaman dengan sistem yang dapat diandalkan dan hemat energi.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Informasi Kontak</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Mastrip, Lingkungan Krajan Timur, Tegalgede, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68124</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 85748100201</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>nursery-mbkm.researce-ai.my.id</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Social Media</h4>
                    <a class="btn btn-link" href="https://www.instagram.com" target="_blank">
                        <i class="fab fa-instagram"></i>
                        IQACS Kopi Nursery
                    </a>
                    <a class="btn btn-link" href="https://www.facebook.com" target="_blank">
                        <i class="fab fa-facebook"></i>
                        IQACS Kopi Nursery
                    </a>
                    <a class="btn btn-link" href="https://twitter.com" target="_blank">
                        <i class="fab fa-twitter"></i>
                        IQACS Kopi Nursery
                    </a>
                    <a class="btn btn-link" href="https://www.youtube.com" target="_blank">
                        <i class="fab fa-youtube"></i>
                        IQACS Kopi Nursery
                    </a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-4">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative w-100">
                        <input class="form-control bg-light border-light w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/landing-page/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/parallax/parallax.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/lib/lightbox/js/lightbox.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/landing-page/js/main.js') }}"></script>
</body>

</html>