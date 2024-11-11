<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Forgot Password</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>

<body>
  <div id="app">
    <section class="section">
        @include('sweetalert::alert')
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-2 col-md-8 offset-md-3 col-lg-6 offset-lg-3 col-xl-5 offset-xl-4">
            <div class="login-brand">
              <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary mx-auto">
              <div class="card-header d-flex flex-column align-items-center">
                <h3 class="font-weight-bold text-dark text-center">Lupa Kata Sandi Anda?</h3>
                <p class="text-muted text-center">Masukkan No Telp anda yang telah Terdaftar</p>
              </div>

              <div class="card-body">
                <form method="POST" action="{{ route('forgot-passwordact') }}">
                    @csrf
                  <div class="form-group">
                    <label for="no_telfon">
                      <i class="fas fa-no_telfon" style="transform: rotate(90deg);"></i> No. Telp
                    </label>
                    <input id="no_telfon" type="tel" class="form-control" name="no_telfon" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Kirim OTP
                    </button >
                  </div>

                  <div class="form-group text-center">
                    <a href="{{ route('login') }}" class="text-small text-success">Kembali ke Halaman Login</a>
                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>
