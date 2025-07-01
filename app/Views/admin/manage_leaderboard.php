<!DOCTYPE html>
<html>
<head>
    <title>Manage Leaderboard</title>
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
        <h2><i class="fas fa-trophy"></i> Manage Leaderboard</h2>
        <a href="<?= base_url('admin/leaderboard/add') ?>" class="elite-button" style="margin-bottom: 15px; display:inline-block;"><i class="fas fa-plus"></i> Add Entry</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04);">
            <thead style="background:#f5e9d7;">
                <tr>
                    <th>Rank</th><th>Name</th><th>Points</th><th>Level</th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leaderboard as $entry): ?>
                <tr style="text-align:center;">
                    <td><?= $entry['rank'] ?></td>
                    <td><?= esc($entry['name']) ?></td>
                    <td><?= esc($entry['points']) ?></td>
                    <td>
                        <span class="badge <?= strtolower($entry['level']) ?>">
                            <?= esc($entry['level']) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('admin/leaderboard/edit/'.$entry['id']) ?>" class="elite-button" style="padding:4px 10px;font-size:0.95em;"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('admin/leaderboard/delete/'.$entry['id']) ?>" class="elite-button" style="background:#c0392b;padding:4px 10px;font-size:0.95em;" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html> 