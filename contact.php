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
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  </head>
  <header class="sticky-top">
    <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
        <a href="index.php" class="navbar-brand fw-bold"> <img src="assets/logo.png" alt="...">Tuhr
        </a>
        <div class="nav-search-container">
          <form class="nav-search" role="search">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="🔍︎Find Your Escape!"
                aria-label="Search"
                style="border-top-left-radius: 20px; border-bottom-left-radius: 20px;"
              />
              <button
                class=" nav-search-btn btn btn-outline-light fw-bold"
                type="submit"
              >
                Search
              </button>
            </div>
          </form>
        </div>
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
              class="nav-link active"
              href="contact.php"
              >Contact Us</a>
            <a
              class="nav-link"
              href="faq.php"
              >FAQ</a>
            <a
              class="nav-link"
              href="login.php"
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
    <div class="vh-100" style="background-color: #ff6d0a">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card" style="border-radius: 1rem">
            <div class="row g-0">
              <div class="col-md-6 col-lg-7 d-md-flex d-md-block">
                <img src="assets/contact.jpg" alt="loginPicture" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
              </div>
              <div class="col-md-4 col-lg-5 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <div class="row-3 fs-3 fw-bold p-2">Contact Us</div>
                  <div class="row g-0">
                    <div class="col-sm-1"></div>
                    <div class="row-3 fs-5 mb-3 p-2 col-sm-10"> 
                      <strong>Phone</strong>  <br>
                      +60 12-368 3333         
                    </div>
                  </div>
                  <div class="row g-0">
                    <div class="col-sm-1"></div>
                    <div class="row-3 fs-5 p-2 col-sm-10">
                      <strong>Email</strong>  <br>
                      b1900577@helplive.edu.my
                    </div>
                  </div>
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
