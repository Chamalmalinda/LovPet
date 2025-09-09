<?php
session_start();
$error = "";


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

      
      if ($user['role'] === 'seller') {
        header("Location: seller-index.php");
        exit();
      } elseif ($user['role'] === 'buyer') {
        header("Location: buyer-index.php");
        exit();
      }
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
  <link rel="stylesheet" href="login.css" />
</head>
<body>

  <a href="index.php" class="home-btn">
    <img src="img/home.png" alt="Home" />
  </a>

  <div class="login-container">
    <form class="login-form" method="POST">
      <h2>Login Page</h2>

      <?php if (!empty($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

      <label for="role">Select Role</label>
      <select id="role" name="role" required>
        <option value="">-- Choose your role --</option>
        <option value="admin">Admin</option>
        <option value="buyer">Buyer</option>
        <option value="seller">Seller</option>
      </select>

      <label for="email">Username or Email</label>
      <input type="text" id="email" name="email" placeholder="Enter your email" required>

      <label for="password">Password</label>
      <div class="password-wrapper">
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <img src="img/visible.png" alt="Toggle Password" id="togglePassword" class="toggle-password">
      </div>

      <button type="submit" class="login-btn">Login</button>

      <p class="register-text">
        Don't have an account? <a href="register.php">Register here</a>
      </p>
    </form>
  </div>

  <script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
      const isPassword = passwordInput.type === 'password';
      passwordInput.type = isPassword ? 'text' : 'password';
      togglePassword.src = isPassword ? 'img/unvisible.png' : 'img/visible.png';
    });
  </script>

</body>
</html>
