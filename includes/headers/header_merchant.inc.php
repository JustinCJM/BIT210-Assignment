
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
          href="addProducts.php"
          >Manage Products</a>
        <a
          class="nav-link"
          href="merchant_dashboard.php"
          >Dashboard</a>
        <a
          class="nav-link"
          style="font-weight: bold"
          >Welcome <?php echo $_SESSION["user_username"]; ?>! </a
        >

        <form action="includes/login/logout.inc.php" method="post">
        <button
          class="nav-link"
          style="font-weight: bold"
          >Logout</button
        >
        </form>

      </div>
    </div>
  </div>
</nav>
</header>
