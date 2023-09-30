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
        <a href="index.php" class="navbar-brand fw-bold"> <img src="assets/logo.png" alt="...">Tuhr
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
    <div class="vh-100 page-body">
    <div class="container py-5" style="height: 90%">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-6 col-lg-5 d-md-flex d-md-block">
                <img src="assets/login.jpeg" alt="loginPicture" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                    <form id="registerForm" class="pt-3 needs-validation was-validated" novalidate="">
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                      Registration
                    </h3>

                    <div class="form-floating mb-4">
                      <input
                        type="text"
                        id="formRegName"
                        class="form-control form-control-lg"
                        placeholder="John Doe"
                        required
                      />
                      <label for="formRegName">Full Name</label>
                      <div class="valid-feedback"></div>
                    </div>

                    <div class="form-floating mb-4">
                      <input
                        type="text"
                        id="formRegUserName"
                        class="form-control form-control-lg"
                        placeholder="JohnDoe123"
                        required
                      />
                      <label for="formRegUserName">Username</label>
                    </div>

                    <div class="form-floating mb-4">
                      <input
                        type="email"
                        id="formRegEmail"
                        class="form-control form-control-lg"
                        placeholder="info@example.com"
                        required
                      />
                      <label for="formEmail">Email Address</label>
                    </div>

                    <div class="form-floating mb-4">
                      <input
                        type="password"
                        id="formRegPassword"
                        class="form-control form-control-lg"
                        placeholder="Password"
                        required
                      />
                      <label for="formPassword">Password</label>
                    </div>

                    <div class="pt-1 mb-4">
                      <button
                        class="btn btn-primary btn-lg btn-block"
                        style="background-color: #7c4dff;"
                        type="submit"
                      >
                        Register
                      </button>
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #393f81">
                      Already have an account?
                      <a href="login.php" style="color: #393f81">Sign In</a>
                    </p>
                  </form>
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
  
</html>
