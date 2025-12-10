<?php
// backend/artworks/get_comments.php - Fetch all comments for an artwork
header('Content-Type: application/json');

require_once '../connection/connect.php';

$artwork_id = isset($_GET['artwork_id']) ? (int)$_GET['artwork_id'] : 0;

if ($artwork_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid artwork ID']);
    exit();
}

try {
    // Fetch comments with user info, ordered by newest first
    $stmt = $conn->prepare("
        SELECT c.comment_id, c.comment_text, c.created_at, u.fullname 
        FROM artwork_comments c 
        JOIN user_acc u ON c.user_id = u.user_id 
        WHERE c.artwork_id = ? 
        ORDER BY c.created_at DESC
    ");
    $stmt->bind_param("i", $artwork_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = [
            'comment_id' => $row['comment_id'],
            'comment_text' => htmlspecialchars($row['comment_text'], ENT_QUOTES, 'UTF-8'),
            'fullname' => htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8'),
            'created_at' => $row['created_at']
        ];
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'comments' => $comments,
        'total' => count($comments)
    ]);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>