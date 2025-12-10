<?php
header('Content-Type: application/json');
require_once '../connection/connect.php';

try {
    // Query to get artwork logs with user and artwork details
    $query = "
        SELECT 
            al.log_id,
            al.user_id,
            al.artwork_id,
            al.action_type,
            al.action_details,
            al.total_likes,
            al.created_at,
            u.fullname,
            a.artwork_title,
            a.image as artwork_image
        FROM artwork_logs al
        INNER JOIN user_acc u ON al.user_id = u.user_id
        INNER JOIN artwork a ON al.artwork_id = a.artwork_id
        ORDER BY al.created_at DESC
        LIMIT 15
    ";
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception('Database query failed: ' . $conn->error);
    }
    
    $logs = [];
    while ($row = $result->fetch_assoc()) {
        $logs[] = [
            'log_id' => $row['log_id'],
            'user_id' => $row['user_id'],
            'artwork_id' => $row['artwork_id'],
            'action_type' => $row['action_type'],
            'action_details' => $row['action_details'],
            'total_likes' => (int)$row['total_likes'],
            'created_at' => $row['created_at'],
            'fullname' => $row['fullname'],
            'artwork_title' => $row['artwork_title'],
            'artwork_image' => $row['artwork_image']
        ];
    }
    
    echo json_encode([
        'success' => true,
        'logs' => $logs,
        'total' => count($logs)
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'logs' => []
    ]);
}

$conn->close();
?>