<!DOCTYPE html>
<html>
<head>
    <title>Upload Payment Proof - Membership Upgrade</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #23272f;
            color: #fff;
            font-family: 'Segoe UI', Arial, sans-serif;
        }
        .upload-card {
            max-width: 480px;
            margin: 48px auto 0 auto;
            background: #2c3e50;
            border-radius: 18px;
            box-shadow: 0 4px 24px #0005;
            padding: 36px 32px 28px 32px;
        }
        .upload-card h2 {
            color: #e8c547;
            font-weight: 800;
            margin-bottom: 10px;
            text-align: center;
        }
        .upload-card p {
            color: #bdc3c7;
            text-align: center;
            margin-bottom: 22px;
        }
        .bank-details {
            background: #23272f;
            border-left: 4px solid #e8c547;
            border-radius: 10px;
            padding: 18px 18px 10px 18px;
            margin-bottom: 22px;
            color: #fff;
        }
        .bank-details h5 {
            color: #e8c547;
            font-size: 1.1em;
            margin-bottom: 8px;
        }
        .form-group {
            margin-bottom: 18px;
        }
        label {
            color: #e8c547;
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
        }
        .form-control {
            width: 100%;
            padding: 10px 12px;
            border-radius: 7px;
            border: 1.5px solid #555;
            background: #23272f;
            color: #fff;
            font-size: 1em;
            margin-bottom: 4px;
        }
        .form-control[type='file'] {
            background: #2c3e50;
        }
        .btn-primary {
            background: #e8c547;
            color: #23272f;
            font-weight: 700;
            border: none;
            border-radius: 7px;
            padding: 12px 0;
            width: 100%;
            font-size: 1.1em;
            margin-top: 10px;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: #d4b03a;
        }
        .alert {
            border-radius: 7px;
            padding: 12px 18px;
            margin-bottom: 18px;
            font-size: 1em;
        }
        .alert-danger { background: #e74c3c; color: #fff; }
        .alert-success { background: #27ae60; color: #fff; }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color: #e8c547;
            text-decoration: underline;
        }
        @media (max-width: 600px) {
            .upload-card { padding: 18px 5vw 18px 5vw; }
        }
    </style>
</head>
<body>
    <div class="upload-card">
        <h2><i class="fas fa-upload"></i> Upload Payment Proof</h2>
        <p>Please transfer the membership fee to our bank account and upload your payment receipt below.<br>Your upgrade will be processed after verification.</p>
        <div class="bank-details">
            <h5><i class="fas fa-university"></i> Bank Details</h5>
            <div><b>Bank:</b> Chess Club Bank</div>
            <div><b>Account Number:</b> 1234-5678-9012-3456</div>
            <div><b>Account Name:</b> Chess Club Membership</div>
            <div><b>Reference:</b> Use your username or email</div>
        </div>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('membership/submitPaymentUpload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="level" value="<?= esc($level) ?>">
            <div class="form-group">
                <label for="payment_reference">Payment Reference (optional):</label>
                <input type="text" name="payment_reference" id="payment_reference" class="form-control" placeholder="E.g. bank slip ref, username">
            </div>
            <div class="form-group">
                <label for="receipt">Upload Receipt (JPG, PNG, PDF):</label>
                <input type="file" name="receipt" id="receipt" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
            </div>
            <button type="submit" class="btn-primary"><i class="fas fa-paper-plane"></i> Submit Payment</button>
        </form>
        <a href="<?= base_url('membership') ?>" class="back-link"><i class="fas fa-arrow-left"></i> Back to Membership</a>
    </div>
</body>
</html>