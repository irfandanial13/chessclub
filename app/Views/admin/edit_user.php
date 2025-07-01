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

    <div class="auth-container" style="box-shadow:0 4px 24px rgba(139,92,42,0.08);">
        <h2><i class="fas fa-user-edit"></i> Edit User</h2>
        <form method="post" action="<?= base_url('admin/users/update/'.$user['id']) ?>">
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Name:</label><br>
            <input type="text" name="name" class="elite-input" value="<?= esc($user['name']) ?>" style="color:#000; font-size:1.08em; margin-bottom:18px;" required><br>
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Email:</label><br>
            <input type="email" name="email" class="elite-input" value="<?= esc($user['email']) ?>" style="color:#000; font-size:1.08em; margin-bottom:18px;" required><br>
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Membership Level:</label><br>
            <select name="membership_level" class="elite-select" style="color:#000; font-size:1.08em; margin-bottom:18px;" required>
                <option value="Bronze" <?= $user['membership_level'] === 'Bronze' ? 'selected' : '' ?>>Bronze</option>
                <option value="Silver" <?= $user['membership_level'] === 'Silver' ? 'selected' : '' ?>>Silver</option>
                <option value="Gold" <?= $user['membership_level'] === 'Gold' ? 'selected' : '' ?>>Gold</option>
                <option value="Admin" <?= $user['membership_level'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
            </select><br>
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Status:</label><br>
            <select name="status" class="elite-select" style="color:#000; font-size:1.08em; margin-bottom:24px;" required>
                <option value="Active" <?= $user['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                <option value="Inactive" <?= $user['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select><br>
            <div style="display:flex; gap:12px; align-items:center; margin-top:8px;">
                <button type="submit" class="elite-button" style="font-size:1.08em; padding:10px 28px; background:#2c3e50; border-radius:6px; transition:background 0.2s;" onmouseover="this.style.background='#1a252f'" onmouseout="this.style.background='#2c3e50'">
                    <i class="fas fa-save"></i> Save
                </button>
                <a href="<?= base_url('admin/users') ?>" class="elite-button" style="font-size:1.08em; padding:10px 28px; background:#888; border-radius:6px; transition:background 0.2s; text-align:center; display:inline-block; line-height:38px;" onmouseover="this.style.background='#555'" onmouseout="this.style.background='#888'">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html>
