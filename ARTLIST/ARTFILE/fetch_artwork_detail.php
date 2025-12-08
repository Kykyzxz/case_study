<?php
// fetch_artwork_detail.php - Fetch single artwork details by ID
header('Content-Type: application/json');
ob_start();

ini_set('display_errors', 0);
error_reporting(E_ALL);

try {
    // Include database connection
    $connection_paths = [
        "../../backend/connection/connect.php",
        "../../../backend/connection/connect.php",
        "../../../../backend/connection/connect.php",
        dirname(dirname(__DIR__)) . "/backend/connection/connect.php"
    ];
    
    $connection_loaded = false;
    foreach ($connection_paths as $path) {
        if (file_exists($path)) {
            require_once $path;
            $connection_loaded = true;
            break;
        }
    }
    
    if (!$connection_loaded || !isset($conn) || $conn->connect_error) {
        throw new Exception("Database connection failed");
    }
    
    // Get artwork ID
    $artwork_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    if ($artwork_id <= 0) {
        throw new Exception("Invalid artwork ID");
    }
    
    // Fetch artwork details - USING 'artwork' TABLE (SINGULAR)
    $query = "SELECT * FROM artwork WHERE artwork_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $artwork_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("Artwork not found");
    }
    
    $artwork = $result->fetch_assoc();
    
    $stmt->close();
    $conn->close();
    
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'artwork' => [
            'id' => $artwork['artwork_id'],
            'title' => htmlspecialchars($artwork['artwork_title'], ENT_QUOTES, 'UTF-8'),
            'artist' => htmlspecialchars($artwork['artist'], ENT_QUOTES, 'UTF-8'),
            'year' => $artwork['year_created'],
            'description' => htmlspecialchars($artwork['artwork_desc'], ENT_QUOTES, 'UTF-8'),
            'medium' => htmlspecialchars($artwork['medium'], ENT_QUOTES, 'UTF-8'),
            'dimension' => htmlspecialchars($artwork['dimension'], ENT_QUOTES, 'UTF-8'),
            'category' => htmlspecialchars($artwork['category'], ENT_QUOTES, 'UTF-8'),
            'orientation' => htmlspecialchars($artwork['orientation'], ENT_QUOTES, 'UTF-8'),
            'artist_desc' => htmlspecialchars($artwork['artist_desc'], ENT_QUOTES, 'UTF-8'),
            'image' => '../../ADMIN/uploads/artworks/' . htmlspecialchars($artwork['image'], ENT_QUOTES, 'UTF-8'),
            'status' => htmlspecialchars($artwork['status'], ENT_QUOTES, 'UTF-8')
        ]
    ]);
    
} catch (Exception $e) {
    ob_end_clean();
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

exit;
?>