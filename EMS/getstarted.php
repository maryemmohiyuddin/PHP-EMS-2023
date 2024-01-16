<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<style>
  



input[type="file"]::before {
  top: 12px;
}

input[type="file"]::after {
  top: 9px;
}

/* ------- From Step 2 ------- */

input[type="file"] {
  position: relative;
}

input[type="file"]::file-selector-button {
  width: 136px;
  color: transparent;
}

/* Faked label styles and icon */
input[type="file"]::before {
  position: absolute;
  pointer-events: none;
  /*   top: 11px; */
  left: 35px;
  /* color: #0964b0; */
  content: "Upload Image";
}

input[type="file"]::after {
  position: absolute;
  pointer-events: none;
  /*   top: 10px; */
  left: 11px;
  height: 20px;
  width: 20px;
  content: "";
  background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' %3E%3Cpath d='M18 15v3H6v-3H4v3c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-3h-2zM7 9l1.41 1.41L11 7.83V16h2V7.83l2.59 2.58L17 9l-5-5-5 5z'/%3E%3C/svg%3E");
}

/* ------- From Step 1 ------- */

/* file upload button */
input[type="file"]::file-selector-button {
  color:white;
  border-radius: 4px;
  padding: 0 16px;
  height: 40px;
  cursor: pointer;
  border: 1px solid rgba(0, 0, 0, 0);
  margin-right: 16px;
}

/* file upload button hover state */
input[type="file"]::file-selector-button:hover {
  background-color: #f3f4f6;
}

/* file upload button active state */
input[type="file"]::file-selector-button:active {
  background-color: #e5e7eb;
}

/* ------------------------ */

/* default boilerplate to center input */

</style>



<head>
  <!-- Add this just before the closing body tag </body> -->
<script>
  let prevScrollPo = window.pageYOffset;
  let isNavbarVisibl = true;

  function handleScrol() {
    const currentScrollPo = window.pageYOffset;
    const scrollingDow = currentScrollPo > prevScrollPo;

    // Adjust this value to control how much scroll is needed to show the navbar
    const scrollThresholdToShowNavba = 20;

    if (scrollingDow && currentScrollPo > scrollThresholdToShowNavba) {
      // Scrolling down, hide the navbar
      if (isNavbarVisibl) {
        document.getElementById('header').style.top = '-100px';
        isNavbarVisibl = false;
      }
    } else {
      // Scrolling up or close to the top, show the navbar
      if (!isNavbarVisibl) {
        document.getElementById('header').style.top = '0';
        isNavbarVisibl = true;
      }
    }

    prevScrollPo = currentScrollPo;
  }

  // Add an event listener to handle scroll and show/hide the navbar
  window.addEventListener('scroll', handleScrol);
</script>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PrePlanner</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">


	<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome.css">
	<link rel="stylesheet" type="text/css" href="assets/css/line-awesome-font-awesome.min.css">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="assets/lib/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
	<link rel="stylesheet" type="text/css" href="assets/css/responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">  
<style>

</style>
  <script> 
                         



