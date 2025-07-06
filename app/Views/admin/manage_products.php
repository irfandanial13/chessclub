<!DOCTYPE html>
<html>
<head>
    <title>Manage Products - Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .action-btn {
            display: inline-block;
            width: 25px;
            height: 20px;
            border-radius: 3px;
            text-decoration: none;
            text-align: center;
            line-height: 32px;
            margin: 0 2px;
            transition: all 0.2s ease;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .edit-btn {
            background: #3498db;
            color: white;
        }
        
        .edit-btn:hover {
            background: #2980b9;
        }
        
        .delete-btn {
            background: #e74c3c;
            color: white;
        }
        
        .delete-btn:hover {
            background: #c0392b;
        }
        
        .view-btn {
            background: #27ae60;
            color: white;
        }
        
        .view-btn:hover {
            background: #229954;
        }
        
        .search-section {
            background: #23272f;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .search-form {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 10px 15px;
            border: 1px solid #444;
            border-radius: 6px;
            background: #1a1a1a;
            color: #fff;
            font-size: 0.95em;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #e8c547;
            box-shadow: 0 0 0 2px rgba(232, 197, 71, 0.2);
        }
        
        .filter-select {
            padding: 10px 15px;
            border: 1px solid #444;
            border-radius: 6px;
            background: #1a1a1a;
            color: #fff;
            font-size: 0.95em;
            min-width: 120px;
        }
        
        .search-btn {
            background: #e8c547;
            color: #23272f;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s;
        }
        
        .search-btn:hover {
            background: #d4b03a;
            transform: translateY(-1px);
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #23272f;
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .stat-icon {
            font-size: 2em;
            color: #e8c547;
            margin-bottom: 10px;
        }
        
        .stat-value {
            font-size: 1.8em;
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #bdc3c7;
            font-size: 0.9em;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid #444;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .status-active {
            background: #27ae60;
            color: white;
        }
        
        .status-inactive {
            background: #e74c3c;
            color: white;
        }
        
        .price-tag {
            color: #e8c547;
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-input, .filter-select {
                min-width: auto;
            }
            
            .stats-cards {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
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
        <h2><i class="fas fa-box"></i> Manage Products</h2>
        
        <!-- Statistics Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-box"></i></div>
                <div class="stat-value"><?= $totalProducts ?? 0 ?></div>
                <div class="stat-label">Total Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-value"><?= $activeProducts ?? 0 ?></div>
                <div class="stat-label">Active Products</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                <div class="stat-value">RM<?= number_format($totalValue ?? 0, 2) ?></div>
                <div class="stat-label">Total Value</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-value"><?= $lowStock ?? 0 ?></div>
                <div class="stat-label">Low Stock Items</div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <form method="get" class="search-form">
                <input type="text" name="search" placeholder="Search products..." class="search-input" value="<?= esc($search ?? '') ?>">
                <select name="category" class="filter-select">
                    <option value="">All Categories</option>
                    <option value="clothing" <?= ($category ?? '') === 'clothing' ? 'selected' : '' ?>>Clothing</option>
                    <option value="accessories" <?= ($category ?? '') === 'accessories' ? 'selected' : '' ?>>Accessories</option>
                    <option value="equipment" <?= ($category ?? '') === 'equipment' ? 'selected' : '' ?>>Equipment</option>
                    <option value="books" <?= ($category ?? '') === 'books' ? 'selected' : '' ?>>Books</option>
                </select>
                <select name="status" class="filter-select">
                    <option value="">All Status</option>
                    <option value="active" <?= ($status ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= ($status ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i> Search
                </button>
            </form>
        </div>

        <a href="<?= base_url('admin/products/create') ?>" class="elite-button" style="margin-bottom: 15px; display:inline-block;"><i class="fas fa-plus"></i> Add New Product</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04); color:#222; font-size:1.08em;">
            <thead style="background:#f5e9d7;">
                <tr>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Image</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Name</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Category</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Price</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Stock</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Status</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $i => $product): ?>
                    <tr style="text-align:center; background:<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>; transition:background 0.2s;" onmouseover="this.style.background='#fbeedc'" onmouseout="this.style.background='<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>'">
                        <td style="padding:12px 8px;">
                            <img src="<?= esc($product['image']) ?>" alt="<?= esc($product['name']) ?>" class="product-image">
                        </td>
                        <td style="padding:12px 8px; text-align:left;">
                            <strong><?= esc($product['name']) ?></strong><br>
                            <small style="color:#666;"><?= esc(substr($product['description'], 0, 50)) ?>...</small>
                        </td>
                        <td style="padding:12px 8px;">
                            <span style="background:#e8c547; color:#23272f; padding:4px 8px; border-radius:12px; font-size:0.8em; font-weight:bold;">
                                <?= ucfirst(esc($product['category'] ?? 'General')) ?>
                            </span>
                        </td>
                        <td style="padding:12px 8px;">
                            <span class="price-tag">RM<?= number_format($product['price'], 2) ?></span>
                        </td>
                        <td style="padding:12px 8px;">
                            <span style="<?= ($product['stock'] ?? 0) < 10 ? 'color:#e74c3c; font-weight:bold;' : 'color:#27ae60;' ?>">
                                <?= $product['stock'] ?? 0 ?>
                            </span>
                        </td>
                        <td style="padding:12px 8px;">
                            <span class="status-badge <?= ($product['status'] ?? 'active') === 'active' ? 'status-active' : 'status-inactive' ?>">
                                <?= ucfirst(esc($product['status'] ?? 'active')) ?>
                            </span>
                        </td>
                        <td style="padding:12px 8px;">
                            <a href="<?= base_url('admin/products/view/'.$product['id']) ?>" class="action-btn view-btn" title="View Product"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('admin/products/edit/'.$product['id']) ?>" class="action-btn edit-btn" title="Edit Product"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('admin/products/delete/'.$product['id']) ?>" class="action-btn delete-btn" title="Delete Product" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="padding:40px; text-align:center; color:#666;">
                            <i class="fas fa-box-open" style="font-size:2em; margin-bottom:10px; display:block;"></i>
                            No products found. <a href="<?= base_url('admin/products/create') ?>" style="color:#e8c547;">Add your first product</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        </div>

        <!-- Pagination -->
        <?php if (isset($pager) && $pager): ?>
        <div style="text-align:center; margin-top:20px;">
            <?= $pager->links() ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html> 