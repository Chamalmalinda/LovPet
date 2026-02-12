<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us - LovPet</title>
  <link rel="stylesheet" href="about.css" />
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
      <li><a href="about.php" class="<?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
      <li><a href="find-pet.php">Buy a Pet</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="display-notice.php">Lost Pets</a></li>
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
  <section class="about-hero">
    <div class="hero-decoration hero-decoration-1"></div>
    <div class="hero-decoration hero-decoration-2"></div>
    <div class="container">
      <div class="about-hero-content">
        <span class="section-badge">Who We Are</span>
        <h1>About LovPet</h1>
        <p>Connecting loving pets with caring families across Sri Lanka</p>
      </div>
    </div>
  </section>

  <!-- Story Section -->
  <section class="story-section">
    <div class="container">
      <div class="story-grid">
        <div class="story-image">
          <div class="story-card">
            <div class="story-icon">
              <i data-lucide="heart"></i>
            </div>
            <h3>Our Passion</h3>
            <p>Dedicated to animal welfare</p>
          </div>
          <div class="story-card">
            <div class="story-icon">
              <i data-lucide="users"></i>
            </div>
            <h3>Our Community</h3>
            <p>Building connections</p>
          </div>
          <div class="story-card">
            <div class="story-icon">
              <i data-lucide="shield-check"></i>
            </div>
            <h3>Our Promise</h3>
            <p>Safe & trusted platform</p>
          </div>
        </div>
        <div class="story-content">
          <h2>Our Story</h2>
          <p>LovPet was born from a shared passion for animals and a vision to revolutionize how Sri Lankans connect with pets and pet services. Since our launch, we've been dedicated to empowering pet lovers, simplifying access to trusted pet sellers, and delivering essential products and services nationwide.</p>
          
          <p>From humble beginnings, LovPet has grown into a comprehensive digital marketplace for everything pet-related. Our platform brings together buyers, sellers, rescuers, and veterinary support in one user-friendly space.With features like secure e-commerce, lost pet notices, verified sellers, and live chat, we ensure every paw finds a purpose and a place. Our commitment to innovation, integrity, and community well-being drives every feature we build.</p>
          
          <div class="story-highlight">
            <i data-lucide="sparkles"></i>
            <p><strong>At LovPet, we believe in connecting hearts through paws</strong> — safely, easily, and compassionately.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-section">
    <div class="container">
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon">
            <i data-lucide="users"></i>
          </div>
          <div class="stat-number">500+</div>
          <div class="stat-label">Happy Families</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i data-lucide="heart-handshake"></i>
          </div>
          <div class="stat-number">200+</div>
          <div class="stat-label">Pets Adopted</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i data-lucide="shield-check"></i>
          </div>
          <div class="stat-number">50+</div>
          <div class="stat-label">Verified Sellers</div>
        </div>
        <div class="stat-card">
          <div class="stat-icon">
            <i data-lucide="map-pin"></i>
          </div>
          <div class="stat-number">All</div>
          <div class="stat-label">Districts Covered</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Vision & Mission Section -->
  <section class="vision-mission-section">
    <div class="container">
      <div class="vm-grid">
        
        <div class="vm-card vision-card">
          <div class="vm-icon">
            <i data-lucide="telescope"></i>
          </div>
          <h3>Our Vision</h3>
          <p>To become Sri Lanka's leading digital platform for pet commerce and care — empowering pet lovers through trusted connections, accessible products, and community-driven services.</p>
        </div>

        <div class="vm-card mission-card">
          <div class="vm-icon">
            <i data-lucide="target"></i>
          </div>
          <h3>Our Mission</h3>
          <ul>
            <li>
              <i data-lucide="check-circle"></i>
              <span>Enable seamless pet listings and product purchases through secure technology</span>
            </li>
            <li>
              <i data-lucide="check-circle"></i>
              <span>Foster responsible pet ownership with features like lost pet notices and verified sellers</span>
            </li>
            <li>
              <i data-lucide="check-circle"></i>
              <span>Bridge communities via real-time communication tools and social media integration</span>
            </li>
            <li>
              <i data-lucide="check-circle"></i>
              <span>Expand access to essential pet care services for everyone, everywhere in Sri Lanka</span>
            </li>
          </ul>
        </div>

      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="values-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">What Drives Us</span>
        <h2>Our Core Values</h2>
        <p>The principles that guide everything we do</p>
      </div>
      <div class="values-grid">
        
        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="heart"></i>
          </div>
          <h4>Compassion</h4>
          <p>We care deeply about animal welfare and the wellbeing of every pet and pet owner in our community.</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="shield-check"></i>
          </div>
          <h4>Trust</h4>
          <p>Building trust through verified sellers, secure transactions, and transparent practices.</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="lightbulb"></i>
          </div>
          <h4>Innovation</h4>
          <p>Continuously improving our platform with cutting-edge features and user-friendly technology.</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="users"></i>
          </div>
          <h4>Community</h4>
          <p>Fostering a supportive network of pet lovers, sellers, and service providers across Sri Lanka.</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="leaf"></i>
          </div>
          <h4>Responsibility</h4>
          <p>Promoting ethical pet ownership and sustainable practices in all our operations.</p>
        </div>

        <div class="value-card">
          <div class="value-icon">
            <i data-lucide="star"></i>
          </div>
          <h4>Excellence</h4>
          <p>Committed to delivering the highest quality service and support to our users every day.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Board Section -->
  <section class="board-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Leadership Team</span>
        <h2>Board of Directors</h2>
        <p>Meet the passionate individuals driving LovPet forward</p>
      </div>
      <div class="board-grid">
        
        <div class="member-card">
          <div class="member-image">
            <img src="img/chirath.jpg" alt="Chirath Chamuditha">
            <div class="member-overlay">
              <i data-lucide="briefcase"></i>
            </div>
          </div>
          <div class="member-content">
            <h4>Mr. Chirath Chamuditha</h4>
            <p class="position">Founder & CEO</p>
            <p class="bio">Leads platform vision and strategic partnerships to build Sri Lanka's #1 pet marketplace.</p>
          </div>
        </div>

        <div class="member-card">
          <div class="member-image">
            <img src="img/chamal.jpg" alt="Chamal Malinda">
            <div class="member-overlay">
              <i data-lucide="settings"></i>
            </div>
          </div>
          <div class="member-content">
            <h4>Mr. Chamal Malinda</h4>
            <p class="position">Operations Director</p>
            <p class="bio">Manages business operations, team coordination, and service optimization.</p>
          </div>
        </div>

        <div class="member-card">
          <div class="member-image">
            <img src="img/yasitha.jpg" alt="Yasitha Heshan">
            <div class="member-overlay">
              <i data-lucide="code"></i>
            </div>
          </div>
          <div class="member-content">
            <h4>Mr. Yasitha Heshan</h4>
            <p class="position">Tech Lead</p>
            <p class="bio">Architects the platform infrastructure and oversees software development.</p>
          </div>
        </div>

        <div class="member-card">
          <div class="member-image">
            <img src="img/oshan.jpg" alt="Oshan Devinda">
            <div class="member-overlay">
              <i data-lucide="megaphone"></i>
            </div>
          </div>
          <div class="member-content">
            <h4>Mr. Oshan Devinda</h4>
            <p class="position">Marketing Head</p>
            <p class="bio">Drives digital campaigns and community engagement across Sri Lanka.</p>
          </div>
        </div>

        <div class="member-card">
          <div class="member-image">
            <img src="img/tharushika.jpg" alt="Tharushika Sewwandi">
            <div class="member-overlay">
              <i data-lucide="headphones"></i>
            </div>
          </div>
          <div class="member-content">
            <h4>Ms. Tharushika Sewwandi</h4>
            <p class="position">Customer Relations Manager</p>
            <p class="bio">Ensures exceptional support experiences and fosters positive customer relationships.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section">
    <div class="cta-decoration cta-decoration-1"></div>
    <div class="cta-decoration cta-decoration-2"></div>
    <div class="container">
      <div class="cta-content">
        <div class="cta-icon">
          <i data-lucide="heart"></i>
        </div>
        <h2>Join Our Growing Community</h2>
        <p>Start your journey with LovPet today and find your perfect companion</p>
        <a href="find-pet.php" class="btn btn-primary btn-large">
          <span>Browse Pets</span>
          <i data-lucide="arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

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
    // Initialize Lucide icons
    lucide.createIcons();
  </script>

</body>

</html>