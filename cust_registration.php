<?php
require_once 'includes/custsignup/custsignup_view.inc.php';
require_once 'includes/config_session.inc.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Registration</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png" />
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link
      rel="stylesheet"
      href="style.css"
    />
  </head>
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand fw-bold"> <img src="assets/logo.png" alt="...">Travurr
        </a>
        <h2>Sign Up</h2>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNavAltMarkup"
          aria-controls="navbarNavAltMarkup"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ms-auto">
            <a
              class="nav-link"
              aria-current="page"
              href="index.php"
              >Home</a
            >
            <a
              class="nav-link"
              href="about.php"
              >About Us</a>
              <a
              class="nav-link"
              href="contact.php"
              >Contact Us</a>
              <a
              class="nav-link"
              href="faq.php"
              >FAQ</a>
            <a
              class="nav-link active"
              href="registration.php"
              style="font-weight: bold"
              >Sign Up</a
            >
            <a
              class="nav-link btn btn-primary login-btn"
              href="login.php"
              style="font-weight: bold"
              >Login</a
            >
          </div>
        </div>
      </div>
    </nav>
  </header>
  <body>
  <div class="page-body">
    <div class="container py-5" style="height: 90%">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-8">
          <div class="card" style="border-radius: 1rem">
              <div class="d-flex align-items-center justify-content-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form action="includes/custsignup/custsignup.inc.php" method="post" id="registerForm" class="pt-3 needs-validation was-validated"
                  novalidate="" enctype="multipart/form-data">
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                      Customer Registration
                    </h3>

                    <?php

                    signup_inputs();

                    ?>

                    <div class="pt-1 mb-4">
                      <button
                        class="btn btn-primary btn-lg btn-block"
                        style="background-color: #7c4dff;"
                        name="submit"
                        type="submit"
                      >
                        Next
                      </button>
                    </div>

                    <div class="row">
                      <div class="col">
                        <p class="mb-5 pb-lg-2" style="color: #393f81">
                          Already have an account?
                          <a href="login.php" style="color: #393f81">Sign In</a>
                        </p>
                      </div>
                      <div class="col">
                        <p class="mb-5 pb-lg-2" style="color: #393f81">
                          Looking to be a Seller?
                          <a href="merch_registration.php" style="color: #393f81">Click Here</a>
                        </p>
                      </div>
                    </div>

                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  check_signup_errors();
  ?>
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
  
</html>
