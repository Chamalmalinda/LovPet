<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_type'])) {
    header("Location: login.php");
    exit();
}

// Check if cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $paymentMethod = mysqli_real_escape_string($conn, $_POST['payment_method'] ?? 'Cash on Delivery');
    $deliveryAddress = mysqli_real_escape_string($conn, $_POST['delivery_address'] ?? '');
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number'] ?? '');
    $notes = mysqli_real_escape_string($conn, $_POST['notes'] ?? '');
    
    // Calculate total
    $totalAmount = 0;
    $itemsCount = count($_SESSION['cart'] ?? []);
    
    foreach ($_SESSION['cart'] as $item) {
        $totalAmount += $item['price'] ?? 0;
    }
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // Insert order
        $orderSql = "INSERT INTO orders (user_id, total_amount, items_count, status, payment_method, delivery_address, contact_number, notes) 
                     VALUES ($userId, $totalAmount, $itemsCount, 'Pending', '$paymentMethod', '$deliveryAddress', '$contactNumber', '$notes')";
        
        if ($conn->query($orderSql)) {
            $orderId = $conn->insert_id;
            
            // Insert order items
            foreach ($_SESSION['cart'] as $item) {
                $itemName = mysqli_real_escape_string($conn, $item['name'] ?? '');
                $itemBreed = mysqli_real_escape_string($conn, $item['breed'] ?? $item['brand'] ?? '');
                $itemPrice = $item['price'] ?? 0;
                $itemImage = mysqli_real_escape_string($conn, $item['image'] ?? '');
                $itemType = isset($item['type']) ? $item['type'] : (isset($item['breed']) ? 'pet' : 'product');
                
                $itemSql = "INSERT INTO order_items (order_id, item_type, item_name, item_breed, item_price, item_image) 
                           VALUES ($orderId, '$itemType', '$itemName', '$itemBreed', $itemPrice, '$itemImage')";
                
                $conn->query($itemSql);
            }
            
            // Commit transaction
            $conn->commit();
            
            // Clear cart
            $_SESSION['cart'] = [];
            
            // Redirect to success page
            header("Location: order-success.php?order_id=$orderId");
            exit();
        }
    } catch (Exception $e) {
        // Rollback on error
        $conn->rollback();
        $error = "Order placement failed. Please try again.";
    }
}

// Get user details
$userId = $_SESSION['user_id'];
$userQuery = $conn->query("SELECT * FROM users WHERE id = $userId");
$user = $userQuery->fetch_assoc();

// Calculate cart total
$cartTotal = 0;
$itemsCount = count($_SESSION['cart'] ?? []);
foreach ($_SESSION['cart'] as $item) {
    $cartTotal += $item['price'] ?? 0;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - LovPet</title>
    <link rel="stylesheet" href="checkout.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container nav-content">
            <div class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet</span>
            </div>
            <a href="cart.php" class="back-btn">
                <i data-lucide="arrow-left"></i>
                <span>Back to Cart</span>
            </a>
        </div>
    </nav>

    <div class="checkout-wrapper">
        <div class="container">
            
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i data-lucide="alert-circle"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <div class="checkout-grid">
                
                <!-- Checkout Form -->
                <div class="checkout-form-section">
                    <div class="form-card">
                        <h2>
                            <i data-lucide="clipboard-check"></i>
                            <span>Order Details</span>
                        </h2>
                        
                        <form method="POST" action="">
                            <div class="form-group">
                                <label>
                                    <i data-lucide="credit-card"></i>
                                    Payment Method
                                </label>
                                <select name="payment_method" required>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Online Payment">Online Payment</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i data-lucide="map-pin"></i>
                                    Delivery Address
                                </label>
                                <textarea name="delivery_address" rows="3" required placeholder="Enter your full delivery address"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>
                                    <i data-lucide="phone"></i>
                                    Contact Number
                                </label>
                                <input type="text" name="contact_number" value="<?= htmlspecialchars($user['contact'] ?? '') ?>" required placeholder="07X XXX XXXX">
                            </div>

                            <div class="form-group">
                                <label>
                                    <i data-lucide="message-square"></i>
                                    Order Notes (Optional)
                                </label>
                                <textarea name="notes" rows="3" placeholder="Any special instructions for your order"></textarea>
                            </div>

                            <button type="submit" class="place-order-btn">
                                <i data-lucide="check-circle"></i>
                                <span>Place Order</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="order-summary-section">
                    <div class="summary-card">
                        <h2>
                            <i data-lucide="shopping-cart"></i>
                            <span>Order Summary</span>
                        </h2>
                        
                        <div class="summary-items">
                            <?php foreach (($_SESSION['cart'] ?? []) as $item): ?>
                                <div class="summary-item">
                                    <img src="<?= htmlspecialchars($item['image'] ?? 'img/placeholder.jpg') ?>" alt="<?= htmlspecialchars($item['name'] ?? '') ?>">
                                    <div class="summary-item-details">
                                        <h4><?= htmlspecialchars($item['name'] ?? '') ?></h4>
                                        <p><?= htmlspecialchars($item['breed'] ?? $item['brand'] ?? '') ?></p>
                                    </div>
                                    <div class="summary-item-price">
                                        LKR <?= number_format($item['price'] ?? 0) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="summary-totals">
                            <div class="summary-row">
                                <span>Subtotal (<?= $itemsCount ?> items)</span>
                                <span>LKR <?= number_format($cartTotal) ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Delivery Fee</span>
                                <span class="free">FREE</span>
                            </div>
                            <div class="summary-row total">
                                <span>Total Amount</span>
                                <span>LKR <?= number_format($cartTotal) ?></span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>