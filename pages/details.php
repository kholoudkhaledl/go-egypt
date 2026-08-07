<?php
// Include database connection configuration and global header template
include '../config/db.php';
include '../include/header.php'; 

// Retrieve landmark ID from URL parameter, default to 1 if not provided
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Fetch destination data from the database based on the ID
$sql = "SELECT * FROM destinations WHERE id = $id";
$result = $conn->query($sql);

// Check if destination exists, otherwise fallback to default placeholder data (Giza Pyramids)
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} 
else {
    $row = [
        'title' => 'Great Pyramids of Giza',
        'region' => 'Lower Egypt',
        'description' => 'The monumental ancient pyramids and the iconic Great Sphinx on the Giza plateau, one of the Seven Wonders of the Ancient World. Built as monumental tombs for the pharaohs Khufu, Khafre, and Menkaure, these engineering marvels continue to captivate visitors from around the globe with their sheer scale, mysterious construction history, and breathtaking desert backdrop. This extraordinary destination offers an unforgettable historical journey, rich cultural heritage, and stunning panoramic views that attract travelers from all over the world to explore its timeless beauty.',
        'img_url' => '../assets/images/pyramids.jpg',
        'ticket_price' => 20.00,
        'duration' => '3 Hours',
        'best_time' => 'Oct - Mar',
        'landmark_type' => 'Historical'
    ];
}

// Initial default values synced with JavaScript (3 total persons: 2 adults + 1 child, and 2 default nights)
$default_adults = 1;
$default_children = 0;
$default_total_persons = $default_adults + $default_children; // 3
$default_nights = 2;
$ticket_unit_price = isset($row['ticket_price']) ? floatval($row['ticket_price']) : 20.00;
$initial_ticket_total = $ticket_unit_price * $default_total_persons;
$initial_transport_price = 40; // Initial estimated transportation cost, will be updated via JS
$initial_guide_price = 10;     // Initial estimated tour guide cost, will be updated via JS
$initial_taxes = 12;
$initial_grand_total = $initial_ticket_total + $initial_transport_price + $initial_guide_price + $initial_taxes;
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Meta tags and page configuration -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row['title']); ?> - Explore Egypt</title>

    <!-- External stylesheets and Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/details.css">
</head>
<body>

<!-- Main page container wrapping the destination details view -->
<div class="page-container main-details">
    
    <!-- Top section containing the main banner image and basic information overview -->
    <header class="details-top-section full-width-top">
        
        <!-- Main destination image container -->
        <div class="main-image-container">
            <img src="<?php echo htmlspecialchars($row['img_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
        </div>

        <!-- Destination info, title, location, ratings, and stats -->
        <div class="details-info-container">
            
            <!-- Title and favorite button row -->
            <div class="details-title-row">
                <h1><?php echo htmlspecialchars($row['title']); ?></h1>
                <button id="favBtn" aria-label="Add to favorites">
                    <i class="ri-heart-line"></i>
                </button>
            </div>

            <!-- Meta information: location map link and user reviews -->
            <div class="details-meta">
                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($row['title'] . ' ' . $row['region']); ?>" target="_blank" rel="noopener noreferrer">
                    <i class="ri-map-pin-line" style="color: #d97706;"></i> 
                    <?php echo htmlspecialchars($row['region']); ?>
                </a>
                <span>
                    <i class="ri-star-fill" style="color: #f59e0b;"></i> 
                    <strong>4.9</strong> (230 reviews)
                </span>
            </div>

            <!-- Short description paragraph -->
            <p class="short-description" style="color: #4b5563; font-size: 14px; line-height: 1.6; margin: 15px 0;">
                <?php echo htmlspecialchars($row['description']); ?>
            </p>

            <!-- Quick statistics summary cards -->
            <section class="stats-card" aria-label="Quick statistics">
                <div class="stat-item">
                    <div class="stat-icon"><i class="ri-time-line"></i></div>
                    <div class="stat-label">Duration</div>
                    <div class="stat-value"><?php echo htmlspecialchars(isset($row['duration']) ? $row['duration'] : '3 Hours'); ?></div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon"><i class="ri-ticket-line"></i></div>
                    <div class="stat-label">Entry Ticket</div>
                    <div class="stat-value">$<span id="ticketUnitPrice"><?php echo htmlspecialchars($ticket_unit_price); ?></span></div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon"><i class="ri-calendar-line"></i></div>
                    <div class="stat-label">Best Time</div>
                    <div class="stat-value"><?php echo htmlspecialchars(isset($row['best_time']) ? $row['best_time'] : 'Oct - Mar'); ?></div>
                </div>

                <div class="stat-item">
                    <div class="stat-icon"><i class="ri-user-shared-line"></i></div>
                    <div class="stat-label">Type</div>
                    <div class="stat-value"><?php echo htmlspecialchars(isset($row['landmark_type']) ? $row['landmark_type'] : 'Historical'); ?></div>
                </div>
            </section>

        </div>

    </header>

    <!-- Main content layout containing details, photo gallery, hotels, and cost calculator -->
    <main class="main-layout">
            
        <div class="left-content">
            
            <!-- About the place description and available amenities/features -->
            <section class="about-section">
                <h3 class="section-title" style="margin-bottom: 0;">About This Place</h3>
                <div class="about-content-wrapper">
                    <p class="about-text">
                        <?php 
                            $desc = htmlspecialchars($row['description']);
                            echo $desc . " This extraordinary destination offers an unforgettable historical journey, rich cultural heritage, and stunning panoramic views that attract travelers from all over the world to explore its timeless beauty.";
                        ?>
                    </p>
                    <div class="about-features-icons">
                        <div class="feature-icon-item">
                            <i class="ri-user-star-line"></i>
                            <span>Tour Guide</span>
                        </div>
                        <div class="feature-icon-item">
                            <i class="ri-bus-line"></i>
                            <span>Transportation</span>
                        </div>
                        <div class="feature-icon-item">
                            <i class="ri-parking-line"></i>
                            <span>Parking</span>
                        </div>
                        <div class="feature-icon-item">
                            <i class="ri-camera-line"></i>
                            <span>Photography</span>
                        </div>
                        <div class="feature-icon-item">
                            <i class="ri-restaurant-line"></i>
                            <span>Restaurant Nearby</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Photo Gallery Section dynamically loaded from the database -->
            <section class="gallery-section" style="margin-top: 40px;">
                <h3 class="section-title" style="margin-bottom: 5px;">Photo Gallery</h3>
                <p style="color: #666; font-size: 13px; margin: 0 0 15px 0;">A glimpse of the landmark</p>
                
                <div class="gallery-grid">
                    <?php
                    $landmark_id = $id;
                    $query_gallery = "SELECT * FROM landmark_images WHERE landmark_id = $landmark_id";
                    $result_gallery = mysqli_query($conn, $query_gallery);

                    if ($result_gallery && mysqli_num_rows($result_gallery) > 0) {
                        while ($img_row = mysqli_fetch_assoc($result_gallery)) {
                            $img_path = isset($img_row['image_path']) ? trim($img_row['image_path']) : '';
                            
                            if (!empty($img_path)) {
                                echo '<div class="gallery-item">';
                                echo '<img src="' . htmlspecialchars($img_path) . '" alt="Landmark Gallery Image">';
                                echo '</div>';
                            }
                        }
                    } else {
                        echo '<p class="no-images-text">No images found for this landmark.</p>';
                    }
                    ?>
                </div>
            </section>

            <!-- Hotels Selection Section dynamically loaded based on the current landmark -->
            <section class="hotels-section">
                <h3 class="section-title" style="margin-bottom: 5px;">Choose Your Hotel</h3>
                <p style="color: #666; font-size: 13px; margin: 0;">Select a hotel that suits you</p>
                
                <div class="hotels-grid">
                    <?php
                    $query_hotels = "SELECT * FROM hotels WHERE landmark_id = $id";
                    $result_hotels = mysqli_query($conn, $query_hotels);

                    if ($result_hotels && mysqli_num_rows($result_hotels) > 0) {
                        while ($hotel = mysqli_fetch_assoc($result_hotels)) {
                            $hotel_img = isset($hotel['image']) ? trim($hotel['image']) : '../assets/images/default-hotel.jpg';
                            if (empty($hotel_img)) {
                                $hotel_img = '../assets/images/default-hotel.jpg';
                            }
                    ?>
                            <article class="hotel-card">
                                <div class="recommend-badge">We recommend</div>
                                <div class="hotel-img-container" style="position: relative; height: 180px; overflow: hidden;">
                                    <div class="check-badge"><i class="ri-check-line"></i></div>
                                    <img src="<?php echo htmlspecialchars($hotel_img); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" class="hotel-img" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div class="hotel-body">
                                    <h4 class="hotel-name"><?php echo htmlspecialchars($hotel['name']); ?></h4>
                                    <div class="hotel-stars">
                                        <i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i><i class="ri-star-fill"></i>
                                    </div>
                                    <ul class="hotel-features">
                                        <li><i class="ri-calendar-event-line" style="color: #d97706;"></i> Breakfast Included</li>
                                        <li><i class="ri-wifi-line" style="color: #d97706;"></i> Free WiFi</li>
                                        <li><i class="ri-swimming-pool-line" style="color: #d97706;"></i> Pool</li>
                                        <li><i class="ri-landscape-line" style="color: #d97706;"></i> Nile View</li>
                                    </ul>
                                    
                                    <div class="hotel-card-bottom">
                                        <div class="hotel-footer">
                                            <div class="hotel-price">$<?php echo htmlspecialchars($hotel['price_per_night']); ?> <span>/ Night</span></div>
                                        </div>
                                        
                                        <div style="margin-bottom: 8px;">
                                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo urlencode($hotel['name']); ?>" target="_blank" rel="noopener noreferrer" class="location-btn" style="display: inline-flex; align-items: center; gap: 5px; font-size: 13px; color: #d97706; text-decoration: none; font-weight: 500;">
                                                <i class="ri-map-pin-line"></i> View on Map
                                            </a>
                                        </div>

                                        <div>
                                            <button type="button" class="select-btn select-hotel-btn" data-name="<?php echo htmlspecialchars($hotel['name']); ?>" data-price="<?php echo htmlspecialchars($hotel['price_per_night']); ?>" style="width: 100%;">Select</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                    <?php
                        }
                    } else {
                        echo '<p>No hotels available at the moment.</p>';
                    }
                    ?>
                </div>
            </section>

            <!-- Booking Dates and Duration Selection Box (Synced with JavaScript) -->
            <section class="dates-selection-box" style="margin-top: 30px; background: #fffdf9; border: 1px solid #f3ebd8; padding: 20px; border-radius: 12px; display: flex; gap: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 500; margin-bottom: 5px; font-size: 14px;"><i class="ri-calendar-line" style="color: #d97706;"></i> Check-in Date</label>
                    <input type="date" id="checkInDate" value="2025-05-20" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div style="flex: 1;">
                    <label style="display: block; font-weight: 500; margin-bottom: 5px; font-size: 14px;"><i class="ri-calendar-line" style="color: #d97706;"></i> Check-out Date</label>
                    <input type="date" id="checkOutDate" value="2025-05-22" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div style="display: flex; align-items: flex-end;">
                    <span id="tripDaysCount" style="padding: 10px 15px; border: 1px solid #ddd; background: #f3f4f6; border-radius: 8px; font-weight: 600; color: #374151;">2 Days</span>
                </div>
            </section>

            <!-- Trip Cost Calculator Section (Adults, Children, Add-ons, and Breakdown) -->
            <section class="cost-calculator-container" style="margin-top: 30px;">
        
                <h3 class="calc-main-title">Trip Cost Calculator</h3>
                
                <div class="calc-controls-grid">
                    
                    <!-- Adults Counter Control -->
                    <div class="control-box">
                        <label><i class="ri-user-line" style="color: #d97706;font-size: 20px;"></i> Adults</label>
                        <div class="counter-wrapper">
                            <button type="button" class="count-btn" id="adultMinus">-</button>
                            <span id="adultCount"><?php echo $default_adults; ?></span>
                            <button type="button" class="count-btn" id="adultPlus">+</button>
                        </div>
                    </div>

                    <!-- Children Counter Control -->
                    <div class="control-box">
                        <label><i class="ri-user-line" style="color: #d97706;font-size: 20px;"></i> Children</label>
                        <div class="counter-wrapper">
                            <button type="button" class="count-btn" id="childMinus">-</button>
                            <span id="childCount"><?php echo $default_children; ?></span>
                            <button type="button" class="count-btn" id="childPlus">+</button>
                        </div>
                    </div>

                    <!-- Transportation Toggle Option -->
                    <div class="toggle-box" id="transToggleBox">
                        <div class="check-badge"><i class="ri-check-line"></i></div>
                        <div class="toggle-content">
                            <div class="toggle-icon"><i class="ri-car-line"></i></div>
                            <div class="toggle-info">
                                <span class="toggle-title">Transportation</span>
                                <span class="toggle-status">Not Included</span>
                            </div>
                        </div>
                        <button type="button" class="calc-select-btn">Select</button>
                    </div>

                    <!-- Tour Guide Toggle Option -->
                    <div class="toggle-box" id="guideToggleBox">
                        <div class="check-badge"><i class="ri-check-line"></i></div>
                        <div class="toggle-content">
                            <div class="toggle-icon"><i class="ri-user-star-line"></i></div>
                            <div class="toggle-info">
                                <span class="toggle-title">Tour Guide</span>
                                <span class="toggle-status">Not Included</span>
                            </div>
                        </div>
                        <button type="button" class="calc-select-btn">Select</button>
                    </div>

                </div>

                <!-- Price Breakdown Details Row -->
                <div class="calc-breakdown-row">
                    
                    <div class="breakdown-item">
                        <span class="b-title">Entry Ticket</span>
                        <span class="b-calc" id="entryCalcText">$<?php echo $ticket_unit_price; ?> × <?php echo $default_total_persons; ?></span>
                        <span class="b-price" id="entryTotalPrice">$<?php echo $initial_ticket_total; ?></span>
                    </div>

                    <div class="breakdown-item" id="transBreakdownItem" style="display: none;">
                        <span class="b-title">Transportation</span>
                        <span class="b-calc" id="transCalcText">1 Car(s) x $40</span>
                        <span class="b-price" id="transTotalPrice">$40</span>
                    </div>

                    <div class="breakdown-item" id="guideBreakdownItem" style="display: none;">
                        <span class="b-title">Tour Guide</span>
                        <span class="b-calc" id="guideCalcText">Fixed Price</span>
                        <span class="b-price" id="guideTotalPrice">$10</span>
                    </div>

                    <div class="total-result-box">
                        <span class="total-label">Total Price</span>
                        <span class="total-amount" id="grandTotalPrice">$<?php echo $initial_grand_total; ?></span>
                    </div>

                </div>

            </section>

        </div>

        <!-- Sidebar: Booking Summary Card -->
        <aside class="booking-summary-card">
            <h3 class="summary-title">Booking Summary</h3>
            
            <div class="summary-destination">
                <img src="<?php echo htmlspecialchars($row['img_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                <div>
                    <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                    <p><?php echo htmlspecialchars($row['region']); ?></p>
                </div>
            </div>

            <div class="summary-details-list">
                <div class="summary-row">
                    <span>Check-in</span>
                    <span id="summaryCheckIn"> May 2025</span>
                </div>
                <div class="summary-row">
                    <span>Check-out</span>
                    <span id="summaryCheckOut">22 May 2025</span>
                </div>
                <div class="summary-row">
                    <span>Guests</span>
                    <span id="summaryGuestsText"><?php echo $default_adults; ?> Adults, <?php echo $default_children; ?> Child</span>
                </div>
            </div>

            <div class="summary-details-list">
                <div class="summary-row" style="font-weight: 600; color: #111;">
                    <span>Selected Hotel</span>
                    <span id="summaryHotelName">None selected</span>
                </div>
                <div class="summary-row">
                    <span>Hotel (<span id="summaryNightsCount"><?php echo $default_nights; ?></span> Nights)</span>
                    <span id="summaryHotelPrice">$0</span>
                </div>
                <div class="summary-row">
                    <span>Entry Ticket (<span id="summaryTotalPersonsCount"><?php echo $default_total_persons; ?></span>)</span>
                    <span id="summaryTicketPrice">$<?php echo $initial_ticket_total; ?></span>
                </div>
                <div class="summary-row" id="summaryTransRow" style="display: none;">
                    <span>Transportation</span>
                    <span id="summaryTransPrice">$0</span>
                </div>
                <div class="summary-row" id="summaryGuideRow" style="display: none;">
                    <span>Tour Guide</span>
                    <span id="summaryGuidePrice">$0</span>
                </div>
                <div class="summary-row">
                    <span>Taxes & Fees</span>
                    <span>$12</span>
                </div>
            </div>

            <div class="summary-total">
                <span>Total</span>
                <span class="total-price" id="summaryFinalTotalPrice">$<?php echo $initial_ticket_total + 12; ?></span>
            </div>

            <div style="margin-top: 20px;">
                <button type="button" class="payment-btn" style="width: 100%;">
                    <span>Proceed to Payment</span>
                    <i class="ri-arrow-right-line"></i>
                </button>
            </div>
        </aside>

    </main>

    <!-- "Why Book With Us?" Features Section -->
    <section class="why-book-section">
        <div class="why-book-container">
            
            <div class="why-content-area">
                <h2 class="why-main-title">Why Book With Us?</h2>
                
                <div class="features-grid">
                    
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-shield-star-line"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Best Price Guarantee</h4>
                            <p>Best market prices</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-customer-service-2-line"></i>
                        </div>
                        <div class="feature-text">
                            <h4>24/7 Customer Support</h4>
                            <p>Always here to help</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-lock-password-line"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Secure Booking</h4>
                            <p>Your payment is safe with us</p>
                        </div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="ri-calendar-check-line"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Free Cancellation</h4>
                            <p>Easy and free cancellation</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Egyptian Heritage SVG Illustration Area -->
            <div class="egyptian-illustration">
                <svg viewBox="0 0 500 180" fill="none" xmlns="http://www.w3.org/2000/svg" class="heritage-svg">
                    <circle cx="410" cy="40" r="18" stroke="#d97706" stroke-width="1.5" stroke-dasharray="4 4" opacity="0.6"/>
                    <circle cx="410" cy="40" r="12" fill="#d97706" opacity="0.15"/>
                    
                    <path d="M70 140 C70 110 60 90 40 70 M70 140 C70 110 80 90 95 75 M70 140 L70 50" stroke="#b45309" stroke-width="2" stroke-linecap="round" opacity="0.7"/>
                    <path d="M40 70 C25 60 20 40 30 35 C45 45 55 65 60 75 Z" fill="#b45309" opacity="0.6"/>
                    <path d="M95 75 C110 65 120 45 110 40 C95 50 85 70 80 80 Z" fill="#b45309" opacity="0.6"/>
                    <path d="M70 50 C55 35 60 20 70 20 C80 20 85 35 70 50 Z" fill="#b45309" opacity="0.6"/>

                    <path d="M120 135 L170 135 C175 135 178 138 175 142 L125 142 C122 138 120 135 120 135 Z" fill="#b45309" opacity="0.7"/>
                    <path d="M145 135 L145 100 L165 125 Z" fill="#b45309" opacity="0.5"/>
                    <line x1="145" y1="135" x2="145" y2="90" stroke="#b45309" stroke-width="1.5"/>

                    <path d="M190 145 L220 95 L250 145 Z" stroke="#b45309" stroke-width="1.5" fill="#d97706" fill-opacity="0.08" opacity="0.7"/>
                    <path d="M220 95 L220 145" stroke="#b45309" stroke-width="1" opacity="0.4"/>

                    <path d="M230 145 L300 60 L380 145 Z" stroke="#b45309" stroke-width="1.8" fill="#d97706" fill-opacity="0.1" opacity="0.8"/>
                    <path d="M300 60 L300 145" stroke="#b45309" stroke-width="1.2" opacity="0.5"/>

                    <rect x="400" y="70" width="80" height="75" stroke="#b45309" stroke-width="1.5" fill="#d97706" fill-opacity="0.08" opacity="0.7"/>
                    <path d="M390 70 L490 70 L485 62 L395 62 Z" fill="#b45309" opacity="0.7"/>
                    <line x1="415" y1="70" x2="415" y2="145" stroke="#b45309" stroke-width="1.5" opacity="0.7"/>
                    <line x1="435" y1="70" x2="435" y2="145" stroke="#b45309" stroke-width="1.5" opacity="0.7"/>
                    <line x1="455" y1="70" x2="455" y2="145" stroke="#b45309" stroke-width="1.5" opacity="0.7"/>
                    <line x1="475" y1="70" x2="475" y2="145" stroke="#b45309" stroke-width="1.5" opacity="0.7"/>

                    <path d="M0 152 C50 148 100 156 150 152 C200 148 250 156 300 152 C350 148 400 156 450 152 C475 150 490 152 500 152" stroke="#b45309" stroke-width="1" opacity="0.4"/>
                </svg>
            </div>

        </div>
    </section>
</div>

<?php 
// Close active database connection safely if initialized
if (isset($conn)) {
    $conn->close();
}
?>
<!-- Include global footer template -->
<?php include '../include/footer.php'; ?>

<!-- Page-specific JavaScript interaction file -->
<script src="../assets/js/details.js"></script>

</body>
</html>