<?php
// Start session if needed (optional, for user check)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Pet - LovPet Seller 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Page Styles -->
    <link rel="stylesheet" href="addpet.css">
</head>
<body>

    <!-- ===== NAVIGATION (Modern LovPet Style) ===== -->
<?php
// Start session if not already (safe)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
  <div class="container nav-content">
    <a href="index.php" class="logo">
      <div class="logo-icon">
        <i data-lucide="paw-print"></i>
      </div>
      <span class="logo-text">LovPet</span>
    </a>

    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="find-pet.php">Buy a Pet</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="display-notice.php" class="<?= basename($_SERVER['PHP_SELF']) == 'display-notice.php' ? 'active' : '' ?>">Lost Pets</a></li>
      <li><a href="cart.php">Cart</a></li>

      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Logged in -->
        <li>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></li>
        <li>
          <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <a href="admin-dashboard.php" class="btn-primary">Admin Dashboard</a>
          <?php elseif ($_SESSION['user_type'] === 'seller'): ?>
            <a href="seller_dashboard.php" class="btn-primary">My Dashboard</a>
          <?php elseif ($_SESSION['user_type'] === 'buyer'): ?>
            <a href="buyer_dashboard.php" class="btn-primary">My Dashboard</a>
          <?php endif; ?>
        </li>
        <li><a href="logout.php" class="btn-secondary">Logout</a></li>
      <?php else: ?>
        <!-- Not logged in -->
        <li><a href="login.php" class="btn-primary">Login</a></li>
        <li><a href="register.php" class="btn-secondary">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="page-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container page-hero-content">
            <div class="section-badge">
                <i data-lucide="plus-circle"></i>
                <span>Seller Dashboard</span>
            </div>
            <h1>Add a New Pet</h1>
            <p>List your pet for adoption and find them a loving home</p>
        </div>
    </section>

    <!-- ===== ADD PET FORM SECTION ===== -->
    <section class="form-section">
        <div class="container">
            <div class="pet-form-container">
                <form class="pet-form" action="save_pet.php" method="POST" enctype="multipart/form-data">
                    
                    <!-- Image Upload -->
                    <div class="form-group">
                        <span class="form-label">
                            <i data-lucide="image"></i>
                            Pet Photograph
                        </span>
                        <div class="upload-box" id="upload-box">
                            <i data-lucide="cloud-upload" style="width: 40px; height: 40px; color: var(--primary-color); margin-bottom: 12px;"></i>
                            <p id="upload-text">Drag & drop image here or click to browse</p>
                            <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
                            <div id="preview" class="preview-container"></div>
                        </div>
                    </div>

                    <!-- Pet Details Grid -->
                    <div class="form-grid">
                        <!-- Left Column -->
                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="tag"></i>
                                Pet Name
                            </span>
                            <input type="text" id="petName" name="petName" placeholder="e.g., Max, Bella" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="list"></i>
                                Category
                            </span>
                            <select id="category" name="category" required>
                                <option value="" disabled selected>Select category</option>
                                <option value="Dog">🐕 Dog</option>
                                <option value="Cat">🐈 Cat</option>
                                <option value="Bird">🦜 Bird</option>
                                <option value="Fish">🐠 Fish</option>
                                <option value="Rabbit">🐇 Rabbit</option>
                                <option value="Others">🐾 Others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="paw-print"></i>
                                Breed
                            </span>
                            <input type="text" id="breed" name="breed" placeholder="e.g., Labrador, Persian" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="venus-and-mars"></i>
                                Gender
                            </span>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="Male" required>
                                    <span>Male</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="Female">
                                    <span>Female</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="clock"></i>
                                Age (months)
                            </span>
                            <input type="number" id="age" name="age" placeholder="e.g., 12" min="0" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="droplet"></i>
                                Color
                            </span>
                            <input type="text" id="color" name="color" placeholder="e.g., Golden, Black" required>
                        </div>

                        <!-- Right Column -->
                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="map-pin"></i>
                                Location / Address
                            </span>
                            <input type="text" id="address" name="address" placeholder="City, District" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="phone"></i>
                                Contact Number
                            </span>
                            <input type="tel" id="number" name="number" placeholder="071 234 5678" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="coins"></i>
                                Price (LKR)
                            </span>
                            <input type="number" id="price" name="price" placeholder="e.g., 25000" min="0" required>
                        </div>

                        <div class="form-group full-width">
                            <span class="form-label">
                                <i data-lucide="file-text"></i>
                                Description
                            </span>
                            <textarea id="description" name="description" rows="5" placeholder="Tell us about this pet's personality, health, and story..." required></textarea>
                        </div>
                    </div>

                    <!-- Commission Notice & Submit Button -->
                    <div class="commission-notice">
                        <i data-lucide="info"></i>
                        <span>By submitting, you agree to pay <strong>20% commission</strong> to LovPet upon successful adoption.</span>
                    </div>

                    <button type="submit" class="submit-btn"
                        oncontextmenu="alert('You have to agree to pay 20% commission to LovPet.'); return false;">
                        <i data-lucide="check-circle"></i>
                        <span>List Pet for Adoption</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER (LovPet Brand) ===== -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i data-lucide="paw-print"></i>
                        </div>
                        <span class="logo-text">LovPet</span>
                    </div>
                    <p class="footer-description">
                        Sri Lanka's most trusted pet platform. Find your perfect companion and give them the care they deserve.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Instagram"><i data-lucide="instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i data-lucide="facebook"></i></a>
                        <a href="#" aria-label="Twitter"><i data-lucide="twitter"></i></a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="seller-index.php">Home</a></li>
                        <li><a href="seller-about.php">About Us</a></li>
                        <li><a href="seller-find-pet.php">Find a Pet</a></li>
                        <li><a href="addpet.php">Add Pets</a></li>
                        <li><a href="seller-product.php">Products</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="seller-faq.php">FAQs</a></li>
                        <li><a href="seller-terms.php">Terms of Service</a></li>
                        <li><a href="seller-privacy.php">Privacy Policy</a></li>
                        <li><a href="seller-cart.php">Cart</a></li>
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
                        <li>
                            <i data-lucide="map-pin"></i>
                            <span>Colombo, Sri Lanka</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
            </div>
        </div>
    </footer>

    <!-- Image Preview & Mobile Menu Script -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // ----- Image Upload & Preview -----
        const uploadBox = document.getElementById('upload-box');
        const imageInput = document.getElementById('imageUpload');
        const preview = document.getElementById('preview');
        const uploadText = document.getElementById('upload-text');

        uploadBox.addEventListener('click', () => imageInput.click());

        uploadBox.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadBox.classList.add('dragover');
        });

        uploadBox.addEventListener('dragleave', () => {
            uploadBox.classList.remove('dragover');
        });

        uploadBox.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadBox.classList.remove('dragover');
            imageInput.files = e.dataTransfer.files;
            previewImage(imageInput.files[0]);
        });

        imageInput.addEventListener('change', () => {
            if (imageInput.files && imageInput.files[0]) {
                previewImage(imageInput.files[0]);
            }
        });

        function previewImage(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '';
                preview.style.display = 'block';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Pet Preview';
                preview.appendChild(img);
                uploadText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }

        // ----- Mobile Menu Toggle -----
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');

        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                this.classList.toggle('active');
            });
        }
    </script>

</body>
</html>