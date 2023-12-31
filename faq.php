<?php
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>FAQ</title>
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
  <body>
    <div class="vh-150">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card justify-content-center align-items-center" style="border-radius: 1rem; border-color:transparent;">
            <div class="row-3 fs-3 mt-4 fw-bold text-center p-2">Frequently Asked Questions</div>
            
            <div class="row g-0">
              <div class="row-3 fs-5 p-2">
                <strong>What is Travurr?</strong>
              
                <div class="row-3 fs-5 mb-5 p-3"> 
                  We're a travel brand specializing in curated vacations at your convenience. 
                  With Travurr, your journey will be a non-stop trip filled to the brim with activities. <br>
  
                  You choose the mode of transportation (plane or car), dates, and budget, 
                  we curate recommendations catered to your interests, and book your travel + accommodations!
                </div>
              </div>
            </div>

            <div class="row g-0">
              <div class="row-3 fs-5 p-2">
                <strong>How Long are the Trips?</strong>
              
                <div class="row-3 fs-5 mb-5 p-3"> 
                  Our trips range in length from two (2) to ten (10) nights. 
                  On your Pre-Trip Survey, you select the length of your getaway.

                  We ask for your time restrictions on the Pre-Trip Survey. 
                  If you don’t list any, we’ll aim to have you depart early on the morning of your departure, 
                  and return in the evening of your return date to make the most of your getaway.
                </div>
              </div>
            </div>

            <div class="row g-0">
              <div class="row-3 fs-5 p-2">
                <strong>Can you plan Trips for wheelchair users?</strong>
              
                <div class="row-3 fs-5 mb-5 p-3"> 
                  Yes! We can definitely accommodate a wheelchair-accessible Trip. 
                  On the Pre-Trip Survey, we ask "Do you have any mobility 
                  restrictions?" for each traveler. 

                  Based on your responses, we will be sure to arrange for an 
                  ADA-compliant hotel room, and wheelchair transfer at the airport, 
                  and will make sure all activities/restaurants recommended are 
                  wheelchair accessible. Beyond that, please let us know any other 
                  specifics in the "Is there anything else we need to know" section!
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
  
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
            <p><i class="fas fa-envelope mr-3"></i> Travurrtravels@gmail.com</p>
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

    <!-- Copyright -->
    <div
          class="text-center p-3"
          style="background-color: rgba(0, 0, 0, 0.2)"
          >
      © 2020 Copyright:
      <a class="text-white" href="https://mdbootstrap.com/"
          >MDBootstrap.com</a
        >
    </div>
    <!-- Copyright -->
  </footer>
  
</html>
