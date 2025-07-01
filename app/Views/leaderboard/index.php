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
    .profile-modal {
        display: none;
        position: fixed;
        top: 0; left: 0; width: 100vw; height: 100vh;
        background: rgba(30,32,40,0.85);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    .profile-modal.show {
        display: flex;
    }
    .modal-content {
        background: #fff;
        border-radius: 12px;
        padding: 32px 24px;
        min-width: 320px;
        max-width: 420px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.18);
        position: relative;
    }
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }
    .modal-title {
        color: #23272f;
        font-size: 1.2em;
        font-weight: bold;
    }
    .modal-close {
        background: none;
        border: none;
        font-size: 1.2em;
        cursor: pointer;
        color: #23272f;
    }
    .modal-body {
        color: #23272f;
    }
    .profile-detail-list {
        list-style: none;
        padding: 0;
        margin: 0 0 12px 0;
    }
    .profile-detail-list li {
        margin-bottom: 8px;
    }
    .profile-events-list {
        margin: 0; padding-left: 18px;
    }
    .profile-events-list li {
        margin-bottom: 6px;
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
    <h2 class="events-title">Top Players <span style="font-size:1.1em;">🏆</span></h2>
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
            <select name="limit" class="elite-input" style="max-width:120px;">
                <option value="10" <?= ($limit == 10) ? 'selected' : '' ?>>Top 10</option>
                <option value="50" <?= ($limit == 50) ? 'selected' : '' ?>>Top 50</option>
            </select>
            <button type="submit" class="elite-button">Filter</button>
        </form>
    </div>
    <table class="leaderboard-table" id="leaderboard-table">
        <thead>
            <tr>
                <th onclick="sortTable(0)">Rank</th>
                <th onclick="sortTable(1)">Name</th>
                <th onclick="sortTable(2)">Level</th>
                <th onclick="sortTable(3)">Points</th>
            </tr>
        </thead>
        <tbody>
            <?php $rank = 1; foreach ($users as $user): ?>
                <tr class="<?= $rank == 1 ? 'first-place' : ($rank == 2 ? 'second-place' : ($rank == 3 ? 'third-place' : '') ) ?>">
                    <td>
                        <?php if ($rank == 1): ?>
                            <span title="1st" style="font-size:1.2em;">🥇</span>
                        <?php elseif ($rank == 2): ?>
                            <span title="2nd" style="font-size:1.1em;">🥈</span>
                        <?php elseif ($rank == 3): ?>
                            <span title="3rd" style="font-size:1.1em;">🥉</span>
                        <?php else: ?>
                            <?= $rank ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="#" class="profile-link" data-user-id="<?= $user['id'] ?>" style="color:#e8c547; text-decoration:underline; font-weight:500;"><?= esc($user['name']) ?></a></td>
                    <td><?= esc($user['membership_level']) ?></td>
                    <td><?= esc($user['points']) ?></td>
                </tr>
            <?php $rank++; endforeach ?>
        </tbody>
    </table>
    <!-- Profile Modal -->
    <div class="profile-modal" id="profile-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title">Member Profile</h3>
                <button class="modal-close" id="modal-close-profile">
                    <span style="font-size:1.3em;">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body-profile">
                <!-- Profile details will be loaded here -->
            </div>
        </div>
    </div>
</div>
<style>
.leaderboard-table th, .leaderboard-table td { cursor: pointer; }
.leaderboard-table th { background: #2c3e50 !important; color: #fff; }
.leaderboard-table td { background: #23272f !important; color: #fff; }
.leaderboard-table tbody tr.first-place { background: linear-gradient(90deg, #fffbe6 0%, #e8c547 100%) !important; color: #23272f; font-weight: bold; }
.leaderboard-table tbody tr.second-place { background: linear-gradient(90deg, #f0f0f0 0%, #bfc1c2 100%) !important; color: #23272f; font-weight: bold; }
.leaderboard-table tbody tr.third-place { background: linear-gradient(90deg, #f8e6d0 0%, #cd7f32 100%) !important; color: #23272f; font-weight: bold; }
</style>
<script>
function sortTable(n) {
    var table = document.getElementById("leaderboard-table");
    var rows = Array.from(table.rows).slice(1);
    var asc = table.getAttribute('data-sort-dir') !== 'asc';
    rows.sort(function(a, b) {
        var x = a.cells[n].innerText.toLowerCase();
        var y = b.cells[n].innerText.toLowerCase();
        if (!isNaN(x) && !isNaN(y)) { x = Number(x); y = Number(y); }
        if (x < y) return asc ? -1 : 1;
        if (x > y) return asc ? 1 : -1;
        return 0;
    });
    rows.forEach(row => table.tBodies[0].appendChild(row));
    table.setAttribute('data-sort-dir', asc ? 'asc' : 'desc');
}
document.querySelectorAll('.profile-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        const userId = this.getAttribute('data-user-id');
        fetch('<?= base_url('leaderboard/profileModal/') ?>' + userId)
            .then(res => res.json())
            .then(data => {
                let html = '<ul class="profile-detail-list">';
                html += '<li><strong>Name:</strong> ' + data.name + '</li>';
                html += '<li><strong>Membership:</strong> ' + data.membership_level + '</li>';
                html += '<li><strong>Points:</strong> ' + data.points + '</li>';
                html += '</ul>';
                if (data.events && data.events.length > 0) {
                    html += '<div><strong>Recent Events:</strong><ul class="profile-events-list">';
                    data.events.forEach(ev => {
                        html += '<li><strong>' + ev.title + '</strong> (' + ev.type + ')<br><span style="font-size:0.95em;">' + (new Date(ev.date).toLocaleDateString()) + '</span></li>';
                    });
                    html += '</ul></div>';
                } else {
                    html += '<div><em>No recent events.</em></div>';
                }
                document.getElementById('modal-body-profile').innerHTML = html;
                document.getElementById('profile-modal').classList.add('show');
            });
    });
});
document.getElementById('modal-close-profile').onclick = function() {
    document.getElementById('profile-modal').classList.remove('show');
};
document.getElementById('profile-modal').onclick = function(e) {
    if (e.target === this) {
        this.classList.remove('show');
    }
};
</script>
</body>
</html>
