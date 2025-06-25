<!DOCTYPE html>
<html>
<head>
    <title>Register - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="auth-container">
        <img src="<?= base_url('images/chess-logo.png') ?>" class="chess-logo" alt="Chess Club Logo">
        <h2>Register New Member</h2>

        <form method="post" action="<?= base_url('register') ?>">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>

            <select name="membership_level" required>
                <option value="Bronze">Bronze</option>
                <option value="Silver">Silver</option>
                <option value="Gold">Gold</option>
            </select>

            <button type="submit">Register</button>
        </form>

        <p style="text-align:center">Already a member? <a href="<?= base_url('login') ?>">Login</a></p>
    </div>
</body>
</html>
