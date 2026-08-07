<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../config/config.php';

// If the user is already logged in, redirect them to the home page
if (isset($_SESSION['user']['id'])) {
    header("Location: " . BASE_URL . "index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login | Explore Egypt</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet"/>

    <!-- Material Symbols Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>

    <!-- Atmospheric Background Image -->
    <div class="login-bg">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3UV6eGRBW7oYW_PBu-mN2_mCKchapYLLzgID5LomgUKbYRFUOM--Bi3Z1TybLI1Bgw_mca9UObxi9FDv7nUnucMLQSe10jUQmdPi2WNOAkwisl16K6xLf7EHgQq-xSaCM38u36fx8PPfNQiu3Y46DEpoUF8eU7b8Yw_m6nqgVcQCFwTuKPTbAqdlZoKChktz1sfPGCpM2QPYCeLb4szowvmZLzaxELZvBGSZqtTQh8bq3T3a1Iw8" alt="Pyramids Background"/>
    </div>

    <!-- Main Container -->
    <main class="login-page">
        <div class="login-card">

            <!-- Logo Header -->
            <div class="login-header">
                <h1 class="login-header-title">Explore Egypt</h1>
                <p class="login-header-subtitle">Heritage &amp; Luxury</p>
            </div>

            <div id="alertMessage" class="login-alert" role="alert"></div>

            <!-- Login Form -->
            <form id="loginForm" action="../action/login_action.php" method="POST">
                <!-- Email Field -->
                <div class="form-field">
                    <label for="email" class="form-field-label">Email Address</label>
                    <div class="form-field-control-wrap">
                        <span class="material-symbols-outlined form-field-icon">mail</span>
                        <input type="email" name="email" class="form-field-input" id="email" placeholder="alexander@luxor.com" required>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-field">
                    <div class="form-field-label-row">
                        <label for="password" class="form-field-label">Password</label>
                        <a href="register.php" class="link-gold text-sm">Forgot your password?</a>
                    </div>
                    <div class="form-field-control-wrap">
                        <span class="material-symbols-outlined form-field-icon">lock</span>
                        <input type="password" name="password" class="form-field-input" id="password" placeholder="••••••••" required>
                        <button type="button" class="form-field-toggle" id="togglePassword">
                            <span class="material-symbols-outlined">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-gold">Sign In</button>
            </form>

            <!-- Divider -->
            <div class="login-divider">
                <span class="login-divider-text">OR CONTINUE WITH</span>
            </div>

            <!-- Social Logins -->
            <div class="social-buttons">
                <div class="social-buttons-item">
                    <button type="button" class="btn btn-social">
                        <svg width="18" height="18" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                        </svg>
                        GOOGLE
                    </button>
                </div>
                <div class="social-buttons-item">
                    <button type="button" class="btn btn-social">
                        <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.05 20.28c-.96.95-2.21 1.72-3.41 1.72-1.34 0-2.06-.55-3.32-.55-1.28 0-2.25.56-3.41.56-1.12 0-2.34-.73-3.23-1.63C1.84 18.52 1 15.93 1 13.52c0-3.9 2.53-6.1 4.92-6.1 1.25 0 2.21.57 3.23.57 1.05 0 1.58-.57 3.2-.57 1.48 0 2.76.61 3.65 1.57-1.78 1.06-2.09 3.52-.33 4.77 1.34.94 3.01.27 3.33-.2-.05.15-.35 1.15-1 1.95M11.96 6.94c0-2.05 1.71-3.73 3.74-3.73.19 0 .38.02.56.05-.08 2.33-1.99 4.14-3.74 4.14-.33 0-.44-.01-.56-.03z"></path>
                        </svg>
                        APPLE
                    </button>
                </div>
            </div>

            <!-- Footer Text -->
            <p class="login-footer">
                Don't have an account? <a href="register.php" class="link-footer">Register</a>
            </p>
        </div>
    </main>

    <script>
        const toggleBtn = document.getElementById('togglePassword');
        const passInput = document.getElementById('password');
        const passIcon = toggleBtn.querySelector('span');

        toggleBtn.addEventListener('click', () => {
            const isPass = passInput.type === 'password';
            passInput.type = isPass ? 'text' : 'password';
            passIcon.textContent = isPass ? 'visibility_off' : 'visibility';
        });
    </script>
</body>
</html>