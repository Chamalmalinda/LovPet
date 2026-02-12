<?php
session_start();

// Admin access only
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Check if product ID is provided
if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit();
}

$productId = intval($_GET['id']);

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details
$stmt = $conn->prepare("SELECT id, name, brand, quantity, price, description, image FROM products WHERE id = ?");
$stmt->bind_param("i", $productId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Product not found.";
    exit();
}

$product = $result->fetch_assoc();
$stmt->close();

// Handle form submission
$success = $error = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $imageData = null;

    // Check if new image uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
    }

    // Update query
    if ($imageData) {
        // With new image
        $updateStmt = $conn->prepare("UPDATE products SET name=?, brand=?, quantity=?, price=?, description=?, image=? WHERE id=?");
        $updateStmt->bind_param("sssdsbi", $name, $brand, $quantity, $price, $description, $null, $productId);
        $null = NULL;
        $updateStmt->send_long_data(5, $imageData);
    } else {
        // Keep existing image
        $updateStmt = $conn->prepare("UPDATE products SET name=?, brand=?, quantity=?, price=?, description=? WHERE id=?");
        $updateStmt->bind_param("sssdsi", $name, $brand, $quantity, $price, $description, $productId);
    }

    if ($updateStmt->execute()) {
        $success = "Product updated successfully!";
        // Refresh product data
        $refreshStmt = $conn->prepare("SELECT id, name, brand, quantity, price, description, image FROM products WHERE id = ?");
        $refreshStmt->bind_param("i", $productId);
        $refreshStmt->execute();
        $refreshResult = $refreshStmt->get_result();
        $product = $refreshResult->fetch_assoc();
        $refreshStmt->close();
    } else {
        $error = "Failed to update product: " . $conn->error;
    }
    $updateStmt->close();
}

$conn->close();

// Convert BLOB to base64 for display
$currentImageBase64 = "";
if (!empty($product['image'])) {
    $currentImageBase64 = 'data:image/jpeg;base64,' . base64_encode($product['image']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Edit Product - LovPet 🐾</title>

    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Page Styles -->
    <link rel="stylesheet" href="admin-edit-product.css">
</head>
<body>

    <!-- ===== ADMIN NAVIGATION ===== -->
    <nav class="admin-nav">
        <div class="container nav-content">
            <a href="admin-dashboard.php" class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet Admin</span>
            </a>
            <a href="admin-dashboard.php#products" class="back-link">
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
                <span>Admin: Edit Product</span>
            </div>
            <h1>Edit Product</h1>
            <p>Update product details – ID #<?= $product['id'] ?></p>
        </div>
    </section>

    <!-- ===== EDIT PRODUCT FORM SECTION ===== -->
    <section class="form-section">
        <div class="container">
            <div class="product-form-container">

                <!-- Success / Error Messages -->
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i data-lucide="check-circle"></i>
                        <span><?= htmlspecialchars($success) ?></span>
                    </div>
                <?php elseif ($error): ?>
                    <div class="alert alert-error">
                        <i data-lucide="alert-circle"></i>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <form class="product-form" method="POST" enctype="multipart/form-data">

                    <!-- Image Upload with Current Image Preview -->
                    <div class="form-group full-width">
                        <span class="form-label">
                            <i data-lucide="image"></i>
                            Product Image
                        </span>
                        <div class="upload-box" id="upload-box">
                            <i data-lucide="cloud-upload" style="width: 40px; height: 40px; color: var(--primary); margin-bottom: 12px;"></i>
                            <p id="upload-text">Drag & drop new image here or click to replace</p>
                            <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
                            <div id="preview" class="preview-container">
                                <?php if ($currentImageBase64): ?>
                                    <img src="<?= $currentImageBase64 ?>" alt="Current Product Image">
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="help-text">Leave empty to keep current image</p>
                    </div>

                    <!-- Product Details Grid -->
                    <div class="form-grid">
                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="tag"></i>
                                Product Name
                            </span>
                            <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" placeholder="e.g., Premium Dog Food" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="building"></i>
                                Brand
                            </span>
                            <input type="text" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" placeholder="e.g., Pedigree, Whiskas" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="package"></i>
                                Quantity
                            </span>
                            <input type="text" name="quantity" value="<?= htmlspecialchars($product['quantity']) ?>" placeholder="e.g., 2kg, 1L, 10pcs" required>
                        </div>

                        <div class="form-group">
                            <span class="form-label">
                                <i data-lucide="coins"></i>
                                Price (LKR)
                            </span>
                            <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" placeholder="e.g., 2500.00" min="0" required>
                        </div>

                        <div class="form-group full-width">
                            <span class="form-label">
                                <i data-lucide="file-text"></i>
                                Description
                            </span>
                            <textarea name="description" rows="5" placeholder="Product details, features, benefits..." required><?= htmlspecialchars($product['description']) ?></textarea>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="submit-btn">
                            <i data-lucide="check-circle"></i>
                            <span>Update Product</span>
                        </button>
                        <a href="admin-dashboard.php#products" class="cancel-btn">
                            <i data-lucide="x-circle"></i>
                            <span>Cancel</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Image Preview & Lucide Icons Script -->
    <script>
        lucide.createIcons();

        // ----- Image Upload & Preview -----
        const uploadBox = document.getElementById('upload-box');
        const imageInput = document.getElementById('imageUpload');
        const preview = document.getElementById('preview');
        const uploadText = document.getElementById('upload-text');

        // If there's already a preview image (current product image), hide default text
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
                img.alt = 'New Product Image';
                preview.appendChild(img);
                uploadText.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    </script>

</body>
</html>