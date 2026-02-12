<?php
// Start session if needed (for navigation login state)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - LovPet 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="privacy.css">
</head>
<body>

    <!-- ===== NAVIGATION (Modern LovPet Style) ===== -->
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
                <li><a href="product.php">Products</a></li>
                <li><a href="display-notice.php">Lost Pets</a></li>
                <li><a href="cart.php">Cart</a></li>
              

                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Logged in -->
                    <li class="welcome-text">Welcome, <?= htmlspecialchars($_SESSION['fullname'] ?? '') ?></li>
                    <li>
                        <?php if (($_SESSION['user_type'] ?? '') === 'admin'): ?>
                            <a href="admin-dashboard.php" class="btn-primary">Admin Dashboard</a>
                        <?php elseif (($_SESSION['user_type'] ?? '') === 'seller'): ?>
                            <a href="seller-index.php" class="btn-primary">My Dashboard</a>
                        <?php elseif (($_SESSION['user_type'] ?? '') === 'buyer'): ?>
                            <a href="buyer-index.php" class="btn-primary">My Dashboard</a>
                        <?php endif; ?>
                    </li>
                    <li><a href="logout.php" class="btn-secondary">Logout</a></li>
                <?php else: ?>
                    <!-- Not logged in -->
                    <li><a href="login.php" class="btn-primary">Login</a></li>
                    <li><a href="register.php" class="btn-secondary">Sign Up</a></li>
                <?php endif; ?>
            </ul>

            <button class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- ===== HERO SECTION ===== -->
    <section class="privacy-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container">
            <div class="hero-content">
                <div class="section-badge">
                    <i data-lucide="shield"></i>
                    <span>Privacy & Security</span>
                </div>
                <h1>Privacy Policy</h1>
                <p>Last updated: February 12, 2026</p>
                <div class="hero-meta">
                    <span><i data-lucide="clock"></i> Effective immediately</span>
                    <span><i data-lucide="globe"></i> Applicable to all LovPet users</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FLOATING TABLE OF CONTENTS (CATEGORIES ONLY) ===== -->
    <div class="toc-container">
        <div class="toc-card">
            <h4><i data-lucide="list"></i> Categories</h4>
            <ul class="toc-links">
                <li><a href="#intro">1. Introduction</a></li>
                <li><a href="#collect">2. Information We Collect</a></li>
                <li><a href="#use">3. How We Use Your Information</a></li>
                <li><a href="#legal">4. Legal Basis for Processing</a></li>
                <li><a href="#cookies">5. Cookies & Tracking</a></li>
                <li><a href="#share">6. How We Share Information</a></li>
                <li><a href="#security">7. Data Security</a></li>
                <li><a href="#retention">8. Data Retention</a></li>
                <li><a href="#rights">9. Your Rights</a></li>
                <li><a href="#children">10. Children's Privacy</a></li>
                <li><a href="#changes">11. Changes to This Policy</a></li>
                <li><a href="#contact">12. Contact Us</a></li>
            </ul>
        </div>
    </div>

    <!-- ===== PRIVACY CONTENT – CATEGORY CARDS ===== -->
    <section class="privacy-section">
        <div class="container">
            <div class="privacy-grid">

                <!-- ===== 1. INTRODUCTION ===== -->
                <div id="intro" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="info"></i>
                        </div>
                        <h2>1. Introduction</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">1.1</span>
                            <div class="clause-content">
                                <p>Welcome to LovPet. Your privacy is critically important to us. This Privacy Policy explains how LovPet Care (PVT) Ltd ("LovPet", "we", "us", or "our") collects, uses, discloses, and safeguards your information when you visit our website, mobile applications, or use our services (collectively, the "Platform").</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">1.2</span>
                            <div class="clause-content">
                                <p>Please read this Privacy Policy carefully. By accessing or using our Platform, you acknowledge that you have read, understood, and agree to be bound by this Privacy Policy. If you do not agree with our policies and practices, do not use our Platform.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">1.3</span>
                            <div class="clause-content">
                                <p>This policy is incorporated into our <a href="terms.php">Terms of Service</a>. Capitalized terms not defined herein have the meanings ascribed to them in the Terms of Service.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 2. INFORMATION WE COLLECT ===== -->
                <div id="collect" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="database"></i>
                        </div>
                        <h2>2. Information We Collect</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">2.1</span>
                            <div class="clause-content">
                                <p><strong>Personal Information You Provide:</strong> When you register for an account, place an order, post a pet listing, or contact us, we collect information such as your name, email address, postal address, phone number, and payment information. Payment details are processed directly by our secure third-party payment processors and are not stored by LovPet.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">2.2</span>
                            <div class="clause-content">
                                <p><strong>Pet & Listing Information:</strong> If you list a pet for adoption or post a lost/found notice, we collect details such as pet name, breed, age, gender, color, medical history, images, and location. This information is visible to other users as part of the listing.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">2.3</span>
                            <div class="clause-content">
                                <p><strong>Usage Data:</strong> We automatically collect certain information when you interact with our Platform, including IP address, browser type, operating system, referring URLs, pages viewed, and the dates/times of your visits. This helps us analyze trends and improve our services.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">2.4</span>
                            <div class="clause-content">
                                <p><strong>Cookies and Similar Technologies:</strong> We use cookies, web beacons, and similar tracking technologies to enhance your experience and collect information about how you use our Platform. You can control cookies through your browser settings.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 3. HOW WE USE YOUR INFORMATION ===== -->
                <div id="use" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="settings"></i>
                        </div>
                        <h2>3. How We Use Your Information</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">3.1</span>
                            <div class="clause-content">
                                <p><strong>To Provide and Maintain Our Services:</strong> We use your information to process adoptions and purchases, facilitate lost & found notices, manage your account, and communicate with you about your transactions.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">3.2</span>
                            <div class="clause-content">
                                <p><strong>To Improve and Personalize Your Experience:</strong> We analyze usage data to optimize our Platform, customize content, and recommend pets or products that may interest you.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">3.3</span>
                            <div class="clause-content">
                                <p><strong>To Communicate With You:</strong> We may send you transactional emails (order confirmations, adoption updates) and, with your consent, promotional emails about new features, products, or services. You can opt out of promotional emails at any time.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">3.4</span>
                            <div class="clause-content">
                                <p><strong>To Ensure Security and Prevent Fraud:</strong> We use your information to detect, investigate, and prevent fraudulent transactions, unauthorized access, and other illegal activities.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">3.5</span>
                            <div class="clause-content">
                                <p><strong>To Comply with Legal Obligations:</strong> We may process your information as necessary to comply with applicable laws, regulations, or legal requests.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 4. LEGAL BASIS FOR PROCESSING (GDPR) ===== -->
                <div id="legal" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="scale"></i>
                        </div>
                        <h2>4. Legal Basis for Processing</h2>
                    </div>
                    <div class="category-body">
                        <p class="note">If you are located in the European Economic Area (EEA) or the United Kingdom, our legal basis for collecting and using your personal information depends on the specific context and the type of information.</p>
                        <div class="clause">
                            <span class="clause-number">4.1</span>
                            <div class="clause-content">
                                <p><strong>Performance of a Contract:</strong> We process your information to fulfill our contractual obligations to you (e.g., processing adoptions, orders).</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">4.2</span>
                            <div class="clause-content">
                                <p><strong>Legitimate Interests:</strong> We process your information to pursue our legitimate business interests, such as improving our Platform, preventing fraud, and communicating with you, provided such processing does not outweigh your rights and freedoms.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">4.3</span>
                            <div class="clause-content">
                                <p><strong>Consent:</strong> We rely on your consent to send marketing communications and to place non-essential cookies. You have the right to withdraw your consent at any time.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">4.4</span>
                            <div class="clause-content">
                                <p><strong>Legal Compliance:</strong> We may process your information as necessary to comply with our legal obligations.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 5. COOKIES & TRACKING ===== -->
                <div id="cookies" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="cookie"></i>
                        </div>
                        <h2>5. Cookies & Tracking Technologies</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">5.1</span>
                            <div class="clause-content">
                                <p>We use cookies and similar technologies to enhance your browsing experience, remember your preferences, and understand how you interact with our Platform.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">5.2</span>
                            <div class="clause-content">
                                <p><strong>Essential Cookies:</strong> Necessary for the operation of our Platform (e.g., authentication, shopping cart).</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">5.3</span>
                            <div class="clause-content">
                                <p><strong>Analytics/Performance Cookies:</strong> Help us understand how visitors interact with our Platform by collecting aggregate information.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">5.4</span>
                            <div class="clause-content">
                                <p><strong>Functional Cookies:</strong> Remember your preferences (e.g., language, region) to provide enhanced, personalized features.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">5.5</span>
                            <div class="clause-content">
                                <p><strong>Targeting/Advertising Cookies:</strong> Used to deliver relevant advertisements and measure campaign effectiveness. We do not currently serve targeted ads, but we may in the future with your consent.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">5.6</span>
                            <div class="clause-content">
                                <p>You can manage your cookie preferences through your browser settings. Please note that disabling certain cookies may affect your ability to use some features of our Platform.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 6. HOW WE SHARE INFORMATION ===== -->
                <div id="share" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="share-2"></i>
                        </div>
                        <h2>6. How We Share Information</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">6.1</span>
                            <div class="clause-content">
                                <p><strong>We Do Not Sell Your Personal Information:</strong> LovPet does not and will not sell your personal information to third parties.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">6.2</span>
                            <div class="clause-content">
                                <p><strong>Service Providers:</strong> We share information with trusted third-party service providers who assist us in operating our Platform, processing payments, delivering orders, and analyzing data. These providers are contractually bound to protect your information and use it only for the purposes we specify.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">6.3</span>
                            <div class="clause-content">
                                <p><strong>Legal Compliance and Security:</strong> We may disclose your information if required to do so by law, in response to a valid legal request (e.g., subpoena, court order), or to protect the rights, property, or safety of LovPet, our users, or the public.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">6.4</span>
                            <div class="clause-content">
                                <p><strong>Business Transfers:</strong> In the event of a merger, acquisition, or sale of all or a portion of our assets, your information may be transferred as part of that transaction. We will notify you via email and/or prominent notice on our Platform of any change in ownership or uses of your personal information.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">6.5</span>
                            <div class="clause-content">
                                <p><strong>With Your Consent:</strong> We may share your information for any other purpose disclosed to you at the time we collect the information or pursuant to your consent.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 7. DATA SECURITY ===== -->
                <div id="security" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="lock"></i>
                        </div>
                        <h2>7. Data Security</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">7.1</span>
                            <div class="clause-content">
                                <p>We implement appropriate technical and organizational security measures to protect your personal information against accidental or unlawful destruction, loss, alteration, unauthorized disclosure, or access.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">7.2</span>
                            <div class="clause-content">
                                <p>All sensitive information (e.g., payment details) is encrypted using Secure Socket Layer (SSL) technology. We regularly review our security practices and update them as necessary.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">7.3</span>
                            <div class="clause-content">
                                <p>Despite our efforts, no method of transmission over the Internet or method of electronic storage is 100% secure. Therefore, we cannot guarantee absolute security. We encourage you to take steps to protect your personal information, such as using a strong password and not sharing your login credentials.</p>
                            </div>
                        </div>
                        <div class="alert-box">
                            <i data-lucide="shield"></i>
                            <span><strong>SSL Encryption:</strong> Your connection to LovPet is secured with 256-bit SSL encryption. Look for the padlock icon in your browser address bar.</span>
                        </div>
                    </div>
                </div>

                <!-- ===== 8. DATA RETENTION ===== -->
                <div id="retention" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="archive"></i>
                        </div>
                        <h2>8. Data Retention</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">8.1</span>
                            <div class="clause-content">
                                <p>We retain your personal information for as long as your account is active or as needed to provide you with our services. We may also retain and use your information to comply with legal obligations, resolve disputes, and enforce our agreements.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">8.2</span>
                            <div class="clause-content">
                                <p>When you delete your account, we will delete or anonymize your personal information within 30 days, except where we are required to retain it for legitimate legal or regulatory reasons (e.g., tax, accounting, fraud prevention).</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">8.3</span>
                            <div class="clause-content">
                                <p>Pet listings and lost/found notices may remain visible on our Platform until you remove them or they expire according to our Terms of Service.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 9. YOUR RIGHTS ===== -->
                <div id="rights" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="user-check"></i>
                        </div>
                        <h2>9. Your Rights</h2>
                    </div>
                    <div class="category-body">
                        <p class="note">Depending on your location, you may have the following rights regarding your personal information:</p>
                        <div class="clause">
                            <span class="clause-number">9.1</span>
                            <div class="clause-content">
                                <p><strong>Access:</strong> You have the right to request a copy of the personal information we hold about you.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.2</span>
                            <div class="clause-content">
                                <p><strong>Rectification:</strong> You have the right to correct inaccurate or incomplete information. You can update your profile directly in your account settings.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.3</span>
                            <div class="clause-content">
                                <p><strong>Erasure (Right to be Forgotten):</strong> You may request deletion of your personal information, subject to certain legal exceptions.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.4</span>
                            <div class="clause-content">
                                <p><strong>Restriction of Processing:</strong> You have the right to request that we restrict the processing of your personal information in certain circumstances.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.5</span>
                            <div class="clause-content">
                                <p><strong>Data Portability:</strong> You have the right to receive your personal information in a structured, commonly used, and machine-readable format.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.6</span>
                            <div class="clause-content">
                                <p><strong>Objection:</strong> You have the right to object to processing based on legitimate interests or direct marketing.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.7</span>
                            <div class="clause-content">
                                <p><strong>Withdraw Consent:</strong> If we process your information based on your consent, you may withdraw that consent at any time without affecting the lawfulness of processing based on consent before its withdrawal.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">9.8</span>
                            <div class="clause-content">
                                <p><strong>Lodge a Complaint:</strong> You have the right to lodge a complaint with a supervisory authority in your country of residence.</p>
                            </div>
                        </div>
                        <p>To exercise any of these rights, please contact us at <strong>privacy@lovpet.lk</strong> or use the contact details below. We will respond to your request within 30 days.</p>
                    </div>
                </div>

                <!-- ===== 10. CHILDREN'S PRIVACY ===== -->
                <div id="children" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="baby"></i>
                        </div>
                        <h2>10. Children's Privacy</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">10.1</span>
                            <div class="clause-content">
                                <p>Our Platform is not directed to children under the age of 13 (or under 16 in certain jurisdictions). We do not knowingly collect personal information from children. If you believe we have inadvertently collected information from a child, please contact us immediately and we will take steps to delete such information.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">10.2</span>
                            <div class="clause-content">
                                <p>If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact us so that we can take necessary action.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 11. CHANGES TO THIS POLICY ===== -->
                <div id="changes" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="edit"></i>
                        </div>
                        <h2>11. Changes to This Policy</h2>
                    </div>
                    <div class="category-body">
                        <div class="clause">
                            <span class="clause-number">11.1</span>
                            <div class="clause-content">
                                <p>We may update this Privacy Policy from time to time to reflect changes in our practices, legal requirements, or operational requirements. When we make material changes, we will notify you by posting the revised policy on this page with an updated "Last Updated" date.</p>
                            </div>
                        </div>
                        <div class="clause">
                            <span class="clause-number">11.2</span>
                            <div class="clause-content">
                                <p>We encourage you to review this Privacy Policy periodically. Your continued use of our Platform after any revisions constitutes your acceptance of the updated policy.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===== 12. CONTACT US ===== -->
                <div id="contact" class="category-card">
                    <div class="category-header">
                        <div class="category-icon">
                            <i data-lucide="headphones"></i>
                        </div>
                        <h2>12. Contact Us</h2>
                    </div>
                    <div class="category-body">
                        <p>If you have any questions, concerns, or requests regarding this Privacy Policy or our data practices, please contact us:</p>
                        <div class="contact-grid">
                            <div class="contact-method">
                                <i data-lucide="mail"></i>
                                <div>
                                    <strong>Privacy Inquiries</strong>
                                    <span>privacy@lovpet.lk</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i data-lucide="mail"></i>
                                <div>
                                    <strong>General Support</strong>
                                    <span>lovpet123@gmail.com</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i data-lucide="phone"></i>
                                <div>
                                    <strong>Phone</strong>
                                    <span>071-4577814</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i data-lucide="map-pin"></i>
                                <div>
                                    <strong>Address</strong>
                                    <span>Colombo, Sri Lanka</span>
                                </div>
                            </div>
                            <div class="contact-method">
                                <i data-lucide="clock"></i>
                                <div>
                                    <strong>Support Hours</strong>
                                    <span>Mon-Fri, 9:00 AM – 5:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOOTER NOTE -->
                <div class="privacy-footer-note">
                    <p>Your trust is our priority. We are committed to protecting your privacy and being transparent about our data practices.</p>
                    <div class="signature-line">
                        <span>— LovPet Privacy Team 🐾</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== FOOTER ===== -->
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
                    <p class="footer-description">
                        Sri Lanka's most trusted pet platform. Connecting loving pets with caring families since 2020.
                    </p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/yourprofile" target="_blank" aria-label="Instagram">
                            <i data-lucide="instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
                            <i data-lucide="facebook"></i>
                        </a>
                        <a href="#" aria-label="Twitter">
                            <i data-lucide="twitter"></i>
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
                        <li><a href="privacy.php" class="active">Privacy Policy</a></li>
                        <li><a href="cart.php">Cart</a></li>
                        <li><a href="login.php">Sign Up</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h4>Contact Us</h4>
                    <ul class="contact-list">
                        <li><i data-lucide="mail"></i><span>lovpet123@gmail.com</span></li>
                        <li><i data-lucide="phone"></i><span>071-4577814</span></li>
                        <li><i data-lucide="map-pin"></i><span>Colombo, Sri Lanka</span></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();

        // Mobile Menu Toggle
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const navMenu = document.querySelector('.nav-menu');
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
                this.classList.toggle('active');
            });
        }

        // Smooth scroll for TOC links
        document.querySelectorAll('.toc-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Active section highlighting (scroll spy)
        const sections = document.querySelectorAll('.category-card');
        const tocLinks = document.querySelectorAll('.toc-links a');

        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.clientHeight;
                if (pageYOffset >= sectionTop) {
                    current = section.getAttribute('id');
                }
            });

            tocLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>