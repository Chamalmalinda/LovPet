<?php
session_start();


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$query = $conn->query("SELECT * FROM users WHERE id = $userId");
$user = $query->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Buyer Dashboard - LovPet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="buyer-dashboard.css" />
</head>
<body>

  <div class="dashboard-container">
    <h1>👋 Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?>!</h1>
    <p>This is your personal dashboard. View your profile and shopping cart history below.</p>

    <div class="section">
      <h2>📋 Your Registration Details</h2>
      <ul class="profile-list">
        <li><strong>Name:</strong> <?= htmlspecialchars($user['fullname']) ?></li>
        <li><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
        <li><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></li>
        <li><strong>Contact:</strong> <?= htmlspecialchars($user['contact']) ?></li>
      </ul>
    </div>

    <div class="section">
      <h2>🛒 Your Cart History</h2>
      <?php if (!empty($_SESSION['cart'])): ?>
        <table class="cart-table">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Brand/Breed</th>
              <th>Price (LKR)</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['cart'] as $item): ?>
              <tr>
                <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="Item" width="60"></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td><?= htmlspecialchars($item['breed']) ?></td>
                <td><?= number_format($item['price'], 2) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p class="empty">🕊️ You haven’t added any items to your cart yet.</p>
      <?php endif; ?>
    </div>

    <div class="btn-group">
      <button class="home-btn" onclick="window.location.href='buyer-index.php'">🏠 Home</button>
      <button class="logout-btn" onclick="return confirmLogout()">🚪 Logout</button>
    </div>
  </div>

  <script>
    function confirmLogout() {
      if (confirm("Are you sure you want to logout?")) {
        window.location.href = 'login.php';
        return true;
      }
      return false;
    }
  </script>

</body>
</html>
