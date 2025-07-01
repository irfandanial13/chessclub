<!DOCTYPE html>
<html>
<head>
    <title>Shop Merchandise - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .merch-grid { display: flex; flex-wrap: wrap; gap: 32px; justify-content: center; margin-top: 32px; }
        .merch-card { background: #23272f; color: #fff; border-radius: 12px; box-shadow: 0 2px 12px #0002; width: 260px; padding: 20px; text-align: center; }
        .merch-card img { width: 100%; height: 160px; object-fit: cover; border-radius: 8px; margin-bottom: 12px; }
        .merch-card h3 { margin: 10px 0 6px 0; font-size: 1.2em; }
        .merch-card p { font-size: 0.98em; margin-bottom: 10px; }
        .merch-card .price { font-weight: bold; color: #e8c547; margin-bottom: 12px; font-size: 1.1em; }
        .merch-card form { margin: 0; }
        .merch-card button { background: #e8c547; color: #23272f; border: none; border-radius: 6px; padding: 8px 18px; font-weight: bold; cursor: pointer; transition: background 0.2s; }
        .merch-card button:hover { background: #fffbe6; }
        .cart-link { margin-left: 18px; font-size: 1.08em; }
        .cart-link a { color: #e8c547; font-weight: bold; text-decoration: none; }
        .cart-link a:hover { text-decoration: underline; }
        .toast-success {
            position: fixed;
            top: 32px;
            right: 32px;
            background: #e8c547;
            color: #23272f;
            padding: 16px 32px;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 2px 12px #0002;
            z-index: 9999;
            font-size: 1.08em;
            animation: fadeIn 0.4s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="elite-chess-theme">
<?= view('partials/navbar') ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="toast-success" id="toast-success">
        <?= session()->getFlashdata('success') ?>
    </div>
    <script>
    setTimeout(function() {
        var toast = document.getElementById('toast-success');
        if (toast) toast.style.display = 'none';
    }, 2500);
    </script>
<?php endif; ?>
<div class="elite-login" style="max-width: 1100px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;">
        <h2 style="margin: 0;">Chess Club Merchandise</h2>
        <a href="<?= base_url('merchandise/cart') ?>" class="cart-link">🛒 View Cart</a>
    </div>
    <div class="merch-grid">
        <?php foreach ($items as $item): ?>
            <div class="merch-card">
                <img src="<?= esc($item['image']) ?>" alt="<?= esc($item['name']) ?>">
                <h3><?= esc($item['name']) ?></h3>
                <div class="price">RM<?= number_format($item['price'], 2) ?></div>
                <p><?= esc($item['description']) ?></p>
                <form method="post" action="<?= base_url('merchandise/addToCart/' . $item['id']) ?>">
                    <?= csrf_field() ?>
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html> 