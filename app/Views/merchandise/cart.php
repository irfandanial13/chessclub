<!DOCTYPE html>
<html>
<head>
    <title>Your Cart - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .cart-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .cart-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 24px; 
            background: #23272f;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .cart-table th, .cart-table td { 
            padding: 15px 12px; 
            border-bottom: 1px solid #444; 
            text-align: center; 
        }
        
        .cart-table th { 
            background: #2c3e50; 
            color: #fff; 
            font-weight: 600;
        }
        
        .cart-table td { 
            background: #23272f; 
            color: #fff; 
        }
        
        .cart-actions button { 
            background: #e74c3c; 
            color: #fff; 
            border: none; 
            border-radius: 6px; 
            padding: 8px 16px; 
            font-weight: bold; 
            cursor: pointer; 
            margin: 0 4px; 
            transition: all 0.3s;
        }
        
        .cart-actions button:hover { 
            background: #c0392b; 
            transform: translateY(-1px);
        }
        
        .cart-summary { 
            text-align: right; 
            margin-top: 18px; 
            font-size: 1.1em; 
            color: #e8c547; 
            background: #2c3e50;
            padding: 20px;
            border-radius: 8px;
        }
        
        .checkout-btn { 
            background: #e8c547; 
            color: #23272f; 
            border: none; 
            border-radius: 8px; 
            padding: 15px 30px; 
            font-weight: bold; 
            font-size: 1.1em; 
            cursor: pointer; 
            margin-top: 18px; 
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .checkout-btn:hover { 
            background: #d4b03a; 
            transform: translateY(-2px);
        }
        
        .empty-cart {
            text-align: center;
            padding: 60px 30px;
            background: #23272f;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            margin: 20px 0;
        }
        
        .empty-cart-icon {
            font-size: 4em;
            color: #e8c547;
            margin-bottom: 20px;
        }
        
        .empty-cart h3 {
            color: #e8c547;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        
        .empty-cart p {
            color: #bdc3c7;
            margin-bottom: 30px;
            font-size: 1.1em;
        }
        
        .shop-now-btn {
            background: #e8c547;
            color: #23272f;
            border: none;
            border-radius: 8px;
            padding: 15px 30px;
            font-weight: bold;
            font-size: 1.1em;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
        }
        
        .shop-now-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
            color: #23272f;
            text-decoration: none;
        }
        
        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .cart-title {
            color: #e8c547;
            font-size: 1.8em;
            font-weight: 700;
        }
        
        .cart-count {
            background: #e8c547;
            color: #23272f;
            padding: 5px 12px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9em;
        }
    </style>
</head>
<body class="elite-chess-theme">
    <?= view('partials/navbar') ?>
    
    <div class="elite-background">
        <div class="wood-pattern"></div>
        <div class="elite-overlay"></div>
        <div class="club-elements">
            <div class="trophy-element">🏆</div>
            <div class="medal-element">🥇</div>
            <div class="chess-piece king">♔</div>
            <div class="chess-piece queen">♕</div>
            <div class="chess-piece rook">♖</div>
            <div class="chess-piece bishop">♗</div>
            <div class="chess-piece knight">♘</div>
            <div class="chess-piece pawn">♙</div>
        </div>
    </div>

    <div class="elite-login" style="max-width: 800px;">
        <div class="cart-container">
            <div class="cart-header">
                <h2 class="cart-title"><i class="fas fa-shopping-cart"></i> Your Cart</h2>
                <?php if (!empty($cart)): ?>
                    <span class="cart-count"><?= count($cart) ?> item<?= count($cart) > 1 ? 's' : '' ?></span>
                <?php endif; ?>
            </div>
            
            <?php if (empty($cart)): ?>
                <div class="empty-cart">
                    <div class="empty-cart-icon">🛒</div>
                    <h3>Your Cart is Empty</h3>
                    <p>Looks like you haven't added any items to your cart yet.</p>
                    <a href="<?= base_url('merchandise') ?>" class="shop-now-btn">
                        <i class="fas fa-shopping-bag"></i>
                        Shop Now
                    </a>
                </div>
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
                                    <button type="submit">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="cart-summary">
                    <strong>Total: RM<?= number_format($total, 2) ?></strong>
                </div>
                
                <form method="post" action="<?= base_url('merchandise/checkout') ?>" style="text-align: right;">
                    <?= csrf_field() ?>
                    <button type="submit" class="checkout-btn">
                        <i class="fas fa-credit-card"></i>
                        Proceed to Checkout
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html> 