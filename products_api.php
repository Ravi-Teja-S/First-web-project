<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Allow external access

// Include your DB connection
require_once './includes/database_connect.php'; // $conn is available

// Fetch all artworks
$sql = "SELECT id, image_url, alt_text, title, description FROM artworks";
$result = $conn->query($sql);

$artworks = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $artworks[] = $row; // Keep image_url as-is
    }
}

// Return JSON
echo json_encode($artworks, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

// Close DB connection
$conn->close();
?>
