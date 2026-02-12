<?php
session_start();
$error = "";

if (isset($_SESSION['user_id'])) {
  // Already logged in – redirect based on role
  if ($_SESSION['user_type'] === 'admin') {
    header("Location: admin-dashboard.php");
    exit();
  } else {
    header("Location: index.php"); // Buyer or Seller → same homepage
    exit();
  }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  if ($role === "admin" && $email === "admin@gmail.com" && $password === "admin1234") {
    $_SESSION['user_id'] = 0;
    $_SESSION['fullname'] = "Admin";
    $_SESSION['user_type'] = "admin";
    header("Location: admin-dashboard.php");
    exit();
  }

  $conn = new mysqli("localhost", "root", "", "lovpet_db");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
  $stmt->bind_param("ss", $email, $role);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['fullname'] = $user['fullname'];
      $_SESSION['user_type'] = $user['role'];

      // Admin → dashboard, Buyer/Seller → index.php
      if ($user['role'] === 'admin') {
        header("Location: admin-dashboard.php");
      } else {
        header("Location: index.php");
      }
      exit();
    } else {
      $error = "Invalid password.";
    }
  } else {
    $error = "No account found with that role and email.";
  }

  $stmt->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - LovPet</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Fixed Home Icon (top-left, always visible) -->
  <a href="index.php" class="back-home" aria-label="Back to Home">
    <i data-lucide="home"></i>
  </a>

  <main class="login-main">
    <div class="login-card">
      <div class="brand-header">
        <div class="logo-icon">
          <i data-lucide="paw-print"></i>
        </div>
        <h1>LovPet</h1>
      </div>

      <h2>Sign In to Your Account</h2>
      <p class="tagline">Welcome back! Please enter your details</p>

      <?php if (!empty($error)) { ?>
        <div class="alert error">
          <i data-lucide="alert-triangle"></i>
          <span><?php echo htmlspecialchars($error); ?></span>
        </div>
      <?php } ?>

      <form class="login-form" method="POST">
        <div class="input-group">
          <label>Role</label>
          <div class="select-wrapper">
            <select name="role" required>
              <option value="">Select your role</option>
              <option value="admin">Admin</option>
              <option value="buyer">Buyer</option>
              <option value="seller">Seller</option>
            </select>
            <i data-lucide="chevron-down" class="select-icon"></i>
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
          <label>Password</label>
          <div class="input-wrapper password-input">
            <i data-lucide="lock" class="input-icon"></i>
            <input type="password" id="password" name="password" placeholder="Enter your password" required />
            <i data-lucide="eye" id="togglePassword" class="toggle-icon"></i>
          </div>
        </div>

        <button type="submit" class="signin-btn">
          <span>Sign In</span>
          <i data-lucide="log-in"></i>
        </button>
      </form>

      <p class="footer-text">
        Don't have an account? <a href="register.php">Create one here</a>
      </p>
    </div>
  </main>

  <script>
    lucide.createIcons();

    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
      const type = passwordField.type === 'password' ? 'text' : 'password';
      passwordField.type = type;
      togglePassword.setAttribute('data-lucide', type === 'password' ? 'eye' : 'eye-off');
      lucide.createIcons();
    });
  </script>

</body>
</html>