
// Gallery modal functionality
const modal = document.querySelector('#imageModal');
const modalImg = document.querySelector('#modalImg');
const modalCaption = document.querySelector('#modalCaption');
const modalClose = document.querySelector('.modal-close');

// Attach a single event listener to the gallery container
document.querySelector('#gallery').addEventListener('click', function (e) {
    const item = e.target.closest('.gallery-item');
    if (item) {
        modal.style.display = 'block';
        modalImg.src = item.querySelector('img').src;
        modalCaption.innerHTML = item.querySelector('.overlay').innerHTML;
    }
});

modalClose.addEventListener('click', function () {
    modal.style.display = 'none';
});

let currentPage = 1;

function loadGallery(page) {
  fetch('fetch_gallery.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded'
    },
    body: `page=${page}`
  })
  .then(response => response.text())
  .then(html => {
    document.querySelector('.gallery-container').innerHTML = html;
    currentPage = page;
    document.querySelector('#prev-gallery').disabled = (currentPage === 1);
    document.querySelector('#next-gallery').disabled = (currentPage === TOTAL_PAGES);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  loadGallery(1);

  document.querySelector('#prev-gallery').addEventListener('click', () => {
    if (currentPage > 1) loadGallery(currentPage - 1);
  });

  document.querySelector('#next-gallery').addEventListener('click', () => {
    if (currentPage < TOTAL_PAGES) loadGallery(currentPage + 1);
  });
});