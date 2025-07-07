
<?= view('partials/navbar_welcome') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<style>
  body {
    background: #23272f;
    color: #fff;
    font-family: 'Segoe UI', Arial, sans-serif;
  }
  .content-wrapper {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: stretch;
  }
  .hero {
    background: linear-gradient(120deg, #23272f 60%, #2c3e50 100%), url('<?= base_url('images/chess-logo.png') ?>') no-repeat right bottom;
    background-size: cover, 120px;
    padding: 60px 0 40px 0;
    text-align: center;
    position: relative;
    box-shadow: 0 8px 32px rgba(0,0,0,0.18);
  }
  .hero-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin: 0 auto;
    padding: 30px 20px 20px 20px;
    background: rgba(44, 62, 80, 0.85);
    border-radius: 18px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.12);
  }
  .hero-content h1 {
    font-size: 2.8em;
    font-weight: 800;
    color: #e8c547;
    margin-bottom: 0.3em;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px #0008;
  }
  .hero-content p.lead {
    font-size: 1.3em;
    color: #fff;
    margin-bottom: 1.5em;
    font-weight: 400;
    letter-spacing: 0.5px;
  }
  .glow-button {
    background: #e8c547;
    color: #23272f;
    font-weight: 700;
    font-size: 1.15em;
    border: none;
    border-radius: 8px;
    padding: 14px 38px;
    box-shadow: 0 0 16px #e8c54755, 0 2px 8px #0005;
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 10px;
  }
  .glow-button:hover {
    background: #d4b03a;
    box-shadow: 0 0 32px #e8c54799, 0 4px 16px #0007;
    transform: translateY(-2px) scale(1.04);
    color: #23272f;
  }
  .highlights-bar {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin: 32px 0 0 0;
    flex-wrap: wrap;
  }
  .highlight-item {
    background: #2c3e50;
    color: #e8c547;
    border-radius: 10px;
    padding: 18px 28px;
    font-size: 1.1em;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 12px;
    box-shadow: 0 2px 8px #0003;
    margin-bottom: 10px;
  }
  .highlight-item i {
    font-size: 1.5em;
    color: #e8c547;
  }
  .carousel-inner .card {
    border-radius: 14px;
    overflow: hidden;
    background: #23272f;
    color: #fff;
    border: 1px solid #e8c54722;
    box-shadow: 0 2px 12px #0002;
  }
  .carousel-inner .card-title {
    color: #e8c547;
    font-weight: 700;
    font-size: 1.15em;
  }
  .carousel-inner .btn-outline-primary {
    border-color: #e8c547;
    color: #e8c547;
    font-weight: 600;
    transition: background 0.2s, color 0.2s;
  }
  .carousel-inner .btn-outline-primary:hover {
    background: #e8c547;
    color: #23272f;
  }
  .carousel-control-prev-icon, .carousel-control-next-icon {
    background-color: #e8c547;
    border-radius: 50%;
    box-shadow: 0 2px 8px #0005;
  }
  .testimonial {
    background: #2c3e50;
    color: #e8c547;
    padding: 40px 0;
    text-align: center;
    font-style: italic;
    font-size: 1.15em;
    margin-top: 40px;
    border-radius: 12px;
    box-shadow: 0 2px 12px #0002;
  }
  @media (max-width: 900px) {
    .hero-content { max-width: 98vw; }
    .highlights-bar { gap: 16px; }
    .highlight-item { padding: 12px 10px; font-size: 1em; }
  }
  @media (max-width: 600px) {
    .hero { padding: 30px 0 20px 0; }
    .hero-content { padding: 18px 5px 10px 5px; }
    .highlights-bar { flex-direction: column; align-items: center; gap: 10px; }
    .highlight-item { width: 90vw; justify-content: center; }
  }
