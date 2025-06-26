<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
<?= view('partials/navbar_admin') ?>

<div class="auth-container">
    <h2>Edit User</h2>

    <form method="post" action="<?= base_url('admin/users/update/'.$user['id']) ?>">
        <input type="text" name="name" value="<?= esc($user['name']) ?>" required>
        <input type="email" name="email" value="<?= esc($user['email']) ?>" required>
        
        <select name="membership_level">
            <option <?= $user['membership_level'] === 'Bronze' ? 'selected' : '' ?>>Bronze</option>
            <option <?= $user['membership_level'] === 'Silver' ? 'selected' : '' ?>>Silver</option>
            <option <?= $user['membership_level'] === 'Gold' ? 'selected' : '' ?>>Gold</option>
        </select>

        <select name="status">
            <option <?= $user['status'] === 'Active' ? 'selected' : '' ?>>Active</option>
            <option <?= $user['status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
        </select>

        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>
