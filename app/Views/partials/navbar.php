<div class="navbar">
    <div class="logo">♟ Chess Club</div>
    <ul>
        <li><a href="<?= base_url('/') ?>">Home</a></li>
        <li><a href="<?= base_url('events') ?>">Events</a></li>
        <li><a href="<?= base_url('my-events') ?>">My Events</a></li>
        <li><a href="<?= base_url('leaderboard') ?>">Leaderboard</a></li>
        <li><a href="<?= base_url('contact') ?>">Contact</a></li>
    </ul>

    <div>
        Hello, <?= session()->get('user_name') ?> |
        <a href="<?= base_url('logout') ?>" style="color: #fff;">Logout</a>
    </div>
</div>