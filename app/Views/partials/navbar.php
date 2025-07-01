<nav class="navbar">
    <div class="logo">
        <span style="font-size: 1.5em; margin-right: 8px; vertical-align: middle;">&#9812;</span> Chess Club
    </div>
    <ul>
        <li><a href="<?= base_url('/') ?>">Home</a></li>
        <li><a href="<?= base_url('events') ?>">Events</a></li>
        <li><a href="<?= base_url('my-events') ?>">My Events</a></li>
        <li><a href="<?= base_url('leaderboard') ?>">Leaderboard</a></li>
        <li><a href="<?= base_url('contact') ?>">Contact</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 10px;">
        <span>Hello, <?= session()->get('user_name') ?></span>
        <a href="<?= base_url('logout') ?>">Logout</a>
    </div>
</nav>