<?php
session_start(); // Added for consistency

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "lovpet_db");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fullname = $conn->real_escape_string($_POST['fullname']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['contact']);
    $role = $conn->real_escape_string($_POST['role']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm-password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkEmail = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        echo "<script>alert('Email already registered.'); window.history.back();</script>";
        exit();
    }

    $sql = "INSERT INTO users (fullname, email, address, contact, role, password)
            VALUES ('$fullname', '$email', '$$address', '$contact', '$role', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register - LovPet</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="register.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Fixed Home Icon -->
  <a href="index.php" class="back-home" aria-label="Back to Home">
    <i data-lucide="home"></i>
  </a>

  <main class="register-main">
    <div class="register-card">
      <div class="brand-header">
        <div class="logo-icon">
          <i data-lucide="paw-print"></i>
        </div>
        <h1>LovPet</h1>
      </div>

      <h2>Create Your Account</h2>
      <p class="tagline">Join us and start your pet journey today</p>

      <form class="register-form" method="POST">
        <div class="input-group">
          <label>Full Name</label>
          <div class="input-wrapper">
            <i data-lucide="user" class="input-icon"></i>
            <input type="text" name="fullname" placeholder="Enter your full name" required />
          </div>
        </div>

        <div class="input-group">
          <label>Email</label>
          <div class="input-wrapper">
            <i data-lucide="mail" class="input-icon"></i>
            <input type="email" name="email" placeholder="Enter your email" required />
          </div>
        </div>

        <div class="input-group">
          <label>Address</label>
          <div class="input-wrapper">
            <i data-lucide="map-pin" class="input-icon"></i>
            <input type="text" name="address" placeholder="Enter your address" required />
          </div>
        </div>

        <div class="input-group">
          <label>Contact Number</label>
          <div class="input-wrapper">
            <i data-lucide="phone" class="input-icon"></i>
            <input type="tel" name="contact" placeholder="Enter your phone number" required />
          </div>
        </div>

        <div class="input-group">
          <label>Role</label>
          <div class="select-wrapper">
            <select name="role" required>
              <option value="">Select your role</option>
              <option value="buyer">Buyer</option>
              <option value="seller">Seller</option>
            </select>
            <i data-lucide="chevron-down" class="select-icon"></i>
          </div>
        </div>

        <div class="input-group">
          <label>Password</label>
          <div class="input-wrapper password-input">
            <i data-lucide="lock" class="input-icon"></i>
            <input type="password" id="password" name="password" placeholder="Create your password" required />
            <i data-lucide="eye" id="togglePassword" class="toggle-icon"></i>
          </div>
        </div>

        <div class="input-group">
          <label>Confirm Password</label>
          <div class="input-wrapper password-input">
            <i data-lucide="lock" class="input-icon"></i>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm your password" required />
            <i data-lucide="eye" id="toggleConfirm" class="toggle-icon"></i>
          </div>
        </div>

        <button type="submit" class="register-btn">
          <span>Create Account</span>
          <i data-lucide="user-plus"></i>
        </button>
      </form>

      <p class="login-text">
        Already have an account? <a href="login.php">Sign in here</a>
      </p>
    </div>
  </main>

  <script>
    lucide.createIcons();

    function createToggleHandler(fieldId, iconId) {
      const field = document.getElementById(fieldId);
      const icon = document.getElementById(iconId);

      const handler = (e) => {
        if (e.type === 'touchstart') e.preventDefault(); // Prevent double fire on mobile
        const type = field.type === 'password' ? 'text' : 'password';
        field.type = type;
        icon.setAttribute('data-lucide', type === 'password' ? 'eye' : 'eye-off');
        lucide.createIcons();
      };

      icon.addEventListener('click', handler);
      icon.addEventListener('touchstart', handler);
    }

    createToggleHandler('password', 'togglePassword');
    createToggleHandler('confirm-password', 'toggleConfirm');
  </script>

</body>
</html>