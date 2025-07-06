<!DOCTYPE html>
<html>
<head>
    <title>Shop Merchandise - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .merchandise-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .merchandise-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .merchandise-title {
            color: #e8c547;
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }
        
        .merchandise-subtitle {
            color: #bdc3c7;
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        
        .header-actions {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .cart-link-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #e8c547;
            color: #23272f !important;
            font-weight: bold;
            border-radius: 12px;
            padding: 12px 25px;
            box-shadow: 0 4px 15px rgba(232, 197, 71, 0.3);
            text-decoration: none;
            font-size: 1.1em;
            transition: all 0.3s;
        }
        
        .cart-link-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(232, 197, 71, 0.4);
            color: #23272f !important;
            text-decoration: none;
        }
        
        .merch-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px; 
            justify-content: center; 
            margin-top: 40px; 
        }
        
        .merch-card { 
            background: #23272f; 
            color: #fff; 
            border-radius: 15px; 
            box-shadow: 0 8px 25px rgba(0,0,0,0.3); 
            padding: 25px; 
            text-align: center; 
            transition: all 0.3s;
            border: 2px solid transparent;
        }
        
        .merch-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.4);
            border-color: #e8c547;
        }
        
        .merch-card img { 
            width: 100%; 
            height: 300px; 
            object-fit: cover; 
            border-radius: 12px; 
            margin-bottom: 20px; 
            transition: all 0.3s;
        }
        
        .merch-card:hover img {
            transform: scale(1.05);
        }
        
        .merch-card h3 { 
            margin: 15px 0 10px 0; 
            font-size: 1.3em; 
            color: #e8c547;
            font-weight: 600;
        }
        
        .merch-card p { 
            font-size: 1em; 
            margin-bottom: 15px; 
            color: #bdc3c7;
            line-height: 1.5;
        }
        
        .merch-card .price { 
            font-weight: bold; 
            color: #e8c547; 
            margin-bottom: 20px; 
            font-size: 1.4em; 
        }
        
        .merch-card form { 
            margin: 0; 
        }
        
        .merch-card button { 
            background: #e8c547; 
            color: #23272f; 
            border: none; 
            border-radius: 8px; 
            padding: 12px 25px; 
            font-weight: bold; 
            cursor: pointer; 
            transition: all 0.3s; 
            font-size: 1em;
            width: 100%;
        }
        
        .merch-card button:hover { 
            background: #d4b03a; 
            transform: translateY(-2px);
        }
        
        .toast-success {
            position: fixed;
            top: 32px;
            right: 32px;
            background: #e8c547;
            color: #23272f;
            padding: 16px 32px;
            border-radius: 12px;
            font-weight: bold;
            box-shadow: 0 8px 25px rgba(232, 197, 71, 0.3);
            z-index: 9999;
            font-size: 1.1em;
            animation: fadeIn 0.4s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 768px) {
            .merch-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }
            
            .merchandise-title {
                font-size: 2em;
            }
            
            .header-actions {
                flex-direction: column;
                gap: 15px;
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
    
    <div class="merchandise-container">
        <div class="merchandise-header">
            <h1 class="merchandise-title">♖ Elite Chess Merchandise ♗</h1>
            <p class="merchandise-subtitle">Premium gear for the distinguished chess player</p>
            
            <div class="header-actions">
                <a href="<?= base_url('merchandise/cart') ?>" class="cart-link-btn">
                    <i class="fas fa-shopping-cart"></i>
                    <span>View Cart</span>
                </a>
            </div>
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
                        <button type="submit">
                            <i class="fas fa-plus"></i> Add to Cart
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html> 