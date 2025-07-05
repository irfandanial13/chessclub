<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard Analytics</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .analytics-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .analytics-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .analytics-title {
            font-size: 2.5em;
            color: #2c3e50;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .analytics-subtitle {
            color: #6c757d;
            font-size: 1.1em;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 5px solid #e8c547;
            transition: transform 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2.5em;
            margin-bottom: 15px;
            color: #e8c547;
        }
        
        .stat-value {
            font-size: 2.5em;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 1em;
            font-weight: 500;
        }
        
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .chart-title {
            font-size: 1.3em;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .top-performers {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .performers-title {
            font-size: 1.5em;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .performer-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 10px;
            background: #f8f9fa;
            border-radius: 10px;
            transition: background 0.2s;
        }
        
        .performer-item:hover {
            background: #e9ecef;
        }
        
        .performer-rank {
            font-size: 1.2em;
            font-weight: 700;
            color: #e8c547;
            min-width: 40px;
        }
        
        .performer-info {
            flex: 1;
            margin-left: 15px;
        }
        
        .performer-name {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .performer-level {
            font-size: 0.9em;
            color: #6c757d;
        }
        
        .performer-points {
            font-weight: 700;
            color: #27ae60;
            font-size: 1.1em;
        }
        
        .back-btn {
            display: inline-block;
            padding: 12px 25px;
            background: #e8c547;
            color: #2c1810;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
            margin-bottom: 20px;
        }
        
        .back-btn:hover {
            background: #d4b03a;
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .analytics-title {
                font-size: 2em;
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

    <div class="auth-container">
        <a href="<?= base_url('admin/leaderboard') ?>" class="back-btn">
            <i class="fas fa-arrow-left"></i> Back to Leaderboard
        </a>
        
        <div class="analytics-container">
            <div class="analytics-header">
                <h1 class="analytics-title"><i class="fas fa-chart-line"></i> Leaderboard Analytics</h1>
                <p class="analytics-subtitle">Comprehensive insights into your chess club's performance metrics</p>
            </div>

            <!-- Statistics Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-value"><?= $totalUsers ?></div>
                    <div class="stat-label">Total Active Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🏆</div>
                    <div class="stat-value"><?= number_format($totalPoints) ?></div>
                    <div class="stat-label">Total Honor Points</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📊</div>
                    <div class="stat-value"><?= $avgPoints ?></div>
                    <div class="stat-label">Average Points per Member</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🥇</div>
                    <div class="stat-value"><?= $goldUsers ?></div>
                    <div class="stat-label">Gold Level Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🥈</div>
                    <div class="stat-value"><?= $silverUsers ?></div>
                    <div class="stat-label">Silver Level Members</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🥉</div>
                    <div class="stat-value"><?= $bronzeUsers ?></div>
                    <div class="stat-label">Bronze Level Members</div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card">
                    <h3 class="chart-title">Membership Level Distribution</h3>
                    <canvas id="membershipChart" width="400" height="300"></canvas>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">Points Distribution</h3>
                    <canvas id="pointsChart" width="400" height="300"></canvas>
                </div>
            </div>

            <!-- Top Performers -->
            <div class="top-performers">
                <h3 class="performers-title"><i class="fas fa-trophy"></i> Top 10 Performers</h3>
                <?php foreach ($topUsers as $index => $user): ?>
                <div class="performer-item">
                    <div class="performer-rank">
                        <?php if ($index == 0): ?>🥇
                        <?php elseif ($index == 1): ?>🥈
                        <?php elseif ($index == 2): ?>🥉
                        <?php else: echo $index + 1; endif; ?>
                    </div>
                    <div class="performer-info">
                        <div class="performer-name"><?= esc($user['name']) ?></div>
                        <div class="performer-level"><?= esc($user['membership_level']) ?> Level</div>
                    </div>
                    <div class="performer-points"><?= number_format($user['honor_points'] ?? 0) ?> pts</div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        // Membership Level Distribution Chart
        const membershipCtx = document.getElementById('membershipChart').getContext('2d');
        new Chart(membershipCtx, {
            type: 'doughnut',
            data: {
                labels: ['Gold', 'Silver', 'Bronze'],
                datasets: [{
                    data: [<?= $goldUsers ?>, <?= $silverUsers ?>, <?= $bronzeUsers ?>],
                    backgroundColor: [
                        '#FFD700',
                        '#C0C0C0',
                        '#CD7F32'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        // Points Distribution Chart (simplified - you can enhance this with actual data)
        const pointsCtx = document.getElementById('pointsChart').getContext('2d');
        new Chart(pointsCtx, {
            type: 'bar',
            data: {
                labels: ['0-100', '101-500', '501-1000', '1000+'],
                datasets: [{
                    label: 'Number of Members',
                    data: [
                        <?= count(array_filter($topUsers, fn($u) => ($u['honor_points'] ?? 0) <= 100)) ?>,
                        <?= count(array_filter($topUsers, fn($u) => ($u['honor_points'] ?? 0) > 100 && ($u['honor_points'] ?? 0) <= 500)) ?>,
                        <?= count(array_filter($topUsers, fn($u) => ($u['honor_points'] ?? 0) > 500 && ($u['honor_points'] ?? 0) <= 1000)) ?>,
                        <?= count(array_filter($topUsers, fn($u) => ($u['honor_points'] ?? 0) > 1000)) ?>
                    ],
                    backgroundColor: [
                        '#e74c3c',
                        '#f39c12',
                        '#3498db',
                        '#27ae60'
                    ],
                    borderWidth: 1,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>
</html> 