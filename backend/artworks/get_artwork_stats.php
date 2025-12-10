<?php
// backend/artworks/get_artwork_stats.php - Get like count, comment count, and user's like status
session_start();
header('Content-Type: application/json');

require_once '../connection/connect.php';

$artwork_id = isset($_GET['artwork_id']) ? (int)$_GET['artwork_id'] : 0;

if ($artwork_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid artwork ID']);
    exit();
}

try {
    // Get like count
    $like_stmt = $conn->prepare("SELECT COUNT(*) as total FROM artwork_likes WHERE artwork_id = ?");
    $like_stmt->bind_param("i", $artwork_id);
    $like_stmt->execute();
    $like_result = $like_stmt->get_result();
    $like_count = $like_result->fetch_assoc()['total'];
    $like_stmt->close();
    
    // Get comment count
    $comment_stmt = $conn->prepare("SELECT COUNT(*) as total FROM artwork_comments WHERE artwork_id = ?");
    $comment_stmt->bind_param("i", $artwork_id);
    $comment_stmt->execute();
    $comment_result = $comment_stmt->get_result();
    $comment_count = $comment_result->fetch_assoc()['total'];
    $comment_stmt->close();
    
    // Check if current user liked this artwork (if logged in)
    $user_liked = false;
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];
        $user_like_stmt = $conn->prepare("SELECT like_id FROM artwork_likes WHERE artwork_id = ? AND user_id = ?");
        $user_like_stmt->bind_param("ii", $artwork_id, $user_id);
        $user_like_stmt->execute();
        $user_like_result = $user_like_stmt->get_result();
        $user_liked = $user_like_result->num_rows > 0;
        $user_like_stmt->close();
    }
    
    echo json_encode([
        'success' => true,
        'like_count' => $like_count,
        'comment_count' => $comment_count,
        'user_liked' => $user_liked,
        'logged_in' => isset($_SESSION['user_id'])
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>