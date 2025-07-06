<!DOCTYPE html>
<html>
<head>
    <title>Thank You - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .thankyou-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }
        
        .success-card {
            background: #23272f;
            color: #fff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            margin-bottom: 30px;
        }
        
        .success-icon {
            font-size: 4em;
            color: #27ae60;
            margin-bottom: 20px;
        }
        
        .order-details {
            background: #2c3e50;
            color: #fff;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            text-align: left;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #444;
        }
        
        .detail-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .detail-label {
            font-weight: 600;
            color: #e8c547;
        }
        
        .detail-value {
            text-align: right;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        
        .btn {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: #e8c547;
            color: #23272f;
        }
        
        .btn-primary:hover {
            background: #d4b03a;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: #34495e;
            color: #fff;
            border: 2px solid #34495e;
        }
        
        .btn-secondary:hover {
            background: #2c3e50;
            transform: translateY(-2px);
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

    <div class="auth-container">
        <div class="thankyou-container">
            <div class="success-card">
                <div class="success-icon">✅</div>
                <h2>Thank You for Your Order!</h2>
                <p>Your order has been successfully placed. We'll process it and ship it to you soon.</p>
            </div>
            
            <div class="order-details">
                <div class="detail-row">
                    <span class="detail-label">Order ID:</span>
                    <span class="detail-value">#<?= $order['id'] ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Order Date:</span>
                    <span class="detail-value"><?= date('F j, Y', strtotime($order['order_date'])) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Customer:</span>
                    <span class="detail-value"><?= esc($order['customer_name']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?= esc($order['customer_email']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value"><?= esc($order['customer_phone']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Delivery Address:</span>
                    <span class="detail-value"><?= esc($order['shipping_address']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Payment Method:</span>
                    <span class="detail-value"><?= ucfirst($order['payment_method']) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value">RM<?= number_format($order['total_amount'], 2) ?></span>
                </div>
                
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value"><?= ucfirst($order['status']) ?></span>
                </div>
            </div>
            
            <div class="action-buttons">
                <a href="<?= base_url('merchandise') ?>" class="btn btn-primary">
                    <i class="fas fa-shopping-bag"></i>
                    Continue Shopping
                </a>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">
                    <i class="fas fa-home"></i>
                    Go to Dashboard
                </a>
            </div>
        </div>
    </div>
</body>
</html> 