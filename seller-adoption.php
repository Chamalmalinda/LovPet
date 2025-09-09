<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Adoption - LovPet</title>
  <link rel="stylesheet" href="adoption.css">

</head>
<body>

   <!-- Navigation -->
  <nav class="navbar">
    <div class="logo">
      <img src="img/logo.png" alt="LovPet Logo" />
    </div>
    <ul class="nav-menu">
      <a href="seller-index.php"class="active"><img src="img/home.png" alt="Home" class="icon" /></a>
      <li><a href="seller-about.php">About Us</a></li>
      <li><a href="seller-find-pet.php">Buy a Pet</a></li>
      <li><a href="addpet.php">Add Pets</a></li>
      <li><a href="seller-product.php">Products</a></li>
      <li><a href="seller-display-notice.php">Lost Pet Notices</a></li>
      <li><a href="seller-cart.php">Cart</a></li>
      <li><a href="seller_dashboard.php">Dashboard</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>


  <header class="page-header">
    <h1>Adopt a Pet, Give Them a Loving Home</h1>
  </header>

  <section class="hero-section">
    <p>
"Every pet deserves a loving home, and every heart has room for a little more love." At LovPet, we believe in second chances,
 unconditional love, and the lifelong bonds that form between people and their pets. Our adoption page is filled with adorable,
  deserving animals—each with their own story, personality, and hope for a brighter future. Whether you're searching for a playful 
  puppy with boundless energy, a gentle kitten who loves to cuddle, or a wise and loyal senior companion who's ready to spend their 
  golden years by your side, your perfect match is just a paw away.

We work closely with shelters, rescue groups, and foster networks to ensure every animal is healthy, vaccinated, 
and ready to find their forever home. Adopting a pet not only transforms their life—it enriches yours with joy, companionship, 
and purpose. Take a moment to explore our adoption listings, learn about each pet's unique needs and traits, and find out how 
you can open your home and heart to a new best friend. At LovPet, we're here to help you every step of the way, because love is 
meant to be shared—and sometimes, it has four legs and a wagging tail.
    </p>
    <span class="scroll-down" onclick="document.getElementById('adoption-benefits').scrollIntoView({ behavior: 'smooth' });">
    
    </span>
  </section>

  <!-- Adoption Benefits Section -->
  <section id="adoption-benefits" class="adoption-benefits">
    <h2>Benefits of Pet Adoption</h2>
    <div class="benefits-grid">
      <div class="benefit-card">
        <img src="img/adoption1.webp" alt="Happy Pet" class="benefit-img">
        <h3>Save a Life</h3>
        <p>Adopting a pet saves a life and helps reduce the number of homeless animals in shelters.</p>
      </div>
      <div class="benefit-card">
        <img src="img/adoption2.jpg" alt="Healthy Pet" class="benefit-img">
        <h3>Healthier Pets</h3>
        <p>Most pets in shelters are vaccinated, dewormed, and spayed or neutered.</p>
      </div>
      <div class="benefit-card">
        <img src="img/adoption3.jpeg" alt="Affordable Adoption" class="benefit-img">
        <h3>Affordable Adoption</h3>
        <p>Adopting is usually more cost-effective than buying from breeders or pet stores.</p>
      </div>
      <div class="benefit-card">
        <img src="img/adoption4.jpeg" alt="Support Shelters" class="benefit-img">
        <h3>Support Local Shelters</h3>
        <p>Your adoption helps fund shelter operations and saves more animals.</p>
      </div>
      <div class="benefit-card">
        <img src="img/adoption5.jpg" alt="Trained Pets" class="benefit-img">
        <h3>Trained Companions</h3>
        <p>Many rescued pets are already house-trained and socialized, making adoption easier.</p>
      </div>
      <div class="benefit-card">
        <img src="img/adoption6.jpg" alt="Unconditional Love" class="benefit-img">
        <h3>Unconditional Love</h3>
        <p>Adopted pets are forever grateful, giving you love, loyalty, and affection every day.</p>
      </div>
    </div>
  </section>

 
  <div class="button-container">
    <p style="font-size: 20px; margin-bottom: 10px;">Ready to meet your future pet?</p>
    <a href="seller-find-pet.php" class="adopt-button">Browse Pets Now</a>
  </div>

  <!-- Footer -->
  <footer>
    <img src="img/logo.png" alt="Logo" class="footer-logo">
    <div class="footer-content">

      <div class="footer-left footer-column">
        <ul>
          <li><a href="seller-index.php">Home</a></li>
          <li><a href="seller-about.php">About us</a></li>
          <li><a href="seller-find-pet.php">Find a Pet</a></li>
          <li><a href="addpet.php">Add Pets</a></li>
          <li><a href="seller-product.php">Products</a></li>
          <li><a href="seller-display-notice.php">Lost Pet Notice</a></li>
          <li><a href="seller-cart.php">Cart</a></li>
          <li><a href="login.php">Signup</a></li>
         
        </ul>
      </div>

      <div class="footer-middle footer-column">
        <ul>
          <li><a href="seller-faq.php">FAQs</a></li>
          <li><a href="seller-terms.php">Terms of Services</a></li>
          <li><a href="seller-privacy.php">Privacy Policy</a></li>
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