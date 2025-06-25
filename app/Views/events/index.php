<?= view('partials/navbar') ?>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<div class="auth-container">
    <h2>Upcoming Events</h2>
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <strong><?= esc($event['title']) ?></strong> (<?= esc($event['type']) ?>)
                - <?= esc($event['event_date']) ?><br>
                <em><?= esc($event['description']) ?></em><br>
                <a href="<?= base_url('events/join/' . $event['id']) ?>">Join</a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
