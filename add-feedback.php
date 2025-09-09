<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST["name"]);
  $message = trim($_POST["message"]);

  if (!empty($name) && !empty($message)) {
    $conn = new mysqli("localhost", "root", "", "lovpet_db");
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO feedbacks (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $message);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: feedback.php");
    exit;
  } else {
    $error = "Both fields are required.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add Feedback - LovPet</title>
  <link rel="stylesheet" href="add-feedback.css" />
</head>
<body>
  

<a href="feedback.php" class="home-btn"><img src="img/back.png" alt="Back" /></a>

<div class="feedback-form-container">
  <h2>Share Your Feedback</h2>

  <?php if (isset($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <form method="POST" class="feedback-form">
    <label for="name">Your Name</label>
    <input type="text" name="name" id="name" required />

    <label for="message">Feedback</label>
    <textarea name="message" id="message" rows="5" required></textarea>

    <button type="submit">Submit Feedback</button>
  </form>
</div>

</body>
</html>
