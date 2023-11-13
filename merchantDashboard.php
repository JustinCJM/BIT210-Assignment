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
    include 'includes/headers/header_merchant.inc.php';
    ?>

    <body>
    <div class="container-fluid pb-5">
        <div class="row">
            <nav class="col-md-2 d-md-block side-menu p-5" style="text-align:center">
                <h5 class="text-center"><?php echo $_SESSION["user_username"] ?>'s Dashboard</h5>
                <hr class="my-3">
                <a href="#" style="font-weight: 600;">My Products</a>
                <a href="viewOrders.php">My Orders</a>
                    <!-- Add more links as needed -->
            </nav>

            <div class="col-md-8 pt-5">
                <!-- <div class="h3 pb-4 pt-3"> My Products</div> -->
                    <table class="table">
                        <thead>
                        <tr>
                            <th style='text-align: center; font-weight: 600;'>Product Image</th>
                            <th style='text-align: center; font-weight: 600;'>Product Name</th>
                            <th style='text-align: center; font-weight: 600;'>Category</th>
                            <th style='text-align: center; font-weight: 600;'>Location</th>
                            <th style='text-align: center; font-weight: 600;'>Price</th>
                            <th style='text-align: center; font-weight: 600;'>Description</th>
                            <th style='text-align: center; font-weight: 600;'>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'includes/merchantDash/merchantDash.inc.php';
                            ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

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
                <h6 class="text-uppercase fw-bold"><img src="assets/logo.png" class="smalllogo" alt="...">Tuhr</h6>
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
            Grid column
            </div>
            <!-- Grid row -->
        </div>
        
        <!-- Section: Links  -->

    </footer>

</html>