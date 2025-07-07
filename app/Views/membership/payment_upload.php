<!DOCTYPE html>
<html>
<head>
    <title>Upload Payment Proof - Membership Upgrade</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <h2>Upload Payment Proof for Membership Upgrade</h2>
        <p>Please transfer the membership fee to our bank account and upload your payment receipt below. Your upgrade will be processed after verification.</p>
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
                <input type="text" name="payment_reference" id="payment_reference" class="form-control">
            </div>
            <div class="form-group">
                <label for="receipt">Upload Receipt (jpg, png, pdf):</label>
                <input type="file" name="receipt" id="receipt" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit Payment</button>
        </form>
        <br>
        <a href="<?= base_url('membership') ?>">Back to Membership</a>
    </div>
</body>
</html> 