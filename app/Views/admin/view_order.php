<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .order-details {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #e8c547;
        }
        .order-id {
            font-size: 1.5em;
            font-weight: 700;
            color: #23272f;
        }
        .order-date {
            color: #000;
            font-size: 0.9em;
        }
        .customer-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .customer-info h3 {
            color: #23272f;
            margin-bottom: 15px;
            font-size: 1.2em;
        }
        .info-row {
            display: flex;
            margin-bottom: 8px;
        }
        .info-label {
            font-weight: 600;
            width: 120px;
            color: #23272f;
        }
        .info-value {
            color: #000;
        }
        .order-items {
            margin-bottom: 20px;
        }
        .order-items h3 {
            color: #000;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .items-table th {
            background: #23272f;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .items-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #000;
        }
        .items-table tr:hover {
            background: #f8f9fa;
        }
        .order-summary {
            background: #e8c547;
            color: #23272f;
            padding: 20px;
            border-radius: 8px;
            text-align: right;
        }
        .total-amount {
            font-size: 1.5em;
            font-weight: 700;
        }
        .back-btn {
            background: #23272f;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-top: 20px;
        }
        .back-btn:hover {
            background: #2c3e50;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body class="elite-chess-theme">
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

    <?= view('partials/navbar_admin') ?>

    <div class="auth-container">
        <div class="order-details">
            <div class="order-header">
                <div>
                    <div class="order-id">Order #<?= $order['id'] ?></div>
                    <div class="order-date"><?= date('F j, Y \a\t g:i A', strtotime($order['created_at'])) ?></div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="customer-info">
                <h3><i class="fas fa-user"></i> Customer Information</h3>
                <div class="info-row">
                    <div class="info-label">Name:</div>
                    <div class="info-value"><?= esc($order['user']['name'] ?? 'Unknown') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?= esc($order['user']['email'] ?? 'Unknown') ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">User ID:</div>
                    <div class="info-value"><?= $order['user_id'] ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Session ID:</div>
                    <div class="info-value"><?= esc($order['session_id'] ?? 'N/A') ?></div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="order-items">
                <h3><i class="fas fa-shopping-bag"></i> Order Items</h3>
                <?php if (!empty($order['items'])): ?>
                    <table class="items-table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['items'] as $item): ?>
                                <tr>
                                    <td><?= esc($item['item_name'] ?? 'Unknown Item') ?></td>
                                    <td><?= $item['quantity'] ?></td>
                                    <td>RM<?= number_format($item['price'], 2) ?></td>
                                    <td>RM<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p style="text-align: center; color: #666; padding: 20px;">No items found for this order.</p>
                <?php endif; ?>
            </div>

            <!-- Order Summary -->
            <div class="order-summary">
                <div class="total-amount">
                    Total: RM<?= number_format($order['total'], 2) ?>
                </div>
            </div>

            <a href="<?= base_url('admin/orders') ?>" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</body>
</html> 