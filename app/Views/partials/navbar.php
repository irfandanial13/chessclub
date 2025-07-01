<nav class="navbar elite-navbar" role="navigation" aria-label="Main navigation">
    <div class="logo">
        <div class="logo-icon" aria-label="Chess Club Logo">
            <span class="chess-king" role="img" aria-label="Chess King">♔</span>
            <div class="logo-glow"></div>
        </div>
        <div class="logo-text">
            <span class="brand-name">Elite Chess Club</span>
            <span class="brand-tagline">Excellence in Every Move</span>
        </div>
    </div>
    
    <ul class="nav-menu" role="menubar">
        <li role="none">
            <a href="<?= base_url('dashboard') ?>" class="nav-link" role="menuitem" aria-label="Go to Dashboard">
                <i class="fas fa-trophy" aria-hidden="true"></i>
                <span>Dashboard</span>
                <span class="nav-tooltip">View your profile and stats</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('events') ?>" class="nav-link" role="menuitem" aria-label="Browse Events">
                <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                <span>Events</span>
                <span class="nav-tooltip">Find tournaments and classes</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('my-events') ?>" class="nav-link" role="menuitem" aria-label="My Events">
                <i class="fas fa-list-check" aria-hidden="true"></i>
                <span>My Events</span>
                <span class="nav-tooltip">Your registered events</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('membership') ?>" class="nav-link" role="menuitem" aria-label="Membership">
                <i class="fas fa-medal" aria-hidden="true"></i>
                <span>Membership</span>
                <span class="nav-tooltip">Manage your membership level</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('leaderboard') ?>" class="nav-link" role="menuitem" aria-label="Leaderboard">
                <i class="fas fa-crown" aria-hidden="true"></i>
                <span>Leaderboard</span>
                <span class="nav-tooltip">See top players rankings</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('merchandise') ?>" class="nav-link" role="menuitem" aria-label="Shop">
                <i class="fas fa-shopping-bag" aria-hidden="true"></i>
                <span>Shop</span>
                <span class="nav-tooltip">Buy chess merchandise</span>
            </a>
        </li>
        <li role="none">
            <a href="<?= base_url('contact') ?>" class="nav-link" role="menuitem" aria-label="Contact Us">
                <i class="fas fa-envelope" aria-hidden="true"></i>
                <span>Contact</span>
                <span class="nav-tooltip">Get help and support</span>
            </a>
        </li>
    </ul>
    
    <div class="user-section">
        <div class="user-greeting" aria-label="User greeting">
            <i class="fas fa-user-circle" aria-hidden="true"></i>
            <span>Welcome, <?= session()->get('user_name') ?></span>
        </div>
        <a href="<?= base_url('logout') ?>" class="logout-btn" aria-label="Logout from your account">
            <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            <span>Logout</span>
        </a>
    </div>
</nav>