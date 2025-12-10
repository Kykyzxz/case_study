<?php
// fetch_artworks.php - Fetch national/featured artworks with filtering, pagination, likes and comments
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
        "../connection/connect.php",
        "../ADMIN/backend/connection/connect.php"
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
    
    // Get filter parameters
    $category = isset($_GET['category']) ? trim($_GET['category']) : '';
    $artist = isset($_GET['artist']) ? trim($_GET['artist']) : '';
    $sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'latest';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 12;
    $offset = ($page - 1) * $limit;
    
    // Build WHERE clause
    $where = "WHERE (LOWER(status) = 'national' OR status = 'National')";
    $params = [];
    $types = '';
    
    if (!empty($category)) {
        $where .= " AND category = ?";
        $params[] = $category;
        $types .= 's';
    }
    
    if (!empty($artist)) {
        $where .= " AND artist LIKE ?";
        $params[] = "%{$artist}%";
        $types .= 's';
    }
    
    // Build ORDER BY clause
    switch ($sort) {
        case 'oldest':
            $orderBy = "ORDER BY year_created ASC";
            break;
        case 'a-z':
            $orderBy = "ORDER BY artwork_title ASC";
            break;
        case 'z-a':
            $orderBy = "ORDER BY artwork_title DESC";
            break;
        case 'latest':
        default:
            $orderBy = "ORDER BY year_created DESC";
            break;
    }
    
    // Get total count
    $countQuery = "SELECT COUNT(*) as total FROM artwork {$where}";
    if (!empty($params)) {
        $countStmt = $conn->prepare($countQuery);
        if (!$countStmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $countStmt->bind_param($types, ...$params);
        $countStmt->execute();
        $countResult = $countStmt->get_result();
        $totalCount = $countResult->fetch_assoc()['total'];
        $countStmt->close();
    } else {
        $countResult = $conn->query($countQuery);
        if (!$countResult) {
            throw new Exception("Query failed: " . $conn->error);
        }
        $totalCount = $countResult->fetch_assoc()['total'];
    }
    
    // Fetch artworks with likes and comments count
    $query = "SELECT 
                a.artwork_id, 
                a.artwork_title, 
                a.artist, 
                a.year_created, 
                a.artwork_desc, 
                a.category, 
                a.image,
                (SELECT COUNT(*) FROM artwork_likes l WHERE l.artwork_id = a.artwork_id) as like_count,
                (SELECT COUNT(*) FROM artwork_comments c WHERE c.artwork_id = a.artwork_id) as comment_count
              FROM artwork a 
              {$where} 
              {$orderBy} 
              LIMIT ? OFFSET ?";
    
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $params[] = $limit;
    $params[] = $offset;
    $types .= 'ii';
    
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();
    
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
            'year' => $row['year_created'],
            'description' => htmlspecialchars($row['artwork_desc'], ENT_QUOTES, 'UTF-8'),
            'category' => htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'),
            'image' => '../ADMIN/uploads/artworks/' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8'),
            'like_count' => (int)$row['like_count'],
            'comment_count' => (int)$row['comment_count'],
            'user_liked' => $user_liked
        ];
    }
    
    $stmt->close();
    $conn->close();
    
    $totalPages = ceil($totalCount / $limit);
    
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'artworks' => $artworks,
        'total' => $totalCount,
        'page' => $page,
        'totalPages' => $totalPages,
        'limit' => $limit,
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