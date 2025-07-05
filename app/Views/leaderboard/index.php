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
    /* Rank Badges */
    .rank-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2em;
        height: 2em;
        border-radius: 50%;
        font-size: 1.2em;
        font-weight: bold;
        margin-right: 2px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .gold-badge { background: linear-gradient(135deg, #ffe066 60%, #ffd700 100%); color: #bfa100; border: 2px solid #ffd700; }
    .silver-badge { background: linear-gradient(135deg, #e0e0e0 60%, #bfc1c2 100%); color: #7d7d7d; border: 2px solid #bfc1c2; }
    .bronze-badge { background: linear-gradient(135deg, #f8e6d0 60%, #cd7f32 100%); color: #8c5a2b; border: 2px solid #cd7f32; }

    /* Tier Row Highlights */
    .gold-row { background: linear-gradient(90deg, #fffbe6 0%, #ffe066 100%) !important; }
    .silver-row { background: linear-gradient(90deg, #f0f0f0 0%, #bfc1c2 100%) !important; }
    .bronze-row { background: linear-gradient(90deg, #f8e6d0 0%, #cd7f32 100%) !important; }

    /* Progress Bar */
    .points-bar-container {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 120px;
    }
    .points-bar-bg {
        background: #e0e7ef;
        border-radius: 8px;
        width: 70px;
        height: 12px;
        overflow: hidden;
        margin-right: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.07);
    }
    .points-bar-fill {
        background: linear-gradient(90deg, #3bb6c1 0%, #e8c547 100%);
        height: 100%;
        border-radius: 8px;
        transition: width 1s cubic-bezier(.4,2,.6,1);
    }
    .points-label {
        font-size: 0.95em;
        color: #22335a;
        font-weight: 600;
    }
    .elite-login {
        /* background: #fff; */
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(44, 24, 16, 0.10), 0 2px 8px rgba(232, 197, 71, 0.08);
        padding: 32px 24px 40px 24px;
        margin: 40px auto 32px auto;
        max-width: 950px;
        position: relative;
        z-index: 2;
    }

    .leaderboard-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: transparent;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 1.08em;
        margin-bottom: 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(44, 24, 16, 0.06);
    }

    .leaderboard-table th, .leaderboard-table td {
        padding: 18px 16px;
        text-align: center;
        border-bottom: 1px solid #f0e6d2;
        font-size: 1.08em;
    }

    .leaderboard-table th {
        background: linear-gradient(90deg, #e8c547 0%, #fffbe6 100%);
        color: #2c1810;
        font-size: 1.12em;
        font-weight: 700;
        position: sticky;
        top: 0;
        z-index: 1;
        letter-spacing: 0.5px;
    }

    .leaderboard-table tbody tr {
        transition: background 0.2s, box-shadow 0.2s;
    }

    .leaderboard-table tbody tr:not(.first-place):not(.second-place):not(.third-place):nth-child(even) {
        background: #f8fbff !important;
    }
    .leaderboard-table tbody tr:not(.first-place):not(.second-place):not(.third-place):nth-child(odd) {
        background: #f4f6fa !important;
    }

    .leaderboard-table tbody tr:hover {
        background: #e8f0fe !important;
        box-shadow: 0 2px 12px rgba(44, 24, 16, 0.08);
    }

    .leaderboard-table tbody tr.first-place,
    .leaderboard-table tbody tr.second-place,
    .leaderboard-table tbody tr.third-place {
        font-size: 1.13em;
        font-weight: bold;
        box-shadow: 0 4px 16px rgba(232, 197, 71, 0.10);
    }

    .rank-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.2em;
        height: 2.2em;
        border-radius: 50%;
        font-size: 1.3em;
        font-weight: bold;
        margin-right: 2px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        animation: popIn 0.7s cubic-bezier(.4,2,.6,1);
    }
    @keyframes popIn {
        0% { transform: scale(0.5); opacity: 0; }
        70% { transform: scale(1.15); opacity: 1; }
        100% { transform: scale(1); }
    }
    .gold-badge { background: linear-gradient(135deg, #ffe066 60%, #ffd700 100%); color: #bfa100; border: 2px solid #ffd700; }
    .silver-badge { background: linear-gradient(135deg, #e0e0e0 60%, #bfc1c2 100%); color: #7d7d7d; border: 2px solid #bfc1c2; }
    .bronze-badge { background: linear-gradient(135deg, #f8e6d0 60%, #cd7f32 100%); color: #8c5a2b; border: 2px solid #cd7f32; }

    .membership-badge {
        display: inline-block;
        font-size: 1.1em;
        margin-left: 6px;
        vertical-align: middle;
    }
    .membership-gold { color: #ffd700; }
    .membership-silver { color: #bfc1c2; }
    .membership-bronze { color: #cd7f32; }

    .events-title {
        text-align: center;
        width: 100%;
        margin-bottom: 18px;
    }
    .filter-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        margin-bottom: 18px;
        flex-wrap: wrap;
        width: 100%;
    }
    #filterForm {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        width: 100%;
    }
    #filterForm .elite-button {
        margin-left: auto;
        margin-right: auto;
        display: block;
    }
    .board-tab {
        background: #e8c547;
        color: #2c1810;
        border: none;
        border-radius: 8px 8px 0 0;
        padding: 10px 24px;
        margin: 0 2px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .board-tab.active, .board-tab:hover {
        background: #2c1810;
        color: #fffbe6;
    }
    .board-table {
        margin-bottom: 32px;
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
<div class="elite-login" style="max-width: 950px; position: relative; z-index: 2;">
    <div class="board-tabs" style="text-align:center; margin-bottom:18px;">
        <button class="board-tab active" onclick="showBoard('all')">All Levels</button>
        <button class="board-tab" onclick="showBoard('gold')">Gold</button>
        <button class="board-tab" onclick="showBoard('silver')">Silver</button>
        <button class="board-tab" onclick="showBoard('bronze')">Bronze</button>
    </div>
    <div id="board-all" class="board-table">
        <h2 class="events-title">Leaderboard - All Levels <span style="font-size:1.1em;">🏆</span></h2>
        <table class="leaderboard-table" id="leaderboard-table-all">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Honor Points</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($users as $user):
                    $tierClass = '';
                    if (strtolower($user['membership_level']) === 'gold') $tierClass = 'gold-row';
                    elseif (strtolower($user['membership_level']) === 'silver') $tierClass = 'silver-row';
                    elseif (strtolower($user['membership_level']) === 'bronze') $tierClass = 'bronze-row';
                ?>
                <tr class="<?= $rank == 1 ? 'first-place' : ($rank == 2 ? 'second-place' : ($rank == 3 ? 'third-place' : '') ) ?> <?= $tierClass ?>">
                    <td>
                        <?php if ($rank == 1): ?>
                            <span class="rank-badge gold-badge" title="1st">🥇</span>
                        <?php elseif ($rank == 2): ?>
                            <span class="rank-badge silver-badge" title="2nd">🥈</span>
                        <?php elseif ($rank == 3): ?>
                            <span class="rank-badge bronze-badge" title="3rd">🥉</span>
                        <?php else: ?>
                            <?= $rank ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="#" class="profile-link" data-user-id="<?= $user['id'] ?>" style="color:#e8c547; text-decoration:underline; font-weight:500;"><?= esc($user['name']) ?></a></td>
                    <td>
                        <?= esc($user['membership_level']) ?>
                        <?php if (strtolower($user['membership_level']) === 'gold'): ?>
                            <span class="membership-badge membership-gold" title="Gold">🥇</span>
                        <?php elseif (strtolower($user['membership_level']) === 'silver'): ?>
                            <span class="membership-badge membership-silver" title="Silver">🥈</span>
                        <?php elseif (strtolower($user['membership_level']) === 'bronze'): ?>
                            <span class="membership-badge membership-bronze" title="Bronze">🥉</span>
                        <?php endif; ?>
                    </td>
                    <td><?= esc($user['honor_points'] ?? 0) ?></td>
                </tr>
                <?php $rank++; endforeach ?>
            </tbody>
        </table>
    </div>
    <div id="board-gold" class="board-table" style="display:none;">
        <h2 class="events-title">Leaderboard - Gold Level <span style="font-size:1.1em;">🥇</span></h2>
        <table class="leaderboard-table" id="leaderboard-table-gold">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Honor Points</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($users as $user):
                    if (trim(strtolower($user['membership_level'])) !== 'gold') continue;
                    $tierClass = 'gold-row';
                ?>
                <tr class="<?= $rank == 1 ? 'first-place' : ($rank == 2 ? 'second-place' : ($rank == 3 ? 'third-place' : '') ) ?> <?= $tierClass ?>">
                    <td>
                        <?php if ($rank == 1): ?>
                            <span class="rank-badge gold-badge" title="1st">🥇</span>
                        <?php elseif ($rank == 2): ?>
                            <span class="rank-badge silver-badge" title="2nd">🥈</span>
                        <?php elseif ($rank == 3): ?>
                            <span class="rank-badge bronze-badge" title="3rd">🥉</span>
                        <?php else: ?>
                            <?= $rank ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="#" class="profile-link" data-user-id="<?= $user['id'] ?>" style="color:#e8c547; text-decoration:underline; font-weight:500;"><?= esc($user['name']) ?></a></td>
                    <td>
                        <?= esc($user['membership_level']) ?>
                        <span class="membership-badge membership-gold" title="Gold">🥇</span>
                    </td>
                    <td><?= esc($user['honor_points'] ?? 0) ?></td>
                </tr>
                <?php $rank++; endforeach ?>
            </tbody>
        </table>
    </div>
    <div id="board-silver" class="board-table" style="display:none;">
        <h2 class="events-title">Leaderboard - Silver Level <span style="font-size:1.1em;">🥈</span></h2>
        <table class="leaderboard-table" id="leaderboard-table-silver">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Honor Points</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($users as $user):
                    if (trim(strtolower($user['membership_level'])) !== 'silver') continue;
                    $tierClass = 'silver-row';
                ?>
                <tr class="<?= $rank == 1 ? 'first-place' : ($rank == 2 ? 'second-place' : ($rank == 3 ? 'third-place' : '') ) ?> <?= $tierClass ?>">
                    <td>
                        <?php if ($rank == 1): ?>
                            <span class="rank-badge gold-badge" title="1st">🥇</span>
                        <?php elseif ($rank == 2): ?>
                            <span class="rank-badge silver-badge" title="2nd">🥈</span>
                        <?php elseif ($rank == 3): ?>
                            <span class="rank-badge bronze-badge" title="3rd">🥉</span>
                        <?php else: ?>
                            <?= $rank ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="#" class="profile-link" data-user-id="<?= $user['id'] ?>" style="color:#e8c547; text-decoration:underline; font-weight:500;"><?= esc($user['name']) ?></a></td>
                    <td>
                        <?= esc($user['membership_level']) ?>
                        <span class="membership-badge membership-silver" title="Silver">🥈</span>
                    </td>
                    <td><?= esc($user['honor_points'] ?? 0) ?></td>
                </tr>
                <?php $rank++; endforeach ?>
            </tbody>
        </table>
    </div>
    <div id="board-bronze" class="board-table" style="display:none;">
        <h2 class="events-title">Leaderboard - Bronze Level <span style="font-size:1.1em;">🥉</span></h2>
        <table class="leaderboard-table" id="leaderboard-table-bronze">
            <thead>
                <tr>
                    <th>Rank</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th>Honor Points</th>
                </tr>
            </thead>
            <tbody>
                <?php $rank = 1; foreach ($users as $user):
                    if (trim(strtolower($user['membership_level'])) !== 'bronze') continue;
                    $tierClass = 'bronze-row';
                ?>
                <tr class="<?= $rank == 1 ? 'first-place' : ($rank == 2 ? 'second-place' : ($rank == 3 ? 'third-place' : '') ) ?> <?= $tierClass ?>">
                    <td>
                        <?php if ($rank == 1): ?>
                            <span class="rank-badge gold-badge" title="1st">🥇</span>
                        <?php elseif ($rank == 2): ?>
                            <span class="rank-badge silver-badge" title="2nd">🥈</span>
                        <?php elseif ($rank == 3): ?>
                            <span class="rank-badge bronze-badge" title="3rd">🥉</span>
                        <?php else: ?>
                            <?= $rank ?>
                        <?php endif; ?>
                    </td>
                    <td><a href="#" class="profile-link" data-user-id="<?= $user['id'] ?>" style="color:#e8c547; text-decoration:underline; font-weight:500;"><?= esc($user['name']) ?></a></td>
                    <td>
                        <?= esc($user['membership_level']) ?>
                        <span class="membership-badge membership-bronze" title="Bronze">🥉</span>
                    </td>
                    <td><?= esc($user['honor_points'] ?? 0) ?></td>
                </tr>
                <?php $rank++; endforeach ?>
            </tbody>
        </table>
    </div>
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
function bindProfileLinks() {
    document.querySelectorAll('.profile-link').forEach(link => {
        link.onclick = function(e) {
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
        };
    });
}
bindProfileLinks();

function refreshLeaderboard() {
    const params = new URLSearchParams(new FormData(document.getElementById('filterForm'))).toString();
    fetch('<?= base_url('leaderboard/ajaxLeaderboard') ?>?' + params)
        .then(res => res.text())
        .then(html => {
            document.querySelector('#leaderboard-table tbody').innerHTML = html;
            bindProfileLinks();
        });
}
setInterval(refreshLeaderboard, 30000);

document.getElementById('modal-close-profile').onclick = function() {
    document.getElementById('profile-modal').classList.remove('show');
};
document.getElementById('profile-modal').onclick = function(e) {
    if (e.target === this) {
        this.classList.remove('show');
    }
};

function showBoard(level) {
    document.querySelectorAll('.board-table').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.board-tab').forEach(btn => btn.classList.remove('active'));
    document.getElementById('board-' + level).style.display = '';
    document.querySelector('.board-tab[onclick*="' + level + '"]').classList.add('active');
}
</script>
</body>
</html>
