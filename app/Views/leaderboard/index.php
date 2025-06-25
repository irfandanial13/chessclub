<?= view('partials/navbar') ?>
 <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
<div class="auth-container">
    <h2>Leaderboard 🏆</h2>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #2c3e50; color: #fff;">
                <th style="padding: 10px;">#</th>
                <th style="padding: 10px;">Name</th>
                <th style="padding: 10px;">Level</th>
                <th style="padding: 10px;">Points</th>
            </tr>
        </thead>
        <tbody>
            <?php $rank = 1; foreach ($users as $user): ?>
                <tr style="<?= $user['id'] == $currentUser ? 'background-color:#d1ecf1;' : '' ?>">
                    <td style="padding: 10px;"><?= $rank++ ?></td>
                    <td style="padding: 10px;"><?= esc($user['name']) ?></td>
                    <td style="padding: 10px;"><?= esc($user['membership_level']) ?></td>
                    <td style="padding: 10px;"><?= esc($user['points']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
