<!DOCTYPE html>
<html>
<head>
    <title>Checkout - Chess Club Merchandise</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .checkout-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .checkout-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .checkout-header h1 {
            color: #e8c547;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .checkout-header p {
            color: #bdc3c7;
            font-size: 1.1em;
        }
        
        .checkout-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }
        
        .payment-section {
            background: #23272f;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
        }
        
        .section-title {
            font-size: 1.5em;
            font-weight: 700;
            color: #e8c547;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-bottom: 2px solid #e8c547;
            padding-bottom: 10px;
        }
        
        .payment-option {
            background: #2c3e50;
            border: 2px solid #444;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }
        
        .payment-option:hover {
            border-color: #e8c547;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(232, 197, 71, 0.2);
        }
        
        .payment-option.selected {
            border-color: #e8c547;
            background: linear-gradient(135deg, rgba(232, 197, 71, 0.1) 0%, rgba(232, 197, 71, 0.05) 100%);
            box-shadow: 0 8px 25px rgba(232, 197, 71, 0.3);
        }
        
        .payment-option.selected::before {
            content: '✓';
            position: absolute;
            top: -10px;
            right: -10px;
            background: #e8c547;
            color: #23272f;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1em;
            box-shadow: 0 4px 15px rgba(232, 197, 71, 0.4);
        }
        
        .payment-icon {
            font-size: 3em;
            color: #e8c547;
            width: 70px;
            text-align: center;
        }
        
        .payment-details {
            flex: 1;
        }
        
        .payment-name {
            font-size: 1.3em;
            font-weight: 600;
            margin-bottom: 8px;
            color: #fff;
        }
        
        .payment-description {
            font-size: 1em;
            color: #bdc3c7;
            line-height: 1.5;
        }
        
        .payment-option input[type="radio"] {
            display: none;
        }
        
        .customer-details {
            background: #34495e;
            border-radius: 12px;
            padding: 30px;
            margin-top: 25px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-20px);
        }
        
        .customer-details.show {
            opacity: 1;
            transform: translateY(0);
            border-color: #e8c547;
            animation: slideIn 0.4s ease-out;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
        }
        
        .form-group.full-width {
            grid-column: 1 / -1;
        }
        
        .form-label {
            font-weight: 600;
            color: #e8c547;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95em;
        }
        
        .form-input {
            padding: 15px;
            border: 2px solid #555;
            border-radius: 8px;
            background: #2c3e50;
            color: #fff;
            font-size: 1em;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #e8c547;
            box-shadow: 0 0 0 3px rgba(232, 197, 71, 0.1);
            background: #2c3e50;
        }
        
        .form-input.error {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }
        
        .form-input.success {
            border-color: #27ae60;
            box-shadow: 0 0 0 3px rgba(39, 174, 96, 0.1);
        }
        
        .error-message {
            color: #e74c3c;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        .success-message {
            color: #27ae60;
            font-size: 0.85em;
            margin-top: 5px;
            display: none;
            animation: fadeIn 0.3s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .file-upload-section {
            background: #34495e;
            border-radius: 12px;
            padding: 25px;
            margin-top: 20px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(-20px);
        }
        
        .file-upload-section.show {
            opacity: 1;
            transform: translateY(0);
            border-color: #e8c547;
            animation: slideIn 0.4s ease-out;
        }
        
        .file-input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }
        
        .file-input {
            width: 100%;
            padding: 15px;
            border: 2px dashed #555;
            border-radius: 8px;
            background: #2c3e50;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .file-input:hover {
            border-color: #e8c547;
            background: rgba(232, 197, 71, 0.05);
        }
        
        .file-input:focus {
            outline: none;
            border-color: #e8c547;
            box-shadow: 0 0 0 3px rgba(232, 197, 71, 0.1);
        }
        
        .bank-details {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #e8c547;
            margin-top: 15px;
        }
        
        .bank-details h5 {
            color: #e8c547;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1.1em;
        }
        
        .bank-details p {
            color: #bdc3c7;
            margin-bottom: 8px;
            font-size: 0.95em;
        }
        
        .bank-details strong {
            color: #fff;
        }
        
        .order-summary {
            background: #2c3e50;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.3);
            height: fit-content;
            position: sticky;
            top: 20px;
        }
        
        .summary-title {
            font-size: 1.4em;
            font-weight: 600;
            color: #e8c547;
            margin-bottom: 25px;
            border-bottom: 2px solid #e8c547;
            padding-bottom: 10px;
        }
        
        .order-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
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
            margin-bottom: 5px;
            color: #fff;
            font-size: 1.05em;
        }
        
        .item-meta {
            font-size: 0.9em;
            color: #bdc3c7;
        }
        
        .item-price {
            color: #e8c547;
            font-weight: 600;
            font-size: 1.1em;
        }
        
        .total-section {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #e8c547;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 1em;
        }
        
        .total-row.final {
            font-size: 1.5em;
            font-weight: 700;
            color: #e8c547;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #444;
        }
        
        .continue-btn {
            width: 100%;
            background: linear-gradient(135deg, #e8c547 0%, #d4b03a 100%);
            color: #23272f;
            border: none;
            border-radius: 12px;
            padding: 20px;
            font-size: 1.2em;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 6px 20px rgba(232, 197, 71, 0.3);
        }
        
        .continue-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(232, 197, 71, 0.4);
        }
        
        .continue-btn:disabled {
            background: #666;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        
        .loading {
            display: none;
        }
        
        .loading.show {
            display: inline-block;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .security-badges {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #444;
        }
        
        .security-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #27ae60;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .progress-indicator {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            gap: 10px;
        }
        
        .progress-step {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #555;
            color: #bdc3c7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        
        .progress-step.active {
            background: #e8c547;
            color: #23272f;
            transform: scale(1.1);
        }
        
        .progress-step.completed {
            background: #27ae60;
            color: #fff;
        }
        
        .progress-line {
            width: 60px;
            height: 3px;
            background: #555;
            border-radius: 2px;
        }
        
        .progress-line.active {
            background: #e8c547;
        }
        
        @media (max-width: 768px) {
            .checkout-content {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .checkout-header h1 {
                font-size: 2em;
            }
            
            .security-badges {
                flex-direction: column;
                gap: 10px;
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
        <div class="checkout-container">
            <!-- Progress Indicator -->
            <!-- <div class="progress-indicator">
                <div class="progress-step active" id="step1">1</div>
                <div class="progress-line" id="line1"></div>
                <div class="progress-step" id="step2">2</div>
                <div class="progress-line" id="line2"></div>
                <div class="progress-step" id="step3">3</div>
            </div> -->
            
            <!-- Checkout Header -->
            <div class="checkout-header">
                <h1><i class="fas fa-shopping-cart"></i> Complete Your Order</h1>
                <p>Review your items and provide payment details</p>
            </div>
            
            <div class="checkout-content">
                <!-- Payment Section -->
                <div class="payment-section">
                    <h3 class="section-title">
                        <i class="fas fa-credit-card"></i>
                        Payment Method
                    </h3>
                    
                    <form id="paymentForm" method="post" action="<?= base_url('merchandise/complete-order') ?>" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        
                        <!-- Payment Options -->
                        <div class="payment-option" onclick="selectPayment('bank')">
                            <input type="radio" name="paymentMethod" value="bank" id="bank">
                            <div class="payment-icon">🏦</div>
                            <div class="payment-details">
                                <div class="payment-name">Bank Transfer</div>
                                <div class="payment-description">
                                    Transfer money directly to our bank account. Upload your transfer slip for verification.
                                </div>
                            </div>
                        </div>
                        
                        <!-- Customer Details Section -->
                        <div id="customerDetails" class="customer-details">
                            <h4 style="color: #e8c547; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-user"></i> Customer Information
                            </h4>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-user"></i> Full Name *
                                    </label>
                                    <input type="text" name="name" class="form-input" required>
                                    <div class="error-message" id="nameError"></div>
                                    <div class="success-message" id="nameSuccess"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-envelope"></i> Email *
                                    </label>
                                    <input type="email" name="email" class="form-input" required>
                                    <div class="error-message" id="emailError"></div>
                                    <div class="success-message" id="emailSuccess"></div>
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-phone"></i> Phone Number *
                                    </label>
                                    <input type="tel" name="phone" class="form-input" required>
                                    <div class="error-message" id="phoneError"></div>
                                    <div class="success-message" id="phoneSuccess"></div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-university"></i> Payment Method *
                                    </label>
                                    <select name="payment_method" class="form-input" required>
                                        <option value="">Select Payment Method</option>
                                        <option value="bank">Bank Transfer</option>
                                    </select>
                                    <div class="error-message" id="paymentError"></div>
                                </div>
                            </div>
                            
                            <div class="form-group full-width">
                                <label class="form-label">
                                    <i class="fas fa-map-marker-alt"></i> Delivery Address *
                                </label>
                                <textarea name="address" class="form-input" required rows="4" placeholder="Enter your complete delivery address..."></textarea>
                                <div class="error-message" id="addressError"></div>
                                <div class="success-message" id="addressSuccess"></div>
                            </div>
                        </div>
                        
                        <!-- File Upload Section -->
                        <div id="fileUploadSection" class="file-upload-section">
                            <h4 style="color: #e8c547; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-upload"></i> Upload Transfer Slip
                            </h4>
                            
                            <div class="file-input-wrapper">
                                <input type="file" name="transfer_slip" class="file-input" accept="image/*,.pdf" required>
                                <small style="color: #bdc3c7; font-size: 0.85em; margin-top: 8px; display: block;">
                                    Accepted formats: JPG, PNG, PDF (Max 5MB)
                                </small>
                                <div class="error-message" id="fileError"></div>
                            </div>
                            
                            <div class="bank-details">
                                <h5><i class="fas fa-info-circle"></i> Bank Transfer Details</h5>
                                <p><strong>Bank:</strong> Chess Club Bank</p>
                                <p><strong>Account Number:</strong> 1234-5678-9012-3456</p>
                                <p><strong>Account Name:</strong> Chess Club Merchandise</p>
                                <p><strong>Reference:</strong> Use your order number as reference</p>
                            </div>
                        </div>
                        
                        <button type="submit" class="continue-btn" id="continueBtn" disabled>
                            <i class="fas fa-university"></i>
                            <span id="btnText">Select Payment Method</span>
                            <i class="fas fa-spinner loading" id="loadingSpinner"></i>
                        </button>
                    </form>
                </div>
                
                <!-- Order Summary -->
                <div class="order-summary">
                    <h3 class="summary-title">
                        <i class="fas fa-shopping-cart"></i> Order Summary
                    </h3>
                    
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
                            <span>RM<span id="delivery">0.00</span></span>
                        </div>
                        <div class="total-row final">
                            <span>Total:</span>
                            <span>RM<span id="finalTotal">0.00</span></span>
                        </div>
                    </div>
                    
                    <div class="security-badges">
                        <div class="security-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Secure Payment</span>
                        </div>
                        <div class="security-badge">
                            <i class="fas fa-lock"></i>
                            <span>SSL Encrypted</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get order data from PHP
        const orderItems = <?= json_encode($cartItems ?? []) ?>;
        const total = <?= $total ?? 0 ?>;

        // Calculate totals
        let subtotal = total;
        let delivery = 0.00; // No delivery fee for now
        let finalTotal = subtotal + delivery;

        // Form validation
        const form = document.getElementById('paymentForm');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        // Real-time validation
        inputs.forEach(input => {
            input.addEventListener('blur', validateField);
            input.addEventListener('input', clearError);
        });

        function validateField(e) {
            const field = e.target;
            const value = field.value.trim();
            const fieldName = field.name;
            const errorElement = document.getElementById(fieldName + 'Error');
            const successElement = document.getElementById(fieldName + 'Success');
            
            let isValid = true;
            let errorMessage = '';
            
            switch(fieldName) {
                case 'name':
                    if (value.length < 2) {
                        isValid = false;
                        errorMessage = 'Name must be at least 2 characters long';
                    }
                    break;
                case 'email':
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid email address';
                    }
                    break;
                case 'phone':
                    const phoneRegex = /^[\d\s\-\+\(\)]{10,}$/;
                    if (!phoneRegex.test(value)) {
                        isValid = false;
                        errorMessage = 'Please enter a valid phone number';
                    }
                    break;
                case 'address':
                    if (value.length < 10) {
                        isValid = false;
                        errorMessage = 'Address must be at least 10 characters long';
                    }
                    break;
                case 'payment_method':
                    if (!value) {
                        isValid = false;
                        errorMessage = 'Please select a payment method';
                    }
                    break;
            }
            
            if (!isValid) {
                field.classList.add('error');
                field.classList.remove('success');
                errorElement.textContent = errorMessage;
                errorElement.style.display = 'block';
                if (successElement) successElement.style.display = 'none';
            } else {
                field.classList.remove('error');
                field.classList.add('success');
                errorElement.style.display = 'none';
                if (successElement) {
                    successElement.textContent = '✓ Valid';
                    successElement.style.display = 'block';
                }
            }
            
            return isValid;
        }

        function clearError(e) {
            const field = e.target;
            const errorElement = document.getElementById(field.name + 'Error');
            const successElement = document.getElementById(field.name + 'Success');
            field.classList.remove('error');
            errorElement.style.display = 'none';
            if (successElement) successElement.style.display = 'none';
        }

        // Populate order summary
        function populateOrderSummary() {
            const orderItemsContainer = document.getElementById('orderItems');
            orderItemsContainer.innerHTML = '';
            
            if (orderItems.length === 0) {
                orderItemsContainer.innerHTML = '<div style="text-align: center; color: #bdc3c7; padding: 20px;">No items in cart</div>';
                return;
            }
            
            orderItems.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'order-item';
                itemDiv.innerHTML = `
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <div class="item-meta">Qty: ${item.quantity} × RM${item.price.toFixed(2)}</div>
                    </div>
                    <div class="item-price">RM${(item.price * item.quantity).toFixed(2)}</div>
                `;
                orderItemsContainer.appendChild(itemDiv);
            });

            document.getElementById('subtotal').textContent = subtotal.toFixed(2);
            document.getElementById('delivery').textContent = delivery.toFixed(2);
            document.getElementById('finalTotal').textContent = finalTotal.toFixed(2);
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
            
            // Show customer details section
            const customerDetails = document.getElementById('customerDetails');
            customerDetails.classList.add('show');
            
            // Set the payment method in the dropdown
            const paymentMethodSelect = customerDetails.querySelector('select[name="payment_method"]');
            paymentMethodSelect.value = method;
            
            // Enable continue button
            document.getElementById('continueBtn').disabled = false;
            
            // Update progress
            updateProgress(2);
            
            // Change button text
            const btnText = document.getElementById('btnText');
            if (method === 'bank') {
                btnText.textContent = 'Complete Order';
            }
            
            // Show file upload section for bank transfer
            const fileUploadSection = document.getElementById('fileUploadSection');
            if (method === 'bank') {
                fileUploadSection.classList.add('show');
            } else {
                fileUploadSection.classList.remove('show');
            }
        }

        // Update progress indicator
        function updateProgress(step) {
            // Update step indicators
            for (let i = 1; i <= 3; i++) {
                const stepElement = document.getElementById('step' + i);
                const lineElement = document.getElementById('line' + (i - 1));
                
                if (i < step) {
                    stepElement.classList.add('completed');
                    stepElement.classList.remove('active');
                    if (lineElement) lineElement.classList.add('active');
                } else if (i === step) {
                    stepElement.classList.add('active');
                    stepElement.classList.remove('completed');
                    if (lineElement) lineElement.classList.add('active');
                } else {
                    stepElement.classList.remove('active', 'completed');
                    if (lineElement) lineElement.classList.remove('active');
                }
            }
        }

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Validate all fields
            let isValid = true;
            inputs.forEach(input => {
                if (!validateField({ target: input })) {
                    isValid = false;
                }
            });
            
            // Check if file is uploaded for bank transfer
            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');
            if (paymentMethod && paymentMethod.value === 'bank') {
                const fileInput = document.querySelector('input[name="transfer_slip"]');
                if (!fileInput.files[0]) {
                    const fileError = document.getElementById('fileError');
                    fileError.textContent = 'Please upload your transfer slip/receipt.';
                    fileError.style.display = 'block';
                    isValid = false;
                } else {
                    // Check file size (5MB limit)
                    const fileSize = fileInput.files[0].size / 1024 / 1024; // Convert to MB
                    if (fileSize > 5) {
                        const fileError = document.getElementById('fileError');
                        fileError.textContent = 'File size must be less than 5MB.';
                        fileError.style.display = 'block';
                        isValid = false;
                    }
                }
            }
            
            if (!isValid) {
                alert('Please correct the errors before submitting.');
                return;
            }
            
            // Show confirmation dialog
            if (confirm('Are you sure you want to complete this order?')) {
                // Show loading state
                const btn = document.getElementById('continueBtn');
                const spinner = document.getElementById('loadingSpinner');
                const btnText = document.getElementById('btnText');
                
                btn.disabled = true;
                spinner.classList.add('show');
                btnText.textContent = 'Processing...';
                
                // Update progress
                updateProgress(3);
                
                // Submit form after a short delay to show processing
                setTimeout(() => {
                    form.submit();
                }, 1500);
            }
        });

        // Initialize
        populateOrderSummary();
        updateProgress(1);
    </script>
</body>
</html>