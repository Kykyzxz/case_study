<?php
// backend/artworks/log_artwork_view.php - Log when user views an artwork
session_start();
header('Content-Type: application/json');

require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$artwork_id = isset($input['artwork_id']) ? (int)$input['artwork_id'] : 0;

// Check if this is from admin panel - DON'T LOG ADMIN VIEWS
$from_admin = isset($input['from_admin']) && $input['from_admin'] === true;

if ($from_admin) {
    echo json_encode(['success' => true, 'logged' => false, 'message' => 'View not logged (admin view)']);
    exit();
}

// Allow viewing even if not logged in, but only log if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => true, 'logged' => false, 'message' => 'View not logged (user not logged in)']);
    exit();
}

$user_id = $_SESSION['user_id'];

if ($artwork_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid artwork ID']);
    exit();
}

try {
    // Get artwork title
    $artwork_stmt = $conn->prepare("SELECT artwork_title FROM artwork WHERE artwork_id = ?");
    $artwork_stmt->bind_param("i", $artwork_id);
    $artwork_stmt->execute();
    $artwork_result = $artwork_stmt->get_result();
    
    if ($artwork_result->num_rows === 0) {
        echo json_encode(['success' => false, 'message' => 'Artwork not found']);
        exit();
    }
    
    $artwork_data = $artwork_result->fetch_assoc();
    $artwork_title = $artwork_data['artwork_title'];
    $artwork_stmt->close();
    
    // Get current like count
    $like_count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM artwork_likes WHERE artwork_id = ?");
    $like_count_stmt->bind_param("i", $artwork_id);
    $like_count_stmt->execute();
    $like_result = $like_count_stmt->get_result();
    $like_count = $like_result->fetch_assoc()['total'];
    $like_count_stmt->close();
    
    // Insert log entry
    $log_stmt = $conn->prepare("INSERT INTO artwork_logs (user_id, artwork_id, action_type, action_details, total_likes) VALUES (?, ?, 'view', 'Viewed artwork', ?)");
    $log_stmt->bind_param("iii", $user_id, $artwork_id, $like_count);
    $log_stmt->execute();
    $log_stmt->close();
    
    echo json_encode([
        'success' => true,
        'logged' => true,
        'message' => 'View logged successfully'
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>