// detail-umkm.js

// Gallery image modal handling
document.addEventListener('DOMContentLoaded', function () {
  const modalImg = document.getElementById('modalImg');
  const galleryImages = document.querySelectorAll('.gallery-img');
  galleryImages.forEach(img => {
    img.addEventListener('click', function () {
      const src = this.dataset.src;
      modalImg.src = src;
    });
  });

  // Initialize Leaflet map if map container exists
  const mapDiv = document.getElementById('map');
  if (mapDiv) {
    const lat = parseFloat(mapDiv.dataset.lat);
    const lng = parseFloat(mapDiv.dataset.lng);
    const map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    L.marker([lat, lng]).addTo(map);
  }
  // Review Button Logic
  const addReviewBtn = document.getElementById('addReviewBtn');
  if (addReviewBtn) {
    addReviewBtn.addEventListener('click', function() {
      if (!window.isLoggedIn) {
        var loginModal = new bootstrap.Modal(document.getElementById('loginPromptModal'));
        loginModal.show();
      } else {
        // Here we could add an AJAX check if user already reviewed
        // For now, we open the review modal.
        var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
        reviewModal.show();
      }
    });
  }

  // Review Form Submit
  const reviewForm = document.getElementById('reviewForm');
  if (reviewForm) {
    reviewForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const idUmkm = document.getElementById('reviewIdUmkm').value;
      const rating = document.getElementById('reviewRating').value;
      const komentar = document.getElementById('reviewKomentar').value;

      const formData = new FormData();
      formData.append('id_umkm', idUmkm);
      formData.append('rating', rating);
      formData.append('komentar', komentar);

      fetch('../ajax/add_review.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          alert(data.message);
          location.reload();
        } else {
          alert(data.message);
        }
      })
      .catch(err => {
        console.error(err);
        alert('Terjadi kesalahan sistem.');
      });
    });
  }

});