</script>

  <!-- =======================================================
  * Template Name: PrePlanner
  * Updated: Jul 05 2023 with Bootstrap v5.3.0
  * Template URL: https://bootstrapmade.com/PrePlanner-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-inner-pages">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a class="planner" href="index.php">PrePlanner</a></h1>
    
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto " href="index.php">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link   scrollto" href="#portfolio">Portfolio</a></li>
          <li><a class="nav-link scrollto" href="#team">Team</a></li>
         
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="getstarted.php">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <main style="padding: 0;" id="main">
    <div id="content">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

      <div class="wrapper">		
    
        <div class="sign-in-page">
          <div class="signin-popup">
            <div class="signin-pop">
              <div class="row">
                <div class="col-lg-6">
                  <div class="cmp-info">
                    <div class="cm-logo">
                      <h2>PrePlanner</h2><br>
                      <p>Workwise,  is a global freelancing platform and social networking where businesses and independent professionals connect and collaborate remotely</p>
                    </div><!--cm-logo end-->	
                    <img src="assets/img/signin.png" alt="">			
                  </div><!--cmp-info end-->
                </div>
                <div style="height: 900px;" class="col-lg-6">
                  <div class="login-sec">
                    <ul class="sign-control">
                      <div style="background-color: #e5e5e5; display: inline-block; border-radius: 15px;">
                      <li data-tab="tab-1" class="current"><a href="#" title="">Sign in</a></li>				
                      <li data-tab="tab-2"><a href="#" title="">Sign up</a></li></div>				
                    </ul>			
                    <div class="sign_in_sec current" id="tab-1">
                    <h3>Sign in</h3>
                      <form action="login_handler.php" method="POST">
                        <div class="row">
                          <div class="col-lg-12 no-pdd">
                            <div class="sn-field">
                              <input type="email" name="email" placeholder="Email Address">
                              <i class="la la-user"></i>
                            </div><!--sn-field end-->
                          </div>
                          <div class="col-lg-12 no-pdd">
                            <div class="sn-field">
                              <input type="password" name="password" placeholder="Password">
                              <i class="la la-lock"></i>
                            </div>
                          </div>
                          <div class="col-lg-12 no-pdd">
                            <div class="checky-sec">
                              <div class="fgt-sec">
                                <input type="checkbox" name="cc" id="c1" value="agreed">
                                <label for="c1">
                                  <span></span>
                                </label>
                                <small>Remember me</small>
                              </div><!--fgt-sec end-->
                              <a href="#" title="">Forgot Password?</a>
                            </div>
                          </div>
                          <div class="col-lg-12 no-pdd">
                            <button type="submit" value="submit">Sign in</button>
                          </div>
                        </div>
                      </form>
                      <div class="login-resources">
                        <h4>Login Via Social Account</h4>
                        <ul>
                          <li><a href="#" title="" class="fb"><i class="bx bxl-facebook"></i> Via Facebook</a></li>
                          <li><a href="#" title="" class="tw"><i class="bx bxl-twitter"></i>Login Via Twitter</a></li>
                        </ul>
                      </div><!--login-resources end-->
                    </div><!--sign_in_sec end-->
                    <div class="sign_in_sec" id="tab-2">
                      <div class="signup-tab">
                        <ul><h3 class="signup">Signup as</h3>
                          <br>
                          <li data-tab="tab-3" class="current"><a href="#" title="">User</a></li>
                          <li data-tab="tab-4"><a href="#" title="">Event Organizer</a></li>
                        </ul>
                      </div><!--signup-tab end-->	
                     
                      <div class="dff-tab current" id="tab-3">
                        <!-- ... Your HTML code ... -->

      <form name="userForm" action="form.php" enctype="multipart/form-data" onsubmit="return validateForm('userForm')" method="POST">
        <h3>Sign up as User</h3>
        <div class="row">
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input type="text" name="name" placeholder="Full Name" >
              <i class="la la-user"></i>
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input type="email" name="email" placeholder="Email Address" >
              <i class="la la-globe"></i>
            </div>
          </div>
          <input type="hidden" name="type" value="User">
          
          <!-- Gender radio buttons are placed within their own div -->
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input class="button radio" type="radio" name="gender" value="male" > Male
              <input class="button radio" type="radio" name="gender" value="female" > Female
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
        <div class="sn-field">
            <input style="padding: 0;" type="file" name="picture" accept=".jpg, .jpeg, .png">
        </div>
    </div>
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <select id="userForm-citySelect" name="city" >
                <option value=" " selected disabled>Select city</option>
                <!-- Add city options here -->
              </select>
              <i class="la la-dropbox"></i>
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input type="password" id="pswd" name="password" placeholder="Password" >
              <i class="la la-lock"></i>
            </div>  
            <span id="message" style="color:red"></span> <br><br>
          </div>
          <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input type="password" id="confirmpswd" name="repeatpassword" placeholder="Repeat Password" >
              <i class="la la-lock"></i>
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
            <div class="checky-sec st2">
              <div class="fgt-sec">
                <input type="checkbox" name="checkbox" id="c2" value="agreed" >
                <label for="c2" name="cc"><span></span></label>
                <small>Yes, I understand and agree to the workwise Terms & Conditions.</small>
              </div>
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
            <button type="submit">Sign up as User</button>
          </div>
        </div>
      </form>
  

