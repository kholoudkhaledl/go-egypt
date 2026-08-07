<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION['user']['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - GO EGYPT</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile.css">
</head>
<body>

    <?php include '../include/header.php'; ?>

    <div class="container profile-container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="profile-card">
                    
                 
                    <div class="text-center mb-4">
                        <i class="ri-user-3-line profile-icon"></i>
                        <h3 class="fw-bold mt-2"><?php echo htmlspecialchars($user['Fname'] . ' ' . $user['Lname']); ?></h3>
                    </div>

                    <!-- First Name & Last Name -->
                    <div class="row">
                        <div class="col-6">
                            <div class="profile-field">
                                <span class="profile-label">First Name</span>
                                <div class="profile-field-item">
                                    <p class="profile-value"><?php echo htmlspecialchars($user['Fname']); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="profile-field">
                                <span class="profile-label">Last Name</span>
                                <div class="profile-field-item">
                                    <p class="profile-value"><?php echo htmlspecialchars($user['Lname']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="profile-field">
                        <span class="profile-label">Email Address</span>
                        <div class="profile-field-item">
                            <i class="ri-mail-line profile-field-icon"></i>
                            <p class="profile-value"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                    </div>

                    <!-- Phone Number -->
                    <div class="profile-field">
                        <span class="profile-label">Phone Number</span>
                        <div class="profile-field-item">
                            <i class="ri-phone-line profile-field-icon"></i>
                            <p class="profile-value"><?php echo !empty($user['phone']) ? htmlspecialchars($user['phone']) : 'N/A'; ?></p>
                        </div>
                    </div>

                    <!-- buttons -->
                    <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                        <a href="<?php echo BASE_URL; ?>index.php" class="btn btn-outline-light btn-back-home">Back to Home</a>
                        <a href="<?php echo BASE_URL; ?>action/logout_action.php" class="btn btn-logout-card">Logout</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>