<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include 'include/head.php'; ?>
    <?php include 'include/header.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>

    <main id="home">
        <!-- Hero Section  -->
        <section  class="hero">
            <video autoplay muted loop playsinline>
                <source src="assets/videos/video home.mp4" type="video/mp4">
            </video>

            <div class="overlay" aria-hidden="true"></div>

            <div class="content">
                <h1>Explore Timeless Egypt</h1>
                    <p>
                        Discover ancient wonders and breathtaking landmarks.<br>
                        Plan your unforgettable journey with absolute ease.
                    </p>
                            <div class="butt">
                    <button type="button" class="butt1">Explore</button>
                    <button type="button" class="butt2">Plan Trip</button>
                </div>
            </div>
        </section>

        <!-- Top Destinations Section -->
        <section id="explore" class="top-destinations w-100">
            <div class="container-fluid px-0">

                <!-- Section Header with Gradient Style -->

                        <header class="text-center mb-5 position-relative container">
                            <span class="section-subtitle text-uppercase fw-bold">Top Destinations</span>
                            <h2 class="section-title fw-bold display-5">EXPLORE THE WONDERS OF EGYPT</h2>
                            <div class="header-divider d-flex align-items-center justify-content-center mt-3">
                                <span class="line gradient-line"></span>
                                    <i class="fa-solid fa-ankh mx-3 gradient-icon"></i>
                                <span class="line gradient-line"></span>
                            </div>
                        </header>

                <!-- Destinations Slider Container -->
                <div class="position-relative px-md-5">
                    
                    <!-- Left Arrow Button -->
                    <button type="button" class="slider-arrow prev-btn shadow" aria-label="Previous Destination">
                        <i class="ri-arrow-left-s-line" aria-hidden="true"></i>
                    </button>

                    <!-- Cards Track / Row -->
                    <div class="destinations-track-wrapper overflow-hidden px-3 py-4">
                        <div class="d-flex destinations-track">
                            
                            <!-- Card 1 -->
                            <article class="destination-item flex-shrink-0">
                                <div class="destination-card rounded-4 overflow-hidden position-relative shadow-lg">
                                    <div class="card-bg" style="background-image: url('assets/images/giza-home.webp');"></div>
                                    <div class="card-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-between p-4">
                                        <div class="icon-box align-self-end text-warning bg-white bg-opacity-75 p-2 rounded-circle shadow-sm">
                                            <i class="ri-landscape-line fs-5" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="text-white fs-4 fw-bold mb-2">GIZA PYRAMIDS</h3>
                                            <p class="text-light small mb-3 opacity-90">The Last Wonder of the Ancient World standing tall through millennia.</p>
                                            <a href="pages/landmarks.php" class="text-warning text-decoration-none fw-bold small explore-link">
                                                landmarks <i class="ri-arrow-right-line ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 2 -->
                            <article class="destination-item flex-shrink-0">
                                <div class="destination-card rounded-4 overflow-hidden position-relative shadow-lg">
                                    <div class="card-bg" style="background-image: url('assets/images/luxor-home.jpg');"></div>
                                    <div class="card-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-between p-4">
                                        <div class="icon-box align-self-end text-warning bg-white bg-opacity-75 p-2 rounded-circle shadow-sm">
                                            <i class="ri-bank-line fs-5" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="text-white fs-4 fw-bold mb-2">LUXOR TEMPLE</h3>
                                            <p class="text-light small mb-3 opacity-90">The World's Greatest Open Air Museum in the heart of ancient Thebes.</p>
                                            <a href="pages/landmarks.php" class="text-warning text-decoration-none fw-bold small explore-link">
                                                landmarks <i class="ri-arrow-right-line ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 3 -->
                            <article class="destination-item flex-shrink-0">
                                <div class="destination-card rounded-4 overflow-hidden position-relative shadow-lg">
                                    <div class="card-bg" style="background-image: url('assets/images/simbel-home.jpeg');"></div>
                                    <div class="card-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-between p-4">
                                        <div class="icon-box align-self-end text-warning bg-white bg-opacity-75 p-2 rounded-circle shadow-sm">
                                            <i class="ri-community-line fs-5" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="text-white fs-4 fw-bold mb-2">ABU SIMBEL</h3>
                                            <p class="text-light small mb-3 opacity-90">A Masterpiece Carved in the Mountain honoring Ramses the Great.</p>
                                            <a href="pages/landmarks.php" class="text-warning text-decoration-none fw-bold small explore-link">
                                                landmarks <i class="ri-arrow-right-line ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 4 -->
                            <article class="destination-item flex-shrink-0">
                                <div class="destination-card rounded-4 overflow-hidden position-relative shadow-lg">
                                    <div class="card-bg" style="background-image: url('assets/images/Alexandria-home.jpg');"></div>
                                    <div class="card-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-between p-4">
                                        <div class="icon-box align-self-end text-warning bg-white bg-opacity-75 p-2 rounded-circle shadow-sm">
                                            <i class="ri-water-flash-line fs-5" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="text-white fs-4 fw-bold mb-2">ALEXANDRIA</h3>
                                            <p class="text-light small mb-3 opacity-90">The Bride of the Mediterranean where ancient history meets coastal beauty.</p>
                                            <a href="pages/landmarks.php" class="text-warning text-decoration-none fw-bold small explore-link">
                                                landmarks <i class="ri-arrow-right-line ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            <!-- Card 5 -->
                            <article class="destination-item flex-shrink-0">
                                <div class="destination-card rounded-4 overflow-hidden position-relative shadow-lg">
                                    <div class="card-bg" style="background-image: url('assets/images/Redsea-home.webp');"></div>
                                    <div class="card-overlay position-absolute w-100 h-100 d-flex flex-column justify-content-between p-4">
                                        <div class="icon-box align-self-end text-warning bg-white bg-opacity-75 p-2 rounded-circle shadow-sm">
                                            <i class="ri-sun-line fs-5" aria-hidden="true"></i>
                                        </div>
                                        <div class="card-content">
                                            <h3 class="text-white fs-4 fw-bold mb-2">RED SEA</h3>
                                            <p class="text-light small mb-3 opacity-90">Crystal clear waters, vibrant coral reefs, and magical moments.</p>
                                            <a href="pages/landmarks.php" class="text-warning text-decoration-none fw-bold small explore-link">
                                                landmarks <i class="ri-arrow-right-line ms-1" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </article>

                        </div>
                    </div>

                    <!-- Right Arrow Button -->
                    <button type="button" class="slider-arrow next-btn shadow" aria-label="Next Destination">
                        <i class="ri-arrow-right-s-line" aria-hidden="true"></i>
                    </button>

                </div>

                <!-- Slider Dots -->
                <div class="slider-dots d-flex justify-content-center align-items-center gap-2 mt-4">
                </div>

            </div>
        </section>

