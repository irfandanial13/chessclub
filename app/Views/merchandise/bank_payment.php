<!DOCTYPE html>
<html>
<head>
    <title>Bank Transfer - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .payment-form {
            max-width: 600px;
            margin: 0 auto;
            background: #23272f;
            color: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .payment-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .payment-icon {
            font-size: 3em;
            color: #e8c547;
            margin-bottom: 15px;
        }
        
        .bank-details {
            background: rgba(232, 197, 71, 0.1);
            border: 1px solid #e8c547;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .bank-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #e8c547;
            margin-bottom: 15px;
        }
        
        .bank-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .bank-field {
            background: #1a1a1a;
            padding: 12px;
            border-radius: 6px;
            border: 1px solid #444;
        }
        
        .bank-label {
            font-size: 0.9em;
            color: #bdc3c7;
            margin-bottom: 5px;
        }
        
        .bank-value {
            font-weight: 600;
            color: #e8c547;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #e8c547;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #444;
            border-radius: 6px;
            background: #1a1a1a;
            color: #fff;
            font-size: 1em;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #e8c547;
            box-shadow: 0 0 0 2px rgba(232, 197, 71, 0.2);
        }
        
        .submit-btn {
            width: 100%;
            background: #e8c547;
            color: #23272f;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 1.1em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
        }
        
        .submit-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
        }
        
        .info-box {
            background: rgba(232, 197, 71, 0.1);
            border: 1px solid #e8c547;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .info-title {
            font-size: 1.1em;
            font-weight: 600;
            color: #e8c547;
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .bank-info {
                grid-template-columns: 1fr;
            }
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
        <div class="payment-form">
            <div class="payment-header">
                <div class="payment-icon">🏦</div>
                <h2>Bank Transfer</h2>
                <p>Transfer money to our bank account</p>
            </div>
            
            <div class="bank-details">
                <div class="bank-title">Our Bank Details</div>
                <div class="bank-info">
                    <div class="bank-field">
                        <div class="bank-label">Bank Name</div>
                        <div class="bank-value">Maybank</div>
                    </div>
                    <div class="bank-field">
                        <div class="bank-label">Account Name</div>
                        <div class="bank-value">Chess Club Malaysia</div>
                    </div>
                    <div class="bank-field">
                        <div class="bank-label">Account Number</div>
                        <div class="bank-value">1234-5678-9012</div>
                    </div>
                    <div class="bank-field">
                        <div class="bank-label">Reference</div>
                        <div class="bank-value">CHESS-ORDER</div>
                    </div>
                </div>
            </div>
            
            <div class="info-box">
                <div class="info-title">Instructions:</div>
                <ol style="margin: 0; padding-left: 20px;">
                    <li>Transfer the exact amount to our bank account</li>
                    <li>Use "CHESS-ORDER" as the payment reference</li>
                    <li>Enter your details below to complete the order</li>
                    <li>We'll confirm your order once payment is received</li>
                </ol>
            </div>
            
            <form method="post" action="<?= base_url('merchandise/complete-order') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="payment_method" value="bank">
                
                <div class="form-group">
                    <label for="name">Full Name *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="form-group">
                    <label for="address">Delivery Address *</label>
                    <input type="text" id="address" name="address" placeholder="Street address, city, postal code" required>
                </div>
                
                <div class="form-group">
                    <label for="transfer_reference">Transfer Reference *</label>
                    <input type="text" id="transfer_reference" name="transfer_reference" placeholder="Enter the reference number from your transfer" required>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-check"></i> Complete Order
                </button>
            </form>
        </div>
    </div>
</body>
</html> 