</div>
<div class="dff-tab" id="tab-4">

  <form name="OrganizerForm" action="form2.php" enctype="multipart/form-data" onsubmit="return validateForm('organizerForm')" method="POST">
    <h3>Sign up as Event Organizer</h3>
    <div class="row">
      <div class="col-lg-12 no-pdd">
        <div class="sn-field">
          <input type="text" name="name" placeholder="Full Name" >
          <i class="la la-user"></i>
        </div>
      </div>
      <div class="col-lg-12 no-pdd">
        <div class="sn-field">
          <input type="email" name="email" placeholder="Email Address" >
          <i class="la la-globe"></i>
        </div>
      </div>
      
      <input type="hidden" name="type" value="Event Organizer">
      
      <!-- Gender radio buttons are placed within their own div -->
     
      <div class="col-lg-12 no-pdd">
            <div class="sn-field">
              <input class="button radio" type="radio" name="gender" value="male" > Male
              <input class="button radio" type="radio" name="gender" value="female" > Female
            </div>
          </div>
          <div class="col-lg-12 no-pdd">
        <div class="sn-field">
            <input style="padding: 0;" type="file" name="picture" accept=".jpg, .jpeg, .png">
        </div>
    </div>
      <div class="col-lg-12 no-pdd">
        <div class="sn-field">
          <select id="OrganizerForm-citySelect" name="city" >
            <option value="" selected disabled>Select city</option>
            <!-- Add city options here -->
          </select>
          <i class="la la-dropbox"></i>
        </div>
      </div>
      <div class="col-lg-12 no-pdd">
        <div class="sn-field">
          <input type="password" name="password" placeholder="Password" >
          <i class="la la-lock"></i>
        </div>  
      </div>
      <div class="col-lg-12 no-pdd">
        <div class="sn-field">
          <input type="password" name="repeatpassword" placeholder="Repeat Password" >
          <i class="la la-lock"></i>
        </div>
      </div>
      <div class="col-lg-12 no-pdd">
        <div class="checky-sec st2">
          <div class="fgt-sec">
            <input type="checkbox" name="checkbox" id="c3" value="agreed" >
            <label for="c3" name="cc"><span></span></label>
            <small>Yes, I understand and agree to the workwise Terms & Conditions.</small>
          </div>
        </div>
      </div>
      <div class="col-lg-12 no-pdd">
        <button type="submit">Sign up as Event Organizer</button>
      </div>
    </div>
  </form>

                      </div>
                     <!--dff-tab end-->
                    </div>		
                  </div><!--login-sec end-->
                </div>
              </div>		
            </div><!--signin-pop end-->
          </div><!--signin-popup end-->
         
        </div><!--sign-in-page end-->
    
    
      </div><!--theme-layout end-->
    
    
    
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/popper.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/lib/slick/slick.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>

     
    </section><!-- End Breadcrumbs -->
    <div id="stop-point"></div>



</div>
</main><!-- End #main -->
 
  
     
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <h4>Join Our Newsletter</h4>
            <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3 class="planner">PrePlanner</h3>
            <p>
              A108 Adam Street <br>
              New York, NY 535022<br>
              United States <br><br>
              <strong>Phone:</strong> +1 5589 55488 55<br>
              <strong>Email:</strong> info@example.com<br>
            </p>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Social Networks</h4>
            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container footer-bottom clearfix">
      <div class="copyright">
        &copy; Copyright <strong><span>PrePlanner</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/PrePlanner-free-bootstrap-html-template-corporate/ -->
      </div>
    </div>
  </footer></div>
  <!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>