<!-- --- Pharaonic Marquee Ticker --- -->
<section class="pharaoh-ticker-section">
    <div class="ticker-track" id="tickerTrack">

        <div class="ticker-item">
            <i class="fa-solid fa-landmark"></i>
            ANCIENT EGYPT
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-mountain"></i>
            PYRAMIDS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-torii-gate"></i>
            TEMPLES
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-crown"></i>
            PHARAOHS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-water"></i>
            THE NILE
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-sun"></i>
            ETERNAL SUN
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-eye"></i>
            ANCIENT MYSTERIES
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-cat"></i>
            SACRED CATS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-dove"></i>
            EGYPTIAN SYMBOLS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-ship"></i>
            NILE JOURNEY
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-compass"></i>
            EXPLORE EGYPT
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-map-location-dot"></i>
            DISCOVER HISTORY
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-monument"></i>
            ANCIENT MONUMENTS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-gem"></i>
            GOLDEN TREASURES
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-scroll"></i>
            ANCIENT STORIES
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-feather"></i>
            EGYPTIAN CULTURE
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-sun-plant-wilt"></i>
            DESERT WONDERS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-location-dot"></i>
            LAND OF PHARAOHS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-star"></i>
            ETERNAL WONDERS
        </div>

        <div class="ticker-item">
            <i class="fa-solid fa-ankh"></i>
            EGYPTIAN HERITAGE
        </div>

    </div>
</section>

<!------------------------------------------------------------------ -->
      <!-- --- Did You Know? Section --- -->
       <section id="did-you-know" class="did-you-know-section">
            <div class="container">

                <header class="text-center mb-5 position-relative text-header2">
                    <span class="section-subtitle text-uppercase fw-bold">DID YOU KNOW?</span>
                    <h2 class="section-title fw-bold display-5">FASCINATING SECRETS OF EGYPT</h2>
                    <div class="header-divider d-flex align-items-center justify-content-center mt-3">
                        <span class="line gradient-line"></span>
                        <i class="fa-solid fa-ankh mx-3 gradient-icon"></i>
                        <span class="line gradient-line"></span>
                        </div>
                    </header>

                <div class="fact-card-container">

                    <div class="side-icon-wrapper">
                        <div class="circle-icon" id="side-icon">
                            <i class="ri-ancient-gate-line"></i>
                        </div>
                            <div class="icon-vertical-line"></div>
                        </div>

                    <div class="fact-text-content">
                        <div class="fact-header-area">
                            <span class="fact-subtitle">DID YOU KNOW?</span>
                            <div class="pharaoh-ornament">
                                <i class="ri-ancient-gate-line"></i>
                                </div>
                            </div>

                            <h2 id="fact-title" class="fact-title">The Great Pyramid is the only remaining Wonder of the Ancient World.</h2>
                            <p id="fact-desc" class="fact-desc">Built over 4,500 years ago, the Great Pyramid of Giza is a testament to the incredible ingenuity of ancient Egyptians.</p>

                        <button id="next-fact-btn" class="next-fact-btn">
                            <span>NEXT FACT</span>
                            <i class="ri-arrow-right-line"></i>
                            </button>
                        </div>

                    <div class="fact-image-content">
                        <svg class="wave-shape" viewBox="0 0 200 800" preserveAspectRatio="none">
                            <path d="M 150 0 C 50 200, 220 400, 50 600 C 0 660, 20 730, 0 800 L 200 800 L 200 0 Z" fill="#f5eedc"></path>
                        </svg>
                            <img id="fact-img" src="assets/images/pyramid.jpg" alt="Egypt Fact Image">
                        </div>

                </div>
            </div>
        </section>

        
    </main>

<?php 
include 'include/footer.php';
 ?>
    <!-- JavaScript -->
    <script src="assets/js/main.js"></script>

</body>
</html>