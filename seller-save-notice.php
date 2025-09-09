<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$petName = $_POST['petName'];
$breed = $_POST['breed'];
$location = $_POST['location'];
$contact = $_POST['contact'];
$description = $_POST['description'];

$sql = "INSERT INTO lost_notices (pet_name, breed, location, contact, description, image)
        VALUES ('$petName', '$breed', '$location', '$contact', '$description', '$targetFile')";

if ($conn->query($sql) === TRUE) {
    header("Location: seller-display-notice.php");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>

