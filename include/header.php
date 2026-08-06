<!-- Navbar -->
<header class="header">
    <nav>
        <a href="#" class="logo">
            <div class="logo-icon">
                <!-- <i class="ri-ancient-gate-line"></i> -->
                <!-- <i class="fas fa-ankh"></i> -->
                <!-- <i class="fas fa-landmark"></i> -->
                <!-- <i class="fas fa-mountain"></i> -->
                 <i class="ri-landscape-line"></i>
                  <!-- <i class="bi bi-triangle-half"></i> أو -->
                <!-- <i class="bi bi-mountain"></i> -->
                <!-- <i class="material-icons">landscape</i> -->
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

            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Explore</a></li>
                <li><a href="#">Landmarks</a></li>
                <li><a href="#">Virtual Tours</a></li>
                <li><a href="#">Plan Trip</a></li>
                <li><a href="#">About</a></li>
            </ul>

<div class="buttons">

<?php if(isset($_SESSION['user_id'])) { ?>

    <span>Welcome, <?php echo $_SESSION['user_name']; ?></span>

    <a href="action/logout.php">
        <button>Logout</button>
    </a>

<?php } else { ?>

    <a href="pages/login.php">
        <button>Login</button>
    </a>

    <a href="pages/register.php">
        <button>Sign Up</button>
    </a>

<?php } ?>

</div>

        </nav>
    </header>
