<?php
// Simple database setup for orders table
$host = 'localhost';
$dbname = 'chessclub';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "<h2>Orders Database Setup</h2>";
    echo "✅ Database connection successful!<br><br>";
    
    // Create orders table if it doesn't exist
    $createTableSQL = "CREATE TABLE IF NOT EXISTS `orders` (
        `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
        `order_number` varchar(50) NOT NULL,
        `user_id` int(11) unsigned NOT NULL,
        `product_name` varchar(255) NOT NULL,
        `quantity` int(11) NOT NULL DEFAULT '1',
        `unit_price` decimal(10,2) NOT NULL,
        `total_amount` decimal(10,2) NOT NULL,
        `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
        `payment_method` varchar(50) DEFAULT NULL,
        `shipping_address` text,
        `order_date` datetime NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL,
        PRIMARY KEY (`id`),
        UNIQUE KEY `order_number` (`order_number`),
        KEY `user_id` (`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    
    $pdo->exec($createTableSQL);
    echo "✅ Orders table created successfully!<br>";
    
    // Check if table has data
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM orders");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($count == 0) {
        // Insert sample orders
        $sampleOrders = [
            [
                'order_number' => 'ORD-2024-001',
                'user_id' => 1,
                'product_name' => 'Chess Club T-Shirt',
                'quantity' => 2,
                'unit_price' => 25.00,
                'total_amount' => 50.00,
                'status' => 'delivered',
                'payment_method' => 'credit_card',
                'shipping_address' => '123 Main St, Kuala Lumpur, Malaysia',
                'order_date' => '2024-01-15 10:30:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'order_number' => 'ORD-2024-002',
                'user_id' => 2,
                'product_name' => 'Professional Chess Set',
                'quantity' => 1,
                'unit_price' => 40.00,
                'total_amount' => 40.00,
                'status' => 'shipped',
                'payment_method' => 'bank_transfer',
                'shipping_address' => '456 Oak Ave, Petaling Jaya, Malaysia',
                'order_date' => '2024-01-16 14:20:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'order_number' => 'ORD-2024-003',
                'user_id' => 3,
                'product_name' => 'Chess Strategy Book',
                'quantity' => 1,
                'unit_price' => 18.50,
                'total_amount' => 18.50,
                'status' => 'processing',
                'payment_method' => 'credit_card',
                'shipping_address' => '789 Pine Rd, Shah Alam, Malaysia',
                'order_date' => '2024-01-17 09:15:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'order_number' => 'ORD-2024-004',
                'user_id' => 1,
                'product_name' => 'Chess Club Mug',
                'quantity' => 3,
                'unit_price' => 12.00,
                'total_amount' => 36.00,
                'status' => 'pending',
                'payment_method' => 'cash',
                'shipping_address' => '123 Main St, Kuala Lumpur, Malaysia',
                'order_date' => '2024-01-18 16:45:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'order_number' => 'ORD-2024-005',
                'user_id' => 4,
                'product_name' => 'Chess Clock',
                'quantity' => 1,
                'unit_price' => 35.00,
                'total_amount' => 35.00,
                'status' => 'pending',
                'payment_method' => 'credit_card',
                'shipping_address' => '321 Elm St, Subang Jaya, Malaysia',
                'order_date' => '2024-01-19 11:30:00',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        
        $insertSQL = "INSERT INTO orders (order_number, user_id, product_name, quantity, unit_price, total_amount, status, payment_method, shipping_address, order_date, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($insertSQL);
        
        foreach ($sampleOrders as $order) {
            $stmt->execute([
                $order['order_number'],
                $order['user_id'],
                $order['product_name'],
                $order['quantity'],
                $order['unit_price'],
                $order['total_amount'],
                $order['status'],
                $order['payment_method'],
                $order['shipping_address'],
                $order['order_date'],
                $order['created_at'],
                $order['updated_at']
            ]);
        }
        
        echo "✅ Inserted " . count($sampleOrders) . " sample orders.<br>";
    } else {
        echo "✅ Orders table already has {$count} orders.<br>";
    }
    
    // Show sample orders
    $stmt = $pdo->query("SELECT order_number, product_name, total_amount, status, order_date FROM orders LIMIT 5");
    echo "<br><strong>Sample Orders:</strong><br>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "- {$row['order_number']}: {$row['product_name']} (RM{$row['total_amount']}) - Status: {$row['status']} - Date: {$row['order_date']}<br>";
    }
    
    echo "<br><a href='/admin/orders' style='background:#e8c547; color:#23272f; padding:10px 20px; text-decoration:none; border-radius:5px;'>Go to Admin Orders</a>";
    
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage();
}
?> 