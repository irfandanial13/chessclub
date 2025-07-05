<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .action-btn {
            display: inline-block;
            width: 25px;
            height: 20px;
            border-radius: 3px;
            text-decoration: none;
            text-align: center;
            line-height: 32px;
            margin: 0 2px;
            transition: all 0.2s ease;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        .edit-btn {
            background: #3498db;
            color: white;
        }
        
        .edit-btn:hover {
            background: #2980b9;
        }
        
        .delete-btn {
            background: #e74c3c;
            color: white;
        }
        
        .delete-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body class="elite-chess-theme">
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

    <?= view('partials/navbar_admin') ?>

    <div class="auth-container">
        <h2><i class="fas fa-calendar-alt"></i> Manage Events</h2>
        <a href="<?= base_url('admin/events/create') ?>" class="elite-button" style="margin-bottom: 15px; display:inline-block;"><i class="fas fa-plus"></i> Create Event</a>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04); color:#222; font-size:1.08em;">
            <thead style="background:#f5e9d7;">
                <tr>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">ID</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Title</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Date</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Description</th>
                    <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($events as $i => $event): ?>
                <tr style="text-align:center; background:<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>; transition:background 0.2s;" onmouseover="this.style.background='#fbeedc'" onmouseout="this.style.background='<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>'">
                    <td style="padding:12px 8px;"><?= $event['id'] ?></td>
                    <td style="padding:12px 8px;"><?= esc($event['title']) ?></td>
                    <td style="padding:12px 8px;"><?= esc($event['event_date']) ?></td>
                    <td style="padding:12px 8px;"><?= esc($event['description']) ?></td>
                    <td style="padding:12px 8px;">
                        <a href="<?= base_url('admin/events/edit/'.$event['id']) ?>" class="action-btn edit-btn" title="Edit Event"><i class="fas fa-edit"></i></a>
                        <a href="<?= base_url('admin/events/delete/'.$event['id']) ?>" class="action-btn delete-btn" title="Delete Event" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</body>
</html> 