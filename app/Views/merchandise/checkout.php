<!DOCTYPE html>
<html>
<head>
    <title>Thank You - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .thankyou-box { text-align: center; padding: 60px 30px; background: #23272f; color: #fff; border-radius: 14px; margin: 60px auto; max-width: 500px; box-shadow: 0 2px 12px #0002; }
        .thankyou-box h2 { color: #e8c547; margin-bottom: 18px; }
        .thankyou-box a { display: inline-block; margin-top: 24px; background: #e8c547; color: #23272f; padding: 10px 28px; border-radius: 6px; font-weight: bold; text-decoration: none; transition: background 0.2s; }
        .thankyou-box a:hover { background: #fffbe6; }
    </style>
</head>
<body class="elite-chess-theme">
<?= view('partials/navbar') ?>
<div class="thankyou-box">
    <h2>Thank You for Your Order!</h2>
    <p>Your order has been received. We appreciate your support for the Chess Club!</p>
    <a href="<?= base_url('merchandise') ?>">Back to Shop</a>
</div>
</body>
</html> 