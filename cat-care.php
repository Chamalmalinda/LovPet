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
    <title>Cat Care Guide - LovPet 🐱</title>
    
    <!-- Main Stylesheet (from homepage) -->
    <link rel="stylesheet" href="style.css">
    <!-- Additional Cat Care specific styles -->
    <link rel="stylesheet" href="cat-care.css">
    
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

    <!-- ===== HERO SECTION (Cat Care specific) ===== -->
    <section class="hero cat-care-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i data-lucide="sparkles"></i>
                    <span>Complete Cat Care Guide</span>
                </div>
                <h1>Everything Your <span style="color: var(--primary-color);">Feline Friend</span> Needs</h1>
                <p>From popular breeds to essential care tips — nutrition, grooming, litter training, and health. Give your cat the love they deserve.</p>
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
                            <i data-lucide="cat"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-number">70+</div>
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
                            <div class="stat-number">3k+</div>
                            <div class="stat-label">Happy Cats</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-visual">
                <div class="hero-card card-1">
                    <div class="pet-icon pet-icon-cat">
                        <i data-lucide="cat"></i>
                    </div>
                    <div class="card-content">
                        <h3>Persian</h3>
                        <p>Sweet & Calm</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-2">
                    <div class="pet-icon pet-icon-cat2">
                        <i data-lucide="cat"></i>
                    </div>
                    <div class="card-content">
                        <h3>Siamese</h3>
                        <p>Vocal & Playful</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
                <div class="hero-card card-3">
                    <div class="pet-icon pet-icon-cat3">
                        <i data-lucide="cat"></i>
                    </div>
                    <div class="card-content">
                        <h3>Bengal</h3>
                        <p>Active & Wild</p>
                    </div>
                    <div class="card-shine"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== POPULAR CAT BREEDS SECTION ===== -->
    <section id="breeds" class="breeds-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🐱 Popular Breeds</span>
                <h2>Find Your Purrfect Match</h2>
                <p>Each breed has unique traits. Learn about their personality, care needs, and more.</p>
            </div>
            <div class="breeds-grid">
                <!-- Persian -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/20.jpg" alt="Persian Cat">
                        <div class="breed-overlay">
                            <span class="breed-tag">Lap Cat</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Persian</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Low</span>
                            <span><i data-lucide="scissors"></i> Grooming: High</span>
                            <span><i data-lucide="brain"></i> Affection: High</span>
                        </div>
                        <p>Sweet, gentle, and quiet. Persians are ideal for calm households. Their long coat requires daily brushing and regular bathing.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Siamese -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/21.webp" alt="Siamese Cat">
                        <div class="breed-overlay">
                            <span class="breed-tag">Talkative</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Siamese</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="brain"></i> Trainability: High</span>
                        </div>
                        <p>Energetic, vocal, and people-oriented. Siamese cats form strong bonds and enjoy interactive play. Their short coat is easy to maintain.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Bengal -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/22.webp" alt="Bengal Cat">
                        <div class="breed-overlay">
                            <span class="breed-tag">Active</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Bengal</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Very High</span>
                            <span><i data-lucide="scissors"></i> Grooming: Low</span>
                            <span><i data-lucide="brain"></i> Trainability: High</span>
                        </div>
                        <p>Adventurous, intelligent, and athletic. Bengals need plenty of exercise and mental stimulation. Their unique spotted coat requires minimal grooming.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Maine Coon -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/maine-coon.jpg" alt="Maine Coon">
                        <div class="breed-overlay">
                            <span class="breed-tag">Gentle Giant</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Maine Coon</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Moderate</span>
                            <span><i data-lucide="scissors"></i> Grooming: High</span>
                            <span><i data-lucide="brain"></i> Trainability: High</span>
                        </div>
                        <p>Friendly, dog-like, and adaptable. Maine Coons are known for their large size and tufted ears. Weekly brushing keeps their coat healthy.</p>
                        <a href="#" class="breed-link">Read more →</a>
                    </div>
                </div>
                <!-- Ragdoll -->
                <div class="breed-card">
                    <div class="breed-image">
                        <img src="img/ragdoll.jpg" alt="Ragdoll">
                        <div class="breed-overlay">
                            <span class="breed-tag">Fluffy</span>
                        </div>
                    </div>
                    <div class="breed-content">
                        <h3>Ragdoll</h3>
                        <div class="breed-stats">
                            <span><i data-lucide="zap"></i> Energy: Low</span>
                            <span><i data-lucide="scissors"></i> Grooming: Moderate</span>
                            <span><i data-lucide="brain"></i> Affection: Very High</span>
                        </div>
                        <p>Relaxed, affectionate, and floppy. Ragdolls go limp when picked up. They are great with children and other pets. Brush 2-3 times a week.</p>
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
                <h2>How to Keep Your Cat Happy & Healthy</h2>
                <p>Simple daily habits that make a big difference.</p>
            </div>
            <div class="tips-grid">
                <!-- Nutrition -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="utensils"></i>
                    </div>
                    <h3>Nutrition & Feeding</h3>
                    <ul class="tip-list">
                        <li>High-protein, meat-based diet</li>
                        <li>Wet food for hydration, dry food for dental health</li>
                        <li>Avoid toxic foods (onion, garlic, chocolate)</li>
                        <li>Fresh water always available</li>
                    </ul>
                </div>
                <!-- Grooming -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="scissors"></i>
                    </div>
                    <h3>Grooming & Coat Care</h3>
                    <ul class="tip-list">
                        <li>Brush short hair weekly, long hair daily</li>
                        <li>Trim nails every 2-3 weeks</li>
                        <li>Clean ears and eyes gently</li>
                        <li>Bathe only when necessary</li>
                    </ul>
                </div>
                <!-- Litter Training -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="trash-2"></i>
                    </div>
                    <h3>Litter Box Training</h3>
                    <ul class="tip-list">
                        <li>One box per cat + one extra</li>
                        <li>Scoop daily, change litter weekly</li>
                        <li>Place in quiet, accessible area</li>
                        <li>Avoid scented litters</li>
                    </ul>
                </div>
                <!-- Health Care -->
                <div class="tip-card">
                    <div class="tip-icon-wrapper">
                        <i data-lucide="activity"></i>
                    </div>
                    <h3>Health & Wellness</h3>
                    <ul class="tip-list">
                        <li>Annual vet check-ups</li>
                        <li>Core vaccines (rabies, FVRCP)</li>
                        <li>Monthly flea/tick prevention</li>
                        <li>Spay/neuter by 5-6 months</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== CAT ESSENTIALS SHOP SECTION ===== -->
    <section class="essentials-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">🛍️ Shop Essentials</span>
                <h2>Everything Your Cat Needs</h2>
                <p>Food, medicine, accessories — we've got it covered.</p>
            </div>
            <div class="essentials-grid">
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="package"></i>
                    </div>
                    <h3>Premium Cat Food</h3>
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
                    <p>Comfortable, breakaway collars for safety.</p>
                    <a href="product.php" class="essential-link">Shop Accessories →</a>
                </div>
                <div class="essential-card">
                    <div class="essential-icon">
                        <i data-lucide="cat"></i>
                    </div>
                    <h3>Toys & Enrichment</h3>
                    <p>Wands, balls, puzzle toys, and scratchers.</p>
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
                <h2>Ready to Welcome a Cat?</h2>
                <p>Browse our available kittens or schedule a vet consultation.</p>
                <a href="find-pet.php" class="btn btn-primary btn-large">
                    <span>Find Your Kitten</span>
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