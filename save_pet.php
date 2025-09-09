<?php
session_start();


if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'seller') {
    header("Location: login.php");
    exit();
}


$conn = new mysqli("localhost", "root", "", "lovpet_db");


if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sellerId = $_SESSION['user_id']; 

   
    $name = $conn->real_escape_string($_POST['petName']);
    $category = $conn->real_escape_string($_POST['category']);
    $breed = $conn->real_escape_string($_POST['breed']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $age = intval($_POST['age']);
    $color = $conn->real_escape_string($_POST['color']);
    $address = $conn->real_escape_string($_POST['address']);
    $contact = $conn->real_escape_string($_POST['number']);
    $vaccinated = $conn->real_escape_string($_POST['vaccinated']);
    $price = floatval($_POST['price']);
    $desc = $conn->real_escape_string($_POST['description']);

   
    $imageDir = "uploads/";
    if (!is_dir($imageDir)) {
        mkdir($imageDir, 0755, true);
    }

    $imageName = time() . '_' . basename($_FILES['image']['name']); 
    $imagePath = $imageDir . $imageName;
    $tmpName = $_FILES['image']['tmp_name'];

    if (move_uploaded_file($tmpName, $imagePath)) {
       
        $sql = "INSERT INTO pets 
                (seller_id, name, category, breed, gender, age, color, address, contact, vaccinated, price, description, image)
                VALUES 
                ('$sellerId', '$name', '$category', '$breed', '$gender', '$age', '$color', '$address', '$contact', '$vaccinated', '$price', '$desc', '$imagePath')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('✅ Pet added successfully!'); window.location.href='seller_dashboard.php';</script>";
            exit();
        } else {
            echo "❌ Error inserting pet: " . $conn->error;
        }
    } else {
        echo "❌ Failed to upload image. Ensure 'uploads/' folder is writable.";
    }
}

$conn->close();
?>
