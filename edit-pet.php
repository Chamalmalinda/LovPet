<?php
session_start();

// Seller access only
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'seller') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];

// Check if pet ID is provided
if (!isset($_GET['id'])) {
    echo "Pet ID not provided.";
    exit();
}

$petId = intval($_GET['id']);
$petQuery = $conn->query("SELECT * FROM pets WHERE id = $petId AND seller_id = $userId");

if ($petQuery->num_rows === 0) {
    echo "Pet not found or access denied.";
    exit();
}

$pet = $petQuery->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['petName']);
    $category = $conn->real_escape_string($_POST['category']);
    $breed = $conn->real_escape_string($_POST['breed']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $age = intval($_POST['age']);
    $color = $conn->real_escape_string($_POST['color']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['number']);
    $vaccinated = $conn->real_escape_string($_POST['vaccinated']);
    $price = floatval($_POST['price']);
    $desc = $conn->real_escape_string($_POST['description']);
    $imagePath = $pet['image'];

    // Upload new image if provided
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $uploadDir = "uploads/";
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "<script>alert('❌ Failed to upload image.');</script>";
            exit();
        }
    }

    $updateSql = "UPDATE pets SET
                    name='$name', category='$category', breed='$breed',
                    gender='$gender', age=$age, color='$color',
                    address='$address', contact='$contact',
                    vaccinated='$vaccinated', price=$price,
                    description='$desc', image='$imagePath'
                  WHERE id=$petId AND seller_id=$userId";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('✅ Pet updated successfully!'); window.location='seller_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('❌ Error updating pet: " . $conn->error . "');</script>";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pet - LovPet Seller 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Page Styles -->
    <link rel="stylesheet" href="edit-pet.css">
</head>
<body>

    <!-- ===== NAVIGATION (Modern LovPet Style) ===== -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="seller-index.php" class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet</span>
            </a>

            <ul class="nav-menu">
                <li><a href="seller-index.php">Home</a></li>
                <li><a href="seller-about.php">About</a></li>
                <li><a href="seller-find-pet.php">Buy a Pet</a></li>
                <li><a href="addpet.php">Add Pets</a></li>
                <li><a href="seller-product.php">Products</a></li>
                <li><a href="seller-display-notice.php">Lost Pets</a></li>
                <li><a href="seller-cart.php">Cart</a></li>
                <li><a href="seller_dashboard.php">Dashboard</a></li>
                <li><a href="login.php" class="logout-btn-nav">Logout</a></li>
            </ul>

            <button class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="page-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container page-hero-content">
            <div class="section-badge">
                <i data-lucide="edit"></i>
                <span>Edit Listing</span>
            </div>
            <h1>Edit Pet Details</h1>
            <p>Update your pet's information and keep their profile accurate</p>
        </div>
    </section>

    <!-- ===== EDIT PET FORM SECTION ===== -->
    <section class="form-section">
        <div class="container">
            <div class="pet-form-container">
                <form class="pet-form" method="POST" enctype="multipart/form-data">
                    
                    <!-- Image Upload with Current Image Preview -->
                    <div class="form-group full-width">
                        <span class="form-label">
                            <i data-lucide="image"></i>
                            Pet Photograph
                        </span>
                        <div class="upload-box" id="upload-box">
                            <i data-lucide="cloud-upload" style="width: 40px; height: 40px; color: var(--primary-color); margin-bottom: 12px;"></i>
                            <p id="upload-text">Drag & drop new image here or click to replace</p>
                            <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
                            <div id="preview" class="preview-container">
                                <?php if (!empty($pet['image'])): ?>
                                    <img src="<?= htmlspecialchars($pet['image']) ?>" alt="Current Pet Image">
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="help-text">Leave empty to keep current image</p>
                    </div>

                    <!-- Pet Details Grid -->
                    <div class="form-grid">
                        <!-- Left Column -->
                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="tag"></i>
                                Pet Name
                            </span>
                            <input type="text" id="petName" name="petName" value="<?= htmlspecialchars($pet['name']) ?>" placeholder="e.g., Max, Bella" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="list"></i>
                                Category
                            </span>
                            <select id="category" name="category" required>
                                <option value="Dog" <?= $pet['category'] == 'Dog' ? 'selected' : '' ?>>🐕 Dog</option>
                                <option value="Cat" <?= $pet['category'] == 'Cat' ? 'selected' : '' ?>>🐈 Cat</option>
                                <option value="Bird" <?= $pet['category'] == 'Bird' ? 'selected' : '' ?>>🦜 Bird</option>
                                <option value="Fish" <?= $pet['category'] == 'Fish' ? 'selected' : '' ?>>🐠 Fish</option>
                                <option value="Rabbit" <?= $pet['category'] == 'Rabbit' ? 'selected' : '' ?>>🐇 Rabbit</option>
                                <option value="Others" <?= $pet['category'] == 'Others' ? 'selected' : '' ?>>🐾 Others</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="paw-print"></i>
                                Breed
                            </span>
                            <input type="text" id="breed" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" placeholder="e.g., Labrador, Persian" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="venus-and-mars"></i>
                                Gender
                            </span>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="Male" <?= $pet['gender'] == 'Male' ? 'checked' : '' ?> required>
                                    <span>Male</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="gender" value="Female" <?= $pet['gender'] == 'Female' ? 'checked' : '' ?>>
                                    <span>Female</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="clock"></i>
                                Age (months)
                            </span>
                            <input type="number" id="age" name="age" value="<?= $pet['age'] ?>" placeholder="e.g., 12" min="0" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="droplet"></i>
                                Color
                            </span>
                            <input type="text" id="color" name="color" value="<?= htmlspecialchars($pet['color']) ?>" placeholder="e.g., Golden, Black" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="map-pin"></i>
                                Location / Address
                            </span>
                            <input type="text" id="address" name="address" value="<?= htmlspecialchars($pet['address']) ?>" placeholder="City, District" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="phone"></i>
                                Contact Number
                            </span>
                            <input type="tel" id="number" name="number" value="<?= htmlspecialchars($pet['contact']) ?>" placeholder="071 234 5678" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="coins"></i>
                                Price (LKR)
                            </span>
                            <input type="number" step="0.01" id="price" name="price" value="<?= $pet['price'] ?>" placeholder="e.g., 25000" min="0" required>
                        </div>

                        <div class="form-group full-width">
                            <span class="form-label">
                                <i data-lucide="file-text"></i>
                                Description
                            </span>
                            <textarea id="description" name="description" rows="5" placeholder="Tell us about this pet's personality, health, and story..." required><?= htmlspecialchars($pet['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i data-lucide="check-circle"></i>
                            <span>Update Pet Details</span>
                        </button>
                        <button type="button" class="cancel-btn" onclick="window.location='seller_dashboard.php'">
                            <i data-lucide="x-circle"></i>
                            <span>Cancel</span>
                        </button>
                    </div>
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

        // If there's already a preview image (current pet image), show it
        if (preview.children.length > 0) {
            uploadText.style.display = 'none';
        }

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
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                imageInput.files = e.dataTransfer.files;
                previewImage(e.dataTransfer.files[0]);
            }
        });

        imageInput.addEventListener('change', () => {
            if (imageInput.files && imageInput.files[0]) {
                previewImage(imageInput.files[0]);
            }
        });

        function previewImage(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = ''; // Clear current preview
                preview.style.display = 'block';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'New Pet Image';
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