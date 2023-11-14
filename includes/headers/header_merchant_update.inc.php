
<header class="sticky-top">
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
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
          href="merchantDashboard.php"
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
