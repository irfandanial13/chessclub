<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome <?= session()->get('user_name') ?>!</h2>
    <p>Membership Level: <?= session()->get('membership_level') ?></p>
    <p><a href="<?= base_url('logout') ?>">Logout</a></p>
</body>
</html>
