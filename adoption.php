<?php
// Start session for navigation (same as homepage)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption - LovPet</title>
  <link rel="stylesheet" href="adoption.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

  <!-- Navigation -->
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
  <section class="adoption-hero">
    <div class="hero-decoration hero-decoration-1"></div>
    <div class="hero-decoration hero-decoration-2"></div>
    <div class="container">
      <div class="adoption-hero-content">
        <span class="section-badge">
          <i data-lucide="heart"></i>
          <span>Make a Difference</span>
        </span>
        <h1>Adopt a Pet, Give Them a Loving Home</h1>
        <p>Every pet deserves a loving home, and every heart has room for a little more love. Join us in giving rescued animals a second chance at happiness.</p>
        <div class="hero-buttons">
          <a href="#adoption-centers" class="btn btn-primary">
            <span>Find Adoption Centers</span>
            <i data-lucide="arrow-down"></i>
          </a>
          <a href="find-pet.php" class="btn btn-secondary">
            <span>Browse Available Pets</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Adopt Section -->
  <section class="why-adopt-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Why Adoption Matters</span>
        <h2>The Life-Changing Power of Pet Adoption</h2>
        <p>Adopting a pet transforms lives both theirs and yours</p>
      </div>
      
      <div class="story-content">
        <p>At LovPet, we believe in second chances, unconditional love, and the lifelong bonds that form between people and their pets. Our platform connects you with adorable, deserving animals each with their own story, personality, and hope for a brighter future.Whether you're searching for a playful puppy with boundless energy, a gentle kitten who loves to cuddle, or a wise and loyal senior companion ready to spend their golden years by your side, your perfect match is waiting.
        We work closely with verified shelters, rescue groups, and foster networks across Sri Lanka to ensure every animal is healthy, vaccinated, and ready to find their forever home. Adopting a pet not only transforms their life.it enriches yours with joy, companionship, and purpose.</p>
      </div>
    </div>
  </section>

  <!-- Benefits Grid -->
  <section class="benefits-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Benefits</span>
        <h2>Why Choose Pet Adoption</h2>
        <p>Discover the incredible advantages of adopting a rescue pet</p>
      </div>
      
      <div class="benefits-grid">
        
        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="heart-handshake"></i>
          </div>
          <h3>Save a Life</h3>
          <p>Adopting a pet saves a life and helps reduce the number of homeless animals in shelters across Sri Lanka.</p>
        </div>

        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="shield-check"></i>
          </div>
          <h3>Healthier Pets</h3>
          <p>Most pets in shelters are vaccinated, dewormed, and spayed or neutered by qualified veterinarians.</p>
        </div>

        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="wallet"></i>
          </div>
          <h3>Cost-Effective</h3>
          <p>Adoption is more affordable than buying from breeders, with many initial medical costs already covered.</p>
        </div>

        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="building"></i>
          </div>
          <h3>Support Shelters</h3>
          <p>Your adoption helps fund shelter operations, rescue efforts, and saves more animals in need.</p>
        </div>

        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="graduation-cap"></i>
          </div>
          <h3>Trained Companions</h3>
          <p>Many rescued pets are already house-trained and socialized, making the transition easier for your family.</p>
        </div>

        <div class="benefit-card">
          <div class="benefit-icon">
            <i data-lucide="sparkles"></i>
          </div>
          <h3>Unconditional Love</h3>
          <p>Adopted pets show incredible gratitude, giving you love, loyalty, and affection every single day.</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Adoption Process -->
  <section class="process-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">How It Works</span>
        <h2>Your Pet Adoption Journey</h2>
        <p>Follow these simple steps to welcome your new family member</p>
      </div>

      <div class="process-timeline">
        
        <div class="process-step">
          <div class="step-number">1</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="search"></i>
            </div>
            <h3>Browse & Research</h3>
            <p>Explore available pets on our platform or visit adoption centers. Research different breeds, temperaments, and care requirements to find your perfect match.</p>
          </div>
        </div>

        <div class="process-step">
          <div class="step-number">2</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="calendar-check"></i>
            </div>
            <h3>Visit & Meet</h3>
            <p>Schedule a visit to meet the pet in person. Spend time interacting, observe their behavior, and ask questions about their history and needs.</p>
          </div>
        </div>

        <div class="process-step">
          <div class="step-number">3</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="file-text"></i>
            </div>
            <h3>Complete Application</h3>
            <p>Fill out the adoption application form. Be honest about your living situation, experience, and ability to care for the pet long-term.</p>
          </div>
        </div>

        <div class="process-step">
          <div class="step-number">4</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="home"></i>
            </div>
            <h3>Home Assessment</h3>
            <p>Some centers conduct home visits to ensure a safe environment. Prepare your home with necessary supplies like food, bedding, and toys.</p>
          </div>
        </div>

        <div class="process-step">
          <div class="step-number">5</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="check-circle"></i>
            </div>
            <h3>Approval & Adoption</h3>
            <p>Once approved, pay the adoption fee and sign the adoption contract. Receive medical records, vaccination certificates, and care instructions.</p>
          </div>
        </div>

        <div class="process-step">
          <div class="step-number">6</div>
          <div class="step-content">
            <div class="step-icon">
              <i data-lucide="heart"></i>
            </div>
            <h3>Welcome Home</h3>
            <p>Bring your new family member home! Provide patience, love, and time for adjustment. Schedule a vet visit and enjoy your new companion.</p>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Verified Adoption Centers in Sri Lanka -->
  <section id="adoption-centers" class="centers-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Trusted Partners</span>
        <h2>Verified Adoption Centers in Sri Lanka</h2>
        <p>Connect with reputable shelters and rescue organizations across the island</p>
      </div>

      <div class="centers-grid">
        
        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>Embark Sri Lanka</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Colombo</span>
              </div>
            </div>
          </div>
          <p>Leading animal welfare organization focusing on street dog population management, sterilization, and adoption programs.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 11 2 888 500</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>info@embarksrilanka.org</span>
            </div>
          </div>
          <a href="https://www.embarksrilanka.org" target="_blank" class="center-link">
            <span>Visit Website</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>CARE Colombo</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Colombo</span>
              </div>
            </div>
          </div>
          <p>Comprehensive Animal Rescue & Education center providing sanctuary, medical care, and adoption services for abandoned animals.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 77 123 4567</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>contact@carecolombo.lk</span>
            </div>
          </div>
          <a href="#" class="center-link">
            <span>Contact Center</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>Blue Paw Trust</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Kandy</span>
              </div>
            </div>
          </div>
          <p>Non-profit animal rescue organization dedicated to rescuing, rehabilitating, and rehoming street dogs and cats in Central Province.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 81 234 5678</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>info@bluepawtrust.lk</span>
            </div>
          </div>
          <a href="#" class="center-link">
            <span>Learn More</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>Galle Animal Shelter</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Galle</span>
              </div>
            </div>
          </div>
          <p>Community-driven shelter providing refuge, medical treatment, and adoption services for abandoned and injured animals in the Southern Province.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 91 345 6789</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>shelter@galleanimals.org</span>
            </div>
          </div>
          <a href="#" class="center-link">
            <span>Get Directions</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>Jaffna Animal Care</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Jaffna</span>
              </div>
            </div>
          </div>
          <p>Northern Province's leading animal welfare center offering rescue, rehabilitation, veterinary services, and adoption programs.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 21 456 7890</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>care@jaffnaanimals.lk</span>
            </div>
          </div>
          <a href="#" class="center-link">
            <span>Visit Us</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

        <div class="center-card">
          <div class="center-header">
            <div class="center-icon">
              <i data-lucide="building-2"></i>
            </div>
            <div class="center-info">
              <h3>Sunshine Animal Sanctuary</h3>
              <div class="center-location">
                <i data-lucide="map-pin"></i>
                <span>Negombo</span>
              </div>
            </div>
          </div>
          <p>Volunteer-run sanctuary providing loving care and adoption opportunities for rescued dogs, cats, and other domestic animals.</p>
          <div class="center-details">
            <div class="detail-item">
              <i data-lucide="phone"></i>
              <span>+94 31 567 8901</span>
            </div>
            <div class="detail-item">
              <i data-lucide="mail"></i>
              <span>hello@sunshinesanctuary.lk</span>
            </div>
          </div>
          <a href="#" class="center-link">
            <span>Explore</span>
            <i data-lucide="external-link"></i>
          </a>
        </div>

      </div>
    </div>
  </section>

  <!-- Requirements Section -->
  <section class="requirements-section">
    <div class="container">
      <div class="section-header">
        <span class="section-badge">Be Prepared</span>
        <h2>Adoption Requirements</h2>
        <p>What you need to know before adopting a pet</p>
      </div>

      <div class="requirements-grid">
        
        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="user-check"></i>
          </div>
          <h4>Age & Identification</h4>
          <ul>
            <li>Must be 21 years or older</li>
            <li>Valid NIC or passport</li>
            <li>Proof of residence</li>
          </ul>
        </div>

        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="home"></i>
          </div>
          <h4>Living Situation</h4>
          <ul>
            <li>Stable housing (owned or rented)</li>
            <li>Landlord permission if renting</li>
            <li>Safe, secure environment</li>
          </ul>
        </div>

        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="wallet"></i>
          </div>
          <h4>Financial Stability</h4>
          <ul>
            <li>Ability to afford pet care</li>
            <li>Budget for food & supplies</li>
            <li>Emergency vet fund</li>
          </ul>
        </div>

        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="clock"></i>
          </div>
          <h4>Time Commitment</h4>
          <ul>
            <li>Time for daily care & exercise</li>
            <li>Training and socialization</li>
            <li>Long-term commitment (10-15 years)</li>
          </ul>
        </div>

        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="users"></i>
          </div>
          <h4>Family Agreement</h4>
          <ul>
            <li>All household members consent</li>
            <li>No allergies to pets</li>
            <li>Understanding of responsibilities</li>
          </ul>
        </div>

        <div class="requirement-card">
          <div class="requirement-icon">
            <i data-lucide="stethoscope"></i>
          </div>
          <h4>Veterinary Care</h4>
          <ul>
            <li>Access to veterinary services</li>
            <li>Commitment to regular check-ups</li>
            <li>Vaccination & health maintenance</li>
          </ul>
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
        <h2>Ready to Meet Your Future Best Friend?</h2>
        <p>Browse our selection of lovable pets waiting for their forever homes</p>
        <a href="find-pet.php" class="btn btn-primary btn-large">
          <span>Browse Available Pets</span>
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

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>

</body>

</html>