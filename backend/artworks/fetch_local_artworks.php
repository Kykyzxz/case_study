<?php
// fetch_local_artworks.php - Fetch local artworks with likes and comments
session_start();
header('Content-Type: application/json');
ob_start();

ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    // Include database connection
    $connection_paths = [
        "../backend/connection/connect.php",
        "../../backend/connection/connect.php",
        dirname(__DIR__) . "/connection/connect.php",
        "../connection/connect.php"
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
        throw new Exception("Connection file not found");
    }
    
    if (!isset($conn)) {
        throw new Exception("Database connection variable not set");
    }
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Fetch all local artworks with likes and comments count
    $query = "SELECT 
                a.artwork_id, 
                a.artwork_title, 
                a.artist, 
                a.artwork_desc, 
                a.category, 
                a.image,
                (SELECT COUNT(*) FROM artwork_likes l WHERE l.artwork_id = a.artwork_id) as like_count,
                (SELECT COUNT(*) FROM artwork_comments c WHERE c.artwork_id = a.artwork_id) as comment_count
              FROM artwork a 
              WHERE (LOWER(status) = 'local' OR status = 'Local')
              ORDER BY artwork_id DESC";
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Failed to fetch local artworks: " . $conn->error);
    }
    
    // Check if user is logged in
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    $artworks = [];
    while ($row = $result->fetch_assoc()) {
        // Check if current user liked this artwork
        $user_liked = false;
        if ($user_id) {
            $like_check = $conn->prepare("SELECT like_id FROM artwork_likes WHERE artwork_id = ? AND user_id = ?");
            $like_check->bind_param("ii", $row['artwork_id'], $user_id);
            $like_check->execute();
            $like_result = $like_check->get_result();
            $user_liked = $like_result->num_rows > 0;
            $like_check->close();
        }
        
        $artworks[] = [
            'id' => $row['artwork_id'],
            'title' => htmlspecialchars($row['artwork_title'], ENT_QUOTES, 'UTF-8'),
            'artist' => htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars($row['artwork_desc'], ENT_QUOTES, 'UTF-8'),
            'category' => htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'),
            'image' => '../ADMIN/uploads/artworks/' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'),
            'like_count' => (int)$row['like_count'],
            'comment_count' => (int)$row['comment_count'],
            'user_liked' => $user_liked
        ];
    }
    
    $conn->close();
    
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'artworks' => $artworks,
        'total' => count($artworks),
        'logged_in' => $user_id !== null
    ]);
    
} catch (Exception $e) {
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage(),
        'artworks' => [],
        'total' => 0
    ]);
}

exit;
?>