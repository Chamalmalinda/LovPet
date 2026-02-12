<?php
session_start();

// Admin access only
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "lovpet_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- DELETE HANDLERS (feedbacks table නිවැරදි කර ඇත) ---
if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    $conn->query("DELETE FROM users WHERE id=$id");
    header("Location: admin-dashboard.php");
    exit();
}
if (isset($_GET['delete_pet'])) {
    $id = intval($_GET['delete_pet']);
    $conn->query("DELETE FROM pets WHERE id=$id");
    header("Location: admin-dashboard.php");
    exit();
}
if (isset($_GET['delete_product'])) {
    $id = intval($_GET['delete_product']);
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: admin-dashboard.php");
    exit();
}
if (isset($_GET['delete_feedback'])) {
    $id = intval($_GET['delete_feedback']);
    $conn->query("DELETE FROM feedbacks WHERE id=$id"); // feedbacks table
    header("Location: admin-dashboard.php");
    exit();
}
if (isset($_GET['delete_lost'])) {
    $id = intval($_GET['delete_lost']);
    $conn->query("DELETE FROM lost_notices WHERE id=$id");
    header("Location: admin-dashboard.php");
    exit();
}
if (isset($_GET['delete_order'])) {
    $id = intval($_GET['delete_order']);
    $conn->query("DELETE FROM orders WHERE id=$id");
    header("Location: admin-dashboard.php");
    exit();
}

// Count stats for sidebar (feedbacks ඇතුළත්)
$stats = [];
$stats['users'] = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$stats['pets'] = $conn->query("SELECT COUNT(*) as count FROM pets")->fetch_assoc()['count'];
$stats['products'] = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$stats['lost'] = $conn->query("SELECT COUNT(*) as count FROM lost_notices")->fetch_assoc()['count'];
$stats['orders'] = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];
$stats['feedbacks'] = $conn->query("SELECT COUNT(*) as count FROM feedbacks")->fetch_assoc()['count']; // Feedback count
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - LovPet 🐾</title>
    <link rel="stylesheet" href="admin-dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- ===== SIDEBAR ===== -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i data-lucide="paw-print"></i>
                    </div>
                    <span class="logo-text">LovPet</span>
                </div>
            </div>

            <!-- Quick Stats (Feedbacks ඇතුළත්) -->
            <div class="sidebar-stats">
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="users"></i></span>
                    <span class="stat-label">Users</span>
                    <span class="stat-value"><?= $stats['users'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="dog"></i></span>
                    <span class="stat-label">Pets</span>
                    <span class="stat-value"><?= $stats['pets'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="package"></i></span>
                    <span class="stat-label">Products</span>
                    <span class="stat-value"><?= $stats['products'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="map-pin"></i></span>
                    <span class="stat-label">Lost Pets</span>
                    <span class="stat-value"><?= $stats['lost'] ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="shopping-cart"></i></span>
                    <span class="stat-label">Orders</span>
                    <span class="stat-value"><?= $stats['orders'] ?></span>
                </div>
                <!-- NEW: Feedbacks count -->
                <div class="stat-item">
                    <span class="stat-icon"><i data-lucide="message-square"></i></span>
                    <span class="stat-label">Feedbacks</span>
                    <span class="stat-value"><?= $stats['feedbacks'] ?></span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <a href="#users" class="active">
                    <span class="nav-icon"><i data-lucide="users"></i></span>
                    Users
                </a>
                <a href="#pets">
                    <span class="nav-icon"><i data-lucide="dog"></i></span>
                    Pets
                </a>
                <a href="#products">
                    <span class="nav-icon"><i data-lucide="package"></i></span>
                    Products
                </a>
                <a href="#lost">
                    <span class="nav-icon"><i data-lucide="map-pin"></i></span>
                    Lost Notices
                </a>
                <a href="#orders">
                    <span class="nav-icon"><i data-lucide="shopping-cart"></i></span>
                    Orders
                </a>
                <!-- NEW: Feedbacks link -->
                <a href="#feedbacks">
                    <span class="nav-icon"><i data-lucide="message-square"></i></span>
                    Feedbacks
                </a>
            </nav>

            <!-- Sidebar Footer with Home + Logout -->
            <div class="sidebar-footer">
                <div class="footer-buttons">
                    <a href="index.php" class="home-btn">
                        <span class="nav-icon"><i data-lucide="home"></i></span>
                        Home
                    </a>
                    <a href="logout.php" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">
                        <span class="nav-icon"><i data-lucide="log-out"></i></span>
                        Logout
                    </a>
                </div>
            </div>
        </aside>

        <!-- ===== MAIN CONTENT ===== -->
        <main class="dashboard-main">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="banner-content">
                    <h1>Admin Dashboard</h1>
                    <p>Manage your LovPet platform with ease</p>
                </div>
                <div class="banner-stats">
                    <div class="stat-badge">
                        <i data-lucide="calendar"></i>
                        <span><?= date('F d, Y') ?></span>
                    </div>
                </div>
            </div>

            <!-- USERS SECTION -->
            <section id="users" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="users"></i>
                        <h2>Manage Users</h2>
                    </div>
                    <span class="section-count"><?= $stats['users'] ?> records</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, fullname, email, role FROM users ORDER BY id DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['fullname']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><span class="role-badge role-<?= $row['role'] ?>"><?= $row['role'] ?></span></td>
                                <td>
                                    <a href="?delete_user=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this user?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- PETS SECTION (with EDIT button) -->
            <section id="pets" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="dog"></i>
                        <h2>Manage Pets</h2>
                    </div>
                    <span class="section-count"><?= $stats['pets'] ?> records</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Breed</th>
                                <th>Price (LKR)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, name, breed, price FROM pets ORDER BY id DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['breed']) ?></td>
                                <td><?= number_format($row['price']) ?></td>
                                <td>
                                    <a href="admin-edit-pet.php?id=<?= $row['id'] ?>" class="btn-edit">
                                        <i data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a href="?delete_pet=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this pet?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- PRODUCTS SECTION (with EDIT button) -->
            <section id="products" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="package"></i>
                        <h2>Manage Products</h2>
                    </div>
                    <a href="admin-add-product.php" class="btn-add">
                        <i data-lucide="plus"></i>
                        Add Product
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Price (LKR)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, name, brand, price FROM products ORDER BY id DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['brand']) ?></td>
                                <td><?= number_format($row['price']) ?></td>
                                <td>
                                    <a href="admin-edit-product.php?id=<?= $row['id'] ?>" class="btn-edit">
                                        <i data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a href="?delete_product=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this product?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- LOST PET NOTICES SECTION -->
            <section id="lost" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="map-pin"></i>
                        <h2>Lost Pet Notices</h2>
                    </div>
                    <span class="section-count"><?= $stats['lost'] ?> records</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Pet Name</th>
                                <th>Breed</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, pet_name, breed, location FROM lost_notices ORDER BY id DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['pet_name']) ?></td>
                                <td><?= htmlspecialchars($row['breed']) ?></td>
                                <td><?= htmlspecialchars($row['location']) ?></td>
                                <td>
                                    <a href="?delete_lost=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this notice?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ORDERS SECTION -->
            <section id="orders" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="shopping-cart"></i>
                        <h2>Orders</h2>
                    </div>
                    <span class="section-count"><?= $stats['orders'] ?> records</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Total (LKR)</th>
                                <th>Order Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, user_id, total_amount, order_date, payment_method, status FROM orders ORDER BY order_date DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td>#<?= $row['user_id'] ?></td>
                                <td><?= number_format($row['total_amount']) ?></td>
                                <td><?= date('M d, Y', strtotime($row['order_date'])) ?></td>
                                <td><?= ucfirst(str_replace('_', ' ', $row['payment_method'])) ?></td>
                                <td>
                                    <span class="status-badge status-<?= strtolower($row['status']) ?>">
                                        <?= $row['status'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="?delete_order=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this order?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- ===== FEEDBACKS SECTION (NEW – Feedbacks table) ===== -->
            <section id="feedbacks" class="section-card">
                <div class="section-header">
                    <div class="header-title">
                        <i data-lucide="message-square"></i>
                        <h2>User Feedbacks</h2>
                    </div>
                    <span class="section-count"><?= $stats['feedbacks'] ?> records</span>
                </div>
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT id, name, message, created_at FROM feedbacks ORDER BY created_at DESC");
                            while ($row = $res->fetch_assoc()):
                            ?>
                            <tr>
                                <td>#<?= $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars(substr($row['message'], 0, 60)) ?>...</td>
                                <td><?= date('M d, Y', strtotime($row['created_at'])) ?></td>
                                <td>
                                    <a href="?delete_feedback=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Delete this feedback?')">
                                        <i data-lucide="trash-2"></i>
                                        Remove
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

    <script>
        lucide.createIcons();

        // Smooth scroll for sidebar links
        document.querySelectorAll('.sidebar-nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                if (targetId.startsWith('#')) {
                    const targetSection = document.querySelector(targetId);
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Active section highlighting (feedbacks ඇතුළත්)
        const navLinks = document.querySelectorAll('.sidebar-nav a');
        const sectionIds = Array.from(navLinks).map(link => link.getAttribute('href'));
        
        function updateActiveSection() {
            let currentSectionId = null;
            for (let id of sectionIds) {
                const section = document.querySelector(id);
                if (section) {
                    const rect = section.getBoundingClientRect();
                    if (rect.top <= 150 && rect.bottom >= 150) {
                        currentSectionId = id;
                        break;
                    }
                }
            }
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === currentSectionId) {
                    link.classList.add('active');
                }
            });
        }

        window.addEventListener('scroll', updateActiveSection);
        window.addEventListener('load', updateActiveSection);
    </script>
</body>
</html>
<?php $conn->close(); ?>