 <?php
session_start();
require_once 'includes/database_connect.php';  // ✅ Reuse DB connection
// Fetch data from artworks table
$imagesPerPage = 10;

// Get current page from query string (default to 1)
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $imagesPerPage;

// Get total number of images
$totalResult = $conn->query("SELECT COUNT(*) AS total FROM artworks");
$totalRow = $totalResult->fetch_assoc();
$totalImages = $totalRow['total'];
$totalPages = ceil($totalImages / $imagesPerPage);

// Get paginated images
$sql = "SELECT * FROM artworks LIMIT $imagesPerPage OFFSET $offset";
$result = $conn->query($sql);
?>


  <?php include './includes/header.php'; ?>
  <!-- Gallery Section -->
        <section class="section" id="gallery">
            <div class="paisley-decoration paisley-1"></div>
            <h2>Our Gallery</h2>
            <p>Explore our curated collection of traditional Indian artworks from various regions. Each piece represents
                centuries of artistic tradition and cultural heritage.</p>

            <div class="gallery-container"></div>

            <div class="gallery-nav">
                <button id="prev-gallery" disabled>Previous</button>
                <button id="next-gallery">Next</button>
            </div>

            <script>
                const TOTAL_PAGES = <?php echo $totalPages; ?>;
            </script>

            <!-- <div class="paisley-decoration paisley-2"></div> -->
        </section>

<?php include './includes/footer.php'; ?>
<!-- Modal for Gallery Images -->
    <div id="imageModal" class="modal">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modalImg">
        <div id="modalCaption" class="modal-caption"></div>
    </div>
<script src="./js/gallery.js"></script>
<script src="./js/menu.js"></script>

</body>
</html>