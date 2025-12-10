<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Please login to comment']);
    exit();
}

require_once '../connection/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);
$artwork_id = isset($input['artwork_id']) ? (int)$input['artwork_id'] : 0;
$comment_text = isset($input['comment_text']) ? trim($input['comment_text']) : '';
$user_id = $_SESSION['user_id'];

if ($artwork_id <= 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid artwork ID']);
    exit();
}

if (empty($comment_text)) {
    echo json_encode(['success' => false, 'message' => 'Comment cannot be empty']);
    exit();
}

if (strlen($comment_text) > 1000) {
    echo json_encode(['success' => false, 'message' => 'Comment is too long (max 1000 characters)']);
    exit();
}

try {
    $user_stmt = $conn->prepare("SELECT fullname FROM user_acc WHERE user_id = ?");
    $user_stmt->bind_param("i", $user_id);
    $user_stmt->execute();
    $user_result = $user_stmt->get_result();
    $user_data = $user_result->fetch_assoc();
    $fullname = $user_data['fullname'];
    $user_stmt->close();
    
    // Insert comment
    $stmt = $conn->prepare("INSERT INTO artwork_comments (artwork_id, user_id, comment_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $artwork_id, $user_id, $comment_text);
    
    if ($stmt->execute()) {
        $comment_id = $conn->insert_id;
        $created_at = date('Y-m-d H:i:s'); // Use current timestamp
        
 
        echo json_encode([
            'success' => true,
            'message' => 'Comment posted successfully',
            'comment' => [
                'comment_id' => $comment_id,
                'comment_text' => htmlspecialchars($comment_text),
                'fullname' => htmlspecialchars($fullname),
                'created_at' => $created_at
            ]
        ]);
    } else {
        throw new Exception('Failed to post comment');
    }
    
    $stmt->close();
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

$conn->close();
?>