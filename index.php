<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LovPet - Pet Shop & Care</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="container top-bar-content">
      <div class="top-left">
        <a href="feedback.php" class="feedback-link">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
          <span>Feedback</span>
        </a>
      </div>
      <div class="top-right">
        <div class="contact-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
          <span>071-4577814</span>
        </div>
        <div class="contact-item">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <span>lovpet123@gmail.com</span>
        </div>
      </div>
    </div>
  </div>

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
      <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
      <li><a href="about.php">About</a></li>
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
  <section class="hero">
    <div class="hero-decoration hero-decoration-1"></div>
    <div class="hero-decoration hero-decoration-2"></div>
    <div class="container hero-content">
      <div class="hero-text">
        <div class="hero-badge">
          <i data-lucide="sparkles"></i>
          <span>Trusted by 500+ Families</span>
        </div>
        <h1>Find Your Perfect Companion</h1>
        <p>Connecting loving pets with caring families. Browse our selection of healthy, friendly pets from trusted sellers across Sri Lanka.</p>
        <div class="hero-buttons">
          <a href="find-pet.php" class="btn btn-primary">
            <span>Browse Pets</span>
            <i data-lucide="arrow-right"></i>
          </a>
          <a href="about.php" class="btn btn-secondary">
            <span>Learn More</span>
          </a>
        </div>
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-icon">
              <i data-lucide="heart"></i>
            </div>
            <div class="stat-info">
              <div class="stat-number">500+</div>
              <div class="stat-label">Happy Families</div>
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-icon">
              <i data-lucide="home"></i>
            </div>
            <div class="stat-info">
              <div class="stat-number">200+</div>
              <div class="stat-label">Pets Available</div>
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-icon">
              <i data-lucide="shield-check"></i>
            </div>
            <div class="stat-info">
              <div class="stat-number">50+</div>
              <div class="stat-label">Verified Sellers</div>
            </div>
          </div>
        </div>
      </div>
      <div class="hero-visual">
        <div class="hero-card card-1">
          <div class="pet-icon pet-icon-dog">
            <i data-lucide="dog"></i>
          </div>
          <div class="card-content">
            <h3>Dogs</h3>
            <p>Loyal & Friendly</p>
          </div>
          <div class="card-shine"></div>
        </div>
        <div class="hero-card card-2">
          <div class="pet-icon pet-icon-cat">
            <i data-lucide="cat"></i>
          </div>
          <div class="card-content">
            <h3>Cats</h3>
            <p>Independent & Loving</p>
          </div>
          <div class="card-shine"></div>
        </div>
        <div class="hero-card card-3">
          <div class="pet-icon pet-icon-bird">
            <i data-lucide="bird"></i>
          </div>
          <div class="card-content">
            <h3>Birds</h3>
            <p>Colorful & Social</p>
          </div>
          <div class="card-shine"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Services Section -->
  <section class="services">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">What We Offer</span>
        <h2>Everything You Need for Your Pet Journey</h2>
        <p>Comprehensive services to help you find, care for, and connect with your furry friends</p>
      </div>
      <div class="services-grid">
        
        <div class="service-card">
          <div class="service-icon">
            <i data-lucide="heart-handshake"></i>
          </div>
          <h3>Pet Adoption</h3>
          <p>Find your perfect pet from our network of verified sellers and breeders across Sri Lanka.</p>
          <a href="adoption.php" class="service-link">
            <span>Explore Pets</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="service-card service-card-featured">
          <div class="featured-badge">
            <i data-lucide="star"></i>
            <span>Popular</span>
          </div>
          <div class="service-icon">
            <i data-lucide="shopping-bag"></i>
          </div>
          <h3>Pet Products</h3>
          <p>Quality food, medicine, toys, and accessories to keep your pet healthy and happy.</p>
          <a href="product.php" class="service-link">
            <span>Shop Now</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

        <div class="service-card">
          <div class="service-icon">
            <i data-lucide="map-pin"></i>
          </div>
          <h3>Lost Pet Notice</h3>
          <p>Post or search for lost pets in your community. Help reunite pets with their families.</p>
          <a href="display-notice.php" class="service-link">
            <span>View Notices</span>
            <i data-lucide="arrow-right"></i>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- Pet Care Section -->
  <section class="pet-care">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Expert Guides</span>
        <h2>Pet Care Resources</h2>
        <p>Professional tips and advice for caring for your beloved companions</p>
      </div>
      <div class="care-grid">
        
        <div class="care-card">
          <div class="care-image care-image-dog">
            <div class="care-icon-wrapper">
              <i data-lucide="dog"></i>
            </div>
          </div>
          <div class="care-content">
            <h3>Dog Care</h3>
            <p>Essential tips for feeding, grooming, training, and keeping your dog healthy and happy.</p>
            <a href="dog-care.php" class="care-link">
              <span>Read Guide</span>
              <i data-lucide="arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="care-card">
          <div class="care-image care-image-cat">
            <div class="care-icon-wrapper">
              <i data-lucide="cat"></i>
            </div>
          </div>
          <div class="care-content">
            <h3>Cat Care</h3>
            <p>Learn about proper nutrition, litter training, grooming, and health care for cats.</p>
            <a href="cat-care.php" class="care-link">
              <span>Read Guide</span>
              <i data-lucide="arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="care-card">
          <div class="care-image care-image-bird">
            <div class="care-icon-wrapper">
              <i data-lucide="bird"></i>
            </div>
          </div>
          <div class="care-content">
            <h3>Bird Care</h3>
            <p>Everything about bird diet, cage maintenance, socialization, and health monitoring.</p>
            <a href="bird-care.php" class="care-link">
              <span>Read Guide</span>
              <i data-lucide="arrow-right"></i>
            </a>
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
        <h2>Ready to Find Your New Best Friend?</h2>
        <p>Browse our selection of healthy, friendly pets waiting for their forever homes.</p>
        <a href="find-pet.php" class="btn btn-primary btn-large">
          <span>Start Your Search</span>
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