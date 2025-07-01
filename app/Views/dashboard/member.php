<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('adminlte/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <span class="navbar-brand ml-2">Chess Club Dashboard</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="<?= base_url('logout') ?>" class="nav-link">Logout</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="content-wrapper p-4">
        <div class="container-fluid">
            <h3>Welcome, <?= esc($name) ?>!</h3>
            <p>Your membership level is: <strong><?= esc($membership_level) ?></strong></p>

            <?php if ($membership_level === 'Bronze'): ?>
                <div class="alert alert-secondary">Bronze members can view events and upgrade.</div>
            <?php elseif ($membership_level === 'Silver'): ?>
                <div class="alert alert-info">Silver members have access to events and class bookings.</div>
            <?php elseif ($membership_level === 'Gold'): ?>
                <div class="alert alert-warning">Gold members enjoy full access to all features.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('adminlte/js/adminlte.min.js') ?>"></script>
</body>
</html>
