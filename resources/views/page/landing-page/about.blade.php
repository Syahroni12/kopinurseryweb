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
                <a href="{{ route('landing-page') }}" class="nav-item nav-link">Beranda</a>
                <a href="{{ route('landing-page-about') }}" class="nav-item nav-link active">Tentang</a>
                <a href="{{ route('landing-page-service') }}" class="nav-item nav-link">Layanan</a>
                <a href="{{ route('landing-page-contact') }}" class="nav-item nav-link">Kontak Kami</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Tentang Kami</h1>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-end">
                <img class="img-fluid rounded" style="width: 550px; height: 500px;" src="{{ asset('assets/landing-page/img/biji_kopi.png') }}">
                <div class="col-lg-7 col-md-9 wow fadeInUp" data-wow-delay="0.3s">
                    <h2 class="display-5 text-black mb-0">Emang Sistem Seperti Apasih?</h2>
                    <h3 class="text-black mb-4">Solusi Inovatif untuk Greenhouse Kopi</h3>
                    <p class="mb-4">IQACS (Intelligence Quality Air Control System) adalah solusi teknologi berbasis IoT yang dirancang khusus untuk mengoptimalkan pengelolaan greenhouse pada nursery bibit kopi. Kami menyediakan sistem monitoring dan kontrol otomatis yang membantu menjaga stabilitas suhu, kelembaban, serta kualitas udara di dalam greenhouse, sehingga mendukung pertumbuhan bibit kopi yang sehat dan berkualitas.</p>
                    <h3 class="text-black mb-4">Fitur Unggulan yang Tersedia</h3>
                    <p class="mb-4">Selain fitur monitoring lingkungan, IQACS juga dilengkapi dengan teknologi deteksi penyakit pada bibit kopi. Melalui sensor dan analisis data, sistem kami mampu mengidentifikasi gejala awal penyakit pada tanaman secara real-time. Dengan demikian, tindakan pencegahan dapat dilakukan lebih cepat dan efektif, sehingga meminimalisir kerugian akibat penularan penyakit.</p>
                    <h3 class="text-black mb-4">Komitmen Kami</h3>
                    <p class="mb-4">Kami berkomitmen untuk memberikan inovasi terbaik dalam menjaga kualitas bibit kopi, meningkatkan produktivitas, dan memajukan industri kopi melalui teknologi modern.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Facts Start -->
    <div class="container-fluid facts my-5 py-5" data-parallax="scroll" data-image-src="{{ asset('assets/landing-page/img/carousel-6.jpg') }}">
        <div class="container py-5">
            <div class="row g-5">
                <!-- <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.1s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Happy Clients</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Garden Complated</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Dedicated Staff</span>
                </div>
                <div class="col-sm-6 col-lg-3 text-center wow fadeIn" data-wow-delay="0.7s">
                    <h1 class="display-4 text-white" data-toggle="counter-up">1234</h1>
                    <span class="fs-5 fw-semi-bold text-light">Awards Achieved</span>
                </div> -->
            </div>
        </div>
    </div>
    <!-- Facts End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-bold text-primary">Fitur-Fitur</p>
                <h1 class="display-5 mb-5">Fitur unggulan dari sistem ini</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-11.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Monitoring Real-Time</h4>
                            <p class="mb-4">Pengguna dapat melihat data suhu, kelembaban, dan kualitas udara secara langsung melalui dashboard yang tersedia, baik di komputer maupun perangkat mobile.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-12.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Kontrol Otomatis</h4>
                            <p class="mb-4">Sistem dapat mengatur dan menyesuaikan suhu serta kelembaban secara otomatis sesuai kebutuhan tanaman. Hal ini membantu menjaga stabilitas lingkungan tanpa intervensi manual yang berlebihan.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-13.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Deteksi Penyakit Tanaman</h4>
                            <p class="mb-4">Menggunakan sensor dan algoritma cerdas, IQACS dapat mendeteksi gejala awal penyakit pada bibit kopi. Dengan informasi ini, petani dapat mengambil tindakan cepat untuk mencegah penyebaran penyakit lebih lanjut.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-11.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Notifikasi dan Peringatan</h4>
                            <p class="mb-4">Sistem ini memungkinkan pengelolaan pengguna dengan berbagai level akses, mulai dari admin hingga user biasa. Setiap pengguna dapat diatur sesuai dengan tugas dan wewenang yang dimiliki, menjadikan sistem lebih aman dan terorganisir.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-12.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Laporan Data dan Analisis</h4>
                            <p class="mb-4">IQACS menyimpan data historis yang terekam dari sensor. Data ini dapat diakses untuk analisis dan dapat diunduh dalam bentuk laporan, membantu pengguna dalam pengambilan keputusan berdasarkan data yang valid.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded d-flex h-100">
                        <div class="service-text rounded p-5">
                            <div class="btn-square rounded-circle mx-auto mb-3">
                                <img class="img-fluid" src="{{ asset('assets/landing-page/img/icon/icon-13.png') }}" alt="Icon">
                            </div>
                            <h4 class="mb-3">Akses Jarak Jauh</h4>
                            <p class="mb-4">Pengguna dapat mengakses dan mengontrol sistem dari jarak jauh melalui aplikasi mobile atau web, sehingga mereka tetap dapat memantau kondisi greenhouse di mana saja dan kapan saja.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->




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