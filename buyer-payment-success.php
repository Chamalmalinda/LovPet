<?php
session_start();


if (!isset($_SESSION['checkout_total'])) {
    header("Location: index.php"); 
    exit();
}


$total = $_SESSION['checkout_total'];
unset($_SESSION['checkout_total']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Payment Success - LovPet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="payment-success.css" />

</head>
<body>

  <div class="success-container">
    <h1>✅ Payment Successful!</h1>
    <p>Thank you for your payment.</p>
    <div class="amount">Total Paid: LKR <?= number_format($total, 2) ?></div>
    <a href="buyer-index.php" class="home-btn">Back to Home</a>
  </div>

</body>
</html>
