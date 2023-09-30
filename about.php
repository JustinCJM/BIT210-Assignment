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
              class="nav-link active"
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
          <div class="card justify-content-center align-items-center" style="border-radius: 1rem">
            <div class="row-3 fs-3 mt-5 fw-bold text-center p-2">Overview</div>
            <div class="row g-0">
              <div class="col-sm-1"></div>
              <div class="row-3 fs-5 mb-5 text-center p-2 col-sm-10"> 
                Experiencing the world we live in is fundamental to our collective happiness. 
                Our mission is and always will be to unlock this by connecting high-quality
                real-life experiences with people all over the world, giving them the opportunity
                to be entertained, educated and inspired.
              </div>
            </div>

            <div class="row-3 fs-3 fw-bold text-center p-2">About us</div>
            <div class="row g-0">
              <div class="row-3 fs-5 text-center p-2"> 
                Founded in 2016, Tuhr was created to help travelers explore the US with spontaneity and ease. 
              </div>
            </div>
            <div class="row g-0">
              <div class="col-sm-1"></div>
              <div class="row-3 fs-5 mb-5 text-center col-sm-10"> 
                With more than 300 destinations and 40,000 travelers over the last 7 years, we know that every destination has amazing things to do, see, and experience. 
              </div>
            </div>

            <div class="row-3 fs-3 fw-bold text-center p-2">Our Values</div>
            <div class="row g-0">
              <div class="row-3 fs-5 text-center p-2"> 
                <ul class="list-unstyled">
                  <li>Hold the traveler experience above all else.</li>
                  <li>Communicate openly, thoughtfully, and deliberately.</li>
                  <li>Inspire positive change + conscious consumption.</li>
                  <li>Explore more + enjoy the ride.</li>
                </ul>
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
