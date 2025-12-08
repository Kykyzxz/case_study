<?php
// Start output buffering to prevent any accidental output
ob_start();

// Set headers first
header('Content-Type: application/json');

// Turn off error display (errors will be logged instead)
ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    // Include database connection
    if (!file_exists("../connection/connect.php")) {
        throw new Exception("Database connection file not found");
    }
    
    require_once "../connection/connect.php";
    
    // Check if connection was successful
    if (!isset($conn) || $conn->connect_error) {
        throw new Exception("Database connection failed: " . ($conn->connect_error ?? 'Connection object not found'));
    }
    
    // Check if form is submitted via POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Invalid request method");
    }
    
    // Get form data and sanitize
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $feedback_desc = trim($_POST['feedback'] ?? '');
    
    // Validate inputs
    if (empty($name)) {
        throw new Exception("Name is required");
    }
    
    if (empty($email)) {
        throw new Exception("Email is required");
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format");
    }
    
    if (empty($feedback_desc)) {
        throw new Exception("Feedback is required");
    }
    
    // Insert feedback into database
    $insert_query = "INSERT INTO feedback (name, email, feedback_desc) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    
    if (!$stmt) {
        throw new Exception("Failed to prepare statement: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $name, $email, $feedback_desc);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute statement: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
    
    // Clear any output buffer and send success response
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your feedback! We appreciate your input.'
    ]);
    
} catch (Exception $e) {
    // Clear any output buffer and send error response
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

exit;
?>