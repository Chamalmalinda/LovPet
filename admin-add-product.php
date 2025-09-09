<?php
session_start();

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
  header("Location: login.php");
  exit();
}

$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $brand = $_POST['brand'];
  $quantity = $_POST['quantity'];
  $price = $_POST['price'];
  $description = $_POST['description'];

  if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
    $imageData = file_get_contents($_FILES['image']['tmp_name']);
    
    $conn = new mysqli("localhost", "root", "", "lovpet_db");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO products (name, brand, quantity, price, description, image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssdsb", $name, $brand, $quantity, $price, $description, $null);
    $null = NULL;
    $stmt->send_long_data(5, $imageData);

    if ($stmt->execute()) {
      $success = "Product added successfully!";
    } else {
      $error = "Failed to add product.";
    }

    $stmt->close();
    $conn->close();
  } else {
    $error = "Please upload a valid image.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Product - LovPet Admin</title>
  <link rel="stylesheet" href="admin-add-product.css" />
</head>
<body>

<a href="admin-dashboard.php" class="back-button">← Back to Dashboard</a>


<div class="add-product-container">
  <h2>Add New Product</h2>

  <?php if ($success): ?>
    <p style="color: green;"><?= $success ?></p>
  <?php elseif ($error): ?>
    <p style="color: red;"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" enctype="multipart/form-data" class="product-form">
    <label>Product Name:</label>
    <input type="text" name="name" required>

    <label>Brand:</label>
    <input type="text" name="brand" required>

    <label>Quantity:</label>
    <input type="text" name="quantity" required>

    <label>Price (LKR):</label>
    <input type="number" step="0.01" name="price" required>

    <label>Description:</label>
    <textarea name="description" rows="4" required></textarea>

    <label>Product Image:</label>
    <input type="file" name="image" accept="image/*" required>

    <button type="submit">Add Product</button>
  </form>
</div>

</body>
</html>
