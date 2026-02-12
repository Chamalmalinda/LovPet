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
    <title>Frequently Asked Questions - LovPet 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="faq.css">
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
    <section class="faq-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container">
            <div class="hero-content">
                <div class="section-badge">
                    <i data-lucide="help-circle"></i>
                    <span>Got Questions? We've Got Answers</span>
                </div>
                <h1>Frequently Asked Questions</h1>
                <p>Find answers to the most common questions about adopting, shopping, and caring for your pets</p>
                
                <!-- Search Bar (Visual Only) -->
                <div class="faq-search">
                    <i data-lucide="search"></i>
                    <input type="text" placeholder="Search FAQs..." id="faqSearch" readonly>
                    <span class="search-hint">Press Enter to search</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FAQ CATEGORY TABS ===== -->
    <section class="faq-categories">
        <div class="container">
            <div class="category-tabs">
                <button class="category-tab active" data-category="all">All Questions</button>
                <button class="category-tab" data-category="adoption">Adoption</button>
                <button class="category-tab" data-category="lost">Lost & Found</button>
                <button class="category-tab" data-category="products">Products</button>
                <button class="category-tab" data-category="shipping">Shipping</button>
                <button class="category-tab" data-category="returns">Returns</button>
                <button class="category-tab" data-category="account">Account</button>
                <button class="category-tab" data-category="health">Health & Care</button>
                <button class="category-tab" data-category="support">Support</button>
            </div>
        </div>
    </section>

    <!-- ===== FAQ ACCORDION SECTION ===== -->
    <section class="faq-section">
        <div class="container">
            <div class="faq-grid">

                <!-- ===== CATEGORY: ADOPTION ===== -->
                <div class="faq-category-group" data-category="adoption">
                    <h2 class="category-title">
                        <i data-lucide="heart"></i>
                        Pet Adoption
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I adopt a pet from LovPet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Visit our <a href="find-pet.php">"Find a Pet"</a> page, browse available pets, and click on a pet you're interested in. Review their profile, then click the "Add to Cart" button. Proceed to checkout to complete the adoption process. Each shelter or rescue group that lists pets on LovPet has its own adoption policies and fees [citation:1][citation:5].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Is the pet I see on LovPet still available?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Pets shown in the "Find a Pet" section are generally available. Once adopted, they are removed from public listings automatically. However, please note that we often receive multiple applications for popular pets. If a pet has an "Adoption Pending" tag, we are still accepting applications but the pet may be on hold [citation:1][citation:5].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How long does it take to hear back after applying?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Response times vary by shelter or rescue group. Some respond within minutes, while others may take a few days or up to 10 business days. We're a volunteer-based organization and receive high volumes of applications. If you don't hear back within 10 days, please feel free to follow up with the shelter directly [citation:1][citation:5].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What are the requirements for adopting a pet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Each shelter and rescue group has its own adoption requirements. Generally, you'll need to complete an adoption application, provide references, agree to a home check (in some cases), and pay an adoption fee. Requirements may include being 21+, having a stable home environment, and demonstrating the ability to care for the pet [citation:1][citation:10].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Why is there an adoption fee?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Adoption fees help cover the cost of veterinary care, vaccinations, spaying/neutering, microchipping, food, and transportation. These fees also support other animals in the shelter who may have medical bills much higher than the adoption fee. Your fee helps the organization continue its mission of rescuing and rehoming pets [citation:1][citation:9].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I adopt a pet from another district/province?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes, out-of-district adoptions are possible but depend on the specific shelter's policies. Some shelters offer transport services for approved adopters. Currently, we facilitate transport to selected locations. Please contact the specific shelter through the pet's profile page for details about their out-of-area adoption policies [citation:1][citation:5].</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: LOST & FOUND ===== -->
                <div class="faq-category-group" data-category="lost">
                    <h2 class="category-title">
                        <i data-lucide="map-pin"></i>
                        Lost & Found Pets
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I post a lost pet notice?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Go to our <a href="display-notice.php">"Lost Pet Notices"</a> page and click the "+ Add Notice" button. Fill in your pet's name, breed, color, last seen location, date, and your contact information. Upload a clear photo to help others identify your pet. Your notice will be visible to our community immediately.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How long does a lost pet notice stay active?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Lost pet notices remain active for 30 days. You can extend the listing if your pet is still missing, or mark it as "Found" to remove the notice once your pet is reunited with you.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What should I do if I find a lost pet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>If you find a lost pet, check for ID tags and try to contact the owner directly. You can also search our Lost Pet Notices to see if anyone has reported the pet missing. If you're unable to locate the owner, you can post a "Found Pet" notice, take the pet to a local vet to scan for a microchip, or contact the nearest animal shelter.</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: PRODUCTS & ORDERS ===== -->
                <div class="faq-category-group" data-category="products">
                    <h2 class="category-title">
                        <i data-lucide="package"></i>
                        Products & Orders
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I determine the correct size for my pet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Each product page includes detailed sizing information and measurement guidelines. For best results, measure your pet accurately—neck girth for collars, chest girth for harnesses, and back length for clothing. Compare your pet's measurements with our size chart before ordering. If you need additional guidance, our customer support team is happy to help [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I make changes to my order after placing it?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>We can accommodate order changes (size, color, quantity) if the order hasn't been processed and shipped yet. Contact our customer support immediately at lovpet123@gmail.com with your order number and requested changes. We'll do our best to assist you [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I cancel my order?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes, you can cancel your order if it hasn't been shipped yet. Please email us at lovpet123@gmail.com as soon as possible with your order number and cancellation request. Once an order has been processed and shipped, we cannot cancel it, but you may return it after delivery [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What payment methods do you accept?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>We accept Visa, MasterCard, online bank transfers, and local e-wallets including eZ Cash and mCash. All payments are processed securely through our encrypted payment gateway.</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: SHIPPING & DELIVERY ===== -->
                <div class="faq-category-group" data-category="shipping">
                    <h2 class="category-title">
                        <i data-lucide="truck"></i>
                        Shipping & Delivery
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How long will it take for my order to arrive?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Delivery times vary based on your location. For Colombo and major cities, delivery takes 1–2 business days. For other areas, please allow 2–4 business days. Orders over LKR 5,000 qualify for free standard delivery. You'll receive a tracking number once your order ships [citation:3][citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do you offer international shipping?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Currently, we only ship within Sri Lanka. We do not offer international shipping at this time. If you're located outside Sri Lanka and wish to purchase our products, you may consider using package forwarding services or checking with local retailers that carry similar pet products [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What should I do if my order is delayed?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>First, check your tracking information for updates. Delays can occur due to weather conditions, customs clearance, or logistical issues. If your order is significantly delayed (beyond the estimated delivery window), please contact us at lovpet123@gmail.com and we'll investigate the matter [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I change my delivery address?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>You may be able to change your delivery address if the order hasn't been shipped yet. Please contact us immediately with your order number and corrected address. Once the order is in transit, we cannot modify the delivery address [citation:7].</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: RETURNS & REFUNDS ===== -->
                <div class="faq-category-group" data-category="returns">
                    <h2 class="category-title">
                        <i data-lucide="rotate-ccw"></i>
                        Returns & Refunds
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What is your return policy?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>We accept returns within 30 days of receiving your item. To be eligible, items must be unused, unworn, in the same condition as received, with all tags attached and in original packaging. You'll need to provide proof of purchase. Please note that certain items are non-returnable: pet food, personalized items, and gift cards [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I initiate a return?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>To initiate a return, please contact us at lovpet123@gmail.com with your order number and reason for return. Our customer service team will guide you through the return process. Please do not send items back without first requesting a return—they will not be accepted [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What if I receive a defective or wrong item?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>If you receive a defective, damaged, or incorrect item, please contact us immediately at lovpet123@gmail.com. Provide your order number, description of the issue, and photos of the damaged/incorrect item if applicable. We'll evaluate the issue and make it right—whether through replacement, refund, or other appropriate resolution [citation:7].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How long do refunds take?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Once your return is approved, we'll process your refund within 10 business days. The refund will be issued to your original payment method. Please note that your bank or credit card company may take additional time to post the refund to your account. If more than 15 business days have passed since approval and you haven't received your refund, please contact us [citation:7].</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: ACCOUNT & SECURITY ===== -->
                <div class="faq-category-group" data-category="account">
                    <h2 class="category-title">
                        <i data-lucide="user"></i>
                        Account & Security
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Do I need an account to adopt or post a pet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes, creating a free LovPet account helps us verify users and track adoption and notice details securely. Your account allows you to save favorite pets, track orders, manage your lost pet notices, and receive updates on your adoption applications.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Is my personal information safe?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Absolutely. We use SSL encryption to protect your data during transmission. We never share or sell your personal information to third parties. Your privacy is important to us—you can read our full <a href="privacy.php">Privacy Policy</a> for complete details on how we collect, use, and protect your information.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I reset my password?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Click on "Login" and select "Forgot Password." Enter your registered email address, and we'll send you a password reset link. Follow the instructions in the email to create a new password. If you don't receive the email within a few minutes, please check your spam folder.</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: HEALTH & CARE ===== -->
                <div class="faq-category-group" data-category="health">
                    <h2 class="category-title">
                        <i data-lucide="activity"></i>
                        Pet Health & Care
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Are the pets vaccinated before adoption?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Most shelter and rescue pets receive age-appropriate vaccinations before adoption. Each pet's profile includes information about their medical history, including vaccination status. If you have specific questions about a pet's health, please contact the shelter or rescue group directly through their profile page [citation:10].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>What should I do immediately after adopting a pet?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Schedule a vet visit within the first week to establish care. Pet-proof your home by removing hazards, set up a designated space with food, water, and bedding, and be patient as your new pet adjusts. Give them time to decompress and learn their new routine. Check our <a href="dog-care.php">Dog Care</a> and <a href="cat-care.php">Cat Care</a> guides for breed-specific advice.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Are your rescue pets potty trained?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Unless a pet's bio specifically states they are potty trained, you should assume they are not. Many rescue animals come from challenging circumstances and may not have been exposed to housetraining. Potty training is typically the responsibility of the adopter. We provide resources and tips to help you with this process [citation:5].</p>
                        </div>
                    </div>
                </div>

                <!-- ===== CATEGORY: SUPPORT ===== -->
                <div class="faq-category-group" data-category="support">
                    <h2 class="category-title">
                        <i data-lucide="headphones"></i>
                        Customer Support
                    </h2>
                    
                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How can I contact LovPet support?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>You can reach us via email at <strong>lovpet123@gmail.com</strong> or call <strong>071-4577814</strong>. Our support hours are Monday to Friday, 9:00 AM – 5:00 PM. We strive to respond to all inquiries within 24 hours on business days [citation:3].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>How do I report a problem with a shelter or rescue group?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>All shelters and rescue groups on LovPet undergo screening and must provide a veterinarian reference. If you have concerns about a specific organization, please contact us at lovpet123@gmail.com with the full name, city, and details of the group. We take these matters seriously and investigate all complaints [citation:1].</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            <span>Can I donate to help rescued animals?</span>
                            <i data-lucide="chevron-down" class="faq-icon"></i>
                        </button>
                        <div class="faq-answer">
                            <p>Yes! We're developing a dedicated donation portal to support shelters and rescue organizations. In the meantime, you can contact individual shelters directly through their profiles to inquire about donation needs—they often need funds, supplies, and volunteers. Your support helps save more lives!</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===== STILL HAVE QUESTIONS? ===== -->
            <div class="still-help">
                <div class="help-card">
                    <div class="help-icon">
                        <i data-lucide="message-circle"></i>
                    </div>
                    <h2>Still have questions?</h2>
                    <p>Can't find the answer you're looking for? Please reach out to our friendly support team.</p>
                    <div class="help-buttons">
                        <a href="add-feedback.php" class="btn-primary">
                            <i data-lucide="mail"></i>
                            <span>Send Message</span>
                        </a>
                        <a href="tel:0714577814" class="btn-secondary">
                            <i data-lucide="phone"></i>
                            <span>Call Us</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FOOTER (Modern LovPet Style) ===== -->
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
                        <li><a href="faq.php" class="active">FAQs</a></li>
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
                        <li>
                            <i data-lucide="map-pin"></i>
                            <span>Colombo, Sri Lanka</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2025 LovPet Care. All rights reserved | Company registration PQ 113 | Powered by eDesigners</p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu & FAQ Accordion Script -->
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

        // FAQ Accordion Functionality
        document.querySelectorAll('.faq-question').forEach(button => {
            button.addEventListener('click', () => {
                const faqItem = button.closest('.faq-item');
                const isActive = faqItem.classList.contains('active');
                
                // Close all other FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                    const icon = item.querySelector('.faq-icon');
                    if (icon) icon.setAttribute('data-lucide', 'chevron-down');
                });
                
                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                    const icon = button.querySelector('.faq-icon');
                    if (icon) icon.setAttribute('data-lucide', 'chevron-up');
                }
                
                lucide.createIcons();
            });
        });

        // Category Tab Filtering
        const categoryTabs = document.querySelectorAll('.category-tab');
        const categoryGroups = document.querySelectorAll('.faq-category-group');

        categoryTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Update active tab
                categoryTabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                
                const selectedCategory = tab.dataset.category;
                
                // Show/hide category groups
                categoryGroups.forEach(group => {
                    if (selectedCategory === 'all' || group.dataset.category === selectedCategory) {
                        group.style.display = 'block';
                    } else {
                        group.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality (visual placeholder)
        const searchInput = document.getElementById('faqSearch');
        if (searchInput) {
            searchInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    alert('🔍 Search feature coming soon! For now, please browse categories or use Ctrl+F to find specific topics.');
                }
            });
        }
    </script>
</body>
</html>