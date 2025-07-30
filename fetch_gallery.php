<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}
include './includes/database_connect.php';

$imagesPerPage = 8;
$page = isset($_POST['page']) && is_numeric($_POST['page']) ? (int)$_POST['page'] : 1;
$offset = ($page - 1) * $imagesPerPage;

$sql = "SELECT * FROM artworks LIMIT $imagesPerPage OFFSET $offset";
$result = $conn->query($sql);

$html = '';

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '
        <div class="gallery-item">
            <img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['alt_text']) . '">
            <div class="overlay">
                <h3>' . htmlspecialchars($row['title']) . '</h3>
                <p>' . htmlspecialchars($row['description']) . '</p>
            </div>
        </div>';
    }
} else {
    $html .= '<p>No artworks found.</p>';
}

echo $html;
$conn->close();
?>
