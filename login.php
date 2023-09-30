<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Login</title>
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
  </head>
  <header>
    <nav class="navbar navbar-expand-lg" style="background-color: white">
      <div class="container-fluid mx-auto" style="max-width: 1430px">
        <a
          class="navbar-brand"
          href="index.php"
          style="color: black; font-size: 35px; font-weight: bold"
        >
          <img
            src="assets/logo.png"
            alt="Logo"
            width="50"
            height="44"
            class="d-inline-block align-text-top"
          />
          Stoopid
        </a>
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
              <div class="col-md-6 col-lg-5 d-md-flex d-md-block">
                <img src="assets/login.jpeg" alt="loginPicture" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
              </div>
              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">
                  <form id="loginForm" class="pt-3">
                    <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
                      Log In
                    </h3>

                    <div class="form-floating mb-4">
                      <input
                        type="email"
                        id="formEmail"
                        class="form-control form-control-lg"
                        placeholder="info@example.com"
                      />
                      <label for="formEmail">Email Address</label>
                    </div>

                    <div class="form-floating mb-4">
                      <input
                        type="password"
                        id="formPassword"
                        class="form-control form-control-lg"
                        placeholder="Password"
                      />
                      <label for="formPassword">Password</label>
                    </div>

                    <div class="input-group mb-3 justify-content-between">
                      <div class="form-check">
                        <input
                          type="checkbox"
                          class="form-check-input"
                          id="formCheck"
                        />
                        <label
                          for="formCheck"
                          class="form-check-label text-secondary"
                          >Remember Me
                          </label>
                      </div>
                      <div class="forgot">
                        <a href="#">Forgot Password?</a>
                      </div>
                    </div>

                    <div class="pt-1 mb-4">
                      <button
                        class="btn btn-primary btn-lg btn-block"
                        type="button"
                      >
                        Login
                      </button>
                    </div>

                    <p class="mb-5 pb-lg-2" style="color: #393f81">
                      Don't have an account?
                      <a href="#!" style="color: #393f81">Sign Up</a>
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
