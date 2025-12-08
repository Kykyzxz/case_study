<?php
// add_artwork.php
require_once "../connection/connect.php";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Get form data and sanitize
    $artwork_title = $conn->real_escape_string($_POST['artworkTitle']);
    $artist = $conn->real_escape_string($_POST['artistName']);
    $year_created = intval($_POST['yearCreated']);
    $artwork_desc = $conn->real_escape_string($_POST['artworkDesc']);
    $medium = $conn->real_escape_string($_POST['medium']);
    $dimension = $conn->real_escape_string($_POST['dimension']);
    $category = $conn->real_escape_string($_POST['category']);
    $orientation = $conn->real_escape_string($_POST['orientation']);
    $artist_desc = $conn->real_escape_string($_POST['artistDesc']);
    $status = $conn->real_escape_string($_POST['status']);
    
    // Handle image upload
    $image_name = '';
    $upload_success = false;
    
    if (isset($_FILES['artworkImage']) && $_FILES['artworkImage']['error'] == 0) {
        
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $file_type = $_FILES['artworkImage']['type'];
        
        // Check if file type is allowed
        if (in_array($file_type, $allowed_types)) {
            
            // Create uploads directory if it doesn't exist
            // ✅ Correct path based on your structure
            $upload_dir = '../../ADMIN/uploads/artworks/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            // Get file extension
            $file_extension = pathinfo($_FILES['artworkImage']['name'], PATHINFO_EXTENSION);
            
            // Create unique filename
            $image_name = time() . '_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $image_name;
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['artworkImage']['tmp_name'], $upload_path)) {
                $upload_success = true;
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to upload image. Check folder permissions.']);
                exit;
            }
            
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, PNG, GIF, and WEBP are allowed.']);
            exit;
        }
    } else {
        $error_message = 'No image uploaded';
        if (isset($_FILES['artworkImage']['error'])) {
            $error_message .= ' (Error code: ' . $_FILES['artworkImage']['error'] . ')';
        }
        echo json_encode(['success' => false, 'message' => $error_message]);
        exit;
    }
    
    // Insert data into database
    if ($upload_success) {
        $sql = "INSERT INTO artwork (
            artwork_title, 
            artist, 
            year_created, 
            artwork_desc, 
            medium, 
            dimension, 
            category, 
            orientation, 
            artist_desc, 
            image, 
            status
        ) VALUES (
            '$artwork_title', 
            '$artist', 
            $year_created, 
            '$artwork_desc', 
            '$medium', 
            '$dimension', 
            '$category', 
            '$orientation', 
            '$artist_desc', 
            '$image_name', 
            '$status'
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                'success' => true, 
                'message' => 'Artwork added successfully!',
                'artwork_id' => $conn->insert_id
            ]);
        } else {
            // If database insert fails, delete the uploaded image
            if (file_exists($upload_path)) {
                unlink($upload_path);
            }
            echo json_encode([
                'success' => false, 
                'message' => 'Database error: ' . $conn->error
            ]);
        }
    }
    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}

$conn->close();
?>