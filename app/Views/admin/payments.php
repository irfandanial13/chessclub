<!DOCTYPE html>
<html>
<head>
    <title>Admin - Payment Approvals - Elite Chess Club</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .payment-page {
            padding: 2rem 0;
        }
        
        .payment-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #e8c547;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #fff;
            opacity: 0.8;
        }
        
        .payment-table-container {
            background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .payment-table {
            width: 100%;
        }
        
        .table-header {
            background: linear-gradient(135deg, #e8c547, #d4af37);
            padding: 1.5rem;
        }
        
        .header-row {
            display: grid;
            grid-template-columns: 60px 1fr 100px 120px 100px 100px 140px 120px;
            gap: 1rem;
            align-items: center;
        }
        
        .header-cell {
            font-weight: 600;
            color: #23272f;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .table-body {
            max-height: 600px;
            overflow-y: auto;
        }
        
        .table-row {
            display: grid;
            grid-template-columns: 60px 1fr 100px 120px 100px 100px 140px 120px;
            gap: 1rem;
            align-items: center;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            transition: background-color 0.3s ease;
        }
        
        .table-row:hover {
            background: rgba(255,255,255,0.05);
        }
        
        .table-row:last-child {
            border-bottom: none;
        }
        
        .table-cell {
            display: flex;
            align-items: center;
        }
        
        .payment-id {
            background: linear-gradient(135deg, #e8c547, #d4af37);
            color: #23272f;
            padding: 0.3rem 0.6rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .user-info i {
            color: #e8c547;
            font-size: 1.2rem;
        }
        
        .user-name {
            font-weight: 500;
            color: #fff;
        }
        
        .level-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
        }
        
        .level-badge.gold {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #23272f;
        }
        
        .level-badge.silver {
            background: linear-gradient(135deg, #c0c0c0, #e5e5e5);
            color: #23272f;
        }
        
        .reference {
            color: #fff;
            font-size: 0.85rem;
        }
        
        .no-reference {
            color: rgba(255,255,255,0.5);
            font-style: italic;
        }
        
        .view-receipt-btn {
            background: linear-gradient(135deg, #4a90e2, #357abd);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .view-receipt-btn:hover {
            background: linear-gradient(135deg, #357abd, #2d5986);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3);
            color: white;
            text-decoration: none;
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-align: center;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .status-badge.pending {
            background: linear-gradient(135deg, #ffa726, #ff9800);
            color: #23272f;
        }
        
        .status-badge.approved {
            background: linear-gradient(135deg, #66bb6a, #4caf50);
            color: white;
        }
        
        .status-badge.rejected {
            background: linear-gradient(135deg, #ef5350, #f44336);
            color: white;
        }
        
        .payment-date {
            color: rgba(255,255,255,0.8);
            font-size: 0.85rem;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }
        
        .approve-btn, .reject-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .approve-btn {
            background: linear-gradient(135deg, #66bb6a, #4caf50);
            color: white;
        }
        
        .approve-btn:hover {
            background: linear-gradient(135deg, #4caf50, #388e3c);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }
        
        .reject-btn {
            background: linear-gradient(135deg, #ef5350, #f44336);
            color: white;
        }
        
        .reject-btn:hover {
            background: linear-gradient(135deg, #f44336, #d32f2f);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244, 67, 54, 0.3);
        }
        
        .no-actions {
            color: rgba(255,255,255,0.5);
            font-style: italic;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: rgba(255,255,255,0.7);
        }
        
        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .empty-state h3 {
            color: #e8c547;
            margin-bottom: 0.5rem;
        }
        
        .sort-link {
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .sort-link i {
            font-size: 0.8rem;
        }
        
        @media (max-width: 768px) {
            .header-row, .table-row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
            
            .table-cell {
                justify-content: center;
            }
            
            .action-buttons {
                justify-content: center;
            }
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

    <div class="membership-container payment-page">
        <div class="membership-header">
            <div class="header-content">
                <h1 class="membership-title">♔ Payment Approvals ♕</h1>
                <p class="membership-subtitle">Admin control for membership upgrades</p>
            </div>
            <div class="current-status">
                <div class="status-badge admin">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin Panel</span>
                </div>
            </div>
        </div>

        <?php 
        $pendingCount = 0;
        $approvedCount = 0;
        $rejectedCount = 0;
        foreach ($payments as $payment) {
            if ($payment['status'] === 'pending') $pendingCount++;
            elseif ($payment['status'] === 'approved') $approvedCount++;
            else $rejectedCount++;
        }
        ?>

        <div class="payment-stats">
            <div class="stat-card">
                <div class="stat-number"><?= count($payments) ?></div>
                <div class="stat-label">Total Payments</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $pendingCount ?></div>
                <div class="stat-label">Pending Review</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $approvedCount ?></div>
                <div class="stat-label">Approved</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= $rejectedCount ?></div>
                <div class="stat-label">Rejected</div>
            </div>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <div class="upgrade-section">
            <div class="section-header">
                <h2>🏆 Membership Payment Requests 🥇</h2>
                <p>Review and approve membership upgrade payments</p>
            </div>

            <div class="payment-table-container">
                <div class="payment-table">
                    <div class="table-header">
                        <div class="header-row">
                            <?php
                            function sort_link($label, $field, $currentSort, $currentDir) {
                                $dir = ($currentSort === $field && $currentDir === 'ASC') ? 'DESC' : 'ASC';
                                $arrow = '';
                                if ($currentSort === $field) {
                                    $arrow = $currentDir === 'ASC' ? ' <i class=\'fas fa-arrow-up\'></i>' : ' <i class=\'fas fa-arrow-down\'></i>';
                                }
                                $url = '?sort=' . $field . '&direction=' . $dir;
                                return "<a href='$url' class='sort-link' style='color:inherit;text-decoration:none;font-weight:inherit;'>$label$arrow</a>";
                            }
                            ?>
                            <div class="header-cell"><?= sort_link('ID', 'id', $sort, $direction) ?></div>
                            <div class="header-cell"><?= sort_link('User', 'user_id', $sort, $direction) ?></div>
                            <div class="header-cell"><?= sort_link('Level', 'level', $sort, $direction) ?></div>
                            <div class="header-cell"><?= sort_link('Reference', 'payment_reference', $sort, $direction) ?></div>
                            <div class="header-cell">Receipt</div>
                            <div class="header-cell"><?= sort_link('Status', 'status', $sort, $direction) ?></div>
                            <div class="header-cell"><?= sort_link('Date', 'created_at', $sort, $direction) ?></div>
                            <div class="header-cell">Actions</div>
                        </div>
                    </div>
                    <div class="table-body">
                        <?php if (empty($payments)): ?>
                            <div class="empty-state">
                                <div class="empty-icon">📋</div>
                                <h3>No Payment Requests</h3>
                                <p>No pending membership upgrade payments found</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($payments as $payment): ?>
                                <div class="table-row">
                                    <div class="table-cell">
                                        <span class="payment-id">#<?= $payment['id'] ?></span>
                                    </div>
                                    <div class="table-cell">
                                        <div class="user-info">
                                            <i class="fas fa-user-circle"></i>
                                            <span class="user-name"><?= esc($payment['user_name'] ?? $payment['user_id']) ?></span>
                                        </div>
                                    </div>
                                    <div class="table-cell">
                                        <?php if ($payment['level'] === 'Gold'): ?>
                                            <span class="level-badge gold">
                                                <i class="fas fa-crown"></i> Gold
                                            </span>
                                        <?php else: ?>
                                            <span class="level-badge silver">
                                                <i class="fas fa-medal"></i> Silver
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="table-cell">
                                        <?php if ($payment['payment_reference']): ?>
                                            <span class="reference"><?= esc($payment['payment_reference']) ?></span>
                                        <?php else: ?>
                                            <span class="no-reference">-</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="table-cell">
                                        <a href="<?= base_url('writable/' . $payment['file_path']) ?>" 
                                           target="_blank" 
                                           class="view-receipt-btn">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                    <div class="table-cell">
                                        <?php if ($payment['status'] === 'pending'): ?>
                                            <span class="status-badge pending">
                                                <i class="fas fa-clock"></i> Pending
                                            </span>
                                        <?php elseif ($payment['status'] === 'approved'): ?>
                                            <span class="status-badge approved">
                                                <i class="fas fa-check"></i> Approved
                                            </span>
                                        <?php else: ?>
                                            <span class="status-badge rejected">
                                                <i class="fas fa-times"></i> Rejected
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="table-cell">
                                        <span class="payment-date">
                                            <?= date('M d, Y H:i', strtotime($payment['created_at'])) ?>
                                        </span>
                                    </div>
                                    <div class="table-cell">
                                        <?php if ($payment['status'] === 'pending'): ?>
                                            <div class="action-buttons">
                                                <form action="<?= base_url('admin/payments/approve/' . $payment['id']) ?>" 
                                                      method="post" 
                                                      style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" 
                                                            class="approve-btn"
                                                            onclick="return confirm('Approve this payment and upgrade user membership?')">
                                                        <i class="fas fa-check"></i> Approve
                                                    </button>
                                                </form>
                                                <form action="<?= base_url('admin/payments/reject/' . $payment['id']) ?>" 
                                                      method="post" 
                                                      style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" 
                                                            class="reject-btn"
                                                            onclick="return confirm('Reject this payment?')">
                                                        <i class="fas fa-times"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        <?php else: ?>
                                            <span class="no-actions">-</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="membership-footer">
            <div class="footer-content">
                <div class="chess-motto">"Excellence in every move, prestige in every game"</div>
                <div class="support-info">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin Control Panel - Elite Chess Club</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 