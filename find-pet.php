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
    <title>Find a Pet - LovPet</title>
    <link rel="stylesheet" href="find-pet.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

    <!-- Navigation -->
    <?php
    // Start session if not already (safe)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    ?>

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
                <li><a href="find-pet.php" class="<?= basename($_SERVER['PHP_SELF']) == 'find-pet.php' ? 'active' : '' ?>">Buy a Pet</a></li>
                <li><a href="product.php">Products</a></li>
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
                    <i data-lucide="heart"></i>
                    <span>Find Your Perfect Match</span>
                </span>
                <h1>Browse Available Pets</h1>
                <p>Discover loving companions from verified sellers across Sri Lanka</p>
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
                    <input type="text" id="searchInput" placeholder="Search by name or breed..." />
                </div>

                <!-- Category Filter -->
                <div class="category-filter">
                    <div class="filter-label">
                        <i data-lucide="filter"></i>
                        <span>Category</span>
                    </div>
                    <select id="categoryFilter">
                        <option value="all">All Pets</option>
                        <option value="dog">Dogs</option>
                        <option value="cat">Cats</option>
                        <option value="bird">Birds</option>
                        <option value="fish">Fish</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <!-- Results Count -->
                <div class="results-count">
                    <i data-lucide="list"></i>
                    <span id="resultsCount">0 pets found</span>
                </div>

            </div>
        </div>
    </section>

    <!-- Pets Grid Section -->
    <section class="pets-section">
        <div class="container">
            <div class="pet-grid" id="petGrid">
                <?php
                $conn = new mysqli("localhost", "root", "", "lovpet_db");
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM pets ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $petId = $row['id'];
                        $name = htmlspecialchars($row['name']);
                        $breed = htmlspecialchars($row['breed']);
                        $gender = htmlspecialchars($row['gender']);
                        $age = htmlspecialchars($row['age']) . ' months';
                        $location = htmlspecialchars($row['address']);
                        $price = $row['price'];
                        $description = htmlspecialchars($row['description']);
                        $image = htmlspecialchars($row['image']);

                        echo '
                        <div class="pet-card" 
                            data-pet-id="' . $petId . '"
                            data-name="' . $name . '"
                            data-breed="' . $breed . '"
                            data-gender="' . $gender . '"
                            data-age="' . $age . '"
                            data-location="' . $location . '"
                            data-price="' . $price . '"
                            data-description="' . $description . '"
                            data-image="' . $image . '"
                            data-category="' . strtolower($breed) . '">

                            <div class="pet-card-image">
                                <img src="' . $image . '" alt="' . $name . '">
                                <div class="pet-badge">
                                    <i data-lucide="heart"></i>
                                </div>
                            </div>

                            <div class="pet-card-content">
                                <h3>' . $name . '</h3>
                                <div class="pet-info">
                                    <div class="info-item">
                                        <i data-lucide="info"></i>
                                        <span>' . $breed . '</span>
                                    </div>
                                    <div class="info-item">
                                        <i data-lucide="map-pin"></i>
                                        <span>' . $location . '</span>
                                    </div>
                                </div>

                                <div class="pet-price">
                                    <span class="price-label">Price</span>
                                    <span class="price-value">LKR ' . number_format($price) . '</span>
                                </div>

                                <!-- Action Buttons -->
                                <div class="pet-actions">
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
                        <h3>No Pets Found</h3>
                        <p>Check back later for new additions to our pet family!</p>
                    </div>
                    ';
                }

                $conn->close();
                ?>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal" id="petModal">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <i data-lucide="x"></i>
            </button>

            <div class="modal-image-section">
                <img id="modalImage" src="" alt="Pet Image" />
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
                        <i data-lucide="info"></i>
                        <div>
                            <span class="info-label">Breed</span>
                            <span class="info-value" id="modalBreed"></span>
                        </div>
                    </div>
                    <div class="modal-info-item">
                        <i data-lucide="user"></i>
                        <div>
                            <span class="info-label">Gender</span>
                            <span class="info-value" id="modalGender"></span>
                        </div>
                    </div>
                    <div class="modal-info-item">
                        <i data-lucide="calendar"></i>
                        <div>
                            <span class="info-label">Age</span>
                            <span class="info-value" id="modalAge"></span>
                        </div>
                    </div>
                    <div class="modal-info-item">
                        <i data-lucide="map-pin"></i>
                        <div>
                            <span class="info-label">Location</span>
                            <span class="info-value" id="modalLocation"></span>
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

                <!-- Modal Buttons -->
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

        // ========== MODAL FUNCTIONS ==========
        function openModal(button) {
            // Get the parent pet-card
            const petCard = button.closest('.pet-card');

            // Extract data attributes
            document.getElementById('modalName').textContent = petCard.dataset.name;
            document.getElementById('modalBreed').textContent = petCard.dataset.breed;
            document.getElementById('modalGender').textContent = petCard.dataset.gender;
            document.getElementById('modalAge').textContent = petCard.dataset.age;
            document.getElementById('modalLocation').textContent = petCard.dataset.location;
            document.getElementById('modalPrice').textContent = parseFloat(petCard.dataset.price).toLocaleString();
            document.getElementById('modalDescription').textContent = petCard.dataset.description;
            document.getElementById('modalImage').src = petCard.dataset.image;

            // Store current pet data in modal dataset for buttons
            document.getElementById('petModal').dataset.petId = petCard.dataset.petId;
            document.getElementById('petModal').dataset.name = petCard.dataset.name;
            document.getElementById('petModal').dataset.breed = petCard.dataset.breed;
            document.getElementById('petModal').dataset.gender = petCard.dataset.gender;
            document.getElementById('petModal').dataset.age = petCard.dataset.age;
            document.getElementById('petModal').dataset.location = petCard.dataset.location;
            document.getElementById('petModal').dataset.price = petCard.dataset.price;
            document.getElementById('petModal').dataset.description = petCard.dataset.description;
            document.getElementById('petModal').dataset.image = petCard.dataset.image;

            // Show modal
            document.getElementById('petModal').classList.add('active');
            document.body.style.overflow = 'hidden';

            setTimeout(() => lucide.createIcons(), 100);
        }

        function closeModal() {
            document.getElementById('petModal').classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('closeModal').addEventListener('click', closeModal);
        document.getElementById('modalOverlay').addEventListener('click', closeModal);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal();
        });

        // ========== CART FUNCTIONS ==========
        function addToCart(petData, buyNow = false) {
            if (!isLoggedIn) {
                showToast('Please login to continue', 'error');
                setTimeout(() => { window.location.href = 'login.php'; }, 2000);
                return;
            }

            // Create form data to send to add_to_cart.php
            const formData = new FormData();
            formData.append('name', petData.name);
            formData.append('breed', petData.breed);
            formData.append('gender', petData.gender);
            formData.append('age', petData.age);
            formData.append('address', petData.location);
            formData.append('price', petData.price);
            formData.append('description', petData.description);
            formData.append('image', petData.image);

            fetch('add_to_cart.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (buyNow) {
                        // Redirect to checkout page
                        window.location.href = 'checkout.php';
                    } else {
                        showToast('Pet added to cart!', 'success');
                    }
                })
                .catch(error => {
                    showToast('Something went wrong. Please try again.', 'error');
                    console.error('Error:', error);
                });
        }

        // ========== BUTTON HANDLERS ==========
        function handleBuyNow(button) {
            const petCard = button.closest('.pet-card');
            const petData = {
                name: petCard.dataset.name,
                breed: petCard.dataset.breed,
                gender: petCard.dataset.gender,
                age: petCard.dataset.age,
                location: petCard.dataset.location,
                price: petCard.dataset.price,
                description: petCard.dataset.description,
                image: petCard.dataset.image
            };
            addToCart(petData, true);
        }

        function handleAddToCart(button) {
            const petCard = button.closest('.pet-card');
            const petData = {
                name: petCard.dataset.name,
                breed: petCard.dataset.breed,
                gender: petCard.dataset.gender,
                age: petCard.dataset.age,
                location: petCard.dataset.location,
                price: petCard.dataset.price,
                description: petCard.dataset.description,
                image: petCard.dataset.image
            };
            addToCart(petData, false);
        }

        function handleModalBuyNow() {
            const modal = document.getElementById('petModal');
            const petData = {
                name: modal.dataset.name,
                breed: modal.dataset.breed,
                gender: modal.dataset.gender,
                age: modal.dataset.age,
                location: modal.dataset.location,
                price: modal.dataset.price,
                description: modal.dataset.description,
                image: modal.dataset.image
            };
            addToCart(petData, true);
        }

        function handleModalAddToCart() {
            const modal = document.getElementById('petModal');
            const petData = {
                name: modal.dataset.name,
                breed: modal.dataset.breed,
                gender: modal.dataset.gender,
                age: modal.dataset.age,
                location: modal.dataset.location,
                price: modal.dataset.price,
                description: modal.dataset.description,
                image: modal.dataset.image
            };
            addToCart(petData, false);
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

            // Auto remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('toast-hide');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ========== FILTERING (unchanged) ==========
        let currentSearch = '';
        let currentCategory = 'all';

        function filterPets() {
            const query = currentSearch.toLowerCase();
            let visibleCount = 0;
            const totalPets = document.querySelectorAll('.pet-card').length;

            const categoryKeywords = {
                dog: ["dog", "labrador", "bulldog", "german shepherd", "beagle", "poodle", "husky", "retriever"],
                cat: ["cat", "persian", "siamese", "maine coon", "bengal", "ragdoll"],
                bird: ["bird", "parrot", "macaw", "cockatoo", "parakeet", "canary"],
                fish: ["fish", "goldfish", "betta", "guppy", "koi", "tetra"]
            };

            document.querySelectorAll('.pet-card').forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const breed = card.dataset.breed.toLowerCase();

                const matchesSearch = name.includes(query) || breed.includes(query);

                let matchesCategory = true;
                if (currentCategory !== 'all') {
                    if (currentCategory === 'others') {
                        const allKnown = [].concat(...Object.values(categoryKeywords));
                        const isKnown = allKnown.some(kw => breed.includes(kw));
                        matchesCategory = !isKnown;
                    } else {
                        const keywords = categoryKeywords[currentCategory] || [];
                        matchesCategory = keywords.some(kw => breed.includes(kw));
                    }
                }

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('resultsCount').textContent = `${visibleCount} pets found`;

            const existingMessage = document.getElementById('filteredNoResults');
            if (visibleCount === 0 && totalPets > 0) {
                if (!existingMessage) {
                    const noResultsDiv = document.createElement('div');
                    noResultsDiv.id = 'filteredNoResults';
                    noResultsDiv.className = 'no-results';
                    noResultsDiv.innerHTML = `
                        <i data-lucide="search-x"></i>
                        <h3>No Pets Match Your Search or Filters</h3>
                        <p>Try different keywords or change the category.</p>
                    `;
                    document.getElementById('petGrid').appendChild(noResultsDiv);
                    lucide.createIcons();
                }
            } else {
                if (existingMessage) existingMessage.remove();
            }
        }

        document.getElementById('searchInput').addEventListener('input', function() {
            currentSearch = this.value.trim();
            filterPets();
        });

        document.getElementById('categoryFilter').addEventListener('change', function() {
            currentCategory = this.value.toLowerCase();
            filterPets();
        });

        filterPets();
        setTimeout(() => lucide.createIcons(), 500);
    </script>

</body>

</html>