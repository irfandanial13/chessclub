<!DOCTYPE html>
<html>
<head>
    <title>Book Tournament or Chess Class - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="elite-chess-theme">
    <?= view('partials/navbar') ?>
    <div class="auth-container" style="max-width: 700px;">
        <h2>Book a Tournament or Chess Class</h2>
        <div style="margin-bottom: 32px;">
            <h3 style="margin-bottom: 12px;">Upcoming Tournaments</h3>
            <?php if (empty($tournaments)): ?>
                <p>No tournaments available for booking.</p>
            <?php else: ?>
                <ul>
                <?php foreach ($tournaments as $event): ?>
                    <li style="margin-bottom: 18px;">
                        <strong><?= esc($event['title']) ?></strong><br>
                        <span><?= date('M j, Y', strtotime($event['event_date'])) ?> at <?= date('g:i A', strtotime($event['event_date'])) ?></span><br>
                        <span><?= esc($event['description']) ?></span><br>
                        <a href="<?= base_url('events/join/' . $event['id']) ?>" class="join-btn small">Book Tournament</a>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
        <div>
            <h3 style="margin-bottom: 12px;">Upcoming Chess Classes</h3>
            <?php if (empty($classes)): ?>
                <p>No classes available for booking.</p>
            <?php else: ?>
                <ul>
                <?php foreach ($classes as $event): ?>
                    <li style="margin-bottom: 18px;">
                        <strong><?= esc($event['title']) ?></strong><br>
                        <span><?= date('M j, Y', strtotime($event['event_date'])) ?> at <?= date('g:i A', strtotime($event['event_date'])) ?></span><br>
                        <span><?= esc($event['description']) ?></span><br>
                        <a href="<?= base_url('events/join/' . $event['id']) ?>" class="join-btn small">Book Class</a>
                    </li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 