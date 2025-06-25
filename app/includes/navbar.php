<nav class="main-header navbar navbar-expand-md navbar-light bg-white shadow-sm border-bottom">
  <div class="container">
    <a href="/chess-club-site/index.php" class="navbar-brand">
      <span class="brand-text fw-bold">Chess Club</span>
    </a>

    <!-- Mobile toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar items -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item"><a class="nav-link" href="/chess-club-site/index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="/chess-club-site/pages/about.php">About</a></li>
        <li class="nav-item"><a class="nav-link" href="/chess-club-site/pages/staff.php">Staff</a></li>
        <li class="nav-item"><a class="nav-link" href="/chess-club-site/pages/policy.php">Website Policy</a></li>
      </ul>

      <!-- Right-aligned buttons -->
      <div class="d-flex">
        <a href="/chess-club-site/pages/login.php" class="btn btn-dark me-2">Login</a>
        <a href="/chess-club-site/pages/register.php" class="btn btn-warning text-dark fw-semibold">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Optional CSS to improve button hover (put in style.css or in <style> in header.php) -->
<style>
  .btn-dark:hover {
    background-color: #000;
    box-shadow: 0 0 12px rgba(0,0,0,0.5);
  }

  .btn-warning:hover {
    background-color: #ffcd39;
    box-shadow: 0 0 12px rgba(255,193,7,0.5);
  }
</style>
