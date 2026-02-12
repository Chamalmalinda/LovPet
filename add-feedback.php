<?php
// Start session for potential user info (optional, not required)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$success = null;
$error = null;

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

        // Redirect to feedback listing page after successful submission
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Feedback - LovPet 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Page-specific styles -->
    <link rel="stylesheet" href="add-feedback.css">
</head>
<body>
    <div class="feedback-page">
        <!-- Simple Header with Logo & Back Button (LovPet style) -->
        <div class="feedback-header">
            <a href="feedback.php" class="back-button">
                <i data-lucide="arrow-left"></i>
                <span>Back to Feedbacks</span>
            </a>
            <div class="brand-mark">
                <div class="brand-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="brand-name">LovPet</span>
            </div>
        </div>

        <!-- Main Feedback Card -->
        <div class="feedback-card">
            <div class="card-decoration"></div>
            
            <div class="card-header">
                <div class="header-icon">
                    <i data-lucide="message-square"></i>
                </div>
                <h2>Share Your Feedback</h2>
                <p>We value your opinion! Help us improve LovPet.</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-error">
                    <i data-lucide="alert-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" class="feedback-form">
                <div class="form-group">
                    <label for="name">
                        <i data-lucide="user"></i>
                        Your Name
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        placeholder="Enter your full name"
                        value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="message">
                        <i data-lucide="edit-3"></i>
                        Your Feedback
                    </label>
                    <textarea 
                        name="message" 
                        id="message" 
                        rows="5" 
                        placeholder="Tell us about your experience..."
                        required
                    ><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '' ?></textarea>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Submit Feedback</span>
                    <i data-lucide="send"></i>
                </button>
            </form>

            <div class="card-footer">
                <p>Your feedback helps us create a better experience for pet lovers.</p>
            </div>
        </div>

        <!-- Simple Footer -->
        <div class="feedback-footer">
            <p>&copy; 2025 LovPet Care. All rights reserved.</p>
        </div>
    </div>

    <!-- Lucide Icons Initialization -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>