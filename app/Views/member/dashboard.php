<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
 
</head>
<body>
    <!-- TOP NAVBAR -->
    <?= view('partials/navbar') ?>

    <!-- DASHBOARD CONTAINER -->
    <div class="auth-container">
        <h2>Welcome, <?= esc($name) ?> 👑</h2>
        <p><strong>Membership Level:</strong> <?= esc($level) ?></p>

        <hr>

        <h4>Quick Stats</h4>
        <div style="display: flex; justify-content: space-between; gap: 20px;">
            <div><strong>Points</strong><br><?= $points ?></div>
            <div><strong>Events Joined</strong><br><?= $events_joined ?></div>
            <div><strong>Classes Booked</strong><br><?= $classes_booked ?></div>
        </div>
    </div>
</body>

</html>
