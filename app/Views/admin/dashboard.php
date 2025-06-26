<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <?= view('partials/navbar_admin') ?> <!-- Optional: use a different navbar like navbar_admin -->

    <div class="auth-container">
        <h2>Welcome to Admin Dashboard</h2>
        <p>Use the sidebar to manage users, events, and site content.</p>

        <hr>

        <ul>
            <li><a href="<?= base_url('admin/users') ?>">Manage Users</a></li>
            <li><a href="<?= base_url('admin/events') ?>">Manage Events</a></li>
            <li><a href="<?= base_url('admin/leaderboard') ?>">Manage Leaderboard</a></li>
        </ul>
    </div>
</body>
</html>
