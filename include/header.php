<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'include/head.php'; ?>
</head>
<!-- Navbar -->
    <header>
        <nav>

            <div class="logo">
                <img src="images/logo.png" alt="Go Egypt Logo">
                <h2>Go Egypt</h2>
            </div>

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