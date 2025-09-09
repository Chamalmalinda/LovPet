<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Find a Pet - LovPet</title>
  <link rel="stylesheet" href="find-pet.css" />
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
      <li><a href="find-pet.php" class="active">Buy a Pet</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="display-notice.php">Lost Pet Notices</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="login.php">Signup</a></li>
    </ul>
  </nav>


  <div class="filter-search-wrapper">
    <div class="filter-section">
      <label for="categoryFilter">Filter by Category:</label>
      <select id="categoryFilter">
        <option value="all">All</option>
        <option value="dog">Dog</option>
        <option value="cat">Cat</option>
        <option value="bird">Bird</option>
        <option value="fish">Fish</option>
        <option value="others">Others</option>
      </select>
    </div>

    <div class="search-container">
      <input type="text" id="searchInput" placeholder="Search Pets or Breeds" />
    </div>
  </div>


  <div class="find-pet-container">
    <main class="pet-grid" id="petGrid">
      <?php
        $conn = new mysqli("localhost", "root", "", "lovpet_db");
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM pets ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo '
              <div class="pet-card">
                <img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["name"]) . '" class="zoomable">
                <h3>' . htmlspecialchars($row["name"]) . '</h3>
                <p>Breed: ' . htmlspecialchars($row["breed"]) . '</p>
                <p>Location: ' . htmlspecialchars($row["address"]) . '</p>
                <p>Price: LKR ' . htmlspecialchars($row["price"]) . '</p>
                <button class="view-btn"
                  data-name="' . htmlspecialchars($row["name"]) . '"
                  data-location="' . htmlspecialchars($row["address"]) . '"
                  data-breed="' . htmlspecialchars($row["breed"]) . '"
                  data-gender="' . htmlspecialchars($row["gender"]) . '"
                  data-age="' . htmlspecialchars($row["age"]) . ' months"
                  data-price="' . htmlspecialchars($row["price"]) . '"
                  data-description="' . htmlspecialchars($row["description"]) . '"
                  data-image="' . htmlspecialchars($row["image"]) . '">
                  More Details
                </button>
              </div>
            ';
          }
        } else {
          echo "<p style='color:gray;'>No pets found.</p>";
        }

        $conn->close();
      ?>
    </main>
  </div>

  
  <div class="modal" id="petModal">
    <div class="modal-content">
      <span class="close-btn" id="closeModal">&times;</span>
      <img id="modalImage" src="" alt="Pet Image" />
      <h3 id="modalName"></h3>
      <p><strong>Breed:</strong> <span id="modalBreed"></span></p>
      <p><strong>Gender:</strong> <span id="modalGender"></span></p>
      <p><strong>Age:</strong> <span id="modalAge"></span></p>
      <p><strong>Location:</strong> <span id="modalLocation"></span></p>
      <p><strong>Price:</strong> LKR <span id="modalPrice"></span></p>
      <p><strong>Description:</strong></p>
      <p id="modalDescription"></p>

      
      <form action="add_to_cart.php" method="POST">
        <input type="hidden" name="name" id="formName">
        <input type="hidden" name="breed" id="formBreed">
        <input type="hidden" name="gender" id="formGender">
        <input type="hidden" name="age" id="formAge">
        <input type="hidden" name="address" id="formLocation">
        <input type="hidden" name="price" id="formPrice">
        <input type="hidden" name="description" id="formDescription">
        <input type="hidden" name="image" id="formImage">
        <button type="submit" class="buy-btn">Add to Cart</button>
      </form>
    </div>
  </div>

  <script>
    
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('modalName').textContent = btn.dataset.name;
        document.getElementById('modalBreed').textContent = btn.dataset.breed;
        document.getElementById('modalGender').textContent = btn.dataset.gender;
        document.getElementById('modalAge').textContent = btn.dataset.age;
        document.getElementById('modalLocation').textContent = btn.dataset.location;
        document.getElementById('modalPrice').textContent = btn.dataset.price;
        document.getElementById('modalDescription').textContent = btn.dataset.description;
        document.getElementById('modalImage').src = btn.dataset.image;
        document.getElementById('petModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';

        
        document.getElementById('formName').value = btn.dataset.name;
        document.getElementById('formBreed').value = btn.dataset.breed;
        document.getElementById('formGender').value = btn.dataset.gender;
        document.getElementById('formAge').value = btn.dataset.age;
        document.getElementById('formLocation').value = btn.dataset.location;
        document.getElementById('formPrice').value = btn.dataset.price;
        document.getElementById('formDescription').value = btn.dataset.description;
        document.getElementById('formImage').value = btn.dataset.image;
      });
    });

    
    document.getElementById('closeModal').addEventListener('click', () => {
      document.getElementById('petModal').style.display = 'none';
      document.body.style.overflow = 'auto';
    });

    window.addEventListener('click', e => {
      if (e.target === document.getElementById('petModal')) {
        document.getElementById('petModal').style.display = 'none';
        document.body.style.overflow = 'auto';
      }
    });

   
    document.getElementById('searchInput').addEventListener('input', function () {
      const query = this.value.toLowerCase();
      document.querySelectorAll('.pet-card').forEach(card => {
        const name = card.querySelector('h3').textContent.toLowerCase();
        const breed = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
        card.style.display = name.includes(query) || breed.includes(query) ? 'block' : 'none';
      });
    });

    
    document.getElementById('categoryFilter').addEventListener('change', function () {
      const selected = this.value.toLowerCase();

      const categoryKeywords = {
        dog: ["dog", "labrador", "bulldog", "german shepherd", "beagle"],
        cat: ["cat", "persian", "siamese", "maine coon"],
        bird: ["bird", "parrot", "macaw", "cockatoo"],
        fish: ["fish", "goldfish", "betta", "guppy"]
      };

      document.querySelectorAll('.pet-card').forEach(card => {
        const breed = card.querySelector('p:nth-of-type(1)').textContent.toLowerCase();

        if (selected === "all") {
          card.style.display = "block";
        } else if (selected === "others") {
          const known = [].concat(...Object.values(categoryKeywords));
          const isKnown = known.some(keyword => breed.includes(keyword));
          card.style.display = isKnown ? "none" : "block";
        } else {
          const keywords = categoryKeywords[selected] || [];
          const match = keywords.some(keyword => breed.includes(keyword));
          card.style.display = match ? "block" : "none";
        }
      });
    });
  </script>

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
