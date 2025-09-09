<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['total_amount'])) {
    $_SESSION['checkout_total'] = $_POST['total_amount'];
}


$totalAmount = isset($_SESSION['checkout_total']) ? $_SESSION['checkout_total'] : '0.00';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Online Payment - LovPet</title>
  <link rel="stylesheet" href="online-payment.css" />
</head>
<body>

  <div class="payment-container">
    <h2>Online Payment</h2>

    <form class="payment-form" action="payment-success.php" method="POST">
      <label for="card-type">Select Card</label>
      <select id="card-type" name="card_type" required>
        <option value="">-- Choose Card Type --</option>
        <option value="visa">Visa</option>
        <option value="master">MasterCard</option>
      </select>

      <label for="holder">Card Holder Name</label>
      <input type="text" id="holder" name="holder" placeholder=" " required />

      <label for="amount">Amount (LKR)</label>
      <input type="text" id="amount" name="amount" value="<?= htmlspecialchars($totalAmount) ?>" readonly />

      <label for="date">Select Date</label>
      <input type="date" id="date" name="date" required />

      <label for="acc">Account Number</label>
      <input type="text" id="acc" name="account" placeholder="**** **** **** ****" required />

      <div class="row">
        <div>
          <label for="cvv">CVV</label>
          <input type="password" id="cvv" name="cvv" maxlength="3" required />
        </div>
        <div>
          <label for="expiry">Expiry Date</label>
          <input type="month" id="expiry" name="expiry" required>
        </div>
      </div>

      <button type="submit" class="pay-btn">Pay Now</button>
      <a href="index.php" class="back-btn">Back to Home</a>
    </form>
  </div>

</body>
</html>
