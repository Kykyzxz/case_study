<?php
// Start output buffering to prevent any accidental output
ob_start();

// Set headers first
header('Content-Type: application/json');

// Turn off error display
ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    // Try different path options for the database connection
    $connection_paths = [
        "../connection/connect.php",
        dirname(__DIR__) . "/connection/connect.php"
    ];
    
    $connection_loaded = false;
    foreach ($connection_paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            $connection_loaded = true;
            break;
        }
    }
    
    if (!$connection_loaded) {
        throw new Exception("Database connection file not found");
    }
    
    // Check if connection was successful
    if (!isset($conn) || $conn->connect_error) {
        throw new Exception("Database connection failed");
    }
    
    // Fetch the latest 3 feedbacks, ordered by most recent using feedback_id
    $query = "SELECT name, feedback_desc FROM feedback ORDER BY feedback_id DESC LIMIT 3";
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Failed to fetch feedback: " . $conn->error);
    }
    
    $feedbacks = [];
    while ($row = $result->fetch_assoc()) {
        $feedbacks[] = [
            'name' => htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'),
            'feedback' => htmlspecialchars($row['feedback_desc'], ENT_QUOTES, 'UTF-8')
        ];
    }
    
    $conn->close();
    
    // Clear output buffer and send success response
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'feedbacks' => $feedbacks,
        'count' => count($feedbacks)
    ]);
    
} catch (Exception $e) {
    // Clear output buffer and send error response
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'feedbacks' => []
    ]);
}

exit;
?>