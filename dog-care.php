<?php
// Start session for navigation (same as homepage)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Care Guide - LovPet 🐾</title>
    
    <!-- Main Stylesheet (from homepage) -->
    <link rel="stylesheet" href="style.css">
    <!-- Additional Dog Care specific styles -->
    <link rel="stylesheet" href="dog-care.css">
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>


    <!-- ===== NAVIGATION (Dynamic, same as homepage) ===== -->
    <nav class="navbar">
        <div class="container nav-content">
            <a href="index.php" class="logo">
                <div class="logo-icon">
                    <i data-lucide="paw-print"></i>
                </div>
                <span class="logo-text">LovPet</span>
            </a>

            <ul class="nav-menu">
                <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="find-pet.php">Buy a Pet</a></li>
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

    <!-- ===== HERO SECTION (Dog Care specific) ===== -->
    <section class="hero dog-care-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i data-lucide="sparkles"></i>
                    <span>Complete Dog Care Guide</span>
                </div>
                <h1>Everything Your <span style="color: var(--primary-color);">Furry Friend</span> Needs</h1>
                <p>From popular breeds to essential care tips — feeding, grooming, training, and health. Give your dog the love they deserve.</p>
                <div class="hero-buttons">
                    <a href="#breeds" class="btn btn-primary">
                        <span>Explore Breeds</span>
                        <i data-lucide="arrow-right"></i>
                    </a>
                    <a href="#tips" class="btn btn-secondary">
                        <span>Care Tips</span>
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i data-lucide="dog"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">450+</div>
                            <div class="stat-label">Breeds</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i data-lucide="check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">100+</div>
                            <div class="stat-label">Care Tips</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i data-lucide="users"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">5k+</div>
                            <div class="stat-label">Happy Dogs</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card card-1">
                    <div class="pet-icon pet-icon-dog">
                        <i data-lucide="dog"></i>
                    </div>
                    <div class="card-content">
                        <h3>Labrador</h3>
                        <p>Friendly & Energetic</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-2">
                    <div class="pet-icon pet-icon-cat">
                        <i data-lucide="dog"></i>
                    </div>
                    <div class="card-content">
                        <h3>Golden Retriever</h3>
                        <p>Gentle & Smart</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-3">
                    <div class="pet-icon pet-icon-bird">
                        <i data-lucide="dog"></i>
                    </div>
                    <div class="card-content">
                        <h3>German Shepherd</h3>
                        <p>Loyal & Protective</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== POPULAR DOG BREEDS SECTION ===== -->
    <section id="breeds" class="breeds-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🐕 Popular Breeds</span>
                <h2>Find Your Perfect Match</h2>
                <p>Each breed has unique traits. Learn about their personality, care needs, and more.</p>
            </div>
            <div class="breeds-grid">
                <!-- Labrador Retriever -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/8.avif" alt="Labrador Retriever">
                        <div class="breed-overlay">
                            <span class="breed-tag">Family Dog</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Labrador Retriever</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Moderate</span>
                            <span><i data-lucide="brain"></i> Trainability: Excellent</span>
                        </div>
                        <p>Friendly, active, and outgoing. Labs are wonderful family companions and excel in service roles. Daily exercise and regular brushing keep them happy.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Golden Retriever -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/11.jpeg" alt="Golden Retriever">
                        <div class="breed-overlay">
                            <span class="breed-tag">Therapy Dog</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Golden Retriever</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Moderate</span>
                            <span><i data-lucide="scissors"></i> Grooming: High</span>
                            <span><i data-lucide="brain"></i> Trainability: Excellent</span>
                        </div>
                        <p>Intelligent, gentle, and devoted. Goldens are ideal for families with children. Their thick coat needs brushing 2-3 times a week.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Poodle -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/10.webp" alt="Poodle">
                        <div class="breed-overlay">
                            <span class="breed-tag">Hypoallergenic</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Poodle (Standard)</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Moderate</span>
                            <span><i data-lucide="scissors"></i> Grooming: High</span>
                            <span><i data-lucide="brain"></i> Trainability: Excellent</span>
                        </div>
                        <p>Exceptionally smart and elegant. Poodles are easy to train and shed very little. Regular professional grooming is a must.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- German Shepherd -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/German.png" alt="German Shepherd">
                        <div class="breed-overlay">
                            <span class="breed-tag">Protector</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>German Shepherd</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Moderate</span>
                            <span><i data-lucide="brain"></i> Trainability: Excellent</span>
                        </div>
                        <p>Confident, courageous, and smart. German Shepherds thrive on having a job. Early socialization and consistent training are key.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Boxer -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/boxer.jpg" alt="Boxer">
                        <div class="breed-overlay">
                            <span class="breed-tag">Playful</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Boxer</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="brain"></i> Trainability: Good</span>
                        </div>
                        <p>Fun-loving, patient, and protective. Boxers bond deeply with families and need plenty of exercise. Their short coat is easy to maintain.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== ESSENTIAL CARE TIPS SECTION ===== -->
    <section id="tips" class="tips-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">❤️ Essential Care</span>
                <h2>How to Keep Your Dog Happy & Healthy</h2>
                <p>Simple daily habits that make a big difference.</p>
            </div>
            <div class="tips-grid">
                <!-- Feeding -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="utensils"></i>
                    </div>
                    <h3>Feeding & Nutrition</h3>
                    <ul class="tip-list">
                        <li>High-quality, age-appropriate food</li>
                        <li>Measure portions to avoid obesity</li>
                        <li>Fresh water always available</li>
                        <li>Avoid toxic foods (chocolate, grapes)</li>
                    </ul>
                </div>
                <!-- Grooming -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="scissors"></i>
                    </div>
                    <h3>Grooming & Hygiene</h3>
                    <ul class="tip-list">
                        <li>Brush coat 2-3 times/week</li>
                        <li>Trim nails every 3-4 weeks</li>
                        <li>Clean ears weekly</li>
                        <li>Bathe only when needed</li>
                    </ul>
                </div>
                <!-- Training -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="gamepad-2"></i>
                    </div>
                    <h3>Training & Behavior</h3>
                    <ul class="tip-list">
                        <li>Start with basic commands (sit, stay)</li>
                        <li>Use positive reinforcement</li>
                        <li>Socialize early with people/dogs</li>
                        <li>Be consistent and patient</li>
                    </ul>
                </div>
                <!-- Health -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="activity"></i>
                    </div>
                    <h3>Health & Wellness</h3>
                    <ul class="tip-list">
                        <li>Annual vet check-ups</li>
                        <li>Monthly flea/tick prevention</li>
                        <li>Daily exercise (30-60 min)</li>
                        <li>Watch for signs of illness</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== DOG ESSENTIALS SHOP SECTION ===== -->
    <section class="essentials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🛍️ Shop Essentials</span>
                <h2>Everything Your Dog Needs</h2>
                <p>Food, medicine, accessories — we've got it covered.</p>
            </div>
            <div class="essentials-grid">
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="package"></i>
                    </div>
                    <h3>Premium Dog Food</h3>
                    <p>Dry, wet, grain-free, and breed-specific formulas.</p>
                    <a href="product.php" class="essential-link">Shop Food →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="pill"></i>
                    </div>
                    <h3>Health & Medicine</h3>
                    <p>Flea/tick treatments, dewormers, vitamins.</p>
                    <a href="product.php" class="essential-link">Shop Medicine →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="toy"></i>
                    </div>
                    <h3>Collars & Leashes</h3>
                    <p>Durable, stylish, and reflective options.</p>
                    <a href="product.php" class="essential-link">Shop Accessories →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="dog"></i>
                    </div>
                    <h3>Toys & Enrichment</h3>
                    <p>Chew toys, puzzle games, fetch balls.</p>
                    <a href="product.php" class="essential-link">Shop Toys →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CTA SECTION ===== -->
    <section class="cta-section">
        <div class="cta-decoration cta-decoration-1"></div>
        <div class="cta-decoration cta-decoration-2"></div>
        <div class="container">
            <div class="cta-content">
                <div class="cta-icon">
                    <i data-lucide="heart"></i>
                </div>
                <h2>Ready to Welcome a Dog?</h2>
                <p>Browse our available puppies or schedule a vet consultation.</p>
                <a href="find-pet.php" class="btn btn-primary btn-large">
                    <span>Find Your Puppy</span>
                    <i data-lucide="arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER (Exact copy from homepage) ===== -->
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

    <!-- Lucide Icons Initialization -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>