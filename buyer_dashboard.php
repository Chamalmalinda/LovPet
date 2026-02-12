<?php
session_start();

// Check if user is logged in as buyer
if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'buyer') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];
$userQuery = $conn->query("SELECT * FROM users WHERE id = $userId");
$user = $userQuery->fetch_assoc();

// Fetch purchase history (orders table)
$ordersQuery = $conn->query("SELECT * FROM orders WHERE user_id = $userId ORDER BY order_date DESC");

// Calculate statistics
$totalOrders = 0;
$totalSpent = 0;
$recentOrders = [];

if ($ordersQuery && $ordersQuery->num_rows > 0) {
    while ($order = $ordersQuery->fetch_assoc()) {
        $totalOrders++;
        $totalSpent += $order['total_amount'] ?? 0;
        $recentOrders[] = $order;
    }
}

// Get cart items count
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$cartTotal = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartTotal += $item['price'] ?? 0;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Buyer Dashboard - LovPet</title>
  <link rel="stylesheet" href="buyer-dashboard.css" />
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
        <a href="cart.php" class="nav-btn cart-btn">
          <i data-lucide="shopping-cart"></i>
          <span>Cart</span>
          <?php if ($cartCount > 0): ?>
            <span class="cart-badge"><?= $cartCount ?></span>
          <?php endif; ?>
        </a>
        <a href="logout.php" class="nav-btn logout" onclick="return confirm('Are you sure you want to logout?')">
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
            <h1>Welcome back, <?= htmlspecialchars($_SESSION['fullname'] ?? '') ?>!</h1>
            <p>Track your orders, manage your profile, and discover your perfect pet companion</p>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="stats-grid">
        
        <div class="stat-card">
          <div class="stat-icon stat-icon-primary">
            <i data-lucide="shopping-bag"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Total Orders</div>
            <div class="stat-value"><?= $totalOrders ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon-success">
            <i data-lucide="wallet"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Total Spent</div>
            <div class="stat-value">LKR <?= number_format($totalSpent ?? 0) ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon-info">
            <i data-lucide="shopping-cart"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Cart Items</div>
            <div class="stat-value"><?= $cartCount ?></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon stat-icon-warning">
            <i data-lucide="heart"></i>
          </div>
          <div class="stat-content">
            <div class="stat-label">Wishlist</div>
            <div class="stat-value">0</div>
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
                  <span class="profile-value"><?= htmlspecialchars($user['fullname'] ?? '') ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="mail"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Email Address</span>
                  <span class="profile-value"><?= htmlspecialchars($user['email'] ?? '') ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="phone"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Contact Number</span>
                  <span class="profile-value"><?= htmlspecialchars($user['contact'] ?? '') ?></span>
                </div>
              </div>

              <div class="profile-item">
                <div class="profile-icon">
                  <i data-lucide="map-pin"></i>
                </div>
                <div class="profile-info">
                  <span class="profile-label">Address</span>
                  <span class="profile-value"><?= htmlspecialchars($user['address'] ?? '') ?></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Current Cart Section -->
        <div class="content-card cart-card">
          <div class="card-header">
            <div class="card-title">
              <i data-lucide="shopping-cart"></i>
              <h2>Current Cart</h2>
            </div>
            <a href="cart.php" class="view-cart-btn">
              <span>View Full Cart</span>
              <i data-lucide="arrow-right"></i>
            </a>
          </div>
          <div class="card-body">
            <?php if (!empty($_SESSION['cart'])): ?>
              <div class="cart-items">
                <?php 
                $displayLimit = 3;
                $count = 0;
                foreach ($_SESSION['cart'] as $item): 
                  if ($count >= $displayLimit) break;
                  $count++;
                ?>
                  <div class="cart-item">
                    <div class="cart-item-image">
                      <img src="<?= htmlspecialchars($item['image'] ?? 'img/placeholder.jpg') ?>" alt="<?= htmlspecialchars($item['name'] ?? '') ?>">
                    </div>
                    <div class="cart-item-details">
                      <h4><?= htmlspecialchars($item['name'] ?? '') ?></h4>
                      <p><?= htmlspecialchars($item['breed'] ?? $item['brand'] ?? '') ?></p>
                      <span class="cart-item-price">LKR <?= number_format($item['price'] ?? 0) ?></span>
                    </div>
                  </div>
                <?php endforeach; ?>
                
                <?php if ($cartCount > $displayLimit): ?>
                  <div class="cart-more">
                    <i data-lucide="plus-circle"></i>
                    <span><?= $cartCount - $displayLimit ?> more items in cart</span>
                  </div>
                <?php endif; ?>
              </div>
              
              <div class="cart-summary">
                <div class="cart-total">
                  <span>Cart Total:</span>
                  <span class="total-amount">LKR <?= number_format($cartTotal) ?></span>
                </div>
                <a href="cart.php" class="checkout-btn">
                  <i data-lucide="credit-card"></i>
                  <span>Proceed to Checkout</span>
                </a>
              </div>
            <?php else: ?>
              <div class="empty-state-small">
                <div class="empty-icon-small">
                  <i data-lucide="shopping-cart"></i>
                </div>
                <p>Your cart is empty</p>
                <a href="find-pet.php" class="browse-btn-small">Browse Pets</a>
              </div>
            <?php endif; ?>
          </div>
        </div>

      </div>

      <!-- Purchase History Section -->
      <div class="content-card purchase-history-card">
        <div class="card-header">
          <div class="card-title">
            <i data-lucide="receipt"></i>
            <h2>Purchase History</h2>
          </div>
        </div>
        <div class="card-body">
          <?php if ($totalOrders > 0): ?>
            <div class="table-wrapper">
              <table class="purchase-table">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($recentOrders as $order): ?>
                    <tr>
                      <td>
                        <span class="order-id">#<?= $order['id'] ?></span>
                      </td>
                      <td><?= date('M d, Y', strtotime($order['order_date'] ?? '')) ?></td>
                      <td><?= htmlspecialchars($order['items_count'] ?? '1') ?> items</td>
                      <td>
                        <span class="order-amount">LKR <?= number_format($order['total_amount'] ?? 0) ?></span>
                      </td>
                      <td>
                        <span class="status-badge status-<?= strtolower($order['status'] ?? 'pending') ?>">
                          <?= ucfirst($order['status'] ?? 'Pending') ?>
                        </span>
                      </td>
                      <td>
                        <a href="order-details.php?id=<?= $order['id'] ?>" class="view-btn">
                          <i data-lucide="eye"></i>
                          <span>View</span>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          <?php else: ?>
            <div class="empty-state">
              <div class="empty-icon">
                <i data-lucide="package-x"></i>
              </div>
              <h3>No Purchase History</h3>
              <p>You haven't made any purchases yet. Start shopping to find your perfect pet companion!</p>
              <a href="find-pet.php" class="browse-btn">
                <i data-lucide="search"></i>
                <span>Browse Available Pets</span>
              </a>
            </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Quick Actions -->
      <div class="quick-actions">
        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="search"></i>
          </div>
          <h3>Find Pets</h3>
          <p>Browse our collection of pets waiting for homes</p>
          <a href="find-pet.php" class="qa-btn">
            <span>Browse Now</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="shopping-bag"></i>
          </div>
          <h3>Shop Products</h3>
          <p>Get food, toys, and accessories for your pets</p>
          <a href="product.php" class="qa-btn">
            <span>Shop Now</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="bell"></i>
          </div>
          <h3>Lost Pets</h3>
          <p>Help reunite lost pets with their families</p>
          <a href="display-notice.php" class="qa-btn">
            <span>View Notices</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="quick-action-card">
          <div class="qa-icon">
            <i data-lucide="heart"></i>
          </div>
          <h3>Pet Adoption</h3>
          <p>Learn about adopting rescue pets</p>
          <a href="adoption.php" class="qa-btn">
            <span>Learn More</span>
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