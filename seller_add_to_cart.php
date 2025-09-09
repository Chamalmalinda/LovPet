<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $item = [
    'name' => $_POST['name'],
    'breed' => $_POST['breed'],
    'price' => (float) $_POST['price'],
    'image' => $_POST['image']
  ];
  $_SESSION['cart'][] = $item;
}
header("Location: seller-cart.php");
exit();
