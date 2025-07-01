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
        <h2><i class="fas fa-user-plus"></i> Create User</h2>
        <form method="post" action="<?= base_url('admin/users/store') ?>">
            <label style="color:#8B5C2A;">Name:</label><br>
            <input type="text" name="name" class="elite-input" required><br><br>
            <label style="color:#8B5C2A;">Email:</label><br>
            <input type="email" name="email" class="elite-input" required><br><br>
            <label style="color:#8B5C2A;">Password:</label><br>
            <input type="password" name="password" class="elite-input" required><br><br>
            <label style="color:#8B5C2A;">Membership Level:</label><br>
            <select name="membership_level" class="elite-select" required>
                <option value="Bronze">Bronze</option>
                <option value="Silver">Silver</option>
                <option value="Gold">Gold</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <label style="color:#8B5C2A;">Status:</label><br>
            <select name="status" class="elite-select" required>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select><br><br>
            <button type="submit" class="elite-button"><i class="fas fa-plus"></i> Create</button>
            <a href="<?= base_url('admin/users') ?>" class="elite-button" style="background:#888;"><i class="fas fa-times"></i> Cancel</a>
        </form>
    </div>

</body>
</html> 