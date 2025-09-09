<?php
session_start();


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'seller') {
    header("Location: login.php");
    exit();
}


$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];


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

    
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $uploadDir = "uploads/";
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "❌ Failed to upload image.";
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
        echo "❌ Error updating pet: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Pet - LovPet</title>
  <link rel="stylesheet" href="edit-pet.css">
</head>
<body>

<div class="form-container">
  <h2>Edit Pet Listing</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Pet Name</label>
    <input type="text" name="petName" value="<?= htmlspecialchars($pet['name']) ?>" required>

    <label>Category</label>
    <input type="text" name="category" value="<?= htmlspecialchars($pet['category']) ?>" required>

    <label>Breed</label>
    <input type="text" name="breed" value="<?= htmlspecialchars($pet['breed']) ?>" required>

    <label>Gender</label>
    <select name="gender" required>
      <option value="Male" <?= $pet['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
      <option value="Female" <?= $pet['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
    </select>

    <label>Age</label>
    <input type="number" name="age" value="<?= $pet['age'] ?>" required>

    <label>Color</label>
    <input type="text" name="color" value="<?= htmlspecialchars($pet['color']) ?>" required>

    <label>Address</label>
    <input type="text" name="address" value="<?= htmlspecialchars($pet['address']) ?>" required>

    <label>Contact Number</label>
    <input type="text" name="number" value="<?= htmlspecialchars($pet['contact']) ?>" required>

    <label>Price (LKR)</label>
    <input type="number" step="0.01" name="price" value="<?= $pet['price'] ?>" required>

    <label>Description</label>
    <textarea name="description" rows="4"><?= htmlspecialchars($pet['description']) ?></textarea>

    <label>Upload New Image (optional)</label>
    <input type="file" name="image" accept="image/*">
    <p>Current Image:</p>
    <img src="<?= $pet['image'] ?>" alt="Pet Image" style="max-width:150px; margin-bottom:10px;">

    <button type="submit">Update Pet</button>
    <button type="button" onclick="window.location='seller_dashboard.php'">Cancel</button>
  </form>
</div>

</body>
</html>
