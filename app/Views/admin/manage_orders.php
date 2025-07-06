<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #e8c547 0%, #f4d03f 100%);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            min-width: 150px;
            min-height: 80px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .stat-card h3 {
            margin: 0;
            font-size: 1.8em;
            color: #23272f;
            font-weight: 700;
        }
        .stat-card p {
            margin: 5px 0 0 0;
            color: #23272f;
            font-size: 0.9em;
            font-weight: 500;
        }
        .filters {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .filters form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }
        .filters .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .filters label {
            font-weight: 600;
            color: #23272f;
        }
        .filters input, .filters select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        .filters button {
            background: #e8c547;
            color: #23272f;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
        }
        .filters button:hover {
            background: #f4d03f;
        }
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .orders-table th {
            background: #23272f;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .orders-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #000;
        }
        .orders-table tr:hover {
            background: #f8f9fa;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 0.8em;
            text-decoration: none;
            display: inline-block;
        }
        .btn-view { background: #17a2b8; color: white; }
        .btn-edit { background: #ffc107; color: #23272f; }
        .btn-delete { background: #dc3545; color: white; }
        .btn:hover { opacity: 0.8; }
        .add-order-btn {
            background: #e8c547;
            color: #23272f;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
        .add-order-btn:hover {
            background: #f4d03f;
        }
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        .empty-state i {
            font-size: 3em;
            margin-bottom: 20px;
            color: #ddd;
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
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2><i class="fas fa-shopping-cart"></i> Manage Orders</h2>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3><?= $totalOrders ?></h3>
                <p>Total Orders</p>
            </div>
            <div class="stat-card">
                <h3>RM<?= number_format($totalRevenue, 2) ?></h3>
                <p>Total Revenue</p>
            </div>
            <div class="stat-card">
                <h3>RM<?= number_format($avgOrderValue, 2) ?></h3>
                <p>Average Order Value</p>
            </div>
            <div class="stat-card">
                <h3><?= $recentOrders ?></h3>
                <p>Recent Orders (30 days)</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" action="<?= base_url('admin/orders') ?>">
                <div class="form-group">
                    <label for="search">Search Orders</label>
                    <input type="text" id="search" name="search" value="<?= esc($search) ?>" placeholder="Order ID, customer name, or email...">
                </div>
                <button type="submit">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="<?= base_url('admin/orders') ?>" style="background: #6c757d; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-times"></i> Clear
                </a>
            </form>
        </div>

        <!-- Orders Table -->
        <?php if (!empty($orders)): ?>
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><strong>#<?= $order['id'] ?></strong></td>
                            <td>
                                <div style="color: #000;"><?= esc($order['user_name'] ?? 'Unknown') ?></div>
                                <small style="color: #666;"><?= esc($order['user_email'] ?? '') ?></small>
                            </td>
                            <td>
                                <?php if (!empty($order['items'])): ?>
                                    <?php foreach ($order['items'] as $index => $item): ?>
                                        <?php if ($index < 2): ?>
                                            <div style="color: #000;"><?= esc($item['item_name'] ?? 'Unknown Item') ?> (x<?= $item['quantity'] ?>)</div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (count($order['items']) > 2): ?>
                                        <small style="color: #666;">+<?= count($order['items']) - 2 ?> more items</small>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span style="color: #666;">No items</span>
                                <?php endif; ?>
                            </td>
                            <td><strong>RM<?= number_format($order['total'], 2) ?></strong></td>
                            <td><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('admin/orders/view/' . $order['id']) ?>" class="btn btn-view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/orders/delete/' . $order['id']) ?>" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this order?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-shopping-cart"></i>
                <h3>No Orders Found</h3>
                <p>There are no orders matching your criteria.</p>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto-submit form when status changes
        document.getElementById('status').addEventListener('change', function() {
            this.form.submit();
        });
    </script>
</body>
</html> 