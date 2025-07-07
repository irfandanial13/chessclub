<!DOCTYPE html>
<html>
<head>
    <title>Register - Elite Chess Club</title>
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
                    <div class="club-subtitle">Join the Exclusive Circle</div>
                </div>
            </div>
            <h2 class="welcome-title">Become an Elite Member</h2>
            <p class="welcome-subtitle">Start your journey to chess mastery</p>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="elite-error">
                <i class="fas fa-exclamation-triangle"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="elite-success">
                <i class="fas fa-check-circle"></i>
                <span><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('register') ?>" class="elite-form" id="registerForm">
            <?= csrf_field() ?>
            
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="validation-summary">
                    <h4><i class="fas fa-exclamation-triangle"></i> Please correct the following errors:</h4>
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <div class="input-field">
                <div class="input-icon">
                    <i class="fas fa-user"></i>
                </div>
                <input type="text" name="name" placeholder="Full Name" required class="elite-input" value="<?= old('name') ?>">
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-field">
                <div class="input-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <input type="email" name="email" placeholder="Email Address" required class="elite-input" value="<?= old('email') ?>">
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-field">
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" name="password" id="password" placeholder="Password" required class="elite-input">
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-field">
                <div class="input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required class="elite-input">
                <div class="input-highlight"></div>
            </div>
            
            <div class="input-field">
                <div class="input-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <select name="membership_level" required class="elite-input elite-select">
                    <option value="Bronze" <?= old('membership_level') == 'Bronze' ? 'selected' : '' ?>>♔ Bronze Member</option>
                    <option value="Silver" <?= old('membership_level') == 'Silver' ? 'selected' : '' ?>>♕ Silver Member</option>
                    <option value="Gold" <?= old('membership_level') == 'Gold' ? 'selected' : '' ?>>♖ Gold Member</option>
                </select>
                <div class="input-highlight"></div>
            </div>
            
            <div class="form-options">
                <label class="elite-checkbox">
                    <input type="checkbox" name="terms" required>
                    <span class="checkmark"></span>
                    I agree to the <a href="#" class="terms-link">Club Terms & Conditions</a>
                </label>
            </div>
            
            <button type="submit" class="elite-button">
                <span class="button-text">
                    <i class="fas fa-user-plus"></i>
                    Join Elite Club
                </span>
                <div class="button-glow"></div>
            </button>
        </form>

        <div class="elite-divider">
            <div class="divider-line"></div>
            <span class="divider-text">or continue with</span>
            <div class="divider-line"></div>
        </div>

        <div class="social-login">
            <button class="social-button google">
                <i class="fab fa-google"></i>
                <span>Google</span>
            </button>
            <button class="social-button facebook">
                <i class="fab fa-facebook-f"></i>
                <span>Facebook</span>
            </button>
        </div>

        <div class="signup-section">
            <p class="signup-text">Already a member? <a href="<?= base_url('login') ?>" class="signup-link">Sign in here</a></p>
        </div>
        
        <div class="elite-footer">
            <div class="club-motto">"Excellence in every move, prestige in every game"</div>
        </div>
    </div>
    
    <!-- Validation Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
    <script src="<?= base_url('js/validation.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('css/validation.css') ?>">
</body>
</html>
