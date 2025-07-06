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
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 5px solid #e8c547;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 160px;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            font-size: 2em;
            margin-bottom: 12px;
            color: #e8c547;
            flex-shrink: 0;
        }
        
        .stat-value {
            font-size: 2em;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            line-height: 1;
            flex-shrink: 0;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        
        .stat-label {
            color: #6c757d;
            font-size: 0.9em;
            font-weight: 500;
            flex-shrink: 0;
            margin-top: auto;
            line-height: 1.2;
        }
        
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .chart-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        
        .chart-title {
            font-size: 1.1em;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
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
                    <div class="chart-container">
                        <canvas id="membershipChart"></canvas>
                    </div>
                </div>
                <div class="chart-card">
                    <h3 class="chart-title">Points Distribution</h3>
                    <div class="chart-container">
                        <canvas id="pointsChart"></canvas>
                    </div>
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
                    borderWidth: 3,
                    borderColor: '#fff',
                    hoverBorderWidth: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 15,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 10,
                        cornerRadius: 6
                    }
                },
                cutout: '60%'
            }
        });

        // Points Distribution Chart
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
                    borderWidth: 2,
                    borderColor: '#fff',
                    borderRadius: 6,
                    borderSkipped: false
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0,0,0,0.1)',
                            lineWidth: 1
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        titleFont: {
                            size: 13,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 12
                        },
                        padding: 10,
                        cornerRadius: 6
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });
    </script>
</body>
</html> 