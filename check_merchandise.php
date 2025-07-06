<?php
// Check merchandise table status
try {
    $pdo = new PDO('mysql:host=localhost;dbname=chessclub', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'merchandise'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Merchandise table exists.\n";
        
        // Check record count
        $stmt = $pdo->query("SELECT COUNT(*) FROM merchandise");
        $count = $stmt->fetchColumn();
        echo "✓ Merchandise table has $count records.\n";
        
        // Show all data
        $stmt = $pdo->query("SELECT id, name, image, is_available FROM merchandise");
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nAll merchandise data:\n";
        foreach ($items as $item) {
            $image = $item['image'] ?? 'NULL';
            echo "- ID: {$item['id']}, Name: {$item['name']}, Image: {$image}, Available: {$item['is_available']}\n";
        }
        
    } else {
        echo "✗ Merchandise table does NOT exist.\n";
        echo "Please run the SQL script to create the table.\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 