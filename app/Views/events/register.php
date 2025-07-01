<!DOCTYPE html>
<html>
<head>
    <title>Register for Event - Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body class="elite-chess-theme">
    <?= view('partials/navbar') ?>
    <div class="elite-login" style="max-width: 600px;">
        <h2>Sign Up for <?= esc($event['title']) ?></h2>
        <p style="margin-bottom: 18px; color: #e8c547;">Just review your info and click Join—no extra details needed!</p>
        <form method="post" action="<?= base_url('events/register/' . $event['id']) ?>">
            <?= csrf_field() ?>
            <div class="input-field">
                <label><strong>Name:</strong></label>
                <input type="text" class="elite-input" value="<?= esc($user['name']) ?>" readonly>
            </div>
            <div class="input-field">
                <label><strong>Email:</strong></label>
                <input type="email" class="elite-input" value="<?= esc($user['email']) ?>" readonly>
            </div>
            <!-- Add extra fields here if needed -->
            <button type="submit" class="join-btn" style="width:100%;">Join Now</button>
        </form>
    </div>
</body>
</html> 