<nav class="navbar">
    <div class="logo">
        <span style="font-size: 1.5em; margin-right: 8px; vertical-align: middle;">&#9812;</span> ChessClub Admin
    </div>
    <ul>
        <li><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
        <li><a href="<?= base_url('admin/users') ?>">Users</a></li>
    </ul>
    <div style="display: flex; align-items: center; gap: 10px;">
        <a href="<?= base_url('logout') ?>">Logout</a>
    </div>
</nav>