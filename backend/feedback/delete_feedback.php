<?php
// Start session and check authentication
session_start();

// Include database connection
require_once "../connection/connect.php";

// Set JSON header
header('Content-Type: application/json');

// Check if user is logged in (optional - add this if you have authentication)
// if (!isset($_SESSION['admin_id'])) {
//     echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
//     exit();
// }

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

// Check if feedback_id is provided
if (!isset($_POST['feedback_id']) || empty($_POST['feedback_id'])) {
    echo json_encode(['success' => false, 'message' => 'Feedback ID is required']);
    exit();
}

$feedback_id = intval($_POST['feedback_id']);

// Validate feedback_id
if ($feedback_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid feedback ID']);
    exit();
}

try {
    // Check if feedback exists
    $check_query = "SELECT feedback_id FROM feedback WHERE feedback_id = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("i", $feedback_id);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if ($check_result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Feedback not found']);
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();
    
    // Delete feedback from database
    $delete_query = "DELETE FROM feedback WHERE feedback_id = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("i", $feedback_id);
    
    if ($delete_stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Feedback deleted successfully',
            'feedback_id' => $feedback_id
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete feedback: ' . $conn->error]);
    }
    
    $delete_stmt->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

// Close database connection
$conn->close();
?>