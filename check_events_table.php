<?php
// Check events table structure
try {
    $pdo = new PDO('mysql:host=localhost;dbname=chessclub', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'events'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Events table exists.\n";
        
        // Show table structure
        $stmt = $pdo->query("DESCRIBE events");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nEvents table structure:\n";
        foreach ($columns as $column) {
            echo "- {$column['Field']} ({$column['Type']})\n";
        }
        
        // Show sample data
        $stmt = $pdo->query("SELECT * FROM events LIMIT 1");
        $event = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($event) {
            echo "\nSample event data:\n";
            foreach ($event as $key => $value) {
                echo "- $key: $value\n";
            }
        } else {
            echo "\nNo events found in table.\n";
        }
        
    } else {
        echo "✗ Events table does NOT exist.\n";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 