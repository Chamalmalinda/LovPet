<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
$cartItem = [
    'id'          => $_POST['product_id'] ?? $_POST['pet_id'] ?? 0,
    'name'        => $_POST['name'] ?? 'Unknown',
    'brand'       => $_POST['brand'] ?? $_POST['breed'] ?? '',
    'price'       => $_POST['price'] ?? 0,
    'quantity'    => $_POST['quantity'] ?? 1,
    'image'       => $_POST['image'] ?? 'img/placeholder.jpg',
    'description' => $_POST['description'] ?? ''
];

$_SESSION['cart'][] = $cartItem;
}
header("Location: cart.php");
exit();
