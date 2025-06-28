
<!DOCTYPE html>
<html>
<head>
    <title><?= esc($title) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
<?= view('partials/navbar_admin') ?>

<div class="auth-container">
    <h2>Manage Users</h2>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="success-message"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <table border="1" width="100%" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th><th>Name</th><th>Email</th><th>Level</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= esc($user['name']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['membership_level']) ?></td>
                <td><?= esc($user['status']) ?></td>
                <td>
                    <a href="<?= base_url('admin/users/edit/'.$user['id']) ?>">Edit</a> |
                    <a href="<?= base_url('admin/users/delete/'.$user['id']) ?>" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
