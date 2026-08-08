<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ------------------------------------------------------------------
// 1) SUCCESS VIEW: coming back from checkout_action.php after a
//    booking was saved successfully.
// ------------------------------------------------------------------
$success = isset($_SESSION['last_booking']) ? $_SESSION['last_booking'] : null;
if ($success) {
    unset($_SESSION['last_booking']);
}

// ------------------------------------------------------------------
// 2) BOOKING DATA: either just posted here from details.php, or
//    kept in the session (e.g. after a validation error redirect).
// ------------------------------------------------------------------
if (!$success) {

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['landmark_title'])) {
        $_SESSION['checkout_booking'] = $_POST;
    }

    $booking = $_SESSION['checkout_booking'] ?? null;

    // No booking context at all -> user opened checkout.php directly
    if (!$booking) {
        header("Location: landmarks.php");
        exit();
    }

    $landmark_id     = isset($booking['landmark_id']) ? (int)$booking['landmark_id'] : 0;
    $landmark_title  = $booking['landmark_title'] ?? '';
    $region          = $booking['region'] ?? '';
    $image           = $booking['image'] ?? '';
    $checkin_date    = $booking['checkin_date'] ?? '';
    $checkout_date   = $booking['checkout_date'] ?? '';
    $adults          = isset($booking['adults']) ? (int)$booking['adults'] : 1;
    $children        = isset($booking['children']) ? (int)$booking['children'] : 0;
    $hotel_name      = $booking['hotel_name'] ?? '';
    $hotel_price     = isset($booking['hotel_price']) ? (float)$booking['hotel_price'] : 0;
    $nights          = isset($booking['nights']) ? (int)$booking['nights'] : 0;
    $entry_total     = isset($booking['entry_total']) ? (float)$booking['entry_total'] : 0;
    $trans_total     = isset($booking['trans_total']) ? (float)$booking['trans_total'] : 0;
    $trans_cars      = isset($booking['trans_cars']) ? max(1, (int)$booking['trans_cars']) : 1;
    $guide_total     = isset($booking['guide_total']) ? (float)$booking['guide_total'] : 0;
    $taxes           = isset($booking['taxes']) ? (float)$booking['taxes'] : 12;
    $hotel_total     = $hotel_price * $nights;
    $grand_total     = $hotel_total + $entry_total + $trans_total + $guide_total + $taxes;

    $checkout_error = $_SESSION['checkout_error'] ?? null;
    unset($_SESSION['checkout_error']);
    $old = $_SESSION['checkout_old'] ?? [];
    unset($_SESSION['checkout_old']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $success ? 'Booking Confirmed' : 'Checkout'; ?> - Go Egypt</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css">
    <link rel="stylesheet" href="../assets/css/checkout.css">
</head>
<body>

    <div class="header">
        <h1>Go Egypt</h1>
    </div>

    <?php if ($success): ?>

        <div class="container" style="max-width: 650px;">
            <div class="card success-card">
                <div class="success-icon"><i class="ri-checkbox-circle-fill"></i></div>
                <h2 class="success-title">Booking Confirmed!</h2>
                <p class="success-subtitle">
                    Thank you, <?php echo htmlspecialchars($success['full_name']); ?>. Your trip to
                    <strong><?php echo htmlspecialchars($success['landmark_title']); ?></strong> has been booked successfully.
                    A confirmation was sent to <strong><?php echo htmlspecialchars($success['email']); ?></strong>.
                </p>

                <div class="success-ref">
                    Booking Reference
                    <span><?php echo htmlspecialchars($success['booking_ref']); ?></span>
                </div>

                <hr style="border: 0.5px solid #eee;">

                <div class="row-space">
                    <span>Destination:</span>
                    <strong><?php echo htmlspecialchars($success['landmark_title']); ?></strong>
                </div>
                <div class="row-space">
                    <span>Guests:</span>
                    <strong><?php echo (int)$success['adults']; ?> Adults, <?php echo (int)$success['children']; ?> Children</strong>
                </div>
                <?php if (!empty($success['hotel_name']) && $success['hotel_name'] !== 'None selected'): ?>
                <div class="row-space">
                    <span>Hotel:</span>
                    <strong><?php echo htmlspecialchars($success['hotel_name']); ?></strong>
                </div>
                <?php endif; ?>
                <div class="row-space">
                    <span>Payment Method:</span>
                    <strong><?php echo htmlspecialchars($success['payment_method']); ?></strong>
                </div>
                <hr style="border: 0.5px solid #eee;">
                <div class="row-space">
                    <strong>Total Paid:</strong>
                    <span class="total-price">$<?php echo number_format((float)$success['total_price'], 2); ?></span>
                </div>

                <a href="profile.php" class="btn-submit" style="display:block; text-align:center; text-decoration:none; box-sizing:border-box;">View My Bookings</a>
                <a href="landmarks.php" class="btn-submit-secondary" style="display:block; text-align:center; text-decoration:none; box-sizing:border-box;">Explore More Landmarks</a>
            </div>
        </div>

    <?php else: ?>

        <form class="container" action="../action/checkout_action.php" method="POST" id="checkoutForm">

            <!-- Carry the booking totals forward to checkout_action.php -->
            <input type="hidden" name="landmark_id" value="<?php echo (int)$landmark_id; ?>">
            <input type="hidden" name="landmark_title" value="<?php echo htmlspecialchars($landmark_title); ?>">
            <input type="hidden" name="region" value="<?php echo htmlspecialchars($region); ?>">
            <input type="hidden" name="image" value="<?php echo htmlspecialchars($image); ?>">
            <input type="hidden" name="checkin_date" value="<?php echo htmlspecialchars($checkin_date); ?>">
            <input type="hidden" name="checkout_date" value="<?php echo htmlspecialchars($checkout_date); ?>">
            <input type="hidden" name="adults" value="<?php echo (int)$adults; ?>">
            <input type="hidden" name="children" value="<?php echo (int)$children; ?>">
            <input type="hidden" name="hotel_name" value="<?php echo htmlspecialchars($hotel_name); ?>">
            <input type="hidden" name="hotel_price" value="<?php echo htmlspecialchars($hotel_price); ?>">
            <input type="hidden" name="nights" value="<?php echo (int)$nights; ?>">
            <input type="hidden" name="entry_total" value="<?php echo htmlspecialchars($entry_total); ?>">
            <input type="hidden" name="trans_total" value="<?php echo htmlspecialchars($trans_total); ?>">
            <input type="hidden" name="trans_cars" value="<?php echo (int)$trans_cars; ?>">
            <input type="hidden" name="guide_total" value="<?php echo htmlspecialchars($guide_total); ?>">
            <input type="hidden" name="taxes" value="<?php echo htmlspecialchars($taxes); ?>">
            <input type="hidden" name="grand_total" value="<?php echo htmlspecialchars($grand_total); ?>">

            <div class="left-side">

                <?php if ($checkout_error): ?>
                    <div class="checkout-alert">
                        <i class="ri-error-warning-line"></i> <?php echo htmlspecialchars($checkout_error); ?>
                    </div>
                <?php endif; ?>

                <div class="card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Visitor Information
                    </h3>

                    <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" placeholder="John Doe" value="<?php echo htmlspecialchars($old['full_name'] ?? ''); ?>" required>
                    </div>

                    <div class="row">
                        <div class="form-group" style="flex:1;">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="john@example.com" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required>
                        </div>
                        <div class="form-group" style="flex:1;">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" placeholder="+123456789" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Nationality</label>
                        <select name="nationality" required>
                            <option value="" disabled <?php echo empty($old['nationality']) ? 'selected' : ''; ?>>Select Nationality</option>
                            <option <?php echo (($old['nationality'] ?? '') === 'Egyptian') ? 'selected' : ''; ?>>Egyptian</option>
                            <option <?php echo (($old['nationality'] ?? '') === 'Foreigner') ? 'selected' : ''; ?>>Foreigner</option>
                        </select>
                    </div>
                </div>


                <div class="card">
                    <h3 class="card-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
                        Payment Method
                    </h3>

                    <!-- first choice -->
                    <div class="payment-box">
                        <input type="radio" id="card" name="payment_method" value="Credit / Debit Card" checked>
                        <label for="card" class="payment-header">
                            <span class="radio-label">Credit / Debit Card</span>
                            <span class="icon">💳</span>
                        </label>

                        <div class="payment-body">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" name="card_number" placeholder="0000 0000 0000 0000" maxlength="19">
                            </div>

                            <div class="row">
                                <div class="form-group" style="flex:1;">
                                    <label>Expiry Date</label>
                                    <input type="text" name="card_expiry" placeholder="MM/YY">
                                </div>
                                <div class="form-group" style="flex:1;">
                                    <label>CVV</label>
                                    <input type="password" name="card_cvv" placeholder="123">
                                </div>
                            </div>
                        </div>
                    </div>

                  <!-- second choice, E wallet  -->
                    <div class="payment-box">
                        <input type="radio" id="wallet" name="payment_method" value="E-Wallet">
                        <label for="wallet" class="payment-header">
                            <span class="radio-label">E-Wallets (Vodafone Cash / InstaPay)</span>
                            <span class="icon">👛</span>
                        </label>

                        <div class="payment-body">
                            <div class="form-group">
                                <label> Wallet Phone Number / InstaPay IPA </label>
                                <input type="text" name="wallet_number" placeholder="010xxxxxxxx or username@instapay">
                            </div>
                        </div>
                    </div>

                  <!-- third choice -->
                    <div class="payment-box">
                        <input type="radio" id="onsite" name="payment_method" value="Pay On-Site">
                        <label for="onsite" class="payment-header">
                            <span class="radio-label">Pay On-Site (At Entrance)</span>
                            <span class="icon">🏛️</span>
                        </label>

                        <div class="payment-body">
                            <p style="font-size: 13px; color: #666; margin: 0;">You can pay in cash or by card upon your arrival at the entrance desk.</p>
                        </div>
                    </div>

                </div>

            </div>


            <div class="right-side">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($image); ?>" class="summary-img" alt="<?php echo htmlspecialchars($landmark_title); ?>">

                    <h4 style="margin: 15px 0 5px 0;"><?php echo htmlspecialchars($landmark_title); ?></h4>
                    <p style="color: #777; font-size: 12px; margin-top: 0;"><?php echo htmlspecialchars($region); ?></p>
                    <hr style="border: 0.5px solid #eee;">

                    <div class="row-space">
                        <span>Check-in:</span>
                        <strong><?php echo htmlspecialchars($checkin_date); ?></strong>
                    </div>
                    <div class="row-space">
                        <span>Check-out:</span>
                        <strong><?php echo htmlspecialchars($checkout_date); ?></strong>
                    </div>
                    <div class="row-space">
                        <span>Guests:</span>
                        <strong><?php echo (int)$adults; ?> Adults, <?php echo (int)$children; ?> Children</strong>
                    </div>
                    <hr style="border: 0.5px solid #eee;">

                    <?php if (!empty($hotel_name) && $hotel_name !== 'None selected'): ?>
                    <div class="row-space">
                        <span>Hotel (<?php echo (int)$nights; ?> Nights):</span>
                        <span>$<?php echo number_format($hotel_total, 2); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="row-space">
                        <span>Entry Tickets:</span>
                        <span>$<?php echo number_format($entry_total, 2); ?></span>
                    </div>
                    <?php if ($trans_total > 0): ?>
                    <div class="row-space">
                        <span>Transportation<?php echo $trans_cars > 1 ? ' (' . (int)$trans_cars . ' Cars)' : ''; ?>:</span>
                        <span>$<?php echo number_format($trans_total, 2); ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($guide_total > 0): ?>
                    <div class="row-space">
                        <span>Tour Guide:</span>
                        <span>$<?php echo number_format($guide_total, 2); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="row-space">
                        <span>Taxes & Fees:</span>
                        <span>$<?php echo number_format($taxes, 2); ?></span>
                    </div>
                    <hr style="border: 0.5px solid #eee;">

                    <div class="row-space">
                        <strong>Total:</strong>
                        <span class="total-price">$<?php echo number_format($grand_total, 2); ?></span>
                    </div>

                    <button type="submit" class="btn-submit">Complete Payment & Confirm</button>
                </div>
            </div>

        </form>

    <?php endif; ?>

</body>
</html>
