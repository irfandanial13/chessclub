<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="elite-chess-theme">
    <div class="elite-background">
        <div class="wood-pattern"></div>
        <div class="elite-overlay"></div>
        <div class="club-elements">
            <div class="trophy-element">🏆</div>
            <div class="medal-element">🥇</div>
            <div class="chess-piece king">♔</div>
            <div class="chess-piece queen">♕</div>
            <div class="chess-piece rook">♖</div>
            <div class="chess-piece bishop">♗</div>
            <div class="chess-piece knight">♘</div>
            <div class="chess-piece pawn">♙</div>
        </div>
    </div>

    <?= view('partials/navbar_admin') ?>

    <div class="auth-container">
        <h2><i class="fas fa-calendar-alt"></i> Manage Events</h2>
        <a href="<?= base_url('admin/events/create') ?>" class="elite-button" style="margin-bottom: 15px; display:inline-block;"><i class="fas fa-plus"></i> Create Event</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <thead style="background:#f5e9d7;">
                <tr>
                    <th>ID</th><th>Name</th><th>Date</th><th>Location</th><th>Status</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $event): ?>
                <tr style="text-align:center;">
                    <td><?= $event['id'] ?></td>
                    <td><?= esc($event['name']) ?></td>
                    <td><?= esc($event['date']) ?></td>
                    <td><?= esc($event['location']) ?></td>
                    <td>
                        <span class="status-<?= strtolower($event['status']) ?>">
                            <?= esc($event['status']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/events/edit/'.$event['id']) ?>" class="elite-button" style="padding:4px 10px;font-size:0.95em;"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('admin/events/delete/'.$event['id']) ?>" class="elite-button" style="background:#c0392b;padding:4px 10px;font-size:0.95em;" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html> 