</style>
<!-- Page Wrapper -->
<div class="content-wrapper">
  <!-- HERO SECTION -->
  <section class="hero">
    <div class="hero-content">
      <h1 class="display-4 fw-bold mb-3">Welcome to the Chess Club</h1>
      <p class="lead mb-4">Strategy. Skill. Sportsmanship.</p>
      <a href="<?= base_url('about') ?>" class="glow-button">Explore More</a>
      <div class="highlights-bar mt-4">
        <div class="highlight-item"><i class="fas fa-chess-knight"></i> Weekly Tournaments</div>
        <div class="highlight-item"><i class="fas fa-users"></i> All Levels Welcome</div>
        <div class="highlight-item"><i class="fas fa-chess-board"></i> Friendly Community</div>
      </div>
    </div>
  </section>

   <!-- EVENTS CAROUSEL SECTION -->
  <section class="py-5 bg-white">
    <div class="container">
      <h2 class="text-center mb-4" style="color:#23272f; font-weight:700;">Upcoming Highlights</h2>
      <div id="eventCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
        <div class="carousel-inner">

          <!-- Slide 1 (all 3 events) -->
          <div class="carousel-item active">
            <div class="row">
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                  <img src="<?= base_url('images/event1.jpg') ?>" class="card-img-top" alt="Event 1">
                  <div class="card-body">
                    <h5 class="card-title">Blitz Tournament</h5>
                    <p class="card-text">Open to all students. Fast-paced, exciting games!</p>
                    <a href="event-details.php?id=1" class="btn btn-outline-primary btn-sm">Details</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                 <img src="<?= base_url('images/event2.jpg') ?>"class="card-img-top" alt="Event 2">
                  <div class="card-body">
                    <h5 class="card-title">Masterclass Session</h5>
                    <p class="card-text">Learn from top players. Focus on openings & endgames.</p>
                    <a href="event-details.php?id=2" class="btn btn-outline-primary btn-sm">Details</a>
                  </div>
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <div class="card shadow-sm border-0 h-100">
                  <img src="<?= base_url('images/event3.jpg') ?>" class="card-img-top" alt="Event 3">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?= view('partials/footer') ?>

<!-- Membership Benefits Section -->
<section class="membership-benefits my-5">
  <div class="container text-center">
    <h2 class="mb-4" style="color:#e8c547;">Why Become a Member?</h2>
    <div class="row justify-content-center">
      <div class="col-md-3 mb-4">
        <div class="benefit-card">
          <i class="fas fa-chess-rook"></i>
          <h5>Exclusive Tournaments</h5>
          <p>Compete in members-only events and climb the club leaderboard.</p>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="benefit-card">
          <i class="fas fa-chalkboard-teacher"></i>
          <h5>Coaching & Workshops</h5>
          <p>Access to masterclasses, strategy sessions, and personal coaching.</p>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="benefit-card">
          <i class="fas fa-users"></i>
          <h5>Community & Networking</h5>
          <p>Meet fellow chess lovers, make friends, and join club socials.</p>
        </div>
      </div>
    </div>
    <a href="<?= base_url('register') ?>" class="glow-button mt-3">Become a Member</a>
  </div>
</section>

<!-- Testimonial Section -->
<section class="testimonial">
  <blockquote>
    “Joining the Chess Club was the best decision I made this year. The tournaments and coaching helped me improve fast!”<br>
    <span>- A. Member</span>
  </blockquote>
</section>

<style>
.membership-benefits {
  background: #2c3e50;
  border-radius: 18px;
  box-shadow: 0 2px 16px #0002;
  padding: 40px 0 30px 0;
  margin-top: 40px;
}
.benefit-card {
  background: #23272f;
  color: #fff;
  border-radius: 12px;
  padding: 28px 18px 20px 18px;
  box-shadow: 0 2px 8px #0003;
  margin: 0 8px;
  min-height: 220px;
}
.benefit-card i {
  color: #e8c547;
  font-size: 2.2em;
  margin-bottom: 12px;
}
.benefit-card h5 {
  color: #e8c547;
  font-weight: 700;
  margin-bottom: 10px;
}
.benefit-card p {
  font-size: 1em;
  color: #bdc3c7;
}
@media (max-width: 700px) {
  .benefit-card { min-height: 0; padding: 18px 8px 12px 8px; }
}
</style>
