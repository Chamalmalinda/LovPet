<?php
session_start();

// Check if user is logged in as seller
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'seller') {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$userResult = $conn->query("SELECT * FROM users WHERE id = $userId");
$user = $userResult->fetch_assoc();

// Handle delete request
if (isset($_GET['delete_pet'])) {
    $petId = intval($_GET['delete_pet']);
    $conn->query("DELETE FROM pets WHERE id = $petId AND seller_id = $userId");
    header("Location: seller-dashboard.php");
    exit();
}

// Fetch seller's pets
$petsResult = $conn->query("SELECT * FROM pets WHERE seller_id = $userId ORDER BY id DESC");

// Calculate statistics
$totalPets = $petsResult->num_rows;
$totalValue = 0;
if ($totalPets > 0) {
    $petsResult->data_seek(0);
    while ($pet = $petsResult->fetch_assoc()) {
        $totalValue += $pet['price'];
    }
    $petsResult->data_seek(0);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seller Dashboard - LovPet</title>
  <link rel="stylesheet" href="seller-dashboard.css" />
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
      <div class="nav-actions">
        <a href="index.php" class="nav-btn">
          <i data-lucide="home"></i>
          <span>Home</span>
        </a>
        <a href="logout.php" class="nav-btn logout">
          <i data-lucide="log-out"></i>
          <span>Logout</span>
        </a>
      </div>
    </div>
  </nav>

  <!-- Dashboard Container -->
  <div class="dashboard-wrapper">
    <div class="container">

      <!-- Welcome Header -->
      <div class="dashboard-header">
        <div class="welcome-section">
          <div class="avatar">
            <i data-lucide="user-circle"></i>
          </div>
          <div class="welcome-text">
            <h1>Welcome back, <?= htmlspecialchars($_SESSION['fullname']) ?>!</h1>
            <p>Manage your pet listings and track your seller activity</p>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="stats-grid">
        
        <div class="stat-card">
          <div class="stat-icon stat-icon-primary">
            <i data-lucide="package"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Total Listings</div>
            <div class="stat-value"><?= $totalPets ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon-success">
            <i data-lucide="trending-up"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Total Value</div>
            <div class="stat-value">LKR <?= number_format($totalValue) ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon-info">
            <i data-lucide="check-circle"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Account Status</div>
            <div class="stat-value stat-value-small">Active</div>
          </div>
        </div>

      </div>

      <!-- Main Content Grid -->
      <div class="content-grid">

        <!-- Profile Section -->
        <div class="content-card profile-card">
          <div class="card-header">
            <div class="card-title">
              <i data-lucide="user"></i>
              <h2>Your Profile</h2>
            </div>
          </div>
          <div class="card-body">
            <div class="profile-details">
              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="user"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Full Name</span>
                  <span class="profile-value"><?= htmlspecialchars($user['fullname']) ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="mail"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Email Address</span>
                  <span class="profile-value"><?= htmlspecialchars($user['email']) ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="phone"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Contact Number</span>
                  <span class="profile-value"><?= htmlspecialchars($user['contact']) ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="map-pin"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Address</span>
                  <span class="profile-value"><?= htmlspecialchars($user['address']) ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pet Listings Section -->
        <div class="content-card listings-card">
          <div class="card-header">
            <div class="card-title">
              <i data-lucide="list"></i>
              <h2>Your Pet Listings</h2>
            </div>
            <a href="addpet.php" class="add-pet-btn">
              <i data-lucide="plus-circle"></i>
              <span>Add New Pet</span>
            </a>
          </div>
          <div class="card-body">
            <?php if ($petsResult && $totalPets > 0): ?>
              <div class="table-wrapper">
                <table class="pet-table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Pet Name</th>
                      <th>Breed</th>
                      <th>Gender</th>
                      <th>Age</th>
                      <th>Price (LKR)</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php while ($pet = $petsResult->fetch_assoc()): ?>
                      <tr>
                        <td>
                          <span class="pet-id">#<?= $pet['id'] ?></span>
                        </td>
                        <td>
                          <div class="pet-name-cell">
                            <i data-lucide="heart"></i>
                            <span><?= htmlspecialchars($pet['name']) ?></span>
                          </div>
                        </td>
                        <td><?= htmlspecialchars($pet['breed']) ?></td>
                        <td>
                          <span class="gender-badge"><?= htmlspecialchars($pet['gender']) ?></span>
                        </td>
                        <td><?= htmlspecialchars($pet['age']) ?> months</td>
                        <td>
                          <span class="price-tag"><?= number_format($pet['price']) ?></span>
                        </td>
                        <td>
                          <div class="action-buttons">
                            <a href="edit-pet.php?id=<?= $pet['id'] ?>" class="action-btn edit-btn" title="Edit">
                              <i data-lucide="edit"></i>
                            </a>
                            <a href="?delete_pet=<?= $pet['id'] ?>" class="action-btn delete-btn" title="Delete" onclick="return confirm('Are you sure you want to delete this pet listing?')">
                              <i data-lucide="trash-2"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  </tbody>
                </table>
              </div>
            <?php else: ?>
              <div class="empty-state">
                <div class="empty-icon">
                  <i data-lucide="package-x"></i>
                </div>
                <h3>No Listings Yet</h3>
                <p>You haven't added any pets to your store. Start by adding your first pet listing!</p>
                <a href="addpet.php" class="add-first-btn">
                  <i data-lucide="plus-circle"></i>
                  <span>Add Your First Pet</span>
                </a>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <!-- Quick Actions -->
      <div class="quick-actions">
        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="plus-circle"></i>
          </div>
          <h3>Add New Pet</h3>
          <p>List a new pet for sale on the platform</p>
          <a href="addpet.php" class="qa-btn">
            <span>Add Pet</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="home"></i>
          </div>
          <h3>Browse Store</h3>
          <p>View your storefront as customers see it</p>
          <a href="seller-index.php" class="qa-btn">
            <span>View Store</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="help-circle"></i>
          </div>
          <h3>Need Help?</h3>
          <p>Contact support for assistance</p>
          <a href="mailto:lovpet123@gmail.com" class="qa-btn">
            <span>Get Support</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>
      </div>

    </div>
  </div>

  <script>
    // Initialize Lucide icons
    lucide.createIcons();
  </script>

</body>

</html>