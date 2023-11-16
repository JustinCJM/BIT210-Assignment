<?php
require_once 'includes/config_session.inc.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Travel Website</title>
    <link rel="icon" type="image/png" href="assets/logo.png" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="style.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
    
  </head>

  <?php
  $userType = $_SESSION["user_type"] ?? null;  
  if ($userType === 'merchant') {
    include 'includes/headers/header_merchant.inc.php';
  } elseif ($userType === 'customer') {
    include 'includes/headers/header_customer.inc.php';
  } elseif ($userType === 'tourism_ministry_officer') {
    include 'includes/headers/header_officer.inc.php';
  } else {
    include 'includes/headers/defaultheader.inc.php';
  }
  ?>
  <body style="min-height: 250vh;">
      <div id="carouselExampleAutoplaying" class=" home-carousel carousel slide pb-3" data-bs-ride="carousel">
        <div class="carousel-inner">
          <div class="c1 carousel-item active">
            <img src="assets/car1.jpg" class="d-block w-100" alt="image1" />
            <div class="mask"></div>
            <div class="carousel-header-text">LET'S PLAN YOUR TRIP TOGETHER</div>
            <div class="carousel-subheader-text" style="font-size: 8rem;">KLCC</div>
            <a href="#" class="btn btn-primary btn-book-now">Book Now</a>
          </div>
          <div class="c1 carousel-item">
            <img src="assets/car2.jpg" class="d-block w-100" alt="image2" />
            <div class="mask"></div>
            <div class="carousel-header-text">FIND THE BEST PLACES TO TRAVEL</div>
            <div class="carousel-subheader-text" style="font-size: 6rem; top: 40%;">CAMERON HIGHLANDS</div>
            <a href="#" class="btn btn-primary btn-book-now">Book Now</a>
          </div>
          <div class="c1 carousel-item">
            <img src="assets/car3.jpg" class="d-block w-100" alt="image3" />
            <div class="mask"></div>
            <div class="carousel-header-text">YOUR LONG AWAITED BREAK STARTS WITH US</div>
            <div class="carousel-subheader-text" style="font-size: 6rem; top: 40%">PULAU PANGKOR</div>
            <a href="#" class="btn btn-primary btn-book-now">Book Now</a>
          </div>
        </div>
        <button
          class="carousel-control-prev"
          type="button"
          data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="prev"
        >
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden"></span>
        </button>
        <button
          class="carousel-control-next"
          type="button"
          data-bs-target="#carouselExampleAutoplaying"
          data-bs-slide="next"
        >
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden"></span>
        </button>
      </div>
      <div class="container-fluid p-0 mt-0">
        <div class="about-container">
          <div class="text-center p-5 pt-5 fs-1 fw-bold">Why Travurr?</div>
          <div class="container text-center p-4" data-aos="fade-right" data-aos-duration="3000">
            <div class="row justify-content-between">
              <div class="col-md-3">
                <img src="assets/insight.png" class="img-fluid" alt="Insight" />
                <div class="row-3 fs-3 fw-bold text-center p-2">Superb Insights!</div>
                <div class="row-3 fs-5 text-center p-2">Save Money, Live Better. <br />
                  The way you want it to!
                </div>
              </div>
              <div class="col-md-3">
                <img src="assets/packages.png" class="img-fluid" alt="Packages" />
                <div class="row-3 fs-3 fw-bold text-center p-2">Adventure-packed Packages!</div>
                <div class="row-3 fs-5 text-center p-2">Check off your bucket list fast! Thrilling activities await you.
                </div>
              </div>
              <div class="col-md-3">
                <img src="assets/voucher.png" class="img-fluid" alt="Voucher" />
                <div class="row-3 fs-3 fw-bold text-center p-2">Superb Deals!</div>
                <div class="row-3 fs-5 text-center p-2">Don't be slow, our prices are low! Grab them before they disappear!
                </div>
              </div>
              <div class="col-md-3">
                <img src="assets/defence.png" class="img-fluid" alt="Defence" />
                <div class="row-3 fs-3 fw-bold text-center p-2">Highly Trusted!</div>
                <div class="row-3 fs-5 text-center p-2">Seal your trust! Our vendors are the best in town!
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center p-5 fs-1 fw-bold">Take a look at our featured products!</div>
      <?php
        include 'includes/productCarousell/productCarousell.inc.php';
      ?>
      <div id="carouselExampleControl" class="carousel slide text-center carousel-dark" data-bs-ride="carousel">
        <div class="text-center p-5 fs-1 fw-bold">See what other people have to say!</div>
        <div class="carousel-inner" data-aos="fade-left" data-aos-duration="2000">
          <div class="carousel-item active">
            <img class="shadow-1-strong mb-4"
              src="assets/review1.jpg" alt="avatar" style="width: 30rem; border-radius: 20px;">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <h5 class="mb-3">Izzard Izzudin</h5>
                <p>Penang</p>
                <p class="text-muted">
                  <i class="fas fa-quote-left pe-2"></i>
                  Having the opportunity to explore Penang was like going back in time! The package
                  I purchased was worth every cent.
                </p>
              </div>
            </div>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
            </ul>
          </div>
          <div class="carousel-item">
            <img class="shadow-1-strong mb-4"
              src="assets/review3.jpg" alt="avatar" style="width: 30rem; border-radius: 20px;">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <h5 class="mb-3">Kathy Cheong</h5>
                <p>Penang</p>
                <p class="text-muted">
                  <i class="fas fa-quote-left pe-2"></i>
                  The package me and my family got was just the thing for a short getaway. Nothing like
                  Penang food to rejuvenate the soul.
                </p>
              </div>
            </div>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="far fa-star fa-sm"></i></li>
            </ul>
          </div>
          <div class="carousel-item">
            <img class="shadow-1-strong mb-4"
              src="assets/review2.jpg" alt="avatar" style="width: 30rem; border-radius: 20px;">
            <div class="row d-flex justify-content-center">
              <div class="col-lg-8">
                <h5 class="mb-3">Chew Zi Nan</h5>
                <p>Melaka</p>
                <p class="text-muted">
                  <i class="fas fa-quote-left pe-2"></i>
                  Went to a remote but beautiful beach off the straits of Melaka. Ocean was beautiful
                  and we couldn't help ourselves to take a dip. Purchasing the package was effortless
                  and worth it!
                </p>
              </div>
            </div>
            <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="fas fa-star fa-sm"></i></li>
              <li><i class="far fa-star fa-sm"></i></li>
            </ul>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControl"
          data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControl"
          data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <br>
  </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
      crossorigin="anonymous"
    >
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>


  <footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
    <!-- Section: Social media -->
    <section
      class="d-flex justify-content-center p-4"
      style="background-color: #6351ce"
      >
      <!-- Right -->
      <div>
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-linkedin"></i>
        </a>
      </div>
      <!-- Right -->
    </section>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    
      <div>
        <!-- Grid row -->
        <div class="row mt-xl-4">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <!-- Content -->
            <h6 class="text-uppercase fw-bold"><img src="assets/logo.png" class="smalllogo" alt="...">Travurr</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p class="fw-bold">
              Unveiling the Extraordinary
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Products</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="#!" class="text-white">Transport</a>
            </p>
            <p>
              <a href="#!" class="text-white">Accommodation</a>
            </p>
            <p>
              <a href="#!" class="text-white">Experiences</a>
            </p>
            <p>
              <a href="#!" class="text-white">Package Deals</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Quick Links</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p>
              <a href="faq.php" class="text-white">FAQ</a>
            </p>
            <p>
              <a href="contact.php" class="text-white">Contact Us</a>
            </p>
            <p>
              <a href="about.php" class="text-white">About Us</a>
            </p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <!-- Links -->
            <h6 class="text-uppercase fw-bold">Contact</h6>
            <hr
                class="mb-4 mt-0 d-inline-block mx-auto"
                style="width: 60px; background-color: #7c4dff; height: 2px"
                />
            <p><i class="fas fa-home mr-3"></i> Tower 3, Brunsfield Oasis, Oasis Square, Jalan PJU 1A/7A, Oasis Ara Damansara, 47301 Petaling Jaya, Selangor</p>
            <p><i class="fas fa-envelope mr-3"></i> travelmate@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i> +60 3845 3984</p>
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
          <!-- Grid column -->
          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          </div>
          <!-- Grid column -->
        </div>
        <!-- Grid row -->
      </div>
    
    <!-- Section: Links  -->

  </footer>
  
</html>
