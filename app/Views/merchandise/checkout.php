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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
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
                <div class="payment-option" onclick="selectPayment('bank')">
                    <input type="radio" name="paymentMethod" value="bank" id="bank">
                    <div class="payment-icon">🏦</div>
                    <div class="payment-details">
                        <div class="payment-name">Bank Transfer</div>
                        <div class="payment-description">Transfer money to our bank account</div>
                    </div>
                </div>

                <!-- File Upload Section - Always visible now -->
                <div id="fileUploadSection" style="margin-top: 20px; padding: 20px; background: #34495e; border-radius: 10px;">
                    <h4 style="color: #e8c547; margin-bottom: 15px;"><i class="fas fa-upload"></i> Upload Transfer Slip</h4>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Transfer Slip/Receipt *</label>
                        <input type="file" name="transfer_slip" id="transferSlipInput" accept="image/*,.pdf" required
                            style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff;">
                        <div id="fileInfo" style="margin-top: 10px; color: #e8c547; font-size: 0.95em;"></div>
                        <div id="filePreview" style="margin-top: 10px;"></div>
                        <div id="fileError" style="color: #e74c3c; font-size: 0.95em; margin-top: 5px; display: none;"></div>
                        <button type="button" id="clearFileBtn" style="display:none; margin-top:10px; background:#e74c3c; color:#fff; border:none; border-radius:5px; padding:5px 12px; cursor:pointer;">Clear File</button>
                        <small style="color: #bdc3c7; font-size: 0.85em;">Accepted formats: JPG, PNG, PDF (Max 5MB)</small>
                    </div>
                    <div style="background: #2c3e50; padding: 15px; border-radius: 8px; border-left: 4px solid #e8c547;">
                        <h5 style="color: #e8c547; margin-bottom: 10px;"><i class="fas fa-info-circle"></i> Bank Details</h5>
                        <div style="color: #bdc3c7; font-size: 0.9em;">
                            <p><strong>Bank:</strong> Chess Club Bank</p>
                            <p><strong>Account Number:</strong> 1234-5678-9012-3456</p>
                            <p><strong>Account Name:</strong> Chess Club Merchandise</p>
                            <p><strong>Reference:</strong> Use your order number as reference</p>
                        </div>
                    </div>
                </div>
                <br />
                <form id="paymentForm" method="post" action="<?= base_url('merchandise/complete-order') ?>"
                    enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Customer Details Section - Hidden initially -->
                    <div id="customerDetails" class="customer-details"
                        style="margin-bottom: 30px; padding: 20px; background: #34495e; border-radius: 10px; display: none;">
                        <h4 style="color: #e8c547; margin-bottom: 15px;"><i class="fas fa-user"></i> Customer Details
                        </h4>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Full Name *</label>
                                <input type="text" name="name" required
                                    style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Email *</label>
                                <input type="email" name="email" required
                                    style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff;">
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                            <div>
                                <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Phone Number
                                    *</label>
                                <input type="tel" name="phone" required
                                    style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Payment Method
                                    *</label>
                                <input type="text" name="payment_method_display" value="Bank Transfer" readonly
                                    style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff;">
                                <input type="hidden" name="payment_method" value="bank">
                            </div>
                        </div>

                        <div>
                            <label style="display: block; margin-bottom: 5px; color: #bdc3c7;">Delivery Address
                                *</label>
                            <textarea name="address" required rows="3"
                                style="width: 100%; padding: 10px; border: 1px solid #555; border-radius: 5px; background: #2c3e50; color: #fff; resize: vertical;"></textarea>
                        </div>
                    </div>



                    <button type="submit" class="continue-btn" id="continueBtn" disabled>
                        <i class="fas fa-check"></i> Complete Order
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
                        <span>RM<span id="delivery">0.00</span></span>
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
        // Get order data from PHP
        const orderItems = <?= json_encode($cartItems ?? []) ?>;
        const total = <?= $total ?? 0 ?>;

        // Calculate totals
        let subtotal = total;
        let delivery = 0.00; // No delivery fee for now
        let finalTotal = subtotal + delivery;

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
                        <div>Qty: ${item.quantity}</div>
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
            customerDetails.style.display = 'block';

            // Set the payment method in the dropdown
            const paymentMethodSelect = customerDetails.querySelector('select[name="payment_method"]');
            paymentMethodSelect.value = method;

            // Enable continue button
            document.getElementById('continueBtn').disabled = false;

            // Change button text based on payment method
            const continueBtn = document.getElementById('continueBtn');
            if (method === 'bank') {
                continueBtn.innerHTML = '<i class="fas fa-university"></i> Complete Order';
            }
        }

        // Form validation
        document.getElementById('paymentForm').addEventListener('submit', function (e) {
            e.preventDefault();

            const paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

            if (!paymentMethod) {
                alert('Please select a payment method.');
                return;
            }

            // Check if file is uploaded for bank transfer
            if (paymentMethod.value === 'bank') {
                const fileInput = document.getElementById('transferSlipInput');
                if (!fileInput.files[0]) {
                    alert('Please upload your transfer slip/receipt.');
                    return;
                }

                // Check file size (5MB limit)
                const fileSize = fileInput.files[0].size / 1024 / 1024; // Convert to MB
                if (fileSize > 5) {
                    alert('File size must be less than 5MB.');
                    return;
                }
            }

            // Show success message before submitting
            if (confirm('Are you sure you want to complete this order?')) {
                // Show loading state
                const btn = document.getElementById('continueBtn');
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';

                // Submit form after a short delay to show processing
                setTimeout(() => {
                    document.getElementById('paymentForm').submit();
                }, 1000);
            }
        });

        // --- File Upload Improvements ---
        const transferSlipInput = document.getElementById('transferSlipInput');
        const fileInfo = document.getElementById('fileInfo');
        const filePreview = document.getElementById('filePreview');
        const fileError = document.getElementById('fileError');
        const clearFileBtn = document.getElementById('clearFileBtn');
        const continueBtn = document.getElementById('continueBtn');

        function resetFileUI() {
            fileInfo.textContent = '';
            filePreview.innerHTML = '';
            fileError.style.display = 'none';
            clearFileBtn.style.display = 'none';
            continueBtn.disabled = false;
        }

        if (transferSlipInput) {
            transferSlipInput.addEventListener('change', function () {
                resetFileUI();
                const file = this.files[0];
                if (!file) return;
                // Validate type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf'];
                if (!validTypes.includes(file.type)) {
                    fileError.textContent = 'Invalid file type. Only JPG, PNG, or PDF allowed.';
                    fileError.style.display = 'block';
                    continueBtn.disabled = true;
                    return;
                }
                // Validate size
                if (file.size > 5 * 1024 * 1024) {
                    fileError.textContent = 'File size must be less than 5MB.';
                    fileError.style.display = 'block';
                    continueBtn.disabled = true;
                    return;
                }
                // Show file name
                fileInfo.textContent = 'Selected: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                // Show preview if image
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        filePreview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="max-width:120px; max-height:120px; border-radius:8px; border:1px solid #e8c547; margin-top:5px;">';
                    };
                    reader.readAsDataURL(file);
                } else {
                    filePreview.innerHTML = '<i class="fas fa-file-pdf" style="font-size:2em; color:#e8c547;"></i> PDF file selected.';
                }
                clearFileBtn.style.display = 'inline-block';
                continueBtn.disabled = false;
            });
            clearFileBtn.addEventListener('click', function () {
                transferSlipInput.value = '';
                resetFileUI();
            });
        }

        // Initialize
        populateOrderSummary();
    </script>
</body>

</html>