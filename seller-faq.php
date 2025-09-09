<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>FAQs - LovPet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="faq.css" />
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



<div class="faq-container">
  <h2>Frequently Asked Questions</h2>

  <div class="faq">
    <button class="faq-question">How do I adopt a pet?</button>
    <div class="faq-answer">
      <p>Visit the "Find a Pet" page, view pet details, and click “Add to Cart.” Proceed to checkout to complete the adoption process.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">How do I post a lost pet notice?</button>
    <div class="faq-answer">
      <p>Go to the "Lost & Found" section and click “+ Add Notice.” Provide your pet’s name, breed, last seen location, and contact information.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">Is there a delivery option for pet products?</button>
    <div class="faq-answer">
      <p>Yes, we deliver pet products across Sri Lanka. Orders over LKR 5,000 qualify for free delivery within 2-3 business days.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">Can I return a purchased product?</button>
    <div class="faq-answer">
      <p>Yes, returns are accepted within 7 days if the item is unused and in its original condition. Contact support to initiate a return.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">How can I contact LovPet support?</button>
    <div class="faq-answer">
      <p>Email us at <strong>support@lovpet.lk</strong> or call <strong>011-2345678</strong>. Support hours are 9:00 AM - 5:00 PM, Monday to Friday.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">Do I need an account to adopt or post a pet?</button>
    <div class="faq-answer">
      <p>Yes. Creating a free LovPet account helps us verify and track adoption and notice details securely.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">How do I know if a pet is still available?</button>
    <div class="faq-answer">
      <p>Pets shown in the "Find a Pet" section are available. Once adopted, they are removed from public listings automatically.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">What types of payment methods are accepted?</button>
    <div class="faq-answer">
      <p>We accept Visa/MasterCard, online bank transfers, and local e-wallets such as eZ Cash and mCash.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">Can I donate to help rescued animals?</button>
    <div class="faq-answer">
      <p>Yes! Visit the "Donate" section of our site to contribute funds or supplies. All donations go directly to shelters and rescue teams.</p>
    </div>
  </div>

  <div class="faq">
    <button class="faq-question">Is my personal information safe?</button>
    <div class="faq-answer">
      <p>Absolutely. We use SSL encryption and do not share or sell any personal data. You can read our full privacy policy for more details.</p>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.classList.toggle('active');
      const answer = btn.nextElementSibling;
      answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
    });
  });
</script>

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
