<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Report Lost Pet - LovPet</title>
  <link rel="stylesheet" href="lost-notice.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar">
    <div class="container nav-content">
      <div class="logo">
        <div class="logo-icon">
          <i data-lucide="paw-print"></i>
        </div>
        <span class="logo-text">LovPet</span>
      </div>
      <ul class="nav-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="find-pet.php">Buy a Pet</a></li>
        <li><a href="product.php">Products</a></li>
        <li><a href="display-notice.php" class="active">Lost Pets</a></li>
        <li><a href="cart.php">Cart</a></li>
        
      </ul>
      <button class="mobile-menu-toggle">
        <span></span>
        <span></span>
        <span></span>
      </button>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="page-hero">
    <div class="hero-decoration hero-decoration-1"></div>
    <div class="hero-decoration hero-decoration-2"></div>
    <div class="container">
      <div class="page-hero-content">
        <span class="section-badge">
          <i data-lucide="alert-circle"></i>
          <span>Help Reunite Pets</span>
        </span>
        <h1>Report a Lost Pet</h1>
        <p>Submit details to help find your missing companion quickly</p>
      </div>
    </div>
  </section>

  <!-- Lost Pet Form Section -->
  <section class="form-section">
    <div class="container">
      <div class="notice-container">
        <form class="notice-form" action="save-notice.php" method="POST" enctype="multipart/form-data">

          <!-- Image Upload -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="image"></i>
              <span>Upload Pet Image</span>
            </label>
            <div class="upload-box" id="upload-box">
              <p id="upload-text">Drag & drop image here or click to select</p>
              <input type="file" id="imageUpload" name="image" accept="image/*" hidden required>
              <div class="preview-container" id="previewContainer">
                <img id="previewImage" src="" alt="Preview">
              </div>
            </div>
          </div>

          <!-- Pet Name -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="heart"></i>
              <span>Pet Name</span>
            </label>
            <input type="text" id="petName" name="petName" placeholder="Enter pet's name" required>
          </div>

          <!-- Breed -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="info"></i>
              <span>Breed</span>
            </label>
            <input type="text" id="breed" name="breed" placeholder="e.g., Labrador, Persian" required>
          </div>

          <!-- Last Seen Location -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="map-pin"></i>
              <span>Last Seen Location</span>
            </label>
            <input type="text" id="location" name="location" placeholder="e.g., Colombo 07, near park" required>
          </div>

          <!-- Contact Number -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="phone"></i>
              <span>Contact Number</span>
            </label>
            <input type="tel" id="contact" name="contact" placeholder="e.g., 071-2345678" required>
          </div>

          <!-- Description -->
          <div class="form-group">
            <label class="form-label">
              <i data-lucide="file-text"></i>
              <span>Description</span>
            </label>
            <textarea id="description" name="description" rows="5" placeholder="Any special markings, behavior, or additional details..." required></textarea>
          </div>

          <!-- Buttons -->
          <div class="form-actions">
            <button type="submit" class="submit-btn">
              <i data-lucide="send"></i>
              <span>Submit Notice</span>
            </button>
            <button type="button" class="cancel-btn" onclick="window.location.href='display-notice.php'">
              <i data-lucide="x"></i>
              <span>Cancel</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-column footer-brand">
          <div class="footer-logo">
            <div class="logo-icon">
              <i data-lucide="paw-print"></i>
            </div>
            <span class="logo-text">LovPet</span>
          </div>
          <p class="footer-description">Connecting loving pets with caring families across Sri Lanka since 2020.</p>
          <div class="social-links">
            <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
              <i data-lucide="instagram"></i>
            </a>
            <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
              <i data-lucide="facebook"></i>
            </a>
          </div>
        </div>

        <div class="footer-column">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="find-pet.php">Find a Pet</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="display-notice.php">Lost Pet Notice</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Support</h4>
          <ul>
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Sign Up</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Contact Us</h4>
          <ul class="contact-list">
            <li>
              <i data-lucide="mail"></i>
              <span>lovpet123@gmail.com</span>
            </li>
            <li>
              <i data-lucide="phone"></i>
              <span>071-4577814</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
      </div>
    </div>
  </footer>

  <script>
    lucide.createIcons();

    // Image upload & preview
    const uploadBox = document.getElementById('upload-box');
    const imageInput = document.getElementById('imageUpload');
    const previewImage = document.getElementById('previewImage');
    const uploadText = document.getElementById('upload-text');
    const previewContainer = document.getElementById('previewContainer');

    uploadBox.addEventListener('click', () => imageInput.click());

    uploadBox.addEventListener('dragover', e => {
      e.preventDefault();
      uploadBox.classList.add('dragover');
    });

    uploadBox.addEventListener('dragleave', () => {
      uploadBox.classList.remove('dragover');
    });

    uploadBox.addEventListener('drop', e => {
      e.preventDefault();
      uploadBox.classList.remove('dragover');
      const file = e.dataTransfer.files[0];
      if (file && file.type.startsWith('image/')) {
        imageInput.files = e.dataTransfer.files;
        previewSelectedImage(file);
      }
    });

    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files[0]) {
        previewSelectedImage(imageInput.files[0]);
      }
    });

    function previewSelectedImage(file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        previewImage.src = e.target.result;
        previewContainer.style.display = 'block';
        uploadText.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }

    setTimeout(() => lucide.createIcons(), 500);
  </script>

</body>
</html>