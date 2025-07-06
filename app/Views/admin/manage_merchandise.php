<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .merchandise-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .stat-card {
            background: linear-gradient(135deg, #e8c547, #f4d03f);
            color: #23272f;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            min-width: 150px;
        }
        .stat-card h3 {
            font-size: 2em;
            margin: 0 0 10px 0;
            font-weight: 700;
        }
        .stat-card p {
            margin: 0;
            font-weight: 600;
            font-size: 0.9em;
        }
        .filters {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .filters form {
            display: flex;
            gap: 15px;
            align-items: end;
            flex-wrap: wrap;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        .form-group label {
            font-weight: 600;
            color: #23272f;
            font-size: 0.9em;
        }
        .form-group input, .form-group select {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 0.9em;
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
        .merchandise-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .merchandise-table th {
            background: #23272f;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: 600;
        }
        .merchandise-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            color: #000;
        }
        .merchandise-table tr:hover {
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
        .btn-toggle { background: #28a745; color: white; }
        .btn:hover { opacity: 0.8; }
        .add-merchandise-btn {
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
        .add-merchandise-btn:hover {
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
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: 600;
        }
        .status-available { background: #d4edda; color: #155724; }
        .status-unavailable { background: #f8d7da; color: #721c24; }
        .status-out-of-stock { background: #fff3cd; color: #856404; }
        .stock-quantity {
            font-weight: 600;
        }
        .stock-low { color: #dc3545; }
        .stock-ok { color: #28a745; }
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
            <h2><i class="fas fa-tshirt"></i> Manage Merchandise</h2>
            <a href="<?= base_url('admin/merchandise/create') ?>" class="add-merchandise-btn">
                <i class="fas fa-plus"></i> Add New Item
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <h3><?= $stats['total'] ?? 0 ?></h3>
                <p>Total Items</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['available'] ?? 0 ?></h3>
                <p>Available Items</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['out_of_stock'] ?? 0 ?></h3>
                <p>Out of Stock</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['low_stock'] ?? 0 ?></h3>
                <p>Low Stock (≤5)</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters">
            <form method="GET" action="<?= base_url('admin/merchandise') ?>">
                <div class="form-group">
                    <label for="search">Search Items</label>
                    <input type="text" id="search" name="search" value="<?= esc($search) ?>" placeholder="Item name...">
                </div>
                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select id="availability" name="availability">
                        <option value="all" <?= ($availability === 'all' || !$availability) ? 'selected' : '' ?>>All Items</option>
                        <option value="available" <?= $availability === 'available' ? 'selected' : '' ?>>Available</option>
                        <option value="unavailable" <?= $availability === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
                        <option value="out_of_stock" <?= $availability === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                    </select>
                </div>
                <button type="submit">
                    <i class="fas fa-search"></i> Filter
                </button>
                <a href="<?= base_url('admin/merchandise') ?>" style="background: #6c757d; color: white; padding: 8px 20px; border-radius: 5px; text-decoration: none; font-weight: 600;">
                    <i class="fas fa-times"></i> Clear
                </a>
            </form>
        </div>

        <!-- Merchandise Table -->
        <?php if (!empty($merchandise)): ?>
            <table class="merchandise-table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($merchandise as $item): ?>
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: #000;"><?= esc($item['name']) ?></div>
                                <small style="color: #666;"><?= esc($item['description']) ?></small>
                            </td>
                            <td><strong>RM<?= number_format($item['price'], 2) ?></strong></td>
                            <td>
                                <span class="stock-quantity <?= $item['stock_quantity'] <= 5 ? 'stock-low' : 'stock-ok' ?>">
                                    <?= $item['stock_quantity'] ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($item['is_available'] && $item['stock_quantity'] > 0): ?>
                                    <span class="status-badge status-available">Available</span>
                                <?php elseif (!$item['is_available']): ?>
                                    <span class="status-badge status-unavailable">Unavailable</span>
                                <?php else: ?>
                                    <span class="status-badge status-out-of-stock">Out of Stock</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="<?= base_url('admin/merchandise/edit/' . $item['id']) ?>" class="btn btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('admin/merchandise/toggle-availability/' . $item['id']) ?>" class="btn btn-toggle" title="Toggle Availability" onclick="return confirm('Are you sure you want to toggle availability?')">
                                        <i class="fas fa-toggle-on"></i>
                                    </a>
                                    <a href="<?= base_url('admin/merchandise/delete/' . $item['id']) ?>" class="btn btn-delete" title="Delete" onclick="return confirm('Are you sure you want to delete this item?')">
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
                <i class="fas fa-tshirt"></i>
                <h3>No Merchandise Found</h3>
                <p>There are no merchandise items matching your criteria.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html> 