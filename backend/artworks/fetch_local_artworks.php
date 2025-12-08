<?php
// fetch_local_artworks.php - Fetch local artworks
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
    
    // Fetch all local artworks - check for both 'Local' and 'local'
    $query = "SELECT artwork_id, artwork_title, artist, artwork_desc, 
              category, image FROM artwork 
              WHERE (LOWER(status) = 'local' OR status = 'Local')
              ORDER BY artwork_id DESC";
    
    $result = $conn->query($query);
    
    if (!$result) {
        throw new Exception("Failed to fetch local artworks: " . $conn->error);
    }
    
    $artworks = [];
    while ($row = $result->fetch_assoc()) {
        $artworks[] = [
            'id' => $row['artwork_id'],
            'title' => htmlspecialchars($row['artwork_title'], ENT_QUOTES, 'UTF-8'),
            'artist' => htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8'),
            'description' => htmlspecialchars($row['artwork_desc'], ENT_QUOTES, 'UTF-8'),
            'category' => htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8'),
            'image' => '../ADMIN/uploads/artworks/' . htmlspecialchars($row['image'], ENT_QUOTES, 'UTF-8')
        ];
    }
    
    $conn->close();
    
    ob_end_clean();
    echo json_encode([
        'success' => true,
        'artworks' => $artworks,
        'total' => count($artworks)
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