<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Pet - LovPet</title>
  <link rel="stylesheet" href="addpet.css" />
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
      <li><a href="addpet.php" class="active">Add Pets</a></li>
      <li><a href="seller-product.php">Products</a></li>
      <li><a href="seller-display-notice.php">Lost Pet Notices</a></li>
      <li><a href="seller-cart.php">Cart</a></li>
      <li><a href="seller_dashboard.php">Dashboard</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>

  <div class="add-pet-container">
    <h2>Add a New Pet</h2>
    <form class="add-pet-form" action="save_pet.php" method="POST" enctype="multipart/form-data">

      <!-- Upload Box -->
      <label>Upload Image</label>
      <div class="upload-box" id="upload-box">
        <p id="upload-text">Drag and drop image here or click to select</p>
        <input type="file" id="imageUpload" name="image" accept="image/*" hidden>
        <div id="preview" class="preview-container"></div>
      </div>

      <!-- Pet Details -->
      <label for="petName">Pet Name</label>
      <input type="text" id="petName" name="petName" required>

      <label for="category">Category</label>
      <select id="category" name="category" required>
        <option value="">Select category</option>
        <option value="Dog">Dog</option>
        <option value="Cat">Cat</option>
        <option value="Bird">Bird</option>
        <option value="Fish">Fish</option>
        <option value="Rabbit">Rabbit</option>
        <option value="Others">Others</option>
      </select>

      <label for="breed">Breed</label>
      <input type="text" id="breed" name="breed" required>

      <label>Gender</label>
      <div class="options">
        <label><input type="radio" name="gender" value="Male" required> Male</label>
        <label><input type="radio" name="gender" value="Female"> Female</label>
      </div>

      <label for="age">Age (in months)</label>
      <input type="number" id="age" name="age" required>

      <label for="color">Color</label>
      <input type="text" id="color" name="color" required>

      <label for="address">Location / Address</label>
      <input type="text" id="address" name="address" required>

      <label for="number">Contact Number</label>
      <input type="tel" id="number" name="number" required>

      <label for="price">Price (LKR)</label>
      <input type="number" id="price" name="price" required>

      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" required></textarea>

      <button type="submit" class="submit-btn"
        oncontextmenu="alert('You have to agree to pay 20% commission to LovPet.'); return false;">
        Submit
      </button>
    </form>
  </div>

  <!-- JS for image preview -->
  <script>
    const uploadBox = document.getElementById('upload-box');
    const imageInput = document.getElementById('imageUpload');
    const preview = document.getElementById('preview');
    const uploadText = document.getElementById('upload-text');

    uploadBox.addEventListener('click', () => imageInput.click());

    uploadBox.addEventListener('dragover', e => {
      e.preventDefault();
      uploadBox.classList.add('dragover');
    });

    uploadBox.addEventListener('dragleave', () => {
      uploadBox.classList.remove('dragover');
    });

    uploadBox.addEventListener('drop', e => {
      e.preventDefault();
      uploadBox.classList.remove('dragover');
      imageInput.files = e.dataTransfer.files;
      previewImage(imageInput.files[0]);
    });

    imageInput.addEventListener('change', () => {
      if (imageInput.files && imageInput.files[0]) {
        previewImage(imageInput.files[0]);
      }
    });

    function previewImage(file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        preview.innerHTML = '';
        const img = document.createElement('img');
        img.src = e.target.result;
        img.style.maxWidth = '100px';
        img.style.marginTop = '10px';
        img.style.borderRadius = '8px';
        preview.appendChild(img);
        uploadText.style.display = 'none';
      };
      reader.readAsDataURL(file);
    }
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
