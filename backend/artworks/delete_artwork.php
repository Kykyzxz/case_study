<?php
// delete_artwork.php
header('Content-Type: application/json');

// Include database connection
require_once "../../backend/connection/connect.php";

// Check if artwork_id is provided
if (!isset($_POST['artwork_id']) || empty($_POST['artwork_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Artwork ID is required'
    ]);
    exit;
}

$artwork_id = intval($_POST['artwork_id']);

// First, get the image filename to delete the file
$select_query = "SELECT image FROM artwork WHERE artwork_id = ?";
$stmt = $conn->prepare($select_query);
$stmt->bind_param("i", $artwork_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Artwork not found'
    ]);
    $stmt->close();
    $conn->close();
    exit;
}

$row = $result->fetch_assoc();
$image_filename = $row['image'];
$stmt->close();

// Delete the artwork from database
$delete_query = "DELETE FROM artwork WHERE artwork_id = ?";
$stmt = $conn->prepare($delete_query);
$stmt->bind_param("i", $artwork_id);

if ($stmt->execute()) {
    // Delete the image file from server
    $image_path = "../../admin/uploads/artworks/" . $image_filename;
    
    if (file_exists($image_path)) {
        unlink($image_path);
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Artwork deleted successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to delete artwork: ' . $conn->error
    ]);
}

$stmt->close();
$conn->close();
?>