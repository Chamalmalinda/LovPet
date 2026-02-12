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
    <title>Bird Care Guide - LovPet 🦜</title>
    
    <!-- Main Stylesheet (from homepage) -->
    <link rel="stylesheet" href="style.css">
    <!-- Additional Bird Care specific styles -->
    <link rel="stylesheet" href="bird-care.css">
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body>

    <!-- ===== NAVIGATION (Dynamic, same as homepage, NO TOP BAR) ===== -->
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

    <!-- ===== HERO SECTION (Bird Care specific) ===== -->
    <section class="hero bird-care-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i data-lucide="sparkles"></i>
                    <span>Complete Bird Care Guide</span>
                </div>
                <h1>Everything Your <span style="color: var(--primary-color);">Feathered Friend</span> Needs</h1>
                <p>From popular breeds to essential care tips — nutrition, housing, grooming, and health. Give your bird the love they deserve.</p>
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
                            <i data-lucide="bird"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">50+</div>
                            <div class="stat-label">Breeds</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i data-lucide="check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">80+</div>
                            <div class="stat-label">Care Tips</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <i data-lucide="users"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">2k+</div>
                            <div class="stat-label">Happy Birds</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card card-1">
                    <div class="pet-icon pet-icon-bird1">
                        <i data-lucide="bird"></i>
                    </div>
                    <div class="card-content">
                        <h3>Parrot</h3>
                        <p>Smart & Chatty</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-2">
                    <div class="pet-icon pet-icon-bird2">
                        <i data-lucide="bird"></i>
                    </div>
                    <div class="card-content">
                        <h3>Canary</h3>
                        <p>Sweet Singer</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-3">
                    <div class="pet-icon pet-icon-bird3">
                        <i data-lucide="bird"></i>
                    </div>
                    <div class="card-content">
                        <h3>Budgie</h3>
                        <p>Playful & Colorful</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== POPULAR BIRD BREEDS SECTION ===== -->
    <section id="breeds" class="breeds-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🦜 Popular Breeds</span>
                <h2>Find Your Feathered Companion</h2>
                <p>Each breed has unique traits. Learn about their personality, care needs, and more.</p>
            </div>
            <div class="breeds-grid">
                <!-- Parrot -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/29.jpg" alt="Parrot">
                        <div class="breed-overlay">
                            <span class="breed-tag">Talking</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Parrot</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Moderate</span>
                            <span><i data-lucide="mic"></i> Mimicry: Excellent</span>
                        </div>
                        <p>Intelligent, social, and long-lived. Parrots need daily interaction and mental stimulation. Provide plenty of toys and out-of-cage time.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Canary -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/30.webp" alt="Canary">
                        <div class="breed-overlay">
                            <span class="breed-tag">Songbird</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Canary</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Moderate</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="music"></i> Singing: Excellent</span>
                        </div>
                        <p>Small, lively, and melodic. Canaries are easy to care for and enjoy a spacious cage with perches. Males are famous for their beautiful songs.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Budgie (Parakeet) -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/31.jpeg" alt="Budgie">
                        <div class="breed-overlay">
                            <span class="breed-tag">Beginner Friendly</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Budgie</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="brain"></i> Trainability: High</span>
                        </div>
                        <p>Playful, affectionate, and easy to tame. Budgies thrive in pairs or groups. Provide a varied diet and plenty of toys to keep them happy.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Cockatiel -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/cockatiel.jpg" alt="Cockatiel">
                        <div class="breed-overlay">
                            <span class="breed-tag">Whistler</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Cockatiel</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Moderate</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="mic"></i> Mimicry: Good</span>
                        </div>
                        <p>Gentle, crest-headed birds that love head scratches. Cockatiels are great for families and can learn to whistle tunes.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Lovebird -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/lovebird.jpg" alt="Lovebird">
                        <div class="breed-overlay">
                            <span class="breed-tag">Affectionate</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Lovebird</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="heart"></i> Bonding: Strong</span>
                        </div>
                        <p>Small parrots that form deep bonds. Lovebirds need a companion (human or bird) and plenty of toys. They are active and curious.</p>
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
                <h2>How to Keep Your Bird Happy & Healthy</h2>
                <p>Simple daily habits that make a big difference.</p>
            </div>
            <div class="tips-grid">
                <!-- Nutrition -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="utensils"></i>
                    </div>
                    <h3>Nutrition & Diet</h3>
                    <ul class="tip-list">
                        <li>High-quality pellets as base diet</li>
                        <li>Fresh vegetables & fruits daily</li>
                        <li>Limit seeds (treats only)</li>
                        <li>Avoid avocado, chocolate, caffeine</li>
                    </ul>
                </div>
                <!-- Cage & Housing -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="home"></i>
                    </div>
                    <h3>Cage & Housing</h3>
                    <ul class="tip-list">
                        <li>Wider cage is better than tall</li>
                        <li>Bar spacing appropriate for species</li>
                        <li>Multiple perches of different sizes</li>
                        <li>Clean cage weekly, food bowls daily</li>
                    </ul>
                </div>
                <!-- Grooming -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="scissors"></i>
                    </div>
                    <h3>Grooming & Hygiene</h3>
                    <ul class="tip-list">
                        <li>Provide shallow water for bathing</li>
                        <li>Trim nails & beak (vets only)</li>
                        <li>Never trim flight feathers fully</li>
                        <li>Check for overgrown beak</li>
                    </ul>
                </div>
                <!-- Health -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="activity"></i>
                    </div>
                    <h3>Health & Wellness</h3>
                    <ul class="tip-list">
                        <li>Annual avian vet check-ups</li>
                        <li>Watch for sneezing, fluffed feathers</li>
                        <li>Quarantine new birds for 30 days</li>
                        <li>Provide UV lighting for indoor birds</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== BIRD ESSENTIALS SHOP SECTION ===== -->
    <section class="essentials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🛍️ Shop Essentials</span>
                <h2>Everything Your Bird Needs</h2>
                <p>Food, cages, toys, health supplies — we've got it covered.</p>
            </div>
            <div class="essentials-grid">
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="package"></i>
                    </div>
                    <h3>Bird Food</h3>
                    <p>Pellets, seeds, and treats for all species.</p>
                    <a href="product.php" class="essential-link">Shop Food →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="home"></i>
                    </div>
                    <h3>Cages & Stands</h3>
                    <p>Spacious, safe cages with appropriate bar spacing.</p>
                    <a href="product.php" class="essential-link">Shop Cages →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="toy"></i>
                    </div>
                    <h3>Toys & Enrichment</h3>
                    <p>Chew toys, swings, bells, and foraging toys.</p>
                    <a href="product.php" class="essential-link">Shop Toys →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="pill"></i>
                    </div>
                    <h3>Health & Supplements</h3>
                    <p>Vitamins, mite sprays, beak conditioners.</p>
                    <a href="product.php" class="essential-link">Shop Health →</a>
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
                <h2>Ready to Welcome a Bird?</h2>
                <p>Browse our available birds or schedule a vet consultation.</p>
                <a href="find-pet.php" class="btn btn-primary btn-large">
                    <span>Find Your Bird</span>
                    <i data-lucide="arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER (Exact copy from homepage, no top bar) ===== -->
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