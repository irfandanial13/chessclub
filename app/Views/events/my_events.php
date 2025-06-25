<?= view('partials/navbar') ?>
  <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<div class="auth-container">
    <h2>My Registered Events</h2>

    <?php if (empty($myEvents)): ?>
        <p>You haven't joined any events yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($myEvents as $event): ?>
                <li>
                    <strong><?= esc($event['title']) ?></strong> (<?= esc($event['type']) ?>)
                    <br>Date: <?= esc($event['event_date']) ?>
                    <br><em><?= esc($event['description']) ?></em>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
