<?php
session_start();
$conn = new mysqli("localhost", "root", "", "lovpet_db");

if (isset($_GET['delete_user'])) {
  $id = intval($_GET['delete_user']);
  $conn->query("DELETE FROM users WHERE id=$id");
}

if (isset($_GET['delete_pet'])) {
  $id = intval($_GET['delete_pet']);
  $conn->query("DELETE FROM pets WHERE id=$id");
}

if (isset($_GET['delete_product'])) {
  $id = intval($_GET['delete_product']);
  $conn->query("DELETE FROM products WHERE id=$id");
}

if (isset($_GET['delete_feedback'])) {
  $id = intval($_GET['delete_feedback']);
  $conn->query("DELETE FROM feedback WHERE id=$id");
}

if (isset($_GET['delete_lost'])) {
  $id = intval($_GET['delete_lost']);
  $conn->query("DELETE FROM lost_notices WHERE id=$id");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard - LovPet</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="admin-dashboard.css" />
</head>
<body>

  <header class="admin-header">
    <a href="index.php" class="home-link">
      <img src="img/home.png" alt="Home">
    </a>
    <h1>Welcome, Admin</h1>
    <a href="login.php" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">Logout</a>
  </header>

  <main class="dashboard-container">

    <!-- USERS -->
    <section class="section">
      <h2>Manage Users</h2>
      <table>
        <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>
        <?php
          $res = $conn->query("SELECT * FROM users");
          while ($row = $res->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['fullname']}</td>
              <td>{$row['email']}</td>
              <td>{$row['role']}</td>
              <td><a href='?delete_user={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Remove</a></td>
            </tr>";
          }
        ?>
      </table>
    </section>

    <!-- PETS -->
    <section class="section">
      <h2>Manage Pets</h2>
      <table>
        <tr><th>ID</th><th>Name</th><th>Breed</th><th>Price</th><th>Action</th></tr>
        <?php
          $res = $conn->query("SELECT * FROM pets");
          while ($row = $res->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['breed']}</td>
              <td>{$row['price']}</td>
              <td><a href='?delete_pet={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this pet?\")'>Remove</a></td>
            </tr>";
          }
        ?>
      </table>
    </section>

    <!-- PRODUCTS -->
    <section class="section">
      <h2>Manage Products</h2>
      <a href="admin-add-product.php" class="add-btn">+ Add Product</a>
      <table>
        <tr><th>ID</th><th>Name</th><th>Brand</th><th>Price</th><th>Action</th></tr>
        <?php
          $res = $conn->query("SELECT * FROM products");
          while ($row = $res->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['name']}</td>
              <td>{$row['brand']}</td>
              <td>{$row['price']}</td>
              <td><a href='?delete_product={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Remove</a></td>
            </tr>";
          }
        ?>
      </table>
    </section>

    <!-- LOST NOTICES -->
    <section class="section">
      <h2>Manage Lost Pet Notices</h2>
      <table>
        <tr><th>ID</th><th>Name</th><th>Breed</th><th>Location</th><th>Action</th></tr>
        <?php
          $res = $conn->query("SELECT * FROM lost_notices");
          while ($row = $res->fetch_assoc()) {
            echo "<tr>
              <td>{$row['id']}</td>
              <td>{$row['pet_name']}</td>
              <td>{$row['breed']}</td>
              <td>{$row['location']}</td>
              <td><a href='?delete_lost={$row['id']}' class='delete-btn' onclick='return confirm(\"Are you sure you want to delete this lost pet notice?\")'>Remove</a></td>
            </tr>";
          }
        ?>
      </table>
    </section>

  </main>
</body>
</html>