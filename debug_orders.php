<?php
// Debug script to check orders table and test order creation
require_once 'vendor/autoload.php';

// Initialize CodeIgniter
$app = require_once 'app/Config/Paths.php';
$paths = new \Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require_once $bootstrap;

try {
    $db = \Config\Database::connect();
    
    echo "<h2>Orders Table Structure:</h2>";
    $result = $db->query("DESCRIBE orders");
    $columns = $result->getResultArray();
    
    echo "<table border='1'>";
    echo "<tr><th>Column</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    foreach ($columns as $column) {
        echo "<tr>";
        echo "<td>" . $column['Field'] . "</td>";
        echo "<td>" . $column['Type'] . "</td>";
        echo "<td>" . $column['Null'] . "</td>";
        echo "<td>" . $column['Key'] . "</td>";
        echo "<td>" . $column['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Recent Orders:</h2>";
    $orders = $db->query("SELECT * FROM orders ORDER BY created_at DESC LIMIT 5")->getResultArray();
    
    if (empty($orders)) {
        echo "<p>No orders found in database.</p>";
    } else {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>User ID</th><th>Total</th><th>Payment Method</th><th>Status</th><th>Created</th></tr>";
        foreach ($orders as $order) {
            echo "<tr>";
            echo "<td>" . $order['id'] . "</td>";
            echo "<td>" . $order['user_id'] . "</td>";
            echo "<td>" . $order['total'] . "</td>";
            echo "<td>" . ($order['payment_method'] ?? 'N/A') . "</td>";
            echo "<td>" . ($order['status'] ?? 'N/A') . "</td>";
            echo "<td>" . $order['created_at'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (Exception $e) {
    echo "<h2>Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
}
?> 