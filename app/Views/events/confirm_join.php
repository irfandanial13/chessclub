<!DOCTYPE html>
<html>

<head>
    <title>Registration Confirmed - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>

<body class="elite-chess-theme">
    <?= view('partials/navbar') ?>
    <div class="elite-login" style="max-width: 600px;">
        <h2>Registration Confirmed!</h2>
        <div style="margin-bottom: 24px;">
            <h3>Your Information</h3>
            <ul style="list-style:none; padding:0;">
                <li><strong>Name:</strong> <?= esc($user['name']) ?></li>
                <li><strong>Email:</strong> <?= esc($user['email']) ?></li>
                <li><strong>Membership Level:</strong> <?= esc($user['membership_level']) ?></li>
            </ul>
        </div>
        <div style="margin-bottom: 24px;">
            <h3>Event Information</h3>
            <ul style="list-style:none; padding:0;">
                <li><strong>Title:</strong> <?= esc($event['title']) ?></li>
                <li><strong>Type:</strong> <?= esc($event['type']) ?></li>
                <li><strong>Date:</strong> <?= date('M j, Y', strtotime($event['event_date'])) ?> at
                    <?= date('g:i A', strtotime($event['event_date'])) ?></li>
                <li><strong>Description:</strong> <?= esc($event['description']) ?></li>
            </ul>
        </div>
        <a href="<?= base_url('my-events') ?>" class="join-btn small">View My Events</a>
        <a href="<?= base_url('events') ?>" class="join-btn small" style="margin-left: 10px;">Back to Events</a>
    </div>
</body>

</html>