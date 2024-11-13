<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Reset Password</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
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
                <p class="text-muted text-center">Kode OTP telah dikirim ke nomor telepon Anda, Silakan cek Pesan Anda.</p>
              </div>

              <div class="card-body">
                <form action="{{ route('checkOTP', ['no_telfon' => $no_telfon]) }}" method="POST">
                    @csrf
                  <div class="form-group d-flex justify-content-center">
                    <input type="text" name="otp[]" class="form-control text-center otp-input" maxlength="1" style="width: 70px; height: 70px; font-size: 24px; margin-right: 10px; border-radius: 12px;" required>
                    <input type="text" name="otp[]" class="form-control text-center otp-input" maxlength="1" style="width: 70px; height: 70px; font-size: 24px; margin-right: 10px; border-radius: 12px;" required>
                    <input type="text" name="otp[]" class="form-control text-center otp-input" maxlength="1" style="width: 70px; height: 70px; font-size: 24px; margin-right: 10px; border-radius: 12px;" required>
                    <input type="text"  name="otp[]" class="form-control text-center otp-input" maxlength="1" style="width: 70px; height: 70px; font-size: 24px; border-radius: 12px;" required>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Konfirmasi OTP
                    </button>
                  </div>
                </form>
                <a href="{{ route('kirimulangotp', ['no_telfon' => $no_telfon]) }}" class="btn btn-primary text-center">Kirim Ulang Kode</a>
              </div>
            </div>


          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/modules/popper.js') }}"></script>
  <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  <script src="{{ asset('assets/js/scripts.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script>
    // Select all OTP input fields
    const otpInputs = document.querySelectorAll('.otp-input');

    // Add event listener to each input
    otpInputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        // Move to next input if a value is entered
        if (input.value.length === 1 && index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        }
        // Optionally move to previous input if the value is empty and not the first input
        else if (input.value.length === 0 && index > 0) {
          otpInputs[index - 1].focus();
        }
      });

      // Add keydown event for Backspace
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
          otpInputs[index - 1].focus();
        }
      });
    });
  </script>

</body>

</html>
