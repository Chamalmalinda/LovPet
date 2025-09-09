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
$userResult = $conn->query("SELECT * FROM users WHERE id = $userId");
$user = $userResult->fetch_assoc();


if (isset($_GET['delete_pet'])) {
    $petId = intval($_GET['delete_pet']);
    $conn->query("DELETE FROM pets WHERE id = $petId AND seller_id = $userId");
}


$petsResult = $conn->query("SELECT * FROM pets WHERE seller_id = $userId");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Seller Dashboard - LovPet</title>
  <link rel="stylesheet" href="seller-dashboard.css" />
</head>
<body>

  <div class="dashboard-container">
    <h1>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?>!</h1>
    <p>This is your Seller Dashboard. You can manage your pets and view your profile details.</p>

   
    <div class="section">
      <h2>Your Registration Details</h2>
      <ul class="profile-list">
        <li><strong>Name:</strong> <?= htmlspecialchars($user['fullname']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
        <li><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></li>
        <li><strong>Contact:</strong> <?= htmlspecialchars($user['contact']) ?></li>
      </ul>
    </div>

   
    <div class="section">
      <h2>Your Pet Listings</h2>
      <a href="addpet.php" class="add-btn">➕ Add New Pet</a>
      <?php if ($petsResult && $petsResult->num_rows > 0): ?>
        <table class="pet-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Breed</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($pet = $petsResult->fetch_assoc()): ?>
              <tr>
                <td><?= $pet['id'] ?></td>
                <td><?= htmlspecialchars($pet['name']) ?></td>
                <td><?= htmlspecialchars($pet['breed']) ?></td>
                <td>LKR <?= number_format($pet['price'], 2) ?></td>
                <td>
                  <a href="edit-pet.php?id=<?= $pet['id'] ?>" class="edit-btn">Edit</a>
                  <a href="?delete_pet=<?= $pet['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure to delete this pet?')">Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="empty">You haven't added any pets yet.</p>
      <?php endif; ?>
    </div>

    
    <div class="btn-group">
      <button class="home-btn" onclick="location.href='seller-index.php'">🏠 Home</button>
      <button class="logout-btn" onclick="location.href='login.php'">🚪 Logout</button>
    </div>
  </div>

</body>
</html>
