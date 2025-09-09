<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LovPet - Pet Shop & Care</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <!-- Top Bar -->
  <div class="top-bar">
    <div class="feedback">
      <div class="icon-stack">
        <a href="feedback.php"><img src="img/feedback.png" alt="Feedback Icon" class="top-icon"></a>
        <span>Feedbacks</span>
      </div>
    </div>
    <div class="contacts">
      <div class="icon-stack">
        <img src="img/call.png" alt="Phone Icon" class="top-icon">
        <span>071-4577814</span>
      </div>
      <div class="icon-stack">
        <img src="img/email.png" alt="Email Icon" class="top-icon">
        <span>lovpet123@gmail.com</span>
      </div>
    </div>
  </div>

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
      <li><a href="display-notice.php">Lost Pet Notices</a></li>
      <li><a href="cart.php">Cart</a></li>
      <li><a href="login.php">Signup</a></li>
    </ul>
  </nav>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-left">
      <p><em>"Our team is fully committed to providing you with pets that are not only friendly and loving but also healthy and well-cared for, ensuring they bring happiness and companionship to your life."</em></p>
      <p1>Want a pet?</p1>
      <a href="find-pet.php"><button class="find-btn">Click Here</button></a>
      
    </div>
    <div class="hero-right">
      <h2>Trust us with the best pets and products for you</h2>
    </div>
  </section>

  <!-- Our Services Section -->
  <section class="services">
    <h2 class="services-title">Our Services</h2>
    <div class="services-boxes">

      <div class="service-card">
        <img src="img/petadoption.webp" alt="Pet Adoption">
        <h3>Pet Adoption</h3>
        <p>Find friendly pets from trusted sellers across Sri Lanka.</p>
        <a href="adoption.php" >Read More</a>
      </div>

      <div class="service-card">
        <img src="img/petproduct.jpg" alt="Pet Products">
        <h3>Pet Products</h3>
        <p>Browse food, medicine, and accessories for your pet's care.</p>
        <a href="pet-product.php" >Read More</a>
      </div>

      <div class="service-card">
        <img src="img/lostpet.webp" alt="Lost Pet Notice">
        <h3>Lost Pet Notice</h3>
        <p>Submit or view lost pet notices from your community.</p>
        <a href="display-notice.php" >Read More</a>
      </div>

    </div>
  </section>

  <!-- Articles Section -->
  <section class="articles">
    <h2 class="article-title">Articles</h2>
    <div class="article-cards">
      <div class="card">
        <img src="img/1.jpeg" alt="Dogs">
        <h3>Dogs</h3>
        <a href="dog-care.php">Read More</a>
          
        </a>
      </div>
      <div class="card">
        <img src="img/2.jpg" alt="Cats">
        <h3>Cats</h3>
        <a href="cat-care.php">Read More</a>
          
        </a>
      </div>
      <div class="card">
        <img src="img/3.jpg" alt="Birds">
        <h3>Birds</h3>
        <a href="bird-care.php">Read More</a>
          
        </a>
      </div>
    </div>
  </section>

  <!-- WhatsApp Floating Button -->
  <div class="whatsapp-btn">
    <a href="https://wa.me/1234567890" target="_blank">
      <img src="img/whatsapp.png" alt="WhatsApp">
    </a>
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
