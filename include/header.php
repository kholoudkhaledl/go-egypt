<?php 
    session_start();

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<header class="header">
    <nav>
        <a href="#" class="logo">
            <div class="logo-icon">
                <i class="ri-landscape-line"></i>
            </div>
            <h2>GO EGYPT</h2>
        </a>
<?php 
$current_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="nav-links">
    <li><a href="/go-egypt/index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
    <li><a href="/go-egypt/index.php#explore">Explore</a></li>
    <li><a href="/go-egypt/pages/landmarks.php" class="<?php echo ($current_page == 'landmarks.php') ? 'active' : ''; ?>">Landmarks</a></li>
    <li><a href="/go-egypt/pages/virtual-tours.php" class="<?php echo ($current_page == 'virtual-tours.php') ? 'active' : ''; ?>">Virtual Tours</a></li>
    <li><a href="/go-egypt/pages/plan-trip.php" class="<?php echo ($current_page == 'plan-trip.php') ? 'active' : ''; ?>">Plan Trip</a></li>
    <li><a href="/go-egypt/pages/about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About</a></li>
    <li><a href="/go-egypt/pages/contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact Us</a></li>
</ul>
        <div class="buttons">
            <button onclick="location.href='/go-egypt/pages/login.php'">Login</button>
            <button>Sign Up</button>
        </div>

        <div class="menu-toggle">
            <i class="ri-menu-3-line"></i>
        </div>
    </nav>
</header>

