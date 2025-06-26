<!DOCTYPE html>
<html>
<head>
    <title>Login - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="auth-container">
        <img src="<?= base_url('images/chess-logo.png') ?>" class="chess-logo" alt="Chess Club Logo">
        <h2> Login</h2>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('login') ?>">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p style="text-align:center">Don't have an account? <a href="<?= base_url('register') ?>">Register</a></p>
    </div>
</body>
</html>
