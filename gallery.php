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

<?php
$page_title = "Gallery | Traditional Arts of India";
$page_description = "Browse our curated gallery showcasing stunning traditional artworks from across India.";
include './includes/header.php';
?>

<!-- Scanner Section -->
<section class="section" id="scanner">
  <h2>📸 Scan a Product</h2>
  <p>Use your camera to scan a handicraft item and see its details instantly.</p>

  <video id="video" autoplay playsinline muted
         style="width:100%; max-width:400px; border:2px solid #444; border-radius:8px;"></video><br>
  <button onclick="capture()">Capture & Search</button>
  <canvas id="canvas" style="display:none;"></canvas>
  <div id="result" style="margin-top:20px; padding:15px; border:1px solid #ddd; background:#f9f9f9;">
    Result will appear here...
  </div>
</section>

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
</section>

<?php include './includes/footer.php'; ?>

<!-- Modal for Gallery Images -->
<div id="imageModal" class="modal">
    <span class="modal-close">&times;</span>
    <img class="modal-content" id="modalImg">
    <div id="modalCaption" class="modal-caption"></div>
</div>

<script src="/js/gallery.js"></script>
<script src="/js/menu.js"></script>


<script>
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const resultDiv = document.getElementById('result');

// Start camera (rear cam if available)
navigator.mediaDevices.getUserMedia({
  video: { facingMode: { ideal: "environment" } }, // rear camera on mobile
  audio: false
})
.then(stream => {
  video.srcObject = stream;
})
.catch(err => {
  resultDiv.innerHTML = "⚠️ Camera error: " + err;
});

// Capture frame & send to Hugging Face
async function capture() {
  const ctx = canvas.getContext('2d');
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

  canvas.toBlob(async function(blob) {
    const formData = new FormData();
    formData.append("file", blob, "capture.jpg");

    resultDiv.innerHTML = "⏳ Scanning...";

    try {
      let response = await fetch("https://your-username-handicraft-scanner.hf.space/run/predict", {
        method: "POST",
        body: formData
      });
      let data = await response.json();
      let textResult = data.data[0]; // HuggingFace returns result inside .data
      resultDiv.innerHTML = textResult;
    } catch (err) {
      resultDiv.innerHTML = "⚠️ Error: " + err;
    }
  }, "image/jpeg");
}
</script>

</body>
</html>
