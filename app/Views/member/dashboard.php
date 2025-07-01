<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?> - Elite Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="elite-chess-theme">
    <div class="elite-background">
        <div class="wood-pattern"></div>
        <div class="elite-overlay"></div>
        <div class="club-elements">
            <div class="trophy-element">🏆</div>
            <div class="medal-element">🥇</div>
            <div class="chess-piece king">♔</div>
            <div class="chess-piece queen">♕</div>
            <div class="chess-piece rook">♖</div>
            <div class="chess-piece bishop">♗</div>
            <div class="chess-piece knight">♘</div>
            <div class="chess-piece pawn">♙</div>
        </div>
    </div>

    <!-- TOP NAVBAR -->
    <?= view('partials/navbar') ?>

    <!-- DASHBOARD CONTAINER -->
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="welcome-section">
                <h1 class="dashboard-title">🏆 Welcome Back, <?= esc($name) ?> 🥇</h1>
                <p class="dashboard-subtitle">Your exclusive chess journey continues</p>
            </div>
            <div class="membership-badge">
                <div class="badge <?= strtolower($level) ?>">
                    <i class="fas fa-medal"></i>
                    <span><?= esc($level) ?> Member</span>
                </div>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= $points ?></div>
                    <div class="stat-label">Total Points</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= $events_joined ?></div>
                    <div class="stat-label">Events Joined</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><?= $classes_booked ?></div>
                    <div class="stat-label">Classes Booked</div>
                </div>
            </div>
        </div>

        <div class="quick-actions">
            <h2 class="section-title">♖ Quick Actions ♗</h2>
            <div class="action-buttons">
                <a href="<?= base_url('membership') ?>" class="action-btn">
                    <i class="fas fa-medal"></i>
                    <span>Manage Membership</span>
                </a>
                <a href="<?= base_url('events') ?>" class="action-btn">
                    <i class="fas fa-calendar-alt"></i>
                    <span>View Events</span>
                </a>
                <a href="<?= base_url('my-events') ?>" class="action-btn">
                    <i class="fas fa-list-check"></i>
                    <span>My Events</span>
                </a>
                <a href="<?= base_url('leaderboard') ?>" class="action-btn">
                    <i class="fas fa-trophy"></i>
                    <span>Leaderboard</span>
                </a>
            </div>
        </div>

        <div class="dashboard-footer">
            <div class="chess-motto">"Excellence in every move, prestige in every game"</div>
        </div>
    </div>
</body>
</html>
