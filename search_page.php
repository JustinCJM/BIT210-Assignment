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

    <body>
        <div class="container my-5" style="min-height: 46.8vh;">
            <table class="table">

                <?php
                    include 'includes/search/search.inc.php';
                ?>

            </table>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"
        >
        </script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="script.js"></script>
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
    