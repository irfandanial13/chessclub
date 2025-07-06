<nav class="elite-navbar">
    <div class="logo">
        <div class="logo-icon">
            <span class="chess-king">&#9812;</span>
            <div class="logo-glow"></div>
        </div>
        <div class="logo-text">
            <span class="brand-name">ChessClub</span>
            <span class="brand-tagline">Admin Panel</span>
        </div>
    </div>
    <ul class="nav-menu">
        <li><a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
        <li><a href="<?= base_url('admin/users') ?>" class="nav-link"><i class="fas fa-users"></i><span>Users</span></a></li>
        <li><a href="<?= base_url('admin/event') ?>" class="nav-link"><i class="fas fa-calendar-alt"></i><span>Events</span></a></li>
        <li><a href="<?= base_url('admin/leaderboard') ?>" class="nav-link"><i class="fas fa-trophy"></i><span>Leaderboard</span></a></li>
        <li><a href="<?= base_url('admin/orders') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Orders</span></a></li>
        <li><a href="<?= base_url('admin/products') ?>" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Merchandise</span></a></li>
    </ul>
    <div class="user-section">
        <a href="<?= base_url('logout') ?>" class="logout-btn"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
    </div>
</nav>