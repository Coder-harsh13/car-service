<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// Your code here
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanic On Wheel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="website icon" type="jpg" href="./web.jpg">
    <link rel="stylesheet" href="https://unpkg.com/lucide-static@0.344.0/font/lucide.css">
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <i class="lucide-wrench"></i>
                <img src="logo.png"\>
                <span>Mechanic On Wheel</span>
            </div>
            <div class="nav-links">
                <a href="#services">Services</a>
                <a href="#how-it-works">How it Works</a>
                <a href="#pricing">Pricing</a>
                <a href="#contact">Contact</a>
                <?php if (isset($_SESSION['username'])): ?>
                    <a href="profile.php" class="login-btn"><?= htmlspecialchars($_SESSION['username']) ?></a>
                <?php else: ?>
                    <a href="login.php" class="login-btn" onclick="openModal('loginModal')">Login</a>
                <?php endif; ?>


                <button class="primary-btn" onclick="openModal('emergencyModel')">Emergency Book</button>
                <a href="about.php" class="text-btn">About</a>
            </div>
            <button class="menu-btn" onclick="toggleMenu()">
                <i class="lucide-menu"></i>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero">
        <div class="hero-content">
            <h1>Expert Car Repair at Your Doorstep</h1>
            <p>Professional mechanics available 24*7. We come to you!</p>
            <div class="hero-buttons">
                <button class="primary-btn" onclick="openModal('bookingModal')">Schedule Service</button>
                <button class="secondary-btn">Learn More</button>
            </div>
            <div class="service-highlights">
                <div class="highlight-card">
                    <i class="lucide-clock"></i>
                    <h3>24*7 Service</h3>
                    <p>Available anytime</p>
                </div>
                <div class="highlight-card">
                    <i class="lucide-map-pin"></i>
                    <h3>At Your Location</h3>
                    <p>We come to you</p>
                </div>
                <div class="highlight-card">
                    <i class="lucide-shield"></i>
                    <h3>Certified Experts</h3>
                    <p>Professional mechanics</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="services">
        <h2>Our Services</h2>
        <div class="services-grid">
            <div class="service-card">
                <i class="lucide-tool"></i>
                <h3>General Repair</h3>
                <p>Complete diagnostic and repair services for all car makes and models</p>
                <button class="text-btn" onclick="openModal('bookingModal')">Book Service →</button>
            </div>
            <div class="service-card">
                <i class="lucide-battery-charging"></i>
                <h3>Battery Service</h3>
                <p>Battery testing, replacement, and jump-start services</p>
                <button class="text-btn" onclick="openModal('bookingModal')">Book Service →</button>
            </div>
            <div class="service-card">
                <i class="lucide-fuel"></i>
                <h3>Oil Change</h3>
                <p>Professional oil change and fluid maintenance services</p>
                <button class="text-btn" onclick="openModal('bookingModal')">Book Service →</button>
            </div>
            <div class="service-card">
                <i class="lucide-car"></i>
                <h3>Tire Service</h3>
                <p>Tire repair, replacement, and rotation services</p>
                <button class="text-btn" onclick="openModal('bookingModal')">Book Service →</button>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="how-it-works">
        <h2>How It Works</h2>
        <div class="steps-container">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Book Online</h3>
                <p>Schedule your service through our easy online booking system</p>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>We Come to You</h3>
                <p>Our mobile mechanic arrives at your location</p>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Get Fixed</h3>
                <p>Professional repair service right at your doorstep</p>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="pricing" class="pricing">
        <h2>Transparent Pricing</h2>
        <div class="pricing-grid">
            <div class="pricing-card">
                <h3>Basic Service</h3>
                <div class="price">1499₹</div>
                <ul>
                    <li><i class="lucide-check"></i> Oil Change</li>
                    <li><i class="lucide-check"></i> Tire Rotation</li>
                    <li><i class="lucide-check"></i> Safety Inspection</li>
                </ul>
                <button class="primary-btn" onclick="openModal('bookingModal')">Book Now</button>
            </div>
            <div class="pricing-card featured">
                <h3>Full Service</h3>
                <div class="price">2999₹</div>
                <ul>
                    <li><i class="lucide-check"></i> Everything in Basic</li>
                    <li><i class="lucide-check"></i> Brake Inspection</li>
                    <li><i class="lucide-check"></i> Battery Test</li>
                    <li><i class="lucide-check"></i> AC Check</li>
                </ul>
                <button class="primary-btn" onclick="openModal('bookingModal')">Book Now</button>
            </div>
            <div class="pricing-card">
                <h3>Premium Service</h3>
                <div class="price">4599₹</div>
                <ul>
                    <li><i class="lucide-check"></i> Everything in Full Service</li>
                    <li><i class="lucide-check"></i> Engine Diagnostic</li>
                    <li><i class="lucide-check"></i> Fluid Top-up</li>
                    <li><i class="lucide-check"></i> Filter Replacement</li>
                </ul>
                <button class="primary-btn" onclick="openModal('bookingModal')">Book Now</button>
            </div>
        </div>
    </section>

    <!-- After the pricing section -->
<section id="review-trigger" class="pricing">
    <div class="pricing-grid">
        <!-- existing pricing cards... -->
    </div>
    <div style="display: flex; justify-content:center; margin-top: 2rem;">
        <button class="primary-btn" onclick="openModal('reviewModal')">Leave a Review</button>
    </div>

</section>

<!-- Review Modal -->
<div id="reviewModal" class="modal">
    <div class="modal-content" id="reviewPopup">
        <span class="close" onclick="closeModal('reviewModal')">&times;</span>
        <h2>Submit Your Review</h2>
        <form id="reviewForm" action="save_review.php" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <select name="rating" required>
                <option value="">Rating</option>
                <option value="5">★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>
            <textarea name="review" placeholder="Your Review" required></textarea>
            <button type="submit" class="primary-btn">Submit Review</button>
        </form>
    </div>
</div>


    <!-- reviews.html -->
    <section class="reviews" id="customerReviews">
        <h2>What Our Customers Say</h2>
        <marquee behavior="alternate" direction="left" scrollamount="5">
            <div class="reviews-wrapper">
            <!-- Review 1 -->
                <div class="review-card">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Customer 1">
                    <h4>Rohan Mehta</h4>
                    <div class="stars">★★★★★</div>
                    <p>Prompt and professional service. <br>Highly recommended!</p>
                </div>
            <!-- Review 2 -->
                <div class="review-card">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Customer 2">
                    <h4>Priya Sharma</h4>
                    <div class="stars">★★★★★</div>
                    <p>The mechanic came right to my house and fixed the issue in <br>no time. Great experience!</p>
                </div>
            <!-- Review 3 -->
                <div class="review-card">
                    <img src="https://randomuser.me/api/portraits/men/23.jpg" alt="Customer 3">
                    <h4>Vikram Singh</h4>
                    <div class="stars">★★★★★</div>
                    <p>Excellent value for money. Friendly staff and quick <br>repair. Will use again!</p>
                </div>
            </div>
        </marquee>
    </section>


    <!-- Contact Section -->
    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h2>SERVE WITH US
                   <br> AND EARN MORE</h2>
                <div class="info-item">
                    <i class="lucide-phone"></i>
                    <p>+91 9208524641</p>
                </div>
                <div class="info-item">
                    <i class="lucide-mail"></i>
                    <p>mechaniconwheel@gmail.com</p>
                </div>
                <div class="info-item">
                    <i class="lucide-map-pin"></i>
                    <p>Serving all major cities</p>
                </div>
            </div>
            <form action="save_contact.php" method="POST" class="contact-form" onsubmit="handleContact(event)" name="submit-to-google-sheet-1">
                <input type="text" placeholder="Your Name" name="Name" required>
                <input type="email" placeholder="Email Address" name="Email" required>
                <textarea placeholder="Message" name="Message" required></textarea>
                <button type="submit" class="primary-btn">Send Message</button>
            </form>
        </div>
    </section>

    

    <div id="emergencyModel" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('emergencyModel')">&times;</span>
            <h2>Emergency Book</h2>
            
            <form action="save_emergency.php" method="POST" id="emergencyBookingForm" >
            <input type="text" name="Name" placeholder="Enter your Name" required>
            <input type="number" name="Mobile" placeholder="Enter your Mobile Number" required>
            <input type="text" name="CarNumber" placeholder="Car Number" required>
            <input type="email" name="Email" placeholder="Enter Email" required>

      
            <!-- Hidden inputs to capture coordinates -->
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
      
            <!-- Button to trigger sharing of live location -->
                <button type="button" id="shareLocationBtn" class="primary-btn">
                    <i class="lucide-map-pin"></i> Share My Location
                </button>
      
            <!-- Map container, styled via existing .map class -->
                <div id="emergencyMap" class="map" style="margin-top:1rem; display:none;"></div>
      
                <button type="submit" class="primary-btn">Book Now</button>
            </form>
        </div>
    </div>  
      


    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('bookingModal')">&times;</span>
            <h2>Book a Service</h2>
            <form action="save_booking.php" method="POST">
                <select name="Service" required>
                    <option value="">Select Service Type</option>
                    <option value="basic">Basic Service</option>
                    <option value="full">Full Service</option>
                    <option value="premium">Premium Service</option>
                </select>
                <input type="date" name="Date" required>
                <input type="alpha-numeric" placeholder="Enter your Car Number Plate" name="Car-Number" required>
                <textarea placeholder="Enter your Full Address" name="Details"></textarea>
                <button type="submit" class="primary-btn">Confirm Booking</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <i class="lucide-wrench"></i>
                <span>24/7 Auto Care</span>
            </div>
            <p>&copy; 2025 24/7 Auto Care. All rights reserved.</p>
        </div>
    </footer>

    <script src="script.js"></script>


</body>
</html>
