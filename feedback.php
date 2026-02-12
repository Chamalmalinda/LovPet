<?php
$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, message, created_at FROM feedbacks ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Feedback - LovPet</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="feedback.css" />
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

  <!-- Fixed Home Icon -->
  <a href="index.php" class="back-home" aria-label="Back to Home">
    <i data-lucide="home"></i>
  </a>

  <main class="feedback-main">
    <div class="container">
      <div class="page-header">
        <h1>User Feedback</h1>
        <p class="subtitle">See what our community is saying about LovPet</p>
        <a href="add-feedback.php" class="add-feedback-btn">
          <i data-lucide="plus"></i>
          <span>Add Your Feedback</span>
        </a>
      </div>

      <?php if ($result && $result->num_rows > 0): ?>
        <div class="feedback-grid">
          <?php while ($row = $result->fetch_assoc()): ?>
            <div class="feedback-card">
              <div class="card-header">
                <div class="user-avatar">
                  <i data-lucide="user"></i>
                </div>
                <div class="user-info">
                  <h3><?= htmlspecialchars($row['name']) ?></h3>
                  <span class="date"><?= date("F j, Y", strtotime($row['created_at'])) ?></span>
                </div>
              </div>
              <div class="card-body">
                <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
              </div>
              <div class="card-decoration">
                <i data-lucide="heart"></i>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      <?php else: ?>
        <div class="empty-state">
          <i data-lucide="message-square"></i>
          <h2>No feedback yet</h2>
          <p>Be the first to share your experience with LovPet!</p>
          <a href="add-feedback.php" class="add-feedback-btn large">
            <i data-lucide="plus"></i>
            <span>Add Feedback</span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </main>

  <script>
    lucide.createIcons();
  </script>

</body>
</html>