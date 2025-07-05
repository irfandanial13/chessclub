<!DOCTYPE html>
<html>
<head>
    <title>Manage Leaderboard</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .admin-controls {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .control-row {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }
        
        .control-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .control-group label {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9em;
        }
        
        .control-group select,
        .control-group input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9em;
        }
        
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-left: 4px solid #e8c547;
        }
        
        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9em;
            font-weight: 500;
        }
        
        .action-btn {
            display: inline-block;
            width: 25px;
            height: 20px;
            border-radius: 3px;
            text-decoration: none;
            text-align: center;
            line-height: 20px;
            margin: 0 2px;
            transition: all 0.2s ease;
            font-size: 12px;
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
        
        .points-btn {
            background: #27ae60;
            color: white;
        }
        
        .points-btn:hover {
            background: #229954;
        }
        
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2em;
            height: 2em;
            border-radius: 50%;
            font-size: 1.2em;
            font-weight: bold;
            margin-right: 8px;
        }
        
        .gold-badge { background: linear-gradient(135deg, #ffe066 60%, #ffd700 100%); color: #bfa100; }
        .silver-badge { background: linear-gradient(135deg, #e0e0e0 60%, #bfc1c2 100%); color: #7d7d7d; }
        .bronze-badge { background: linear-gradient(135deg, #f8e6d0 60%, #cd7f32 100%); color: #8c5a2b; }
        
        .points-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .points-modal.show {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: 12px;
            padding: 30px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 1.3em;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .close-btn {
            background: none;
            border: none;
            font-size: 1.5em;
            cursor: pointer;
            color: #6c757d;
        }
        
        .form-group {
            margin-bottom: 15px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 0.9em;
        }
        
        .form-group textarea {
            height: 80px;
            resize: vertical;
        }
        
        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
        }
        
        .bulk-actions {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }
        
        .bulk-actions h4 {
            margin: 0 0 10px 0;
            color: #856404;
        }
        
        .bulk-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        
        .bulk-form input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            width: 120px;
        }
        
        .bulk-form button {
            padding: 8px 16px;
            background: #e8c547;
            color: #2c1810;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        
        .bulk-form button:hover {
            background: #d4b03a;
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
        <h2><i class="fas fa-trophy"></i> Manage Leaderboard</h2>
        
        <!-- Statistics Cards -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-value"><?= $totalUsers ?></div>
                <div class="stat-label">Total Members</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= array_sum(array_column($users, 'honor_points')) ?></div>
                <div class="stat-label">Total Points</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= count(array_filter($users, fn($u) => $u['membership_level'] === 'Gold')) ?></div>
                <div class="stat-label">Gold Members</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= count(array_filter($users, fn($u) => $u['membership_level'] === 'Silver')) ?></div>
                <div class="stat-label">Silver Members</div>
            </div>
        </div>

        <!-- Admin Controls -->
        <div class="admin-controls">
            <div class="control-row">
                <div class="control-group">
                    <label>Filter by Level:</label>
                    <select id="levelFilter" onchange="filterTable()">
                        <option value="">All Levels</option>
                        <?php foreach ($membershipLevels as $level): ?>
                            <option value="<?= $level ?>"><?= $level ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="control-group">
                    <label>Search User:</label>
                    <input type="text" id="searchInput" placeholder="Enter name..." onkeyup="filterTable()">
                </div>
                <div class="control-group">
                    <label>Sort by:</label>
                    <select id="sortBy" onchange="filterTable()">
                        <option value="honor_points">Points</option>
                        <option value="name">Name</option>
                        <option value="membership_level">Level</option>
                    </select>
                </div>
            </div>
            
            <div class="control-row">
                <a href="<?= base_url('admin/leaderboard/analytics') ?>" class="elite-button">
                    <i class="fas fa-chart-bar"></i> Analytics
                </a>
                <a href="<?= base_url('admin/leaderboard/export') ?>" class="elite-button">
                    <i class="fas fa-download"></i> Export CSV
                </a>
                <button onclick="showBulkActions()" class="elite-button">
                    <i class="fas fa-users"></i> Bulk Actions
                </button>
                <button onclick="resetLeaderboard()" class="elite-button" style="background: #e74c3c;">
                    <i class="fas fa-redo"></i> Reset All Points
                </button>
            </div>
        </div>

        <!-- Bulk Actions Panel -->
        <div id="bulkActions" class="bulk-actions" style="display: none;">
            <h4><i class="fas fa-users"></i> Bulk Point Adjustment</h4>
            <div class="bulk-form">
                <input type="number" id="bulkPoints" placeholder="Points to add/subtract">
                <textarea id="bulkReason" placeholder="Reason for adjustment"></textarea>
                <button onclick="applyBulkPoints()">Apply to All</button>
                <button onclick="hideBulkActions()" style="background: #6c757d;">Cancel</button>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="success-message"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <!-- Leaderboard Table -->
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; background:#faf8f6; border-radius:8px; box-shadow:0 2px 8px rgba(0,0,0,0.04); color:#222; font-size:1.08em;">
                <thead style="background:#f5e9d7;">
                    <tr>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Rank</th>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Name</th>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Email</th>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Level</th>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Points</th>
                        <th style="font-weight:700; color:#5A3A13; padding:14px 8px;">Actions</th>
                    </tr>
                </thead>
                <tbody id="leaderboardTable">
                    <?php foreach ($users as $i => $user): ?>
                    <tr style="text-align:center; background:<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>; transition:background 0.2s;" 
                        onmouseover="this.style.background='#fbeedc'" 
                        onmouseout="this.style.background='<?= $i%2==0 ? '#fff' : '#f7f1ea' ?>'"
                        data-level="<?= strtolower($user['membership_level']) ?>"
                        data-name="<?= strtolower($user['name']) ?>">
                        <td style="padding:12px 8px;">
                            <?php if ($user['rank'] == 1): ?>
                                <span class="rank-badge gold-badge">🥇</span>
                            <?php elseif ($user['rank'] == 2): ?>
                                <span class="rank-badge silver-badge">🥈</span>
                            <?php elseif ($user['rank'] == 3): ?>
                                <span class="rank-badge bronze-badge">🥉</span>
                            <?php else: ?>
                                <?= $user['rank'] ?>
                            <?php endif; ?>
                        </td>
                        <td style="padding:12px 8px;"><?= esc($user['name']) ?></td>
                        <td style="padding:12px 8px;"><?= esc($user['email']) ?></td>
                        <td style="padding:12px 8px;">
                            <span class="badge <?= strtolower($user['membership_level']) ?>">
                                <?= esc($user['membership_level']) ?>
                            </span>
                        </td>
                        <td style="padding:12px 8px;" id="points-<?= $user['id'] ?>"><?= esc($user['honor_points'] ?? 0) ?></td>
                        <td style="padding:12px 8px;">
                            <a href="#" onclick="showPointsModal(<?= $user['id'] ?>, '<?= esc($user['name']) ?>', <?= $user['honor_points'] ?? 0 ?>)" 
                               class="action-btn points-btn" title="Adjust Points">
                                <i class="fas fa-plus-minus"></i>
                            </a>
                            <a href="<?= base_url('admin/users/edit/'.$user['id']) ?>" 
                               class="action-btn edit-btn" title="Edit User">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Points Adjustment Modal -->
    <div id="pointsModal" class="points-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Adjust Points</h3>
                <button class="close-btn" onclick="closePointsModal()">&times;</button>
            </div>
            <form id="pointsForm">
                <input type="hidden" id="userId" name="userId">
                <div class="form-group">
                    <label>User:</label>
                    <input type="text" id="userName" readonly>
                </div>
                <div class="form-group">
                    <label>Current Points:</label>
                    <input type="number" id="currentPoints" readonly>
                </div>
                <div class="form-group">
                    <label>Points Adjustment (+/-):</label>
                    <input type="number" id="pointsAdjustment" name="points" required placeholder="e.g., 10 or -5">
                </div>
                <div class="form-group">
                    <label>Reason:</label>
                    <textarea id="adjustmentReason" name="reason" placeholder="Reason for this adjustment"></textarea>
                </div>
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closePointsModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Points</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function filterTable() {
            const levelFilter = document.getElementById('levelFilter').value.toLowerCase();
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const sortBy = document.getElementById('sortBy').value;
            
            const rows = document.querySelectorAll('#leaderboardTable tr');
            
            rows.forEach(row => {
                const level = row.getAttribute('data-level');
                const name = row.getAttribute('data-name');
                
                const levelMatch = !levelFilter || level === levelFilter;
                const nameMatch = !searchInput || name.includes(searchInput);
                
                row.style.display = levelMatch && nameMatch ? '' : 'none';
            });
        }
        
        function showPointsModal(userId, userName, currentPoints) {
            document.getElementById('userId').value = userId;
            document.getElementById('userName').value = userName;
            document.getElementById('currentPoints').value = currentPoints;
            document.getElementById('pointsModal').classList.add('show');
        }
        
        function closePointsModal() {
            document.getElementById('pointsModal').classList.remove('show');
            document.getElementById('pointsForm').reset();
        }
        
        document.getElementById('pointsForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const userId = document.getElementById('userId').value;
            const points = document.getElementById('pointsAdjustment').value;
            const reason = document.getElementById('adjustmentReason').value;
            
            fetch(`<?= base_url('admin/leaderboard/update-points/') ?>${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `points=${points}&reason=${encodeURIComponent(reason)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById(`points-${userId}`).textContent = data.newPoints;
                    closePointsModal();
                    alert('Points updated successfully!');
                    location.reload(); // Refresh to update rankings
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while updating points.');
            });
        });
        
        function showBulkActions() {
            document.getElementById('bulkActions').style.display = 'block';
        }
        
        function hideBulkActions() {
            document.getElementById('bulkActions').style.display = 'none';
        }
        
        function applyBulkPoints() {
            const points = document.getElementById('bulkPoints').value;
            const reason = document.getElementById('bulkReason').value;
            
            if (!points) {
                alert('Please enter points to adjust.');
                return;
            }
            
            if (confirm(`Are you sure you want to ${points > 0 ? 'add' : 'subtract'} ${Math.abs(points)} points to all users?`)) {
                // This would need to be implemented in the controller
                alert('Bulk points adjustment feature will be implemented.');
            }
        }
        
        function resetLeaderboard() {
            if (confirm('Are you sure you want to reset ALL points to 0? This action cannot be undone!')) {
                window.location.href = '<?= base_url('admin/leaderboard/reset') ?>';
            }
        }
        
        // Close modal when clicking outside
        document.getElementById('pointsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePointsModal();
            }
        });
    </script>
</body>
</html> 