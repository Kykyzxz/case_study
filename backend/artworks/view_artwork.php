<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
require_once "../connection/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['artwork_id'])) {
    $artwork_id = intval($_POST['artwork_id']);

    $query = "SELECT * FROM artwork WHERE artwork_id = ? LIMIT 1";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $artwork_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $artwork = $result->fetch_assoc();

            // FIXED — Match your database column names EXACTLY
            echo json_encode([
                'success' => true,
                'data' => [
                    'artwork_id'       => $artwork['artwork_id'],
                    'artwork_title'    => $artwork['artwork_title'],
                    'artist'      => $artwork['artist'],
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
