<?php
$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
  $stmt->bind_result($image);
  $stmt->fetch();
  header("Content-Type: image/jpeg");
  echo $image;
} else {
  http_response_code(404);
  echo "Image not found";
}
$stmt->close();
$conn->close();
?>
