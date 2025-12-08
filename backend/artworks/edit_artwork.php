<?php
header('Content-Type: application/json');
ini_set('display_errors', 0);
error_reporting(0);

require_once "../connection/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $artwork_id = isset($_POST['artworkId']) ? intval($_POST['artworkId']) : 0;
    $artwork_title = isset($_POST['artworkTitle']) ? trim($_POST['artworkTitle']) : '';
    $artist = isset($_POST['artistName']) ? trim($_POST['artistName']) : '';
    $year_created = isset($_POST['yearCreated']) ? trim($_POST['yearCreated']) : '';
    $medium = isset($_POST['medium']) ? trim($_POST['medium']) : '';
    $dimension = isset($_POST['dimension']) ? trim($_POST['dimension']) : '';
    $category = isset($_POST['category']) ? trim($_POST['category']) : '';
    $orientation = isset($_POST['orientation']) ? trim($_POST['orientation']) : '';
    $status = isset($_POST['status']) ? trim($_POST['status']) : '';
    $artwork_desc = isset($_POST['artworkDesc']) ? trim($_POST['artworkDesc']) : '';
    $artist_desc = isset($_POST['artistDesc']) ? trim($_POST['artistDesc']) : '';

    // Validate required fields
    if (empty($artwork_id) || empty($artwork_title) || empty($artist) || empty($year_created) || 
        empty($medium) || empty($dimension) || empty($category) || empty($orientation) || 
        empty($status) || empty($artwork_desc) || empty($artist_desc)) {
        echo json_encode([
            'success' => false,
            'message' => 'All fields except image are required'
        ]);
        exit;
    }

    // Check if new image is uploaded
    $update_image = false;
    $image_name = '';
    
    if (isset($_FILES['artworkImage']) && $_FILES['artworkImage']['error'] === UPLOAD_ERR_OK) {
        $update_image = true;
        
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = $_FILES['artworkImage']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            echo json_encode([
                'success' => false,
                'message' => 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.'
            ]);
            exit;
        }

        $max_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['artworkImage']['size'] > $max_size) {
            echo json_encode([
                'success' => false,
                'message' => 'File size too large. Maximum 5MB allowed.'
            ]);
            exit;
        }

        // Generate unique filename
        $file_extension = pathinfo($_FILES['artworkImage']['name'], PATHINFO_EXTENSION);
        $image_name = 'artwork_' . time() . '_' . uniqid() . '.' . $file_extension;
        $upload_path = '../../admin/uploads/artworks/' . $image_name;

        // Create directory if it doesn't exist
        if (!file_exists('../../admin/uploads/artworks/')) {
            mkdir('../../admin/uploads/artworks/', 0777, true);
        }

        // Move uploaded file
        if (!move_uploaded_file($_FILES['artworkImage']['tmp_name'], $upload_path)) {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to upload image'
            ]);
            exit;
        }

        // Get old image to delete it
        $old_image_query = "SELECT image FROM artwork WHERE artwork_id = ?";
        $stmt = $conn->prepare($old_image_query);
        $stmt->bind_param("i", $artwork_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $old_image_path = '../../admin/uploads/artworks/' . $row['image'];
            if (file_exists($old_image_path)) {
                unlink($old_image_path);
            }
        }
        $stmt->close();
    }

    // Update query
    if ($update_image) {
        $query = "UPDATE artwork SET 
                  artwork_title = ?, 
                  artist = ?, 
                  year_created = ?, 
                  medium = ?, 
                  dimension = ?, 
                  category = ?, 
                  orientation = ?, 
                  status = ?, 
                  artwork_desc = ?, 
                  artist_desc = ?,
                  image = ?
                  WHERE artwork_id = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssssssssi", 
            $artwork_title, 
            $artist, 
            $year_created, 
            $medium, 
            $dimension, 
            $category, 
            $orientation, 
            $status, 
            $artwork_desc, 
            $artist_desc,
            $image_name,
            $artwork_id
        );
    } else {
        $query = "UPDATE artwork SET 
                  artwork_title = ?, 
                  artist = ?, 
                  year_created = ?, 
                  medium = ?, 
                  dimension = ?, 
                  category = ?, 
                  orientation = ?, 
                  status = ?, 
                  artwork_desc = ?, 
                  artist_desc = ?
                  WHERE artwork_id = ?";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssssssi", 
            $artwork_title, 
            $artist, 
            $year_created, 
            $medium, 
            $dimension, 
            $category, 
            $orientation, 
            $status, 
            $artwork_desc, 
            $artist_desc,
            $artwork_id
        );
    }

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Artwork updated successfully'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $stmt->error
        ]);
    }

    $stmt->close();
    $conn->close();

} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>