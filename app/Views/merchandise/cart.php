<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .cart-table { width: 100%; border-collapse: collapse; margin-top: 24px; }
        .cart-table th, .cart-table td { padding: 10px 8px; border-bottom: 1px solid #eee; text-align: center; }
        .cart-table th { background: #2c3e50; color: #fff; }
        .cart-table td { background: #23272f; color: #fff; }
        .cart-actions button { background: #e8c547; color: #23272f; border: none; border-radius: 6px; padding: 6px 14px; font-weight: bold; cursor: pointer; margin: 0 4px; }
        .cart-actions button:hover { background: #fffbe6; }
        .cart-summary { text-align: right; margin-top: 18px; font-size: 1.1em; color: #e8c547; }
        .checkout-btn { background: #e8c547; color: #23272f; border: none; border-radius: 6px; padding: 10px 28px; font-weight: bold; font-size: 1.1em; cursor: pointer; margin-top: 18px; }
        .checkout-btn:hover { background: #fffbe6; }
    </style>
</head>
<body class="elite-chess-theme">
<?= view('partials/navbar') ?>
<div class="elite-login" style="max-width: 700px;">
    <h2>Your Cart</h2>
    <?php if (empty($cart)): ?>
        <p>Your cart is empty. <a href="<?= base_url('merchandise') ?>">Shop now</a>.</p>
    <?php else: ?>
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; foreach ($cart as $item): $subtotal = $item['price'] * $item['qty']; $total += $subtotal; ?>
                <tr>
                    <td><?= esc($item['name']) ?></td>
                    <td>RM<?= number_format($item['price'], 2) ?></td>
                    <td><?= $item['qty'] ?></td>
                    <td>RM<?= number_format($subtotal, 2) ?></td>
                    <td class="cart-actions">
                        <form method="post" action="<?= base_url('merchandise/removeFromCart/' . $item['id']) ?>" style="display:inline;">
                            <?= csrf_field() ?>
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="cart-summary">
            <strong>Total: RM<?= number_format($total, 2) ?></strong>
        </div>
        <form method="post" action="<?= base_url('merchandise/checkout') ?>">
            <?= csrf_field() ?>
            <button type="submit" class="checkout-btn">Checkout</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html> 