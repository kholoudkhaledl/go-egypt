<?php 
if (session_status() === PHP_SESSION_NONE) {
     session_start();
      }

require_once __DIR__ . '/../config/config.php';

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<header class="header">
    <nav>
        <a href="<?php echo BASE_URL; ?>index.php" class="logo">
            <div class="logo-icon">
                <i class="ri-landscape-line"></i>
            </div>
            <h2>GO EGYPT</h2>
        </a>

        <ul class="nav-links">
            <li><a href="<?php echo BASE_URL; ?>index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="<?php echo BASE_URL; ?>index.php#explore">Explore</a></li>
            <li><a href="<?php echo BASE_URL; ?>pages/landmarks.php" class="<?php echo ($current_page == 'landmarks.php') ? 'active' : ''; ?>">Landmarks</a></li>
            <li><a href="<?php echo BASE_URL; ?>pages/about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">About</a></li>
            <li><a href="<?php echo BASE_URL; ?>pages/history.php" class="<?php echo ($current_page == 'history.php') ? 'active' : ''; ?>"> History </a></li>
            <li><a href="<?php echo BASE_URL; ?>pages/contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">Contact Us</a></li>
  
        </ul>

        <div class="buttons">
            <?php if (isset($_SESSION['user']['username'])): ?>
        <!-- login done  -->
              <a href="<?php echo BASE_URL; ?>pages/profile.php" style="color: #fff; font-weight: bold; margin-right: 10px; text-decoration: none;">
              <i class="ri-user-line"></i> <?php echo htmlspecialchars($_SESSION['user']['username']); ?>
              </a>
                <button onclick="location.href='<?php echo BASE_URL; ?>action/logout_action.php'">Logout</button>

            <?php else: ?>
      <!-- no login status  -->
                <button onclick="location.href='<?php echo BASE_URL; ?>pages/login.php'">Login</button>
                <button onclick="location.href='<?php echo BASE_URL; ?>pages/register.php'">Sign Up</button>
            <?php endif; ?>
        </div>

        <div class="menu-toggle">
            <i class="ri-menu-3-line"></i>
        </div>
    </nav>
</header>