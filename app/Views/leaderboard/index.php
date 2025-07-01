<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
    .leaderboard-table th {
        background: #a0522d !important;
        color: #fff;
    }
    .leaderboard-table td {
        background: #2c1810 !important;
        color: #fff;
    }
    .leaderboard-table tbody tr {
        background: #cd853f4d !important;
    }
    </style>
</head>
<body class="elite-chess-theme">
<?= view('partials/navbar') ?>
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
<div class="elite-login" style="max-width: 900px; position: relative; z-index: 2;">
    <h2 class="events-title">Leaderboard <span style="font-size:1.1em;">🏆</span></h2>
    <div class="filter-bar" style="display:flex; gap:16px; margin-bottom:18px; flex-wrap:wrap; align-items:center;">
        <form id="filterForm" method="get" style="display:flex; gap:12px; flex-wrap:wrap; align-items:center;">
            <input type="text" name="search" placeholder="Search by name..." value="<?= esc($_GET['search'] ?? '') ?>" class="elite-input" style="max-width:180px;">
            <select name="membership_level" class="elite-input" style="max-width:150px;">
                <option value="All">All Levels</option>
                <option value="Bronze" <?= (($_GET['membership_level'] ?? '') == 'Bronze') ? 'selected' : '' ?>>Bronze</option>
                <option value="Silver" <?= (($_GET['membership_level'] ?? '') == 'Silver') ? 'selected' : '' ?>>Silver</option>
                <option value="Gold" <?= (($_GET['membership_level'] ?? '') == 'Gold') ? 'selected' : '' ?>>Gold</option>
            </select>
            <select name="month" class="elite-input" style="max-width:150px;">
                <option value="All">All Months</option>
                <?php foreach ($months as $m): ?>
                    <option value="<?= $m ?>" <?= (($_GET['month'] ?? '') == $m) ? 'selected' : '' ?>><?= date('F Y', strtotime($m.'-01')) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="elite-button">Filter</button>
        </form>
    </div>
    <table class="leaderboard-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Level</th>
                <th>Points</th>
                <th>Events Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php $rank = 1; foreach ($users as $user): ?>
                <tr>
                    <td><?= $rank ?></td>
                    <td><?= esc($user['name']) ?></td>
                    <td><?= esc($user['membership_level']) ?></td>
                    <td><?= esc($user['points']) ?></td>
                    <td>
                        <?php if (empty($user['event_titles'])): ?>
                            <span style="color:#aaa;">None</span>
                        <?php else: ?>
                            <ul style="margin:0; padding-left:18px; text-align:left;">
                                <?php foreach ($user['event_titles'] as $title): ?>
                                    <li><?= esc($title) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php $rank++; endforeach ?>
        </tbody>
    </table>
</div>
</body>
</html>
