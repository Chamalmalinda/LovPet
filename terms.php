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
    <title>Terms of Service - LovPet 🐾</title>
    
    <!-- Google Fonts & Lucide Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="terms.css">
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
    <section class="terms-hero">
        <div class="hero-decoration hero-decoration-1"></div>
        <div class="hero-decoration hero-decoration-2"></div>
        <div class="container">
            <div class="hero-content">
                <div class="section-badge">
                    <i data-lucide="scale"></i>
                    <span>Legal & Compliance</span>
                </div>
                <h1>Terms of Service</h1>
                <p>Last updated: February 12, 2026</p>
                <div class="hero-meta">
                    <span><i data-lucide="clock"></i> Effective immediately</span>
                    <span><i data-lucide="globe"></i> Applicable to all LovPet users</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FIXED TABLE OF CONTENTS (VERTICALLY CENTERED) ===== -->
    <div class="toc-container">
        <div class="toc-card">
            <h4><i data-lucide="list"></i> Contents</h4>
            <ul class="toc-links">
                <li><a href="#acceptance">1. Acceptance of Terms</a></li>
                <li><a href="#eligibility">2. Eligibility</a></li>
                <li><a href="#accounts">3. Accounts & Security</a></li>
                <li><a href="#adoption">4. Pet Adoption</a></li>
                <li><a href="#seller">5. Seller Terms & Commission</a></li>
                <li><a href="#products">6. Product Purchases</a></li>
                <li><a href="#returns">7. Returns & Refunds</a></li>
                <li><a href="#lost">8. Lost & Found Notices</a></li>
                <li><a href="#conduct">9. User Conduct</a></li>
                <li><a href="#prohibited">10. Prohibited Activities</a></li>
                <li><a href="#ip">11. Intellectual Property</a></li>
                <li><a href="#payments">12. Payments & Pricing</a></li>
                <li><a href="#disclaimers">13. Disclaimers</a></li>
                <li><a href="#liability">14. Limitation of Liability</a></li>
                <li><a href="#termination">15. Termination</a></li>
                <li><a href="#governing">16. Governing Law</a></li>
                <li><a href="#changes">17. Changes to Terms</a></li>
                <li><a href="#contact">18. Contact Us</a></li>
            </ul>
        </div>
    </div>

    <!-- ===== TERMS CONTENT SECTION ===== -->
    <section class="terms-section">
        <div class="container">
            <div class="terms-card">

                <!-- INTRO -->
                <div class="terms-intro">
                    <p class="lead">Welcome to <strong>LovPet</strong>. By accessing or using our website, mobile applications, and services (collectively, the <strong>"Platform"</strong>), you agree to be bound by these Terms of Service and our <a href="privacy.php">Privacy Policy</a>.</p>
                    <p class="lead">Please read these terms carefully. If you do not agree, you must immediately stop using our Platform.</p>
                </div>

                <!-- 1. ACCEPTANCE OF TERMS -->
                <div id="acceptance" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">1</span>
                        <h2>Acceptance of Terms</h2>
                    </div>
                    <div class="block-content">
                        <p>By creating an account, placing an order, posting a listing, or otherwise accessing or using the LovPet Platform, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service, our Privacy Policy, and any additional terms that may apply to specific services (e.g., seller commissions, subscription programs).</p>
                        <p>These Terms constitute a legally binding agreement between you and LovPet Care (PVT) Ltd. Your continued use of the Platform following any amendments constitutes your acceptance of the revised Terms.</p>
                    </div>
                </div>

                <!-- 2. ELIGIBILITY -->
                <div id="eligibility" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">2</span>
                        <h2>Eligibility</h2>
                    </div>
                    <div class="block-content">
                        <p>You must be at least <strong>18 years of age</strong> to use LovPet or create an account. If you are between 13 and 17 years of age, you may only use the Platform under the direct supervision of a parent or legal guardian who agrees to be bound by these Terms.</p>
                        <p>By using LovPet, you represent and warrant that:</p>
                        <ul class="terms-list">
                            <li>You have the legal capacity to enter into a binding agreement;</li>
                            <li>All information you provide is truthful, accurate, and complete;</li>
                            <li>You will maintain and promptly update your information as necessary;</li>
                            <li>You are not located in a country subject to trade sanctions or embargoes.</li>
                        </ul>
                    </div>
                </div>

                <!-- 3. ACCOUNTS & SECURITY -->
                <div id="accounts" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">3</span>
                        <h2>Accounts & Security</h2>
                    </div>
                    <div class="block-content">
                        <p>To access certain features, you must register for a LovPet account. You are solely responsible for maintaining the confidentiality of your login credentials and for all activities that occur under your account.</p>
                        <p>You agree to:</p>
                        <ul class="terms-list">
                            <li>Notify us immediately at <strong>lovpet123@gmail.com</strong> of any unauthorized use of your account or any other security breach;</li>
                            <li>Ensure that you log out of your account at the end of each session;</li>
                            <li>Not share your password, impersonate another user, or allow any third party to access your account.</li>
                        </ul>
                        <p>LovPet reserves the right to suspend or terminate your account if we reasonably believe that your account has been compromised or is being used in violation of these Terms.</p>
                    </div>
                </div>

                <!-- 4. PET ADOPTION -->
                <div id="adoption" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">4</span>
                        <h2>Pet Adoption</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet provides a platform connecting prospective adopters with verified sellers and rescue organizations. <strong>We are not a party to any adoption agreement</strong>; the legal contract is solely between the adopter and the seller/rescue group.</p>
                        
                        <h3>4.1 Adoption Process</h3>
                        <ul class="terms-list">
                            <li>All adoption applications are reviewed by the respective seller or shelter;</li>
                            <li>Approval times vary; LovPet cannot guarantee a specific response timeline;</li>
                            <li>Adoption fees are set by the seller and may include costs for vaccinations, microchipping, spaying/neutering, and transportation.</li>
                        </ul>

                        <h3>4.2 Pet Availability</h3>
                        <p>Pets listed on the Platform are generally available, but we cannot guarantee that a pet has not been adopted or placed on hold. If a pet becomes unavailable after you have initiated an adoption request, your sole remedy is a full refund of any fees paid.</p>

                        <h3>4.3 Health & Veterinary Care</h3>
                        <p>Sellers are required to disclose known health conditions. However, LovPet does not independently verify health claims. Adopters are strongly encouraged to:</p>
                        <ul class="terms-list">
                            <li>Schedule a veterinary visit within 7 days of adoption;</li>
                            <li>Review all medical records provided by the seller;</li>
                            <li>Ask questions about the pet's history, temperament, and special needs.</li>
                        </ul>

                        <div class="alert-box">
                            <i data-lucide="alert-triangle"></i>
                            <span><strong>Live Animal Return Policy:</strong> Live animals (dogs, cats, birds, fish, small pets) may be returned within <strong>30 days of purchase</strong> for a full refund, provided the animal is in good health and returned with all original documentation. Saltwater aquatic life are final sale.</span>
                        </div>
                    </div>
                </div>

                <!-- 5. SELLER TERMS & COMMISSION -->
                <div id="seller" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">5</span>
                        <h2>Seller Terms & Commission</h2>
                    </div>
                    <div class="block-content">
                        <p>By listing a pet or product for sale on LovPet, you agree to:</p>
                        <ul class="terms-list">
                            <li>Provide accurate, complete, and current information about the pet or product;</li>
                            <li>Respond promptly to adoption or purchase inquiries;</li>
                            <li>Honor all commitments made to buyers, including price, health guarantees, and delivery arrangements;</li>
                            <li>Pay a <strong>20% commission fee</strong> on the total sale price of each pet successfully adopted through the Platform;</li>
                            <li>Pay applicable commission fees on product sales as specified in your seller agreement.</li>
                        </ul>
                        <p>LovPet reserves the right to withhold commission payments, suspend listings, or terminate seller accounts for fraudulent activity, misrepresentation, or violation of these Terms.</p>
                    </div>
                </div>

                <!-- 6. PRODUCT PURCHASES -->
                <div id="products" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">6</span>
                        <h2>Product Purchases</h2>
                    </div>
                    <div class="block-content">
                        <h3>6.1 Order Acceptance</h3>
                        <p>Your receipt of an order confirmation does not constitute our acceptance of your order. LovPet reserves the right to:</p>
                        <ul class="terms-list">
                            <li>Limit order quantities;</li>
                            <li>Refuse service to any customer;</li>
                            <li>Correct pricing errors, inaccuracies, or omissions (even after an order has been submitted).</li>
                        </ul>

                        <h3>6.2 Risk of Loss</h3>
                        <p>All items purchased are made pursuant to a shipment contract. The risk of loss and title for such items pass to you upon our delivery to the carrier.</p>

                        <h3>6.3 Product Descriptions</h3>
                        <p>We strive for accuracy, but we do not warrant that product descriptions, images, or other content are error-free, complete, or current. If a product is not as described, your sole remedy is to return it in accordance with our Return Policy.</p>

                        <h3>6.4 Prescription Medications</h3>
                        <p>Due to health and safety regulations, prescription medications are <strong>final sale and non-returnable</strong>.</p>
                    </div>
                </div>

                <!-- 7. RETURNS & REFUNDS -->
                <div id="returns" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">7</span>
                        <h2>Returns & Refunds</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet's Return Policy is designed to be fair and transparent. The following terms apply to all product purchases:</p>

                        <div class="table-wrapper">
                            <table class="policy-table">
                                <thead>
                                    <tr>
                                        <th>Return Window</th>
                                        <th>Condition</th>
                                        <th>Refund Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>0-30 days</strong></td>
                                        <td>Unused, unopened, original packaging</td>
                                        <td>Full refund to original payment method</td>
                                    </tr>
                                    <tr>
                                        <td><strong>31-60 days</strong></td>
                                        <td>Unused, unopened, original packaging</td>
                                        <td>Store credit / Gift card</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Opened pet food</strong></td>
                                        <td>Palatability issue (within 30 days)</td>
                                        <td>Full refund with proof of purchase</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Faulty/Defective</strong></td>
                                        <td>Manufacturing defect (any time)</td>
                                        <td>Repair, replacement, or refund</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h3>7.1 Non-Returnable Items</h3>
                        <ul class="terms-list">
                            <li>Prescription medications;</li>
                            <li>Saltwater aquatic life;</li>
                            <li>Gift cards;</li>
                            <li>Customized or personalized items;</li>
                            <li>Products damaged due to customer misuse.</li>
                        </ul>

                        <h3>7.2 How to Initiate a Return</h3>
                        <p>To initiate a return, please contact us at <strong>lovpet123@gmail.com</strong> with your order number and reason for return. Do not send items back without prior authorization.</p>

                        <div class="alert-box alert-success">
                            <i data-lucide="check-circle"></i>
                            <span><strong>Palatability Guarantee:</strong> If your pet refuses their food within 30 days of purchase, we will refund the full purchase price. Please provide photos of the batch/expiry date and the food inside the bag.</span>
                        </div>
                    </div>
                </div>

                <!-- 8. LOST & FOUND NOTICES -->
                <div id="lost" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">8</span>
                        <h2>Lost & Found Notices</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet provides a community bulletin board for lost and found pets. By posting a notice, you confirm that:</p>
                        <ul class="terms-list">
                            <li>You are the legal owner of the lost pet or have obtained explicit permission to post on behalf of the owner;</li>
                            <li>All information provided is accurate and truthful;</li>
                            <li>You will promptly remove or update the notice once the pet is reunited with its family.</li>
                        </ul>
                        <p>LovPet reserves the right to remove any notice that is fraudulent, misleading, or violates these Terms.</p>
                    </div>
                </div>

                <!-- 9. USER CONDUCT -->
                <div id="conduct" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">9</span>
                        <h2>User Conduct</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet is committed to fostering a respectful, safe, and supportive community. You agree not to:</p>
                        <ul class="terms-list">
                            <li>Harass, abuse, threaten, stalk, or intimidate any user, seller, or LovPet staff member;</li>
                            <li>Post or transmit any content that is defamatory, obscene, hateful, discriminatory, or otherwise objectionable;</li>
                            <li>Impersonate any person or entity, or falsely state or misrepresent your affiliation with LovPet;</li>
                            <li>Upload or transmit viruses, malware, or other harmful code;</li>
                            <li>Attempt to gain unauthorized access to other users' accounts or LovPet's systems;</li>
                            <li>Use the Platform for any illegal purpose or in violation of applicable laws and regulations.</li>
                        </ul>
                        <p>Violations of these conduct standards may result in immediate account suspension or permanent termination.</p>
                    </div>
                </div>

                <!-- 10. PROHIBITED ACTIVITIES -->
                <div id="prohibited" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">10</span>
                        <h2>Prohibited Activities</h2>
                    </div>
                    <div class="block-content">
                        <p>The following activities are strictly prohibited on the LovPet Platform:</p>
                        <ul class="terms-list">
                            <li><strong>Animal cruelty:</strong> Listing or selling animals from puppy mills, illegal breeders, or any source that engages in animal abuse or neglect;</li>
                            <li><strong>Endangered species:</strong> Offering exotic or endangered animals in violation of CITES or Sri Lankan wildlife laws;</li>
                            <li><strong>Fraudulent listings:</strong> Posting fake pets, counterfeit products, or deceptive advertisements;</li>
                            <li><strong>Commission avoidance:</strong> Attempting to finalize transactions outside the LovPet platform to avoid fees;</li>
                            <li><strong>Reselling:</strong> Purchasing pets for commercial resale without explicit authorization;</li>
                            <li><strong>Spam:</strong> Unsolicited advertising, promotional materials, or repetitive content.</li>
                        </ul>
                    </div>
                </div>

                <!-- 11. INTELLECTUAL PROPERTY -->
                <div id="ip" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">11</span>
                        <h2>Intellectual Property</h2>
                    </div>
                    <div class="block-content">
                        <p>All content on the LovPet Platform – including logos, text, graphics, images, software, and the overall "look and feel" – is the exclusive property of LovPet Care (PVT) Ltd and is protected by Sri Lankan and international copyright, trademark, and intellectual property laws.</p>
                        
                        <h3>11.1 Limited License</h3>
                        <p>LovPet grants you a limited, non-exclusive, non-transferable, revocable license to access and use the Platform for personal, non-commercial purposes. You may not:</p>
                        <ul class="terms-list">
                            <li>Copy, reproduce, modify, distribute, or create derivative works of any Platform content;</li>
                            <li>Use our trademarks, logos, or brand features without our prior written consent;</li>
                            <li>Frame or mirror any part of the Platform;</li>
                            <li>Reverse engineer, decompile, or disassemble any software used in the Platform.</li>
                        </ul>

                        <h3>11.2 User-Generated Content</h3>
                        <p>By posting reviews, photos, comments, or other content on LovPet, you grant us a non-exclusive, worldwide, royalty-free, perpetual license to use, reproduce, modify, publish, and distribute such content in connection with the Platform and our marketing efforts. You represent that you own or have the necessary rights to grant this license.</p>
                    </div>
                </div>

                <!-- 12. PAYMENTS & PRICING -->
                <div id="payments" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">12</span>
                        <h2>Payments & Pricing</h2>
                    </div>
                    <div class="block-content">
                        <h3>12.1 Payment Methods</h3>
                        <p>We accept Visa, MasterCard, online bank transfers, and local e-wallets (eZ Cash, mCash). All payments are processed securely through our third-party payment gateway. By providing payment information, you represent that you are authorized to use the designated payment method.</p>

                        <h3>12.2 Pricing</h3>
                        <p>All prices are displayed in <strong>Sri Lankan Rupees (LKR)</strong> and are inclusive of applicable taxes unless otherwise stated. LovPet reserves the right to modify prices at any time without prior notice; however, changes will not affect orders already accepted.</p>

                        <h3>12.3 Seller Commission</h3>
                        <p>Sellers agree to pay LovPet a <strong>20% commission</strong> on the final sale price of each pet successfully adopted. Commission is calculated on the total amount paid by the buyer, excluding any separately stated delivery charges. Commission fees are non-refundable except in cases of fraudulent transactions.</p>
                    </div>
                </div>

                <!-- 13. DISCLAIMERS -->
                <div id="disclaimers" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">13</span>
                        <h2>Disclaimer of Warranties</h2>
                    </div>
                    <div class="block-content">
                        <p><strong>Your use of the LovPet platform is at your sole risk.</strong> The platform and all content, products, and services provided through it are provided on an "as is" and "as available" basis, without warranties of any kind, either express or implied.</p>
                        <p><strong>To the fullest extent permitted by law, LovPet disclaims all warranties, express or implied, including but not limited to:</strong></p>
                        <ul class="terms-list">
                            <li>Implied warranties of merchantability, fitness for a particular purpose, and non-infringement;</li>
                            <li>Warranties that the Platform will be uninterrupted, error-free, secure, or free from viruses or other harmful components;</li>
                            <li>Warranties regarding the accuracy, reliability, or completeness of any content or user-generated information.</li>
                        </ul>
                    </div>
                </div>

                <!-- 14. LIMITATION OF LIABILITY -->
                <div id="liability" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">14</span>
                        <h2>Limitation of Liability</h2>
                    </div>
                    <div class="block-content">
                        <p><strong>To the maximum extent permitted by law, LovPet shall not be liable for any indirect, incidental, special, consequential, or punitive damages, or any loss of profits or revenues, whether incurred directly or indirectly, or any loss of data, use, goodwill, or other intangible losses, resulting from:</strong></p>
                        <ul class="terms-list">
                            <li>Your use or inability to use the Platform;</li>
                            <li>Any conduct or content of any third party on the Platform;</li>
                            <li>Any goods or services obtained through the Platform;</li>
                            <li>Unauthorized access, use, or alteration of your transmissions or content.</li>
                        </ul>
                        <p><strong>In no event shall LovPet's aggregate liability exceed the greater of (a) the amount you paid to LovPet in the six (6) months preceding the claim, or (b) LKR 10,000.</strong></p>
                    </div>
                </div>

                <!-- 15. TERMINATION -->
                <div id="termination" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">15</span>
                        <h2>Termination</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet reserves the right, in its sole discretion, to terminate your account, suspend your access, or remove any content you have posted, without prior notice, for any reason, including but not limited to:</p>
                        <ul class="terms-list">
                            <li>Violation of these Terms of Service;</li>
                            <li>Fraudulent, abusive, or illegal activity;</li>
                            <li>Requests by law enforcement or government agencies;</li>
                            <li>Extended periods of inactivity;</li>
                            <li>Technical or security issues.</li>
                        </ul>
                        <p>If your account is terminated for a reason other than a violation of these Terms, you will receive a prorated refund of any prepaid fees. If terminated for cause, all fees paid are forfeited.</p>
                    </div>
                </div>

                <!-- 16. GOVERNING LAW -->
                <div id="governing" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">16</span>
                        <h2>Governing Law & Dispute Resolution</h2>
                    </div>
                    <div class="block-content">
                        <p>These Terms shall be governed by and construed in accordance with the laws of the <strong>Democratic Socialist Republic of Sri Lanka</strong>, without regard to its conflict of law provisions.</p>
                        
                        <h3>16.1 Informal Resolution</h3>
                        <p>Before filing any claim, you agree to attempt to resolve any dispute informally by contacting us at <strong>lovpet123@gmail.com</strong>. We will attempt to resolve the dispute within 30 days.</p>

                        <h3>16.2 Arbitration</h3>
                        <p>Any dispute arising out of or relating to these Terms or your use of the Platform that cannot be resolved informally shall be resolved by binding arbitration administered by the <strong>Institute for the Development of Commercial Law and Practice (ICLP)</strong> in Colombo, Sri Lanka. The arbitration shall be conducted in English, and judgment on the arbitral award may be entered in any court having jurisdiction thereof.</p>

                        <p><strong>You and LovPet agree that any dispute resolution proceedings will be conducted only on an individual basis and not in a class, consolidated, or representative action.</strong></p>
                    </div>
                </div>

                <!-- 17. CHANGES TO TERMS -->
                <div id="changes" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">17</span>
                        <h2>Changes to These Terms</h2>
                    </div>
                    <div class="block-content">
                        <p>LovPet reserves the right to modify or replace these Terms at any time. If we make material changes, we will provide notice through the Platform (e.g., a prominent notice on our website) or via email. Your continued use of the Platform after such notice constitutes your acceptance of the revised Terms.</p>
                        <p>The "Last Updated" date at the top of this page indicates when these Terms were last revised. It is your responsibility to review these Terms periodically.</p>
                    </div>
                </div>

                <!-- 18. CONTACT US -->
                <div id="contact" class="terms-block">
                    <div class="block-header">
                        <span class="block-number">18</span>
                        <h2>Contact Us</h2>
                    </div>
                    <div class="block-content">
                        <p>If you have any questions, concerns, or requests regarding these Terms of Service, please contact us:</p>

                        <div class="contact-grid">
                            <div class="contact-method">
                                <i data-lucide="mail"></i>
                                <div>
                                    <strong>Email</strong>
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
                <div class="terms-footer-note">
                    <p>By using LovPet, you acknowledge that you have read, understood, and agree to be bound by these Terms of Service.</p>
                    <div class="signature-line">
                        <span>— LovPet Care Team 🐾</span>
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
                        <li><a href="faq.php">FAQs</a></li>
                        <li><a href="terms.php" class="active">Terms of Service</a></li>
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

    <!-- Mobile Menu & Smooth Scroll Script -->
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

        // Smooth scroll for Table of Contents links
        document.querySelectorAll('.toc-links a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    targetElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Highlight active section in TOC
        const sections = document.querySelectorAll('.terms-block');
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