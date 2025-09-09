<?php
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
            VALUES ('$fullname', '$email', '$address', '$contact', '$role', '$hashed_password')";

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
  <link rel="stylesheet" href="register.css" />
</head>
<body>

  <div class="register-container">
    <form class="register-form" method="POST" action="">
      <h2>Create Your Account</h2>

      <label for="fullname">Full Name</label>
      <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Enter your address" required>

      <label for="contact">Contact Number</label>
      <input type="tel" id="contact" name="contact" placeholder="Enter your phone number" required>

      <label for="role">Select Role</label>
      <select id="role" name="role" required>
        <option value="">-- Choose your role --</option>
        <option value="buyer">Buyer</option>
        <option value="seller">Seller</option>
      </select>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Create password" required>

      <label for="confirm-password">Confirm Password</label>
      <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required>

      <button type="submit" class="register-btn">Register</button>

      <p class="login-text">
        Already have an account? <a href="login.php">Login here</a>
      </p>
    </form>
  </div>

  <script>
    document.querySelector('.register-form').addEventListener('submit', function(e) {
      const pwd = document.getElementById('password').value;
      const confirm = document.getElementById('confirm-password').value;
      if (pwd !== confirm) {
        e.preventDefault();
        alert("Passwords do not match!");
      }
    });
  </script>

</body>
</html>
