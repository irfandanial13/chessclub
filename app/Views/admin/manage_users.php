<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
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
        <h2><i class="fas fa-users"></i> Manage Users</h2>
        <a href="<?= base_url('admin/users/create') ?>" class="elite-button" style="margin-bottom: 15px; display:inline-block;"><i class="fas fa-user-plus"></i> Create User</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04); color:#222; font-size:1.08em;">
            <thead style="background:#f5e9d7;">
                <tr>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">ID</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Name</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Email</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Level</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Status</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $i => $user): ?>
                <tr style="text-align:center; background:<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>; transition:background 0.2s;" onmouseover="this.style.background='#fbeedc'" onmouseout="this.style.background='<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>'">
                    <td style="padding:12px 8px;"><?= $user['id'] ?></td>
                    <td style="padding:12px 8px;"><?= esc($user['name']) ?></td>
                    <td style="padding:12px 8px;"><?= esc($user['email']) ?></td>
                    <td style="padding:12px 8px;">
                        <span class="badge <?= strtolower($user['membership_level']) ?>">
                            <?= esc($user['membership_level']) ?>
                        </span>
                    </td>
                    <td style="padding:12px 8px;">
                        <span class="status-<?= strtolower($user['status']) ?>">
                            <?= esc($user['status']) ?>
                        </span>
                    </td>
                    <td style="padding:12px 8px;">
                        <a href="<?= base_url('admin/users/edit/'.$user['id']) ?>" class="action-btn edit-btn" style="padding:4px 10px;font-size:0.95em; background:#2c3e50; color:#fff;"><i class="fas fa-edit"></i> Edit</a>
                        <a href="<?= base_url('admin/users/delete/'.$user['id']) ?>" class="action-btn delete-btn" style="background:#c0392b;padding:4px 10px;font-size:0.95em; color:#fff;" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html>
