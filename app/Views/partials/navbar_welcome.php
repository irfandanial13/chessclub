<style>
.navbar {
  width: 100%;
  background: #23272f;
  color: #e8c547;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 18px 40px 18px 32px;
  box-shadow: 0 2px 12px #0002;
  position: sticky;
  top: 0;
  z-index: 100;
}
.navbar .logo {
  font-size: 1.6em;
  font-weight: 800;
  letter-spacing: 1px;
  display: flex;
  align-items: center;
  color: #e8c547;
  gap: 10px;
}
.navbar .logo span {
  font-size: 1.7em;
  margin-right: 8px;
  vertical-align: middle;
  color: #e8c547;
}
.navbar ul {
  list-style: none;
  display: flex;
  gap: 28px;
  margin: 0;
  padding: 0;
}
.navbar ul li {
  display: inline-block;
}
.navbar ul li a {
  color: #e8c547;
  font-weight: 600;
  font-size: 1.08em;
  text-decoration: none;
  padding: 8px 18px;
  border-radius: 6px;
  transition: background 0.18s, color 0.18s;
}
.navbar ul li a:hover, .navbar ul li a:focus {
  background: #e8c547;
  color: #23272f;
  outline: none;
}
@media (max-width: 700px) {
  .navbar { flex-direction: column; align-items: flex-start; padding: 14px 10px; }
  .navbar .logo { font-size: 1.2em; }
  .navbar ul { gap: 10px; }
  .navbar ul li a { font-size: 1em; padding: 7px 10px; }
}
</style>
<nav class="navbar">
    <div class="logo">
        <span>&#9812;</span> Chess Club
    </div>
    <ul>
        <li><a href="<?= base_url('login') ?>">Login</a></li>
        <li><a href="<?= base_url('register') ?>">Register</a></li>
    </ul>
</nav>
