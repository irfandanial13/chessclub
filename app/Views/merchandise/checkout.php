<!DOCTYPE html>
<html>
<head>
    <title>Payment Method - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .payment-container {
            max-width: 800px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
        
        .payment-methods {
            background: #23272f;
            color: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        
        .payment-title {
            font-size: 1.5em;
            font-weight: 700;
            color: #e8c547;
            margin-bottom: 25px;
            text-align: center;
        }
        
        .payment-option {
            background: #2c3e50;
            border: 2px solid #444;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .payment-option:hover {
            border-color: #e8c547;
            transform: translateY(-2px);
        }
        
        .payment-option.selected {
            border-color: #e8c547;
            background: rgba(232, 197, 71, 0.1);
        }
        
        .payment-icon {
            font-size: 2em;
            color: #e8c547;
            width: 50px;
            text-align: center;
        }
        
        .payment-details {
            flex: 1;
        }
        
        .payment-name {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .payment-description {
            font-size: 0.9em;
            color: #bdc3c7;
        }
        
        .payment-option input[type="radio"] {
            display: none;
        }
        
        .order-summary {
            background: #2c3e50;
            color: #fff;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            height: fit-content;
        }
        
        .summary-title {
            font-size: 1.2em;
            font-weight: 600;
            color: #e8c547;
            margin-bottom: 20px;
            border-bottom: 2px solid #e8c547;
            padding-bottom: 10px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #444;
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            margin-bottom: 4px;
        }
        
        .item-price {
            color: #e8c547;
            font-weight: 600;
        }
        
        .total-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #e8c547;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .total-row.final {
            font-size: 1.3em;
            font-weight: 700;
            color: #e8c547;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #444;
        }
        
        .continue-btn {
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
        
        .continue-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
        }
        
        .continue-btn:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
        }
        
        @media (max-width: 768px) {
            .payment-container {
                grid-template-columns: 1fr;
                gap: 20px;
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
        <h2><i class="fas fa-credit-card"></i> Choose Payment Method</h2>
        
        <div class="payment-container">
            <!-- Payment Methods -->
            <div class="payment-methods">
                <h3 class="payment-title">Select Your Payment Method</h3>
                
                <form id="paymentForm" method="post" action="<?= base_url('merchandise/process-payment') ?>">
                    <?= csrf_field() ?>
                    
                    <div class="payment-option" onclick="selectPayment('cash')">
                        <input type="radio" name="paymentMethod" value="cash" id="cash" required>
                        <div class="payment-icon">💵</div>
                        <div class="payment-details">
                            <div class="payment-name">Cash on Delivery</div>
                            <div class="payment-description">Pay with cash when your order arrives</div>
                        </div>
                    </div>
                    
                    <div class="payment-option" onclick="selectPayment('bank')">
                        <input type="radio" name="paymentMethod" value="bank" id="bank">
                        <div class="payment-icon">🏦</div>
                        <div class="payment-details">
                            <div class="payment-name">Bank Transfer</div>
                            <div class="payment-description">Transfer money to our bank account</div>
                        </div>
                    </div>
                    
                    <div class="payment-option" onclick="selectPayment('online')">
                        <input type="radio" name="paymentMethod" value="online" id="online">
                        <div class="payment-icon">💳</div>
                        <div class="payment-details">
                            <div class="payment-name">Online Payment</div>
                            <div class="payment-description">Pay with credit/debit card online</div>
                        </div>
                    </div>
                    
                    <button type="submit" class="continue-btn" id="continueBtn" disabled>
                        <i class="fas fa-arrow-right"></i> Continue to Payment Details
                    </button>
                </form>
            </div>
            
            <!-- Order Summary -->
            <div class="order-summary">
                <h3 class="summary-title"><i class="fas fa-shopping-cart"></i> Order Summary</h3>
                
                <div id="orderItems">
                    <!-- Order items will be populated by JavaScript -->
                </div>
                
                <div class="total-section">
                    <div class="total-row">
                        <span>Subtotal:</span>
                        <span>RM<span id="subtotal">0.00</span></span>
                    </div>
                    <div class="total-row">
                        <span>Delivery:</span>
                        <span>RM<span id="delivery">10.00</span></span>
                    </div>
                    <div class="total-row final">
                        <span>Total:</span>
                        <span>RM<span id="finalTotal">0.00</span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sample order data (in real app, this would come from session/cart)
        const orderItems = [
            { name: 'Chess Club T-Shirt', price: 25.00, qty: 1 },
            { name: 'Chess Mug', price: 12.00, qty: 2 }
        ];

        // Calculate totals
        let subtotal = orderItems.reduce((sum, item) => sum + (item.price * item.qty), 0);
        let delivery = 10.00;
        let total = subtotal + delivery;

        // Populate order summary
        function populateOrderSummary() {
            const orderItemsContainer = document.getElementById('orderItems');
            orderItemsContainer.innerHTML = '';
            
            orderItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'order-item';
                itemDiv.innerHTML = `
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <div>Qty: ${item.qty}</div>
</div>
                    <div class="item-price">RM${(item.price * item.qty).toFixed(2)}</div>
                `;
                orderItemsContainer.appendChild(itemDiv);
            });

            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('delivery').textContent = delivery.toFixed(2);
            document.getElementById('finalTotal').textContent = total.toFixed(2);
        }

        // Payment method selection
        function selectPayment(method) {
            // Remove selected class from all payment options
            document.querySelectorAll('.payment-option').forEach(el => {
                el.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            event.currentTarget.classList.add('selected');
            
            // Check the radio button
            document.getElementById(method).checked = true;
            
            // Enable continue button
            document.getElementById('continueBtn').disabled = false;
        }

        // Form validation
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            
            if (!paymentMethod) {
                e.preventDefault();
                alert('Please select a payment method.');
                return;
            }
            
            // Change button text based on payment method
            const continueBtn = document.getElementById('continueBtn');
            const method = paymentMethod.value;
            
            if (method === 'cash') {
                continueBtn.innerHTML = '<i class="fas fa-check"></i> Complete Order';
            } else if (method === 'bank') {
                continueBtn.innerHTML = '<i class="fas fa-university"></i> Get Bank Details';
            } else if (method === 'online') {
                continueBtn.innerHTML = '<i class="fas fa-credit-card"></i> Enter Card Details';
            }
        });

        // Initialize
        populateOrderSummary();
    </script>
</body>
</html> 