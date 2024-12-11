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
                <a href="{{ route('landing-page-about') }}" class="nav-item nav-link">Tentang</a>
                <a href="{{ route('landing-page-service') }}" class="nav-item nav-link active">Layanan</a>
                <a href="{{ route('landing-page-contact') }}" class="nav-item nav-link">Kontak Kami</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-3 text-white mb-4 animated slideInDown">Layanan Kami</h1>
        </div>
    </div>
    <!-- Page Header End -->

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