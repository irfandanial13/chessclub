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
    
    <div class="auth-container elite-login">
        <div class="elite-header">
            <div class="club-logo">
                <div class="trophy-logo">🏆</div>
                <div class="brand-section">
                    <h1 class="elite-title">Elite Chess Club</h1>
                    <div class="club-subtitle">Page Not Found</div>
                </div>
            </div>
            <h2 class="welcome-title">Error <?= esc($error_code) ?></h2>
            <p class="welcome-subtitle"><?= esc($error_message) ?></p>
        </div>

        <div class="error-content" style="text-align: center; padding: 2rem 0;">
            <div class="error-icon" style="font-size: 8rem; color: #8B5C2A; margin-bottom: 1rem;">
                <i class="fas fa-chess-board"></i>
            </div>
            
            <div class="error-suggestions" style="margin-top: 2rem;">
                <h3 style="color: #8B5C2A; margin-bottom: 1rem;">What you can do:</h3>
                <ul style="list-style: none; padding: 0; text-align: left; max-width: 400px; margin: 0 auto;">
                    <?php foreach ($suggestions as $suggestion): ?>
                        <li style="margin-bottom: 0.5rem; color: #666;">
                            <i class="fas fa-arrow-right" style="color: #8B5C2A; margin-right: 0.5rem;"></i>
                            <?= esc($suggestion) ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="error-actions" style="margin-top: 2rem;">
            <a href="<?= base_url('/') ?>" class="elite-button" style="margin-right: 1rem;">
                <span class="button-text">
                    <i class="fas fa-home"></i>
                    Go Home
                </span>
            </a>
            
            <a href="javascript:history.back()" class="elite-button" style="background: #666;">
                <span class="button-text">
                    <i class="fas fa-arrow-left"></i>
                    Go Back
                </span>
            </a>
        </div>
        
        <div class="elite-footer">
            <div class="club-motto">"Excellence in every move, prestige in every game"</div>
        </div>
    </div>
</body>
</html> 