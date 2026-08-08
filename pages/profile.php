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
$stmt->close();

// Fetch this user's confirmed bookings (most recent first) to show below the profile card.
$bookings = [];
$b_sql = "SELECT * FROM bookings WHERE user_id = ? ORDER BY created_at DESC";
$b_stmt = $conn->prepare($b_sql);
$b_stmt->bind_param("i", $user_id);
$b_stmt->execute();
$b_result = $b_stmt->get_result();
while ($b_row = $b_result->fetch_assoc()) {
    $bookings[] = $b_row;
}
$b_stmt->close();
$conn->close();

$profile_success = $_SESSION['profile_success'] ?? null;
unset($_SESSION['profile_success']);
$profile_error = $_SESSION['profile_error'] ?? null;
unset($_SESSION['profile_error']);

// Translate region code to friendly label
function friendly_region_label($region) {
    $map = [
        'lower egypt'    => 'Cairo & Giza',
        'upper egypt'    => 'Luxor & Aswan',
        'red sea & sinai' => 'Sinai & Red Sea',
        'western desert' => 'Western Desert',
        'alexandria'     => 'Alexandria',
    ];
    $key = strtolower(trim($region));
    return $map[$key] ?? $region;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php $page_title = 'My Profile'; ?>
<?php include '../include/head.php'; ?>

<!-- إضافة مكتبة Remix Icon للتأكد من ظهور الأيقونات -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/profile.css?v=<?php echo time(); ?>">

<body>

    <?php include '../include/header.php'; ?>

    <div class="container profile-container">
        <div class="row justify-content-center g-4">
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

            <div class="col-md-10 col-lg-6">
                <div class="bookings-card">
                    <h4 class="bookings-title"><i class="ri-suitcase-3-line"></i> My Bookings</h4>

                    <?php if ($profile_success): ?>
                        <div class="profile-flash profile-flash-success"><i class="ri-checkbox-circle-line"></i> <?php echo htmlspecialchars($profile_success); ?></div>
                    <?php endif; ?>
                    <?php if ($profile_error): ?>
                        <div class="profile-flash profile-flash-error"><i class="ri-error-warning-line"></i> <?php echo htmlspecialchars($profile_error); ?></div>
                    <?php endif; ?>

                    <?php if (empty($bookings)): ?>
                        <p class="bookings-empty">You don't have any bookings yet. Start exploring the <a href="landmarks.php">landmarks</a>!</p>
                    <?php else: ?>
                        <div class="bookings-list">
                            <?php foreach ($bookings as $bk): ?>
                                <div class="booking-box">
                                    <div class="booking-box-header">
                                        <h5><?php echo htmlspecialchars($bk['landmark_title']); ?></h5>
                                        <div class="booking-header-right">
                                            <span class="booking-ref"><?php echo htmlspecialchars($bk['booking_ref']); ?></span>
                                            <form action="../action/delete_booking_action.php" method="POST" class="delete-booking-form">
                                                <input type="hidden" name="booking_id" value="<?php echo (int)$bk['id']; ?>">
                                                <button type="submit" class="btn-delete-booking" aria-label="Delete this booking" title="Delete this booking">
                                                    <i class="ri-delete-bin-6-line"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="booking-region"><i class="ri-map-pin-line"></i> <?php echo htmlspecialchars(friendly_region_label($bk['region'])); ?></p>

                                    <div class="booking-box-row">
                                        <span><i class="ri-calendar-line"></i> <?php echo htmlspecialchars($bk['checkin_date']); ?> &rarr; <?php echo htmlspecialchars($bk['checkout_date']); ?></span>
                                        <span><i class="ri-group-line"></i> <?php echo (int)$bk['adults']; ?> Adults<?php echo $bk['children'] > 0 ? ', ' . (int)$bk['children'] . ' Children' : ''; ?></span>
                                    </div>

                                    <?php if (!empty($bk['hotel_name']) && $bk['hotel_name'] !== 'None selected'): ?>
                                        <div class="booking-box-row">
                                            <span><i class="ri-hotel-line"></i> <?php echo htmlspecialchars($bk['hotel_name']); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <div class="booking-box-footer">
                                        <span class="booking-payment"><?php echo htmlspecialchars($bk['payment_method']); ?></span>
                                        <span class="booking-total">$<?php echo number_format((float)$bk['total_price'], 2); ?></span>
                                    </div>

                                    <div class="booking-date-made">Booked on <?php echo date('M j, Y', strtotime($bk['created_at'])); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="bookings-clear-all-wrap">
                            <form action="../action/delete_booking_action.php" method="POST" class="clear-all-form">
                                <input type="hidden" name="clear_all" value="1">
                                <button type="submit" class="btn-clear-all">
                                    <i class="ri-delete-bin-line"></i> Clear All
                                </button>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/profile.js"></script>
</body>
</html>