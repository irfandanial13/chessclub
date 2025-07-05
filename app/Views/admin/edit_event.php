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
        <h2><i class="fas fa-calendar-edit"></i> Edit Event</h2>
        <form method="post" action="<?= base_url('admin/events/update/'.$event['id']) ?>">
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Title:</label><br>
            <input type="text" name="title" class="elite-input" value="<?= esc($event['title']) ?>" style="color:#000; font-size:1.08em; margin-bottom:18px;" required><br>
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Date:</label><br>
            <input type="date" name="date" class="elite-input" value="<?= esc($event['event_date']) ?>" style="color:#000; font-size:1.08em; margin-bottom:18px;" required><br>
            <label style="color:#8B5C2A; font-weight:600; font-size:1.08em; margin-bottom:6px;">Description:</label><br>
            <textarea name="description" class="elite-input" style="color:#000; font-size:1.08em; margin-bottom:24px; min-height:80px;" required><?= esc($event['description']) ?></textarea><br>
            <div style="display:flex; gap:12px; align-items:center; margin-top:8px;">
                <button type="submit" class="elite-button" style="font-size:1.08em; padding:10px 28px; background:#2c3e50; border-radius:6px; transition:background 0.2s;" onmouseover="this.style.background='#1a252f'" onmouseout="this.style.background='#2c3e50'">
                    <i class="fas fa-save"></i> Save
                </button>
                <a href="<?= base_url('admin/event') ?>" class="elite-button" style="font-size:1.08em; padding:10px 28px; background:#888; border-radius:6px; transition:background 0.2s; text-align:center; display:inline-block; line-height:38px;" onmouseover="this.style.background='#555'" onmouseout="this.style.background='#888'">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</body>
</html> 