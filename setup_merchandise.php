<?php
// Simple setup script for merchandise table
// Run this in your browser or via command line

// Database configuration
$host = 'localhost';
$dbname = 'chessclub';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Create merchandise table
    $sql = "CREATE TABLE IF NOT EXISTS merchandise (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255),
        is_available BOOLEAN DEFAULT TRUE,
        stock_quantity INT(11) DEFAULT 0,
        created_at DATETIME NOT NULL,
        updated_at DATETIME NOT NULL
    )";
    
    $pdo->exec($sql);
    echo "Merchandise table created successfully.\n";
    
    // Check if table is empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM merchandise");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        // Insert sample data
        $sampleData = [
            [
                'name' => 'Chess Club T-Shirt',
                'description' => 'Premium cotton T-shirt with exclusive Chess Club design. Available in various sizes.',
                'price' => 25.00,
                'image' => '/images/merch_tshirt.jpg',
                'is_available' => 1,
                'stock_quantity' => 50,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Mug',
                'description' => 'Ceramic mug featuring elegant chess piece design. Perfect for coffee or tea.',
                'price' => 12.00,
                'image' => '/images/merch_mug.jpg',
                'is_available' => 1,
                'stock_quantity' => 30,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Set',
                'description' => 'Classic wooden chess set for club members. Includes board and pieces.',
                'price' => 40.00,
                'image' => '/images/merch_set.jpg',
                'is_available' => 1,
                'stock_quantity' => 20,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Club Cap',
                'description' => 'Stylish cap with embroidered Chess Club logo. Adjustable fit.',
                'price' => 15.00,
                'image' => '/images/merch_cap.jpg',
                'is_available' => 1,
                'stock_quantity' => 25,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Timer',
                'description' => 'Digital chess timer for tournament play. Easy to use and reliable.',
                'price' => 35.00,
                'image' => '/images/merch_timer.jpg',
                'is_available' => 0,
                'stock_quantity' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Chess Strategy Book',
                'description' => 'Comprehensive guide to chess strategies and tactics for all levels.',
                'price' => 18.00,
                'image' => '/images/merch_book.jpg',
                'is_available' => 1,
                'stock_quantity' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];
        
        $stmt = $pdo->prepare("INSERT INTO merchandise (name, description, price, image, is_available, stock_quantity, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($sampleData as $data) {
            $stmt->execute([
                $data['name'],
                $data['description'],
                $data['price'],
                $data['image'],
                $data['is_available'],
                $data['stock_quantity'],
                $data['created_at'],
                $data['updated_at']
            ]);
        }
        
        echo "Sample merchandise data inserted successfully.\n";
    } else {
        echo "Merchandise table already contains data.\n";
    }
    
    echo "Setup completed successfully!\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 