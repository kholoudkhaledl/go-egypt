<!DOCTYPE html>
<html lang="ar" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Egypt</title>

    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/landmarks.css?v=100">
</head>
<body>

<?php 
include '../include/header.php'; 
?>

<div class="layout">
    
    <aside class="sidebar">
     
        <h1 class="sidebar-title">Explore<br>Egypt</h1>

        <div class="filter-group">
            <h3>Categories</h3>
            <div class="radio-pills">
                <label class="pill-item">
                    <input type="radio" name="category" value="ALL" checked onchange="fetchDestinations()">
                    <span>All</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="category" value="Ancient Egypt" onchange="fetchDestinations()">
                    <span>Ancient Egypt</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="category" value="Islamic & Coptic" onchange="fetchDestinations()">
                    <span>Islamic & Coptic</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="category" value="Coastal & Red Sea" onchange="fetchDestinations()">
                    <span>Coastal & Red Sea</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="category" value="Oases & Desert" onchange="fetchDestinations()">
                    <span>Oases & Desert</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="category" value="Museums & Culture" onchange="fetchDestinations()">
                    <span>Museums & Culture</span>
                </label>
            </div>
        </div>

        <div class="filter-group">
            <h3>Regions</h3>
            <div class="radio-pills">
                <label class="pill-item">
                    <input type="radio" name="region" value="ALL" checked onchange="fetchDestinations()">
                    <span>All</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="region" value="Lower Egypt" onchange="fetchDestinations()">
                    <span>Cairo & Giza</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="region" value="Upper Egypt" onchange="fetchDestinations()">
                    <span>Luxor & Aswan</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="region" value="Red Sea & Sinai" onchange="fetchDestinations()">
                    <span>Sinai & Red Sea</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="region" value="Western Desert" onchange="fetchDestinations()">
                    <span>Western Desert</span>
                </label>
                <label class="pill-item">
                    <input type="radio" name="region" value="Alexandria" onchange="fetchDestinations()">
                    <span>Alexandria</span>
                </label>
            </div>
        </div>
    </aside>

    <main class="grid" id="cards-container">
     
    </main>
</div>

<!-- Divider Line -->
<div class="section-divider"></div>

<!-- Traveler Tips & Guidelines Section -->

<section class="tips-section">
    <div class="tips-container">
        
        <!-- Section Header -->
        <div class="tips-header">
            <h2 class="tips-title">Traveler Tips & Guidelines</h2>
            <p class="tips-subtitle">
                Essential information to ensure your journey through Egypt is comfortable, respectful, and unforgettable.
            </p>
        </div>

        <!-- Cards Container -->
        <div class="tips-cards-grid">
            
            <!-- Card 1: Best Time to Visit -->
            <div class="tip-card">
                <div class="tip-icon-circle icon-sun">☀️</div>
                <h3 class="tip-card-title">Best Time to Visit</h3>
                <p class="tip-card-text">
                    The most pleasant weather in Egypt is between <strong class="tip-bold">October and April</strong>, when temperatures are mild and perfect for exploring ancient monuments.
                </p>
            </div>

            <!-- Card 2: Cultural Etiquette -->
            <div class="tip-card">
                <div class="tip-icon-circle icon-people">👥</div>
                <h3 class="tip-card-title">Cultural Etiquette</h3>
                <p class="tip-card-text">
                    Egypt is a conservative country. <strong class="tip-bold">Dress modestly</strong> in public (covering shoulders and knees) and always ask for permission before taking photos.
                </p>
            </div>

            <!-- Card 3: Getting Around -->
            <div class="tip-card">
                <div class="tip-icon-circle icon-plane">✈️</div>
                <h3 class="tip-card-title">Getting Around</h3>
                <p class="tip-card-text">
                    Effortlessly navigate via <strong class="tip-bold">domestic flights</strong> or trains. For local travel, ride-sharing apps like <strong class="tip-bold">Uber and InDrive</strong> are reliable.
                </p>
            </div>

        </div>
    </div>
</section>
<?php include '../include/footer.php'; ?>
<script src="../assets/js/landmark.js"></script>
</body>
</html>