<?php

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT name, message, created_at FROM feedbacks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Feedback - LovPet</title>
  <link rel="stylesheet" href="feedback.css" />
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
      <li><a href="buyer-cart.php">Cart</a></li>
      <li><a href="buyer_dashboard.php">Dashboard</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>

<div class="feedback-container">
  <div class="header">
    <h2>User Feedback</h2>
    <a href="buyer-add-feedback.php" class="add-btn">+ Add Feedback</a>
  </div>

  <?php if ($result && $result->num_rows > 0): ?>
    <div class="feedback-list">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="feedback-card">
          <h4><?= htmlspecialchars($row['name']) ?></h4>
          <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
          <small><?= date("F j, Y g:i A", strtotime($row['created_at'])) ?></small>
        </div>
      <?php endwhile; ?>
    </div>
  <?php else: ?>
    <p class="empty">No feedback found.</p>
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
