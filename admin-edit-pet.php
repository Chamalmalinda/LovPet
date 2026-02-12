<?php
session_start();

// Admin access only
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if pet ID is provided
if (!isset($_GET['id'])) {
    echo "Pet ID not provided.";
    exit();
}

$petId = intval($_GET['id']);
$petQuery = $conn->query("SELECT * FROM pets WHERE id = $petId");

if ($petQuery->num_rows === 0) {
    echo "Pet not found.";
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
                  WHERE id=$petId";

    if ($conn->query($updateSql) === TRUE) {
        echo "<script>alert('✅ Pet updated successfully!'); window.location='admin-dashboard.php#pets';</script>";
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
    <title>Admin Edit Pet - LovPet 🐾</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="admin-edit-pet.css">
</head>
<body>

    <!-- ===== NAVIGATION (Admin Minimal) ===== -->
    <nav class="admin-nav">
        <div class="container nav-content">
            <a href="admin-dashboard.php" class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet Admin</span>
            </a>
            <a href="admin-dashboard.php" class="back-link">
                <i data-lucide="arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="page-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container page-hero-content">
            <div class="section-badge">
                <i data-lucide="edit"></i>
                <span>Admin: Edit Pet</span>
            </div>
            <h1>Edit Pet Listing</h1>
            <p>Update pet information – ID #<?= $pet['id'] ?></p>
        </div>
    </section>

    <!-- ===== EDIT FORM ===== -->
    <section class="form-section">
        <div class="container">
            <div class="pet-form-container">
                <form class="pet-form" method="POST" enctype="multipart/form-data">
                    
                    <!-- Image Upload with Current Preview -->
                    <div class="form-group full-width">
                        <span class="form-label">
                            <i data-lucide="image"></i>
                            Pet Photograph
                        </span>
                        <div class="upload-box" id="upload-box">
                            <i data-lucide="cloud-upload" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
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
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="tag"></i> Pet Name</span>
                            <input type="text" name="petName" value="<?= htmlspecialchars($pet['name']) ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="list"></i> Category</span>
                            <select name="category" required>
                                <option value="Dog" <?= $pet['category'] == 'Dog' ? 'selected' : '' ?>>🐕 Dog</option>
                                <option value="Cat" <?= $pet['category'] == 'Cat' ? 'selected' : '' ?>>🐈 Cat</option>
                                <option value="Bird" <?= $pet['category'] == 'Bird' ? 'selected' : '' ?>>🦜 Bird</option>
                                <option value="Fish" <?= $pet['category'] == 'Fish' ? 'selected' : '' ?>>🐠 Fish</option>
                                <option value="Rabbit" <?= $pet['category'] == 'Rabbit' ? 'selected' : '' ?>>🐇 Rabbit</option>
                                <option value="Others" <?= $pet['category'] == 'Others' ? 'selected' : '' ?>>🐾 Others</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="paw-print"></i> Breed</span>
                            <input type="text" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="venus-and-mars"></i> Gender</span>
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
                            <span class="form-label"><i data-lucide="clock"></i> Age (months)</span>
                            <input type="number" name="age" value="<?= $pet['age'] ?>" min="0" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="droplet"></i> Color</span>
                            <input type="text" name="color" value="<?= htmlspecialchars($pet['color']) ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="map-pin"></i> Location</span>
                            <input type="text" name="address" value="<?= htmlspecialchars($pet['address']) ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="phone"></i> Contact</span>
                            <input type="tel" name="number" value="<?= htmlspecialchars($pet['contact']) ?>" required>
                        </div>
                        <div class="form-group">
                            <span class="form-label"><i data-lucide="coins"></i> Price (LKR)</span>
                            <input type="number" step="0.01" name="price" value="<?= $pet['price'] ?>" min="0" required>
                        </div>
                        <div class="form-group full-width">
                            <span class="form-label"><i data-lucide="file-text"></i> Description</span>
                            <textarea name="description" rows="5" required><?= htmlspecialchars($pet['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i data-lucide="check-circle"></i>
                            <span>Update Pet</span>
                        </button>
                        <a href="admin-dashboard.php#pets" class="cancel-btn">
                            <i data-lucide="x-circle"></i>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        lucide.createIcons();

        // Image preview
        const uploadBox = document.getElementById('upload-box');
        const imageInput = document.getElementById('imageUpload');
        const preview = document.getElementById('preview');
        const uploadText = document.getElementById('upload-text');

        if (preview.children.length > 0) uploadText.style.display = 'none';

        uploadBox.addEventListener('click', () => imageInput.click());
        uploadBox.addEventListener('dragover', (e) => { e.preventDefault(); uploadBox.classList.add('dragover'); });
        uploadBox.addEventListener('dragleave', () => uploadBox.classList.remove('dragover'));
        uploadBox.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadBox.classList.remove('dragover');
            if (e.dataTransfer.files[0]) {
                imageInput.files = e.dataTransfer.files;
                previewImage(e.dataTransfer.files[0]);
            }
        });
        imageInput.addEventListener('change', () => {
            if (imageInput.files[0]) previewImage(imageInput.files[0]);
        });

        function previewImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.innerHTML = '';
                preview.style.display = 'block';
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'New Pet Image';
                preview.appendChild(img);
                uploadText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>