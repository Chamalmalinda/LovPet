<?php
session_start();

// Initialize cart session if not present
if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

// Handle addition via POST (from pet or product page)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['breed'], $_POST['price'], $_POST['image'])) {
  $item = [
    'name' => $_POST['name'],
    'breed' => $_POST['breed'] ?? '', // For products, breed might be brand
    'price' => (float)$_POST['price'],
    'image' => $_POST['image']
  ];

  $_SESSION['cart'][] = $item;
  header("Location: cart.php");
  exit;
}

// Handle item removal
if (isset($_GET['remove'])) {
  $index = (int)$_GET['remove'];
  if (isset($_SESSION['cart'][$index])) {
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index
  }
  header("Location: cart.php");
  exit;
}

// Calculate total
$total = 0;
foreach ($_SESSION['cart'] as $item) {
  $total += $item['price'] ?? 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Cart - LovPet</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="cart.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Fixed Home Icon (top-left) -->
  <a href="index.php" class="back-home" aria-label="Back to Home">
    <i data-lucide="home"></i>
  </a>

  <main class="cart-main">
    <div class="container">
      <div class="cart-header">
        <h1>Your Shopping Cart</h1>
        <p class="item-count"><?= count($_SESSION['cart'] ?? []) ?> item<?= count($_SESSION['cart'] ?? []) !== 1 ? 's' : '' ?></p>
      </div>

      <?php if (empty($_SESSION['cart'])): ?>
        <div class="empty-cart">
          <i data-lucide="shopping-cart"></i>
          <h2>Your cart is empty</h2>
          <p>Looks like you haven't added anything yet. Start shopping!</p>
          <a href="find-pet.php" class="continue-shopping-btn">Continue Shopping</a>
        </div>
      <?php else: ?>
        <div class="cart-items">
          <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <div class="cart-item">
              <div class="item-image">
                <img src="<?= htmlspecialchars($item['image'] ?? 'img/placeholder.jpg') ?>" alt="<?= htmlspecialchars($item['name'] ?? '') ?>">
              </div>
              <div class="item-details">
                <h3><?= htmlspecialchars($item['name'] ?? '') ?></h3>
                <!-- breed/brand field - products use brand, pets use breed -->
                <p class="breed"><?= htmlspecialchars($item['breed'] ?? $item['brand'] ?? '') ?></p>
                <p class="price">LKR <?= number_format($item['price'] ?? 0, 2) ?></p>
              </div>
              <a href="cart.php?remove=<?= $index ?>" class="remove-item">
                <i data-lucide="trash-2"></i>
              </a>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="cart-summary">
          <div class="summary-row">
            <span>Subtotal</span>
            <span>LKR <?= number_format($total, 2) ?></span>
          </div>
          <div class="summary-row total">
            <strong>Total</strong>
            <strong>LKR <?= number_format($total, 2) ?></strong>
          </div>

          <a href="checkout.php" class="checkout-btn">
            <span>Proceed to Checkout</span>
            <i data-lucide="arrow-right"></i>
          </a>

          <a href="find-pet.php" class="continue-shopping">← Continue Shopping</a>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <script>
    lucide.createIcons();
  </script>

</body>
</html>