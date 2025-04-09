<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
<link rel="shortcut icon" href="img/favicon.png" />
<title>Car rental management system</title>
<meta name="description" content="Login and Register Form Html">
<meta name="author" content="#">

<!-- Web Fonts
========================= -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900' type='text/css'>

<!-- Stylesheet
========================= -->
<link rel="stylesheet" type="text/css" href="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="https://harnishdesign.net/demo/html/oxyy/vendor/font-awesome/css/all.min.css" />
<link rel="stylesheet" type="text/css" href="https://harnishdesign.net/demo/html/oxyy/css/stylesheet.css" />
<!-- Colors Css -->
<link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
</head>
<body>

<!-- Preloader -->
<div class="preloader preloader-dark">
  <div class="lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>
</div>
<!-- Preloader End -->

<div id="main-wrapper" class="oxyy-login-register">
  <div class="container-fluid px-0">
    <div class="row g-0 min-vh-100"> 
      <!-- Welcome Text
      ========================= -->
      <div class="col-md-4">
        <div class="hero-wrap d-flex align-items-center h-100">
          <div class="hero-mask opacity-5 bg-dark"></div>
          <div class="hero-bg hero-bg-scroll" style="background-image:url('https://harnishdesign.net/demo/html/oxyy/images/login-bg-6.jpg');"></div>
          <div class="hero-content mx-auto w-100 h-100">
            <div class="container d-flex flex-column h-100">
              <div class="row g-0">
                <div class="col-11 col-lg-9 mx-auto">
                  <div class="logo mt-5 mb-5"> <a class="d-flex" href="https://harnishdesign.net/demo/html/oxyy/index.php" title="Oxyy"><img src="img/logo.png" alt="Oxyy"></a> </div>
                </div>
              </div>
              <div class="row g-0 mt-3">
                <div class="col-11 col-lg-9 mx-auto">
                  <h1 class="text-9 text-white fw-300 mb-5">We care about your account security.</h1>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Welcome Text End --> 
      
      <!-- OTP Form
      ========================= -->
      <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
        <div class="container my-auto py-5">
          <div class="row g-0">
            <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
              <h3 class="text-white mb-4">Two-Step Verification</h3>
              <p class="text-cente"><img class="img-fluid" src="https://harnishdesign.net/demo/html/oxyy/images/otp-icon-light.png" alt="verification"></p>
              <p class="text-light mb-4">Please enter the OTP (one time password) to verify your account. A Code has been sent to <span class="text-white text-4">+1*******179</span></p>
              <form id="otp-screen" class="form-dark" method="post">
                <label class="form-label text-light">Enter 4 digit code</label>
                <div class="row g-3">
                  <div class="col">
                    <input type="text" class="form-control text-center text-6 py-2" maxlength="1" required autocomplete="off">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control text-center text-6 py-2" maxlength="1" required autocomplete="off">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control text-center text-6 py-2" maxlength="1" required autocomplete="off">
                  </div>
                  <div class="col">
                    <input type="text" class="form-control text-center text-6 py-2" maxlength="1" required autocomplete="off">
                  </div>
                </div>
                <div class="row align-items-center mt-4">
                  <div class="col-auto">
                    <button class="btn btn-primary shadow-none my-2" type="submit">Verify</button>
                  </div>
                  <div class="col">
                    <p class="text-end text-2 text-light mb-0">Didn't get the code? <a href="#">Resend it</a></p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- OTP Form End --> 
    </div>
  </div>
</div>

<!-- Styles Switcher -->
<div id="styles-switcher" class="right">
  <h5>Color Switcher</h5>
  <hr>
  <ul class="mb-0">
    <li class="blue" data-bs-toggle="tooltip" title="Blue" data-path="#"></li>
    <li class="indigo" data-bs-toggle="tooltip" title="Indigo" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-indigo.css"></li>
    <li class="purple" data-bs-toggle="tooltip" title="Purple" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-purple.css"></li>
    <li class="pink" data-bs-toggle="tooltip" title="Pink" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-pink.css"></li>
    <li class="red" data-bs-toggle="tooltip" title="Red" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-red.css"></li>
    <li class="orange" data-bs-toggle="tooltip" title="Orange" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-orange.css"></li>
    <li class="yellow" data-bs-toggle="tooltip" title="Yellow" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-yellow.css"></li>
    <li class="teal" data-bs-toggle="tooltip" title="Teal" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-teal.css"></li>
    <li class="green" data-bs-toggle="tooltip" title="Green" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-green.css"></li>
    <li class="cyan" data-bs-toggle="tooltip" title="Cyan" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-cyan.css"></li>
    <li class="brown" data-bs-toggle="tooltip" title="Brown" data-path="https://harnishdesign.net/demo/html/oxyy/css/color-brown.css"></li>
  </ul>
  <button class="btn switcher-toggle"><i class="fas fa-cog"></i></button>
</div>
<!-- Styles Switcher End --> 

<!-- Script --> 
<script src="https://harnishdesign.net/demo/html/oxyy/vendor/jquery/jquery.min.js"></script> 
<script src="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> 
<!-- Style Switcher --> 
<script src="https://harnishdesign.net/demo/html/oxyy/js/switcher.min.js"></script> 
<script src="https://harnishdesign.net/demo/html/oxyy/js/theme.js"></script>
</body>
</html>