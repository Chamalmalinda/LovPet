<?php
session_start();
// Check login status for JavaScript
$isLoggedIn = isset($_SESSION['user_id']) ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pet Products - LovPet</title>
    <link rel="stylesheet" href="product.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet</span>
            </a>

            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="find-pet.php">Buy a Pet</a></li>
                <li><a href="product.php" class="<?= basename($_SERVER['PHP_SELF']) == 'product.php' ? 'active' : '' ?>">Products</a></li>
                <li><a href="display-notice.php">Lost Pets</a></li>
                <li><a href="cart.php">Cart</a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Logged in -->
                    <li>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></li>
                    <li>
                        <?php if ($_SESSION['user_type'] === 'admin'): ?>
                            <a href="admin-dashboard.php" class="btn-primary">Admin Dashboard</a>
                        <?php elseif ($_SESSION['user_type'] === 'seller'): ?>
                            <a href="seller_dashboard.php" class="btn-primary">My Dashboard</a>
                        <?php elseif ($_SESSION['user_type'] === 'buyer'): ?>
                            <a href="buyer_dashboard.php" class="btn-primary">My Dashboard</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="logout.php" class="btn-secondary">Logout</a></li>
                <?php else: ?>
                    <!-- Not logged in -->
                    <li><a href="login.php" class="btn-primary">Login</a></li>
                    <li><a href="register.php" class="btn-secondary">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container">
            <div class="page-hero-content">
                <span class="section-badge">
                    <i data-lucide="shopping-bag"></i>
                    <span>Quality Products for Pets</span>
                </span>
                <h1>Browse Pet Products</h1>
                <p>Discover premium food, toys, accessories and more for your furry friends</p>
            </div>
        </div>
    </section>

    <!-- Filter and Search Section -->
    <section class="filter-section-wrapper">
        <div class="container">
            <div class="filter-search-container">

                <!-- Search Bar -->
                <div class="search-box">
                    <i data-lucide="search"></i>
                    <input type="text" id="searchInput" placeholder="Search by product name or brand..." />
                </div>

                <!-- Category Filter -->
                <div class="category-filter">
                    <div class="filter-label">
                        <i data-lucide="filter"></i>
                        <span>Category</span>
                    </div>
                    <select id="categoryFilter">
                        <option value="all">All Products</option>
                        <option value="food">Food & Treats</option>
                        <option value="toys">Toys</option>
                        <option value="accessories">Accessories</option>
                        <option value="health">Health Care</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <!-- Results Count -->
                <div class="results-count">
                    <i data-lucide="list"></i>
                    <span id="resultsCount">0 products found</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Products Grid Section -->
    <section class="products-section">
        <div class="container">
            <div class="product-grid" id="productGrid">
                <?php
                $conn = new mysqli("localhost", "root", "", "lovpet_db");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM products ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $productId = $row['id'];
                        $name = htmlspecialchars($row['name']);
                        $brand = htmlspecialchars($row['brand']);
                        $quantity = htmlspecialchars($row['quantity']);
                        $price = $row['price'];
                        $description = htmlspecialchars($row['description']);
                        $image = "display-image.php?id=" . $row['id'];

                        echo '
                        <div class="product-card" 
                            data-product-id="' . $productId . '"
                            data-name="' . $name . '"
                            data-brand="' . $brand . '"
                            data-quantity="' . $quantity . '"
                            data-price="' . $price . '"
                            data-description="' . $description . '"
                            data-image="' . $image . '">

                            <div class="product-card-image">
                                <img src="' . $image . '" alt="' . $name . '">
                                <div class="product-badge">
                                    <i data-lucide="heart"></i>
                                </div>
                            </div>

                            <div class="product-card-content">
                                <h3>' . $name . '</h3>
                                <div class="product-info">
                                    <div class="info-item">
                                        <i data-lucide="tag"></i>
                                        <span>' . $brand . '</span>
                                    </div>
                                    <div class="info-item">
                                        <i data-lucide="package"></i>
                                        <span>' . $quantity . ' units</span>
                                    </div>
                                </div>

                                <div class="product-price">
                                    <span class="price-label">Price</span>
                                    <span class="price-value">LKR ' . number_format($price) . '</span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="product-actions">
                                    <button class="buy-now-btn" onclick="handleBuyNow(this)">
                                        <i data-lucide="zap"></i>
                                        <span>Buy Now</span>
                                    </button>
                                    <button class="add-to-cart-btn" onclick="handleAddToCart(this)">
                                        <i data-lucide="shopping-cart"></i>
                                        <span>Add to Cart</span>
                                    </button>
                                    <button class="view-details-btn" onclick="openModal(this)">
                                        <i data-lucide="eye"></i>
                                        <span>Details</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                } else {
                    echo '
                    <div class="no-results">
                        <i data-lucide="search-x"></i>
                        <h3>No Products Available</h3>
                        <p>Check back later for new additions!</p>
                    </div>
                    ';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="productModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <i data-lucide="x"></i>
            </button>

            <div class="modal-image-section">
                <img id="modalImage" src="" alt="Product Image" />
            </div>

            <div class="modal-details">
                <div class="modal-header">
                    <h2 id="modalName"></h2>
                    <div class="modal-price">
                        <span class="price-label">Price</span>
                        <span class="price-value">LKR <span id="modalPrice"></span></span>
                    </div>
                </div>

                <div class="modal-info-grid">
                    <div class="modal-info-item">
                        <i data-lucide="tag"></i>
                        <div>
                            <span class="info-label">Brand</span>
                            <span class="info-value" id="modalBrand"></span>
                        </div>
                    </div>
                    <div class="modal-info-item">
                        <i data-lucide="package"></i>
                        <div>
                            <span class="info-label">Quantity Available</span>
                            <span class="info-value" id="modalQuantity"></span>
                        </div>
                    </div>
                </div>

                <div class="modal-description">
                    <h4>
                        <i data-lucide="file-text"></i>
                        <span>Description</span>
                    </h4>
                    <p id="modalDescription"></p>
                </div>

                <!-- Modal Action Buttons -->
                <div class="modal-actions">
                    <button class="modal-buy-now-btn" onclick="handleModalBuyNow()">
                        <i data-lucide="zap"></i>
                        <span>Buy Now</span>
                    </button>
                    <button class="modal-add-to-cart-btn" onclick="handleModalAddToCart()">
                        <i data-lucide="shopping-cart"></i>
                        <span>Add to Cart</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="toast-container"></div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-column footer-brand">
                    <div class="footer-logo">
                        <div class="logo-icon">
                            <i data-lucide="paw-print"></i>
                        </div>
                        <span class="logo-text">LovPet</span>
                    </div>
                    <p class="footer-description">Connecting loving pets with caring families across Sri Lanka since 2020.</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
                            <i data-lucide="instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
                            <i data-lucide="facebook"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-column">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="find-pet.php">Find a Pet</a></li>
                        <li><a href="product.php">Products</a></li>
                        <li><a href="display-notice.php">Lost Pet Notice</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Support</h4>
                    <ul>
                        <li><a href="faq.php">FAQs</a></li>
                        <li><a href="terms.php">Terms of Service</a></li>
                        <li><a href="privacy.php">Privacy Policy</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="login.php">Sign Up</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Contact Us</h4>
                    <ul class="contact-list">
                        <li>
                            <i data-lucide="mail"></i>
                            <span>lovpet123@gmail.com</span>
                        </li>
                        <li>
                            <i data-lucide="phone"></i>
                            <span>071-4577814</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
            </div>
        </div>
    </footer>

    <script>
        // Pass login status to JavaScript
        const isLoggedIn = <?= $isLoggedIn ?>;

        // Initialize Lucide icons
        lucide.createIcons();

        // ========== CART FUNCTIONS ==========
        function addToCart(productData, buyNow = false) {
            if (!isLoggedIn) {
                showToast('Please login to continue', 'error');
                setTimeout(() => { window.location.href = 'login.php'; }, 2000);
                return;
            }

            // Create form data to send to add_to_cart.php
            const formData = new FormData();
            formData.append('name', productData.name);
            formData.append('brand', productData.brand);
            formData.append('price', productData.price);
            formData.append('description', productData.description);
            formData.append('image', productData.image);
            formData.append('quantity', productData.quantity); // if needed

            fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (buyNow) {
                        window.location.href = 'checkout.php';
                    } else {
                        showToast('Product added to cart!', 'success');
                    }
                })
                .catch(error => {
                    showToast('Something went wrong. Please try again.', 'error');
                    console.error('Error:', error);
                });
        }

        // ========== BUTTON HANDLERS ==========
        function handleBuyNow(button) {
            const productCard = button.closest('.product-card');
            const productData = {
                name: productCard.dataset.name,
                brand: productCard.dataset.brand,
                quantity: productCard.dataset.quantity,
                price: productCard.dataset.price,
                description: productCard.dataset.description,
                image: productCard.dataset.image
            };
            addToCart(productData, true);
        }

        function handleAddToCart(button) {
            const productCard = button.closest('.product-card');
            const productData = {
                name: productCard.dataset.name,
                brand: productCard.dataset.brand,
                quantity: productCard.dataset.quantity,
                price: productCard.dataset.price,
                description: productCard.dataset.description,
                image: productCard.dataset.image
            };
            addToCart(productData, false);
        }

        // ========== MODAL FUNCTIONS ==========
        function openModal(button) {
            const productCard = button.closest('.product-card');

            document.getElementById('modalName').textContent = productCard.dataset.name;
            document.getElementById('modalBrand').textContent = productCard.dataset.brand;
            document.getElementById('modalQuantity').textContent = productCard.dataset.quantity + ' units';
            document.getElementById('modalPrice').textContent = parseFloat(productCard.dataset.price).toLocaleString();
            document.getElementById('modalDescription').textContent = productCard.dataset.description;
            document.getElementById('modalImage').src = productCard.dataset.image;

            // Store current product data in modal dataset
            document.getElementById('productModal').dataset.name = productCard.dataset.name;
            document.getElementById('productModal').dataset.brand = productCard.dataset.brand;
            document.getElementById('productModal').dataset.quantity = productCard.dataset.quantity;
            document.getElementById('productModal').dataset.price = productCard.dataset.price;
            document.getElementById('productModal').dataset.description = productCard.dataset.description;
            document.getElementById('productModal').dataset.image = productCard.dataset.image;

            document.getElementById('productModal').classList.add('active');
            document.body.style.overflow = 'hidden';

            setTimeout(() => lucide.createIcons(), 100);
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('closeModal').addEventListener('click', closeModal);
        document.getElementById('modalOverlay').addEventListener('click', closeModal);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        function handleModalBuyNow() {
            const modal = document.getElementById('productModal');
            const productData = {
                name: modal.dataset.name,
                brand: modal.dataset.brand,
                quantity: modal.dataset.quantity,
                price: modal.dataset.price,
                description: modal.dataset.description,
                image: modal.dataset.image
            };
            addToCart(productData, true);
        }

        function handleModalAddToCart() {
            const modal = document.getElementById('productModal');
            const productData = {
                name: modal.dataset.name,
                brand: modal.dataset.brand,
                quantity: modal.dataset.quantity,
                price: modal.dataset.price,
                description: modal.dataset.description,
                image: modal.dataset.image
            };
            addToCart(productData, false);
        }

        // ========== TOAST NOTIFICATIONS ==========
        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast toast-${type}`;

            const icon = type === 'success' ? 'check-circle' : 'alert-circle';

            toast.innerHTML = `
                <i data-lucide="${icon}"></i>
                <span>${message}</span>
            `;

            container.appendChild(toast);
            lucide.createIcons();

            setTimeout(() => {
                toast.classList.add('toast-hide');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ========== FILTERING ==========
        let currentSearch = '';
        let currentCategory = 'all';

        function filterProducts() {
            const query = currentSearch.toLowerCase();
            let visibleCount = 0;
            const totalProducts = document.querySelectorAll('.product-card').length;

            const categoryKeywords = {
                food: ["food", "feed", "treat", "biscuit", "kibble", "pedigree", "whiskas", "royal"],
                toys: ["toy", "ball", "rope", "chew", "plush", "kong", "frisbee"],
                accessories: ["collar", "leash", "bed", "bowl", "carrier", "grooming", "harness"],
                health: ["shampoo", "flea", "tick", "vitamin", "medicine", "supplement", "care"]
            };

            document.querySelectorAll('.product-card').forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const brand = card.dataset.brand.toLowerCase();
                const text = name + ' ' + brand;

                const matchesSearch = text.includes(query);

                let matchesCategory = true;
                if (currentCategory !== 'all') {
                    if (currentCategory === 'others') {
                        const allKnown = [].concat(...Object.values(categoryKeywords));
                        matchesCategory = !allKnown.some(kw => text.includes(kw));
                    } else {
                        const keywords = categoryKeywords[currentCategory] || [];
                        matchesCategory = keywords.some(kw => text.includes(kw));
                    }
                }

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('resultsCount').textContent = `${visibleCount} products found`;

            const existingMessage = document.getElementById('filteredNoResults');
            if (visibleCount === 0 && totalProducts > 0) {
                if (!existingMessage) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'filteredNoResults';
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = `
                        <i data-lucide="search-x"></i>
                        <h3>No Products Match Your Search or Filters</h3>
                        <p>Try different keywords or change the category.</p>
                    `;
                    document.getElementById('productGrid').appendChild(noResultsDiv);
                    lucide.createIcons();
                }
            } else if (existingMessage) {
                existingMessage.remove();
            }
        }

        // Filters
        document.getElementById('searchInput').addEventListener('input', function() {
            currentSearch = this.value.trim();
            filterProducts();
        });

        document.getElementById('categoryFilter').addEventListener('change', function() {
            currentCategory = this.value.toLowerCase();
            filterProducts();
        });

        filterProducts();
        setTimeout(() => lucide.createIcons(), 500);
    </script>

</body>

</html>