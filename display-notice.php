<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lost Pet Notices - LovPet</title>
  <link rel="stylesheet" href="display-notice.css" />
</head>
<body>

    <!-- Navigation -->
  <nav class="navbar">
    <div class="logo">
      <img src="img/logo.png" alt="LovPet Logo" />
    </div>
    <ul class="nav-menu">
      <a href="index.php"class="active"><img src="img/home.png" alt="Home" class="icon" /></a>
      <li><a href="about.php">About Us</a></li>
      <li><a href="find-pet.php">Buy a Pet</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="display-notice.php" class="active">Lost Pet Notices</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="login.php">Signup</a></li>
    </ul>
  </nav>

  
  <div class="lost-notice-container">
    <div class="header">
      <h2>Lost Pet Notices</h2>
      <a href="lost-notice.php" class="add-notice-btn">+ Add Notice</a>
    </div>

    <div class="notice-grid">
      <?php
        
        $conn = new mysqli("localhost", "root", "", "lovpet_db");

        
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        
        $sql = "SELECT * FROM lost_notices ORDER BY id DESC";
        $result = $conn->query($sql);

        
        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '
              <div class="notice-card">
                <img src="' . htmlspecialchars($row["image"]) . '" alt="Lost Pet">
                <h3>' . htmlspecialchars($row["pet_name"]) . '</h3>
                <p><strong>Breed:</strong> ' . htmlspecialchars($row["breed"]) . '</p>
                <p><strong>Last Seen:</strong> ' . htmlspecialchars($row["location"]) . '</p>
                <p><strong>Contact:</strong> ' . htmlspecialchars($row["contact"]) . '</p>
                <p>' . nl2br(htmlspecialchars($row["description"])) . '</p>
              </div>
            ';
          }
        } else {
          echo "<p style='color:gray;'>No lost pet notices found.</p>";
        }

        $conn->close();
      ?>
    </div>
  </div>
  
<!-- Footer -->
  <footer>
    <img src="img/logo.png" alt="Logo" class="footer-logo">
    <div class="footer-content">

      <div class="footer-left footer-column">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About us</a></li>
          <li><a href="find-pet.php">Find a Pet</a></li>
          <li><a href="product.php">Products</a></li>
          <li><a href="display-notice.php">Lost Pet Notice</a></li>
          <li><a href="cart.php">Cart</a></li>
          <li><a href="login.php">Signup</a></li>
         
        </ul>
      </div>

      <div class="footer-middle footer-column">
        <ul>
          <li><a href="faq.php">FAQs</a></li>
          <li><a href="terms.php">Terms of Services</a></li>
          <li><a href="privacy.php">Privacy Policy</a></li>
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
