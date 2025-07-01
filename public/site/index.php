<?php include("includes/header.php"); ?>
<?php include("includes/navbar.php"); ?>

<style>
/* Hero Section */
.hero {
  background: url('/chess-club-site/asset/images/hero-bg.jpg') center center / cover no-repeat;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  color: white;
  text-align: center;
}
.hero::after {
  content: "";
  position: absolute;
  top: 0; left: 0;
  height: 100%; width: 100%;
  background: rgba(0,0,0,0.6);
  z-index: 1;
}
.hero-content {
  position: relative;
  z-index: 2;
  animation: fadeInUp 1.5s ease-out;
}
@keyframes fadeInUp {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}
.glow-button {
  color: #fff;
  border: 2px solid #fff;
  background: transparent;
  padding: 12px 30px;
  border-radius: 50px;
  text-transform: uppercase;
  font-weight: bold;
  transition: 0.3s ease-in-out;
}
.glow-button:hover {
  background: #ffc107;
  color: black;
  box-shadow: 0 0 15px #ffc107;
}

/* Carousel card styling */
.card {
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
  transform: scale(1.03);
  box-shadow: 0 10px 20px rgba(0, 123, 255, 0.3);
}
.card-img-top {
  height: 180px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}
.card-body {
  min-height: 160px;
}
.carousel-control-prev-icon,
.carousel-control-next-icon {
  background-color: rgba(0,0,0,0.5);
  border-radius: 50%;
  padding: 10px;
}
</style>

<!-- Main Wrapper -->
<div class="content-wrapper">

  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="display-4 fw-bold mb-3">Welcome to the Chess Club</h1>
      <p class="lead mb-4">Strategy. Skill. Sportsmanship.</p>
      <a href="pages/about.php" class="glow-button">Explore More</a>
    </div>
  </section>

  <!-- EVENTS CAROUSEL SECTION -->
  <section class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center mb-4">Upcoming Highlights</h2>
      <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

          <!-- Slide 1 (all 3 events) -->
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                  <img src="/chess-club-site/asset/images/event1.jpg" class="card-img-top" alt="Event 1">
                  <div class="card-body">
                    <h5 class="card-title">Blitz Tournament</h5>
                    <p class="card-text">Open to all students. Fast-paced, exciting games!</p>
                    <a href="event-details.php?id=1" class="btn btn-outline-primary btn-sm">Details</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                  <img src="/chess-club-site/asset/images/event2.jpg" class="card-img-top" alt="Event 2">
                  <div class="card-body">
                    <h5 class="card-title">Masterclass Session</h5>
                    <p class="card-text">Learn from top players. Focus on openings & endgames.</p>
                    <a href="event-details.php?id=2" class="btn btn-outline-primary btn-sm">Details</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                  <img src="/chess-club-site/asset/images/event3.jpg" class="card-img-top" alt="Event 3">
                  <div class="card-body">
                    <h5 class="card-title">Friendly Match</h5>
                    <p class="card-text">Support our team in a match vs. local university rivals.</p>
                    <a href="event-details.php?id=3" class="btn btn-outline-primary btn-sm">Details</a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

        <!-- Carousel  -->
        <button class="carousel-control-prev" type="button" data-bs-target="#eventCarousel" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#eventCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

</div>

<?php include("includes/footer.php"); ?>
