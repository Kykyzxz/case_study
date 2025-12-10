<?php
session_start();
header('Content-Type: application/json');
ini_set('display_errors', 0);
require_once "../connection/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artwork_id'])) {
    $artwork_id = intval($_POST['artwork_id']);
    
    // Check if this is from admin panel (don't log admin views)
    $is_admin_view = isset($_POST['from_admin']) && $_POST['from_admin'] === 'true';

    $query = "SELECT * FROM artwork WHERE artwork_id = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $artwork_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $artwork = $result->fetch_assoc();
            
            // Only log if NOT from admin panel AND user is logged in
            if (!$is_admin_view && isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                // Get total likes for this artwork
                $like_count_stmt = $conn->prepare("SELECT COUNT(*) as total FROM artwork_likes WHERE artwork_id = ?");
                $like_count_stmt->bind_param("i", $artwork_id);
                $like_count_stmt->execute();
                $like_count_result = $like_count_stmt->get_result();
                $like_count = $like_count_result->fetch_assoc()['total'];
                $like_count_stmt->close();
                
                // Insert log entry
                $log_stmt = $conn->prepare("INSERT INTO artwork_logs (user_id, artwork_id, action_type, action_details, total_likes) VALUES (?, ?, 'view', 'Viewed artwork', ?)");
                $log_stmt->bind_param("iii", $user_id, $artwork_id, $like_count);
                $log_stmt->execute();
                $log_stmt->close();
            }

            echo json_encode([
                'success' => true,
                'data' => [
                    'artwork_id'       => $artwork['artwork_id'],
                    'artwork_title'    => $artwork['artwork_title'],
                    'artist'           => $artwork['artist'],
                    'year_created'     => $artwork['year_created'],
                    'medium'           => $artwork['medium'],
                    'dimension'        => $artwork['dimension'],
                    'category'         => $artwork['category'],
                    'orientation'      => $artwork['orientation'],
                    'status'           => $artwork['status'],
                    'artwork_desc'     => $artwork['artwork_desc'], 
                    'artist_desc'      => $artwork['artist_desc'],
                    'image'            => $artwork['image']
                ]
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Artwork not found'
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database query failed'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request'
    ]);
}

$conn->close();
?>