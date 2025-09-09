<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['breed'], $_POST['price'], $_POST['image'])) {
  $item = [
    'name' => $_POST['name'],
    'breed' => $_POST['breed'],
    'price' => (float)$_POST['price'],
    'image' => $_POST['image']
  ];

  $_SESSION['cart'][] = $item;
  header("Location: cart.php");
  exit;
}

if (isset($_GET['remove'])) {
  $index = (int)$_GET['remove'];
  unset($_SESSION['cart'][$index]);
  $_SESSION['cart'] = array_values($_SESSION['cart']); 
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
  $total += $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Your Cart - LovPet</title>
  <link rel="stylesheet" href="cart.css" />
</head>
<body>

   <!-- Navigation -->
  <nav class="navbar">
    <div class="logo">
      <img src="img/logo.png" alt="LovPet Logo" />
    </div>
    <ul class="nav-menu">
      <a href="buyer-index.php"class="active"><img src="img/home.png" alt="Home" class="icon" /></a>
      <li><a href="buyer-about.php">About Us</a></li>
      <li><a href="buyer-find-pet.php">Buy a Pet</a></li>
      <li><a href="buyer-product.php">Products</a></li>
      <li><a href="buyer-display-notice.php">Lost Pet Notices</a></li>
      <li><a href="buyer-cart.php" class="active">Cart</a></li>
      <li><a href="buyer_dashboard.php">Dashboard</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>


  <div class="cart-container">
    <h2>Your Cart</h2>

    <?php if (empty($_SESSION['cart'])): ?>
      <p class="empty">Your cart is empty.</p>
    <?php else: ?>
      <table class="cart-table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Breed / Brand</th>
            <th>Price (LKR)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($_SESSION['cart'] as $index => $item): ?>
            <tr>
              <td>
                <img src="<?= htmlspecialchars($item['image']) ?>" alt="Cart Item" style="width: 80px; height: auto;">
              </td>
              <td><?= htmlspecialchars($item['name']) ?></td>
              <td><?= htmlspecialchars($item['breed']) ?></td>
              <td><?= number_format($item['price'], 2) ?></td>
              <td>
                <a href="buyer-cart.php?remove=<?= $index ?>" class="remove-btn">Remove</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <div class="cart-total">
        <strong>Total:</strong> LKR <?= number_format($total, 2) ?>
      </div>

      <form method="POST" action="buyer-online-payment.php">
  <input type="hidden" name="total_amount" value="<?= number_format($total, 2, '.', '') ?>">
  <button type="submit" class="checkout-btn">Proceed to Checkout</button>
</form>

    <?php endif; ?>
  </div>

  <!-- Footer -->
  <footer>
    <img src="img/logo.png" alt="Logo" class="footer-logo">
    <div class="footer-content">

      <div class="footer-left footer-column">
        <ul>
          <li><a href="buyer-index.php">Home</a></li>
          <li><a href="buyer-about.php">About us</a></li>
          <li><a href="buyer-find-pet.php">Find a Pet</a></li>
          <li><a href="buyer-product.php">Products</a></li>
          <li><a href="buyer-display-notice.php">Lost Pet Notice</a></li>
          <li><a href="buyer-cart.php">Cart</a></li>
          <li><a href="login.php">Signup</a></li>
         
        </ul>
      </div>

      <div class="footer-middle footer-column">
        <ul>
          <li><a href="buyer-faq.php">FAQs</a></li>
          <li><a href="buyer-terms.php">Terms of Services</a></li>
          <li><a href="buyer-privacy.php">Privacy Policy</a></li>
        </ul>
      </div>

      <div class="footer-right footer-column">
        <div class="contact-line">
          <img src="img/email1.png" alt="Email Icon" class="icon-img" />
          <span>lovpet123@gmail.com</span>
        </div>
        <div class="contact-line">
          <img src="img/call1.png" alt="Phone Icon" class="icon-img" />
          <span>071-4577814</span>
        </div>
        <div class="socials">
          <a href="https://www.instagram.com/yourprofile" target="_blank">
            <img src="img/insta.jpeg" alt="Instagram" class="social-icon" />
          </a>
          <a href="https://www.facebook.com/yourprofile" target="_blank">
            <img src="img/fb.png" alt="Facebook" class="social-icon" />
          </a>
        </div>

      </div>

    </div>
    <p class="copyright">
      Copyright 2025 © LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners
    </p>
  </footer>


</body>
</html>
