<!DOCTYPE html>
<html>
<head>
    <title>Card Payment - Chess Club Merchandise</title>
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
        
        .card-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
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
        
        .card-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        
        .card-icon {
            width: 50px;
            height: 30px;
            background: #fff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8em;
            font-weight: bold;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .card-row {
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
                <div class="payment-icon">💳</div>
                <h2>Card Payment</h2>
                <p>Pay securely with your credit or debit card</p>
            </div>
            
            <div class="info-box">
                <div class="info-title">Secure Payment:</div>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Your payment information is encrypted and secure</li>
                    <li>We accept Visa, Mastercard, and American Express</li>
                    <li>No card details are stored on our servers</li>
                </ul>
            </div>
            
            <form method="post" action="<?= base_url('merchandise/complete-order') ?>">
                <?= csrf_field() ?>
                <input type="hidden" name="payment_method" value="card">
                
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
                    <label for="card_number">Card Number *</label>
                    <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                    <div class="card-icons">
                        <div class="card-icon">VISA</div>
                        <div class="card-icon">MC</div>
                        <div class="card-icon">AMEX</div>
                    </div>
                </div>
                
                <div class="card-row">
                    <div class="form-group">
                        <label for="expiry">Expiry Date *</label>
                        <input type="text" id="expiry" name="expiry" placeholder="MM/YY" maxlength="5" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV *</label>
                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="4" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-lock"></i> Pay Securely
                </button>
            </form>
        </div>
    </div>

    <script>
        // Card number formatting
        document.getElementById('card_number').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            value = value.replace(/\D/g, '');
            value = value.replace(/(\d{4})/g, '$1 ').trim();
            e.target.value = value;
        });

        // Expiry date formatting
        document.getElementById('expiry').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });

        // CVV formatting
        document.getElementById('cvv').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>
</html> 