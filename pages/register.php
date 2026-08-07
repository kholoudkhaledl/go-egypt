<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If the user is already logged in, redirect them to the home page
if (isset($_SESSION['user']['id'])) {
    header("Location: /go-egypt/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Egypt - Register</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your External Custom CSS -->
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>

    <!-- Ambient Background -->
    <div class="bg-ambient-wrapper">
        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3UV6eGRBW7oYW_PBu-mN2_mCKchapYLLzgID5LomgUKbYRFUOM--Bi3Z1TybLI1Bgw_mca9UObxi9FDv7nUnucMLQSe10jUQmdPi2WNOAkwisl16K6xLf7EHgQq-xSaCM38u36fx8PPfNQiu3Y46DEpoUF8eU7b8Yw_m6nqgVcQCFwTuKPTbAqdlZoKChktz1sfPGCpM2QPYCeLb4szowvmZLzaxELZvBGSZqtTQh8bq3T3a1Iw8" alt="Egyptian Pyramids" class="bg-ambient-img">
        <div class="bg-overlay"></div>
    </div>

  <!-- Registration Form Card -->
    <div class="glass-card">
        
        <!-- Header / Branding -->
        <div class="text-center mb-4">
            <h1 class="brand-title">Explore Egypt</h1>
            <p class="brand-subtitle m-0">HERITAGE & LUXURY</p>
        </div>

        <!-- Form Elements -->
        <form action="../action/register_action.php" method="POST" class="d-flex flex-column gap-3">
            
            <!-- First Name -->
            <div>
                <label class="form-label-custom">FIRST NAME</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">person</span>
                    <input type="text" name="first_name" class="form-control form-control-custom w-100" placeholder="e.g. Alexander" required>
                </div>
            </div>

            <!-- Last Name -->
            <div>
                <label class="form-label-custom">LAST NAME</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">badge</span>
                    <input type="text" name="last_name" class="form-control form-control-custom w-100" placeholder="e.g. Smith" required>
                </div>
            </div>

            <!-- Email Address -->
            <div>
                <label class="form-label-custom">EMAIL ADDRESS</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">mail</span>
                    <input type="email" name="email" class="form-control form-control-custom w-100" placeholder="alexander@luxor.com" required>
                </div>
            </div>

            <!-- Phone Number -->
            <div>
                <label class="form-label-custom">PHONE NUMBER</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">call</span>
                    <input type="tel" name="phone" class="form-control form-control-custom w-100" placeholder="+1 (555) 000-0000">
                </div>
            </div>

            <!-- Password -->
            <div>
                <label class="form-label-custom">PASSWORD</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">lock</span>
                    <input type="password" name="password" class="form-control form-control-custom has-toggle w-100" placeholder="••••••••" required>
                    <button type="button" class="toggle-password">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label class="form-label-custom">CONFIRM PASSWORD</label>
                <div class="input-icon-wrapper">
                    <span class="material-symbols-outlined left-icon">lock_reset</span>
                    <input type="password" name="confirm_password" class="form-control form-control-custom has-toggle w-100" placeholder="••••••••" required>
                    <button type="button" class="toggle-password">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>

            <!-- Primary Action -->
            <button type="submit" class="btn btn-primary-custom mt-2">
                Create Account
            </button>

        </form>

        <!-- Divider -->
        <div class="divider-container">
            <div class="divider-line"></div>
            <span class="divider-text">OR CONTINUE WITH</span>
            <div class="divider-line"></div>
        </div>

        <!-- Social Buttons -->
        <div class="row g-3 mb-4">
            <div class="col-6">
                <button type="button" class="btn btn-social-custom">
                    <svg width="20" height="20" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"></path>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                    </svg>
                    <span>GOOGLE</span>
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-social-custom">
                    <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.19 2.31-.88 3.5-.8 1.48.09 2.68.7 3.38 1.76-3.08 1.83-2.53 5.92.51 7.15-.69 1.77-1.52 3.2-2.47 4.06zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"></path>
                    </svg>
                    <span>APPLE</span>
                </button>
            </div>
        </div>

        <!-- Footer Link -->
        <div class="text-center">
            <p class="m-0 footer-text">
                Already have an account? 
                <a href="login.php" class="link-primary-custom ms-1">Sign In</a>
            </p>
        </div>

    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>