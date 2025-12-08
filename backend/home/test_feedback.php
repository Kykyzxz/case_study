<?php
header('Content-Type: application/json');

// Enable error display for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

$debug_info = [
    'current_file' => __FILE__,
    'current_dir' => __DIR__,
    'parent_dir' => dirname(__DIR__),
];

try {
    // Try to find and include connection
    $connection_path = "../connection/connect.php";
    $debug_info['connection_path_tried'] = $connection_path;
    $debug_info['connection_file_exists'] = file_exists($connection_path);
    $debug_info['connection_absolute_path'] = realpath($connection_path);
    
    if (!file_exists($connection_path)) {
        throw new Exception("Connection file not found at: " . $connection_path);
    }
    
    require_once $connection_path;
    $debug_info['connection_included'] = true;
    
    // Check connection
    if (!isset($conn)) {
        throw new Exception("Connection object (\$conn) not found after including connect.php");
    }
    
    if ($conn->connect_error) {
        throw new Exception("Database connection error: " . $conn->connect_error);
    }
    
    $debug_info['connection_successful'] = true;
    
    // Try to query feedback table
    $query = "SELECT * FROM feedback ORDER BY id DESC LIMIT 3";
    $debug_info['query'] = $query;
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Query failed: " . $conn->error);
    }
    
    $debug_info['query_successful'] = true;
    $debug_info['num_rows'] = $result->num_rows;
    
    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = $row;
    }
    
    $debug_info['feedbacks_found'] = count($feedbacks);
    
    $conn->close();
    
    echo json_encode([
        'success' => true,
        'debug' => $debug_info,
        'feedbacks' => $feedbacks
    ], JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'debug' => $debug_info
    ], JSON_PRETTY_PRINT);
}
?>