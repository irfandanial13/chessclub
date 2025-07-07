<!DOCTYPE html>
<html>
<head>
    <title>Membership - Elite Chess Club</title>
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

    <?= view('partials/navbar') ?>

    <div class="membership-container">
        <div class="membership-header">
            <div class="header-content">
                <h1 class="membership-title">🏆 Elite Membership Status 🥇</h1>
                <p class="membership-subtitle">Your exclusive chess journey</p>
            </div>
            <div class="current-status">
                <div class="status-badge <?= strtolower($level ?? 'bronze') ?>">
                    <i class="fas fa-medal"></i>
                    <span><?= esc($level ?? 'Bronze') ?> Member</span>
                </div>
            </div>
        </div>

        <div class="membership-info">
            <div class="info-card">
                <div class="info-item">
                    <i class="fas fa-medal"></i>
                    <div class="info-content">
                        <label>Current Level</label>
                        <span><?= esc($level ?? 'Bronze') ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-check-circle"></i>
                    <div class="info-content">
                        <label>Status</label>
                        <span class="status-<?= strtolower($status ?? 'active') ?>"><?= esc($status ?? 'Active') ?></span>
                    </div>
                </div>
                <div class="info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <div class="info-content">
                        <label>Expiry Date</label>
                        <span><?= esc($expiry_date) ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="upgrade-section">
            <div class="section-header">
                <h2>♔ Upgrade Your Membership ♕</h2>
                <p>Choose your path to chess excellence</p>
            </div>

            <div class="membership-cards">
                <div class="membership-card bronze <?= strtolower($level ?? 'bronze') === 'bronze' ? 'current' : '' ?>">
                    <div class="card-header">
                        <div class="card-icon">♔</div>
                        <h3>Bronze Member</h3>
                        <div class="card-price">Free</div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Basic club access</li>
                            <li><i class="fas fa-check"></i> View events</li>
                            <li><i class="fas fa-check"></i> Basic leaderboard</li>
                            <li><i class="fas fa-check"></i> Community forum</li>
                        </ul>
                    </div>
                    <div class="card-action">
                        <?php if (strtolower($level ?? 'bronze') === 'bronze'): ?>
                            <button class="current-btn" disabled>
                                <i class="fas fa-check-circle"></i>
                                Current Plan
                            </button>
                        <?php else: ?>
                            <button class="upgrade-btn" disabled>
                                <i class="fas fa-arrow-down"></i>
                                Downgrade
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="membership-card silver <?= strtolower($level ?? 'bronze') === 'silver' ? 'current' : '' ?>">
                    <div class="card-header">
                        <div class="card-icon">♕</div>
                        <h3>Silver Member</h3>
                        <div class="card-price">$19.99<span>/month</span></div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> All Bronze features</li>
                            <li><i class="fas fa-check"></i> Join events & tournaments</li>
                            <li><i class="fas fa-check"></i> Chess classes access</li>
                            <li><i class="fas fa-check"></i> Advanced analytics</li>
                            <li><i class="fas fa-check"></i> Priority support</li>
                        </ul>
                    </div>
                    <div class="card-action">
                        <?php if (strtolower($level ?? 'bronze') === 'silver'): ?>
                            <button class="current-btn" disabled>
                                <i class="fas fa-check-circle"></i>
                                Current Plan
                            </button>
                        <?php elseif (strtolower($level ?? 'bronze') === 'gold'): ?>
                            <button class="upgrade-btn" disabled>
                                <i class="fas fa-arrow-down"></i>
                                Downgrade
                            </button>
                        <?php else: ?>
                            <form method="post" action="<?= base_url('membership/payment-upload') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="level" value="Silver">
                                <button type="submit" class="upgrade-btn">
                                    <i class="fas fa-arrow-up"></i>
                                    Upgrade to Silver
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="membership-card gold <?= strtolower($level ?? 'bronze') === 'gold' ? 'current' : '' ?>">
                    <div class="card-header">
                        <div class="card-icon">♖</div>
                        <h3>Gold Member</h3>
                        <div class="card-price">$39.99<span>/month</span></div>
                        <div class="popular-badge">Most Popular</div>
                    </div>
                    <div class="card-features">
                        <ul>
                            <li><i class="fas fa-check"></i> All Silver features</li>
                            <li><i class="fas fa-check"></i> Exclusive tournaments</li>
                            <li><i class="fas fa-check"></i> Personal chess coach</li>
                            <li><i class="fas fa-check"></i> Advanced leaderboard</li>
                            <li><i class="fas fa-check"></i> VIP support</li>
                            <li><i class="fas fa-check"></i> Custom profile badge</li>
                        </ul>
                    </div>
                    <div class="card-action">
                        <?php if (strtolower($level ?? 'bronze') === 'gold'): ?>
                            <button class="current-btn" disabled>
                                <i class="fas fa-check-circle"></i>
                                Current Plan
                            </button>
                        <?php else: ?>
                            <form method="post" action="<?= base_url('membership/payment-upload') ?>">
                                <?= csrf_field() ?>
                                <input type="hidden" name="level" value="Gold">
                                <button type="submit" class="upgrade-btn">
                                    <i class="fas fa-arrow-up"></i>
                                    Upgrade to Gold
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="membership-footer">
            <div class="footer-content">
                <div class="chess-motto">"Excellence in every move, prestige in every game"</div>
                <div class="support-info">
                    <i class="fas fa-headset"></i>
                    <span>Need help? Contact our support team</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>