<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
  <title>About Us – Mechanic On Wheel</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="stylesheet" href="https://unpkg.com/lucide-static@0.344.0/font/lucide.css">
  <!-- Partner section styles -->
  <style>
    .partners-section {
      padding: 4rem 2rem;
      background-color: var(--background-color);
      text-align: center;
    }
    .partners-section h2 {
      color: var(--primary-color);
      font-size: 2.5rem;
      margin-bottom: 2rem;
    }
    .partner-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 2rem;
      max-width: 1200px;
      margin: 0 auto;
    }
    .partner-card {
      background-color: var(--card-background);
      padding: 1.5rem;
      border-radius: 10px;
      transition: transform 0.3s, box-shadow 0.3s;
    }
    .partner-card img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      margin-bottom: 1rem;
    }
    .partner-card p {
      color: var(--text-color);
      font-weight: bold;
    }
    .partner-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    .gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  max-width: 1000px;
  margin: 0 auto;
}

.gallery-image {
  width: 100%;
  border-radius: 10px;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  cursor: pointer;
}

.gallery-image:hover {
  transform: scale(1.05);
  box-shadow: 0 10px 20px rgba(0,0,0,0.3);
}

/* Modal Styles */
.image-modal {
  display: none;
  position: fixed;
  z-index: 999;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.9);
  animation: fadeIn 0.5s ease;
}

.image-modal .modal-content {
  margin: auto;
  display: block;
  max-width: 80%;
  max-height: 80%;
  animation: zoomIn 0.3s ease;
  border-radius: 12px;
}

.close-modal {
  position: absolute;
  top: 25px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
}

@keyframes zoomIn {
  from {transform: scale(0.8);}
  to {transform: scale(1);}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity: 1;}
}

  </style>
</head>
<body>
  <!-- reuse your nav, but mark About active -->
  <nav>
    <div class="nav-container">
      <div class="logo">
        <i class="lucide-wrench"></i>
        <span>24*7 Mechanic On Wheel</span>
      </div>
      <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="#company-details" class="active">About</a>
        <a href="index.php#services">Services</a>
        <a href="index.php#contact">Contact</a>
      </div>
      <button class="menu-btn" onclick="toggleMenu()">
        <i class="lucide-menu"></i>
      </button>
    </div>
  </nav>

  <main class="about-container" style="padding: 5rem 2rem; max-width:1200px; margin:0 auto;">
    <!-- Company Details -->
    <section id="company-details" style="margin-bottom:4rem;">
      <h2 style="color:var(--primary-color); margin-bottom:1rem;">Company Details</h2>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:center;">
        <img src="./gallery.jpg" alt="Our Company" style="width:100%; border-radius:10px;" />
        <p>
          Founded in 2020, <strong>Mechanic On Wheel</strong> has been delivering professional, certified auto‑repair
          services right to your driveway—24 hours a day, 7 days a week. Our mission is to bring the garage to you,
          minimizing downtime and maximizing convenience.
        </p>
      </div>
    </section>

    <!-- Workplace -->
    <section id="workplace" style="margin-bottom:4rem;">
      <h2 style="color:var(--primary-color); margin-bottom:1rem;">Our Workplace</h2>
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem; align-items:center;">
        <p>
          Each of our mobile units is fully equipped with the latest diagnostic tools, quality parts, and a
          friendly technician. We maintain a fleet of vans designed as rolling workshops, so we can handle
          everything from oil changes to brake repairs on the spot.
        </p>
        <img src="./workshop.jpg" alt="Workplace" style="width:100%; border-radius:10px;" />
      </div>
    </section>

    <!-- Our Services -->
    <section id="our-services" style="margin-bottom:4rem;">
      <h2 style="color:var(--primary-color); margin-bottom:1rem;">Our Services</h2>
      <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:2rem;">
        <div style="text-align:center; background:var(--card-background); padding:2rem; border-radius:10px;">
          <img src="./general.jpg" alt="General Repair" style="width:100%; border-radius:8px; margin-bottom:1rem;" />
          <h3>General Repair</h3>
          <p>Diagnostics and full repair for all makes &amp; models.</p>
        </div>
        <div style="text-align:center; background:var(--card-background); padding:2rem; border-radius:10px;">
          <img src="./battery repair.jpg" alt="Battery Service" style="width:100%; border-radius:8px; margin-bottom:1rem;" />
          <h3>Battery Service</h3>
          <p>Testing, replacement, and jump‑start.</p>
        </div>
        <div style="text-align:center; background:var(--card-background); padding:2rem; border-radius:10px;">
          <img src="./oil repairing.jpg" alt="Oil Change" style="width:100%; border-radius:8px; margin-bottom:1rem;" />
          <h3>Oil Change</h3>
          <p>Fast oil &amp; fluid maintenance at your door.</p>
        </div>
      </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" style="margin-bottom: 4rem;">
        <h2 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Gallery</h2>
        <div class="gallery-grid">
            <img src="./g1.jpg" alt="Gallery Image 1" class="gallery-image" />
            <img src="./g2.jpg" alt="Gallery Image 2" class="gallery-image" />
            <img src="./g3.jpg" alt="Gallery Image 3" class="gallery-image" />
            <img src="./g4.jpg" alt="Gallery Image 4" class="gallery-image" />
        </div>
    </section>
  
  <!-- Modal for image popup -->
    <div id="imageModal" class="image-modal">
        <span class="close-modal" onclick="closeImageModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>
  
  

    <!-- Service Partners -->
    <section id="partners" class="partners-section">
      <h2>Our Service Partners</h2>
      <div class="partner-grid">
        <div class="partner-card">
          <img src="./autozone image.jpg" alt="Partner 1" />
          <p>AutoZone</p>
        </div>
        <div class="partner-card">
          <img src="./napa-autoparts.jpg" alt="Partner 2" />
          <p>NAPA Auto Parts</p>
        </div>
        <div class="partner-card">
          <img src="./Boschd.jpg" alt="Partner 3" />
          <p>Bosch</p>
        </div>
        <div class="partner-card">
          <img src="./castrol-logo-FE5807D6DC-seeklogo.jpg" alt="Partner 4" />
          <p>Castrol</p>
        </div>
        <div class="partner-card">
          <img src="./mobil 1.jpg" alt="Partner 5" />
          <p>Mobil 1</p>
        </div>
      </div>
    </section>
  </main>

  <footer>
    <div class="footer-content">
      <div class="footer-logo">
        <i class="lucide-wrench"></i>
        <span>24/7 Auto Care</span>
      </div>
      <p>&copy; 2025 24/7 Auto Care. All rights reserved.</p>
    </div>
  </footer>

  <script src="script.js">
    // Gallery modal logic
const modal = document.getElementById("imageModal");
const modalImg = document.getElementById("modalImage");

document.querySelectorAll(".gallery-image").forEach(img => {
  img.onclick = function() {
    modal.style.display = "block";
    modalImg.src = this.src;
  };
});

function closeImageModal() {
  modal.style.display = "none";
}

  </script>
</body>
</html>