<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Pet Products - LovPet</title>
  <link rel="stylesheet" href="product.css" />
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
      <li><a href="buyer-product.php" class="active">Products</a></li>
      <li><a href="buyer-display-notice.php">Lost Pet Notices</a></li>
      <li><a href="buyer-cart.php">Cart</a></li>
      <li><a href="buyer_dashboard.php">Dashboard</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>

  <!-- Search Bar -->
  <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by product or brand" />
  </div>

  <div class="product-page">
    <main class="product-grid" id="productGrid">

    <?php
      $conn = new mysqli("localhost", "root", "", "lovpet_db");
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $result = $conn->query("SELECT * FROM products ORDER BY id DESC");

      if ($result && $result->num_rows > 0) {
        while ($product = $result->fetch_assoc()) {
          echo '
          <div class="product-card">
            <img src="display-image.php?id=' . $product['id'] . '" alt="Product Image">
            <h4>' . htmlspecialchars($product["name"]) . '</h4>
            <p><strong>Brand:</strong> ' . htmlspecialchars($product["brand"]) . '</p>
            <p><strong>Quantity:</strong> ' . htmlspecialchars($product["quantity"]) . '</p>
            <p><strong>Price:</strong> LKR ' . number_format($product["price"], 2) . '</p>
            <p class="description">' . htmlspecialchars($product["description"]) . '</p>
            <div class="button-group">
           
              <form method="POST" action="buyer-cart.php">
                <input type="hidden" name="name" value="' . htmlspecialchars($product["name"]) . '">
                <input type="hidden" name="breed" value="' . htmlspecialchars($product["brand"]) . '">
                <input type="hidden" name="price" value="' . htmlspecialchars($product["price"]) . '">
                <input type="hidden" name="image" value="display-image.php?id=' . $product['id'] . '">
                <button type="submit" class="cart-btn">Add to Cart</button>
              </form>
            </div>
          </div>';
        }
      } else {
        echo "<p style='color:gray;'>No products available.</p>";
      }

      $conn->close();
    ?>
    </main>
  </div>

  <script>
    
    document.getElementById("searchInput").addEventListener("input", function () {
      const query = this.value.toLowerCase();
      document.querySelectorAll(".product-card").forEach(card => {
        const name = card.querySelector("h4").textContent.toLowerCase();
        const brand = card.querySelector("p:nth-of-type(1)").textContent.toLowerCase(); // Brand line
        card.style.display = name.includes(query) || brand.includes(query) ? "block" : "none";
      });
    });
  </script>

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
