<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
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

    <?= view('partials/navbar_admin') ?>

    <div class="auth-container">
        <h2 style="text-align:center;"><i class="fas fa-chess-king"></i> Admin Dashboard</h2>
        <p style="text-align:center; color:#555;">Use the links below to manage users, events, and site content.</p>
        <hr>
        <ul style="list-style:none; padding:0; max-width:400px; margin:30px auto 0 auto;">
            <li style="margin-bottom:18px;">
                <a href="<?= base_url('admin/users') ?>" style="display:flex;align-items:center;gap:10px;font-size:1.15em;text-decoration:none;color:#2c3e50;font-weight:600;">
                    <i class="fas fa-users"></i> Manage Users
                </a>
            </li>
            <li style="margin-bottom:18px;">
                <a href="<?= base_url('admin/event') ?>" style="display:flex;align-items:center;gap:10px;font-size:1.15em;text-decoration:none;color:#2c3e50;font-weight:600;">
                    <i class="fas fa-calendar-alt"></i> Manage Events
                </a>
            </li>
            <li style="margin-bottom:18px;">
                <a href="<?= base_url('admin/leaderboard') ?>" style="display:flex;align-items:center;gap:10px;font-size:1.15em;text-decoration:none;color:#2c3e50;font-weight:600;">
                    <i class="fas fa-trophy"></i> Manage Leaderboard
                </a>
            </li>
        </ul>
    </div>
</body>
</html>
