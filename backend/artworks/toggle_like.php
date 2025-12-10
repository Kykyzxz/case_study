<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to like artworks']);
    exit();
}

require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$artwork_id = isset($input['artwork_id']) ? (int)$input['artwork_id'] : 0;
$user_id = $_SESSION['user_id'];

if ($artwork_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid artwork ID']);
    exit();
}

try {
    // First check if like exists
    $check = $conn->prepare("SELECT like_id FROM artwork_likes WHERE artwork_id = ? AND user_id = ?");
    $check->bind_param("ii", $artwork_id, $user_id);
    $check->execute();
    $result = $check->get_result();
    $exists = $result->num_rows > 0;
    $check->close();
    
    if ($exists) {
        // Delete like (UNLIKE)
        $stmt = $conn->prepare("DELETE FROM artwork_likes WHERE artwork_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $artwork_id, $user_id);
        $stmt->execute();
        $stmt->close();
        $liked = false;
        $action_type = 'unlike';
    } else {
        // Insert like (LIKE)
        $stmt = $conn->prepare("INSERT INTO artwork_likes (artwork_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $artwork_id, $user_id);
        $stmt->execute();
        $stmt->close();
        $liked = true;
        $action_type = 'like';
    }

    // Get updated like count
    $count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM artwork_likes WHERE artwork_id = ?");
    $count_stmt->bind_param("i", $artwork_id);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $like_count = $count_result->fetch_assoc()['total'];
    $count_stmt->close();
    
    // ⭐ LOG THE ACTION ⭐
    // Get artwork title for action details
    $artwork_stmt = $conn->prepare("SELECT artwork_title FROM artwork WHERE artwork_id = ?");
    $artwork_stmt->bind_param("i", $artwork_id);
    $artwork_stmt->execute();
    $artwork_result = $artwork_stmt->get_result();
    $artwork_data = $artwork_result->fetch_assoc();
    $artwork_title = $artwork_data['artwork_title'];
    $artwork_stmt->close();
    
    // Insert log entry
    $log_stmt = $conn->prepare("INSERT INTO artwork_logs (user_id, artwork_id, action_type, action_details, total_likes) VALUES (?, ?, ?, ?, ?)");
    $action_details = $liked ? "Liked artwork" : "Unliked artwork";
    $log_stmt->bind_param("iissi", $user_id, $artwork_id, $action_type, $action_details, $like_count);
    $log_stmt->execute();
    $log_stmt->close();
    
    echo json_encode([
        'success' => true,
        'liked' => $liked,
        'like_count' => $like_count,
        'message' => $liked ? 'Artwork liked' : 'Artwork unliked'
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>