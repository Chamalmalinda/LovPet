<?php // session_start() if needed ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lost Pet Notices - LovPet</title>
  <link rel="stylesheet" href="display-notice.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

  <!-- Navigation -->
<?php
// Start session if not already (safe)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar">
  <div class="container nav-content">
    <a href="index.php" class="logo">
      <div class="logo-icon">
        <i data-lucide="paw-print"></i>
      </div>
      <span class="logo-text">LovPet</span>
    </a>

    <ul class="nav-menu">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="find-pet.php">Buy a Pet</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="display-notice.php" class="<?= basename($_SERVER['PHP_SELF']) == 'display-notice.php' ? 'active' : '' ?>">Lost Pets</a></li>
      <li><a href="cart.php">Cart</a></li>

      <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Logged in -->
        <li>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></li>
        <li>
          <?php if ($_SESSION['user_type'] === 'admin'): ?>
            <a href="admin-dashboard.php" class="btn-primary">Admin Dashboard</a>
          <?php elseif ($_SESSION['user_type'] === 'seller'): ?>
            <a href="seller_dashboard.php" class="btn-primary">My Dashboard</a>
          <?php elseif ($_SESSION['user_type'] === 'buyer'): ?>
            <a href="buyer_dashboard.php" class="btn-primary">My Dashboard</a>
          <?php endif; ?>
        </li>
        <li><a href="logout.php" class="btn-secondary">Logout</a></li>
      <?php else: ?>
        <!-- Not logged in -->
        <li><a href="login.php" class="btn-primary">Login</a></li>
        <li><a href="register.php" class="btn-secondary">Sign Up</a></li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

  <!-- Hero Section -->
  <section class="page-hero">
    <div class="hero-decoration hero-decoration-1"></div>
    <div class="hero-decoration hero-decoration-2"></div>
    <div class="container">
      <div class="page-hero-content">
        <span class="section-badge">
          <i data-lucide="alert-circle"></i>
          <span>Lost & Found Community</span>
        </span>
        <h1>Lost Pet Notices</h1>
        <p>Help reunite missing pets with their loving families across Sri Lanka</p>
      </div>
    </div>
  </section>

  <!-- Filter and Search Section -->
  <section class="filter-section-wrapper">
    <div class="container">
      <div class="filter-search-container">
        
        <!-- Search Bar -->
        <div class="search-box">
          <i data-lucide="search"></i>
          <input type="text" id="searchInput" placeholder="Search by name, breed or location..." />
        </div>

        <!-- Category Filter -->
        <div class="category-filter">
          <div class="filter-label">
            <i data-lucide="filter"></i>
            <span>Category</span>
          </div>
          <select id="categoryFilter">
            <option value="all">All Pets</option>
            <option value="dog">Dogs</option>
            <option value="cat">Cats</option>
            <option value="bird">Birds</option>
            <option value="fish">Fish</option>
            <option value="others">Others</option>
          </select>
        </div>

        <!-- Add Notice Button -->
        <a href="lost-notice.php" class="add-notice-btn">
          <i data-lucide="plus"></i>
          <span>Report Lost Pet</span>
        </a>

        <!-- Results Count -->
        <div class="results-count">
          <i data-lucide="list"></i>
          <span id="resultsCount">0 notices found</span>
        </div>

      </div>
    </div>
  </section>

  <!-- Notices Grid Section -->
  <section class="notices-section">
    <div class="container">
      <div class="notice-grid" id="noticeGrid">
        <?php
          $conn = new mysqli("localhost", "root", "", "lovpet_db");
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM lost_notices ORDER BY id DESC";
          $result = $conn->query($sql);

          if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $shortDesc = strlen($row["description"]) > 100 ? substr($row["description"], 0, 100) . '...' : $row["description"];
              echo '
                <div class="notice-card">
                  <div class="notice-card-image">
                    <img src="' . htmlspecialchars($row["image"]) . '" alt="' . htmlspecialchars($row["pet_name"]) . '">
                    <div class="lost-badge">LOST</div>
                    <div class="notice-badge">
                      <i data-lucide="heart"></i>
                    </div>
                  </div>
                  <div class="notice-card-content">
                    <h3>' . htmlspecialchars($row["pet_name"]) . '</h3>
                    <div class="notice-info">
                      <div class="info-item">
                        <i data-lucide="info"></i>
                        <span>' . htmlspecialchars($row["breed"]) . '</span>
                      </div>
                      <div class="info-item">
                        <i data-lucide="map-pin"></i>
                        <span>Last seen: ' . htmlspecialchars($row["location"]) . '</span>
                      </div>
                      <div class="info-item">
                        <i data-lucide="phone"></i>
                        <span>' . htmlspecialchars($row["contact"]) . '</span>
                      </div>
                    </div>
                    <p class="short-desc">' . nl2br(htmlspecialchars($shortDesc)) . '</p>
                    <button class="view-details-btn"
                      data-name="' . htmlspecialchars($row["pet_name"]) . '"
                      data-breed="' . htmlspecialchars($row["breed"]) . '"
                      data-location="' . htmlspecialchars($row["location"]) . '"
                      data-contact="' . htmlspecialchars($row["contact"]) . '"
                      data-description="' . htmlspecialchars($row["description"]) . '"
                      data-image="' . htmlspecialchars($row["image"]) . '">
                      <span>View Full Details</span>
                      <i data-lucide="arrow-right"></i>
                    </button>
                  </div>
                </div>
              ';
            }
          } else {
            echo '
              <div class="no-results">
                <i data-lucide="search-x"></i>
                <h3>No Lost Pet Notices Found</h3>
                <p>Be the first to report a missing pet!</p>
              </div>
            ';
          }

          $conn->close();
        ?>
      </div>
    </div>
  </section>

  <!-- Modal -->
  <div class="modal" id="noticeModal">
    <div class="modal-overlay" id="modalOverlay"></div>
    <div class="modal-content">
      <button class="modal-close" id="closeModal">
        <i data-lucide="x"></i>
      </button>
      
      <div class="modal-image-section">
        <img id="modalImage" src="" alt="Lost Pet Image" />
        <div class="modal-lost-badge">LOST</div>
      </div>

      <div class="modal-details">
        <div class="modal-header">
          <h2 id="modalName"></h2>
        </div>

        <div class="modal-info-grid">
          <div class="modal-info-item">
            <i data-lucide="info"></i>
            <div>
              <span class="info-label">Breed</span>
              <span class="info-value" id="modalBreed"></span>
            </div>
          </div>
          <div class="modal-info-item">
            <i data-lucide="map-pin"></i>
            <div>
              <span class="info-label">Last Seen Location</span>
              <span class="info-value" id="modalLocation"></span>
            </div>
          </div>
          <div class="modal-info-item">
            <i data-lucide="phone"></i>
            <div>
              <span class="info-label">Contact Owner</span>
              <span class="info-value"><a href="tel:" id="modalContactLink"></a></span>
            </div>
          </div>
        </div>

        <div class="modal-description">
          <h4>
            <i data-lucide="file-text"></i>
            <span>Description</span>
          </h4>
          <p id="modalDescription"></p>
        </div>

        <div class="modal-actions">
          <a href="tel:" id="callButton" class="call-btn">
            <i data-lucide="phone-call"></i>
            <span>Call Owner</span>
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-column footer-brand">
          <div class="footer-logo">
            <div class="logo-icon">
              <i data-lucide="paw-print"></i>
            </div>
            <span class="logo-text">LovPet</span>
          </div>
          <p class="footer-description">Connecting loving pets with caring families across Sri Lanka since 2020.</p>
          <div class="social-links">
            <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
              <i data-lucide="instagram"></i>
            </a>
            <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
              <i data-lucide="facebook"></i>
            </a>
          </div>
        </div>

        <div class="footer-column">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="find-pet.php">Find a Pet</a></li>
            <li><a href="product.php">Products</a></li>
            <li><a href="display-notice.php">Lost Pet Notice</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Support</h4>
          <ul>
            <li><a href="faq.php">FAQs</a></li>
            <li><a href="terms.php">Terms of Service</a></li>
            <li><a href="privacy.php">Privacy Policy</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Sign Up</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h4>Contact Us</h4>
          <ul class="contact-list">
            <li>
              <i data-lucide="mail"></i>
              <span>lovpet123@gmail.com</span>
            </li>
            <li>
              <i data-lucide="phone"></i>
              <span>071-4577814</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
      </div>
    </div>
  </footer>

  <script>
    lucide.createIcons();

    let currentSearch = '';
    let currentCategory = 'all';

    function filterNotices() {
      const query = currentSearch.toLowerCase();
      let visibleCount = 0;
      const totalNotices = document.querySelectorAll('.notice-card').length;

      const categoryKeywords = {
        dog: ["dog", "labrador", "bulldog", "german shepherd", "beagle", "poodle", "husky", "retriever"],
        cat: ["cat", "persian", "siamese", "maine coon", "bengal", "ragdoll"],
        bird: ["bird", "parrot", "macaw", "cockatoo", "parakeet", "canary"],
        fish: ["fish", "goldfish", "betta", "guppy", "koi", "tetra"]
      };

      document.querySelectorAll('.notice-card').forEach(card => {
        const name = card.querySelector('h3').textContent.toLowerCase();
        const breed = card.querySelector('.info-item:nth-child(1) span').textContent.toLowerCase();
        const location = card.querySelector('.info-item:nth-child(2) span').textContent.toLowerCase();
        const text = name + ' ' + breed + ' ' + location;

        const matchesSearch = text.includes(query);

        let matchesCategory = true;
        if (currentCategory !== 'all') {
          if (currentCategory === 'others') {
            const allKnown = [].concat(...Object.values(categoryKeywords));
            matchesCategory = !allKnown.some(kw => breed.includes(kw));
          } else {
            const keywords = categoryKeywords[currentCategory] || [];
            matchesCategory = keywords.some(kw => breed.includes(kw));
          }
        }

        if (matchesSearch && matchesCategory) {
          card.style.display = 'block';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      document.getElementById('resultsCount').textContent = `${visibleCount} notices found`;

      const existingMessage = document.getElementById('filteredNoResults');
      if (visibleCount === 0 && totalNotices > 0) {
        if (!existingMessage) {
          const noResultsDiv = document.createElement('div');
          noResultsDiv.id = 'filteredNoResults';
          noResultsDiv.className = 'no-results';
          noResultsDiv.innerHTML = `
            <i data-lucide="search-x"></i>
            <h3>No Notices Match Your Search or Filters</h3>
            <p>Try different keywords or change the category.</p>
          `;
          document.getElementById('noticeGrid').appendChild(noResultsDiv);
          lucide.createIcons();
        }
      } else if (existingMessage) {
        existingMessage.remove();
      }
    }

    // Modal
    document.querySelectorAll('.view-details-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        document.getElementById('modalName').textContent = btn.dataset.name;
        document.getElementById('modalBreed').textContent = btn.dataset.breed;
        document.getElementById('modalLocation').textContent = btn.dataset.location;
        const contact = btn.dataset.contact;
        document.getElementById('modalContactLink').textContent = contact;
        document.getElementById('modalContactLink').href = 'tel:' + contact;
        document.getElementById('callButton').href = 'tel:' + contact;
        document.getElementById('modalDescription').innerHTML = btn.dataset.description.replace(/\n/g, '<br>');
        document.getElementById('modalImage').src = btn.dataset.image;
        
        document.getElementById('noticeModal').classList.add('active');
        document.body.style.overflow = 'hidden';
        
        setTimeout(() => lucide.createIcons(), 100);
      });
    });

    function closeModal() {
      document.getElementById('noticeModal').classList.remove('active');
      document.body.style.overflow = 'auto';
    }

    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('modalOverlay').addEventListener('click', closeModal);
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeModal();
    });

    // Filters
    document.getElementById('searchInput').addEventListener('input', function () {
      currentSearch = this.value.trim();
      filterNotices();
    });

    document.getElementById('categoryFilter').addEventListener('change', function () {
      currentCategory = this.value.toLowerCase();
      filterNotices();
    });

    filterNotices();
    setTimeout(() => lucide.createIcons(), 500);
  </script>

</body>
</html>