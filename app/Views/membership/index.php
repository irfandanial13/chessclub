<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

<?= view('partials/navbar') ?>

<div class="auth-container">
    <h2>My Membership</h2>

    <p><strong>Current Level:</strong> <?= esc($level) ?> </p>
    <p><strong>Status:</strong> <?= esc($status) ?></p>
    <p><strong>Expiry Date:</strong> <?= esc($expiry_date) ?></p>

    <hr>

    <h4>Upgrade Membership</h4>
    <div class="membership-options">
        <div class="card bronze">
            <h3>Bronze</h3>
            <p>Free membership with basic access.</p>
            <button disabled>Current</button>
        </div>
        <div class="card silver">
            <h3>Silver</h3>
            <p>Access events & chess classes</p>
            <form method="post" action="<?= base_url('membership/upgrade') ?>">
                <input type="hidden" name="level" value="Silver">
                <button type="submit">Upgrade to Silver</button>
            </form>
        </div>
        <div class="card gold">
            <h3>Gold</h3>
            <p>Full access, leaderboard, priority support</p>
            <form method="post" action="<?= base_url('membership/upgrade') ?>">
                <input type="hidden" name="level" value="Gold">
                <button type="submit">Upgrade to Gold</button>
            </form>
        </div>
    </div>
</div>