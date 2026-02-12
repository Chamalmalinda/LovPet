<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$orderId = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($orderId === 0) {
    header("Location: buyer-index.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch order details
$orderQuery = $conn->query("SELECT * FROM orders WHERE id = $orderId AND user_id = {$_SESSION['user_id']}");
$order = $orderQuery->fetch_assoc();

if (!$order) {
    header("Location: buyer-index.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful - LovPet</title>
    <link rel="stylesheet" href="order-success.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="success-container">
        <div class="success-icon">
            <i data-lucide="check"></i>
        </div>
        
        <h1>Order Placed Successfully!</h1>
        
        <div class="order-number">
            Order #<?= $orderId ?>
        </div>
        
        <p>Thank you for your order! We've received your request and will process it shortly. You'll receive updates on your contact number.</p>
        
        <div class="order-details">
            <div class="detail-row">
                <span class="detail-label">Order Date</span>
                <span class="detail-value"><?= date('M d, Y - h:i A', strtotime($order['order_date'])) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Amount</span>
                <span class="detail-value">LKR <?= number_format($order['total_amount']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value"><?= htmlspecialchars($order['payment_method']) ?></span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Status</span>
                <span class="detail-value"><?= ucfirst($order['status']) ?></span>
            </div>
        </div>
        
        <div class="button-group">
            <a href="buyer_dashboard.php" class="btn btn-primary">
                <i data-lucide="layout-dashboard"></i>
                <span>View Dashboard</span>
            </a>
            <a href="find-pet.php" class="btn btn-secondary">
                <i data-lucide="search"></i>
                <span>Continue Shopping</span>
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>