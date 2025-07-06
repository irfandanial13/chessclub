<!DOCTYPE html>
<html>
<head>
    <title>Create Product - Admin Dashboard</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        <h2><i class="fas fa-plus"></i> Create New Product</h2>
        
        <?php if (session()->getFlashdata('error')): ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('admin/products/store') ?>" style="background:#faf8f6; padding:30px; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.1);">
            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Product Name *</label>
                <input type="text" name="name" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;" value="<?= old('name') ?>">
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Description</label>
                <textarea name="description" rows="4" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px; resize:vertical;"><?= old('description') ?></textarea>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Price (RM) *</label>
                    <input type="number" name="price" step="0.01" min="0" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;" value="<?= old('price') ?>">
                </div>
                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Stock Quantity *</label>
                    <input type="number" name="stock" min="0" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;" value="<?= old('stock') ?>">
                </div>
            </div>

            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px;">
                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Category *</label>
                    <select name="category" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;">
                        <option value="">Select Category</option>
                        <option value="clothing" <?= old('category') === 'clothing' ? 'selected' : '' ?>>Clothing</option>
                        <option value="accessories" <?= old('category') === 'accessories' ? 'selected' : '' ?>>Accessories</option>
                        <option value="equipment" <?= old('category') === 'equipment' ? 'selected' : '' ?>>Equipment</option>
                        <option value="books" <?= old('category') === 'books' ? 'selected' : '' ?>>Books</option>
                        <option value="general" <?= old('category') === 'general' ? 'selected' : '' ?>>General</option>
                    </select>
                </div>
                <div>
                    <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Status *</label>
                    <select name="status" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;">
                        <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>

            <div style="margin-bottom:30px;">
                <label style="display:block; margin-bottom:8px; font-weight:bold; color:#5A3A13;">Image URL</label>
                <input type="url" name="image" placeholder="https://example.com/image.jpg" style="width:100%; padding:12px; border:1px solid #ddd; border-radius:6px; font-size:16px;" value="<?= old('image') ?>">
                <small style="color:#666; font-size:14px;">Leave empty to use default image</small>
            </div>

            <div style="display:flex; gap:15px;">
                <button type="submit" class="elite-button" style="flex:1;">
                    <i class="fas fa-save"></i> Create Product
                </button>
                <a href="<?= base_url('admin/products') ?>" class="elite-button" style="flex:1; text-align:center; text-decoration:none;">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </form>
    </div>
</body>
</html> 