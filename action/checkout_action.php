<?php
session_start();
include '../config/db.php';

function backWithError($message) {
    global $conn;
    $_SESSION['checkout_error'] = $message;
    $_SESSION['checkout_old'] = $_POST;
    if (isset($conn)) { $conn->close(); }
    header("Location: ../pages/checkout.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/landmarks.php");
    exit();
}

// ---------------- Booking / trip details (hidden fields) ----------------
$landmark_id    = isset($_POST['landmark_id']) ? (int)$_POST['landmark_id'] : 0;
$landmark_title = trim($_POST['landmark_title'] ?? '');
$region         = trim($_POST['region'] ?? '');
$image          = trim($_POST['image'] ?? '');
$checkin_date   = trim($_POST['checkin_date'] ?? '');
$checkout_date  = trim($_POST['checkout_date'] ?? '');
$adults         = isset($_POST['adults']) ? (int)$_POST['adults'] : 1;
$children       = isset($_POST['children']) ? (int)$_POST['children'] : 0;
$hotel_name     = trim($_POST['hotel_name'] ?? '');
$hotel_price    = isset($_POST['hotel_price']) ? (float)$_POST['hotel_price'] : 0;
$nights         = isset($_POST['nights']) ? (int)$_POST['nights'] : 0;
$entry_total    = isset($_POST['entry_total']) ? (float)$_POST['entry_total'] : 0;
$trans_total    = isset($_POST['trans_total']) ? (float)$_POST['trans_total'] : 0;
$guide_total    = isset($_POST['guide_total']) ? (float)$_POST['guide_total'] : 0;
$taxes          = isset($_POST['taxes']) ? (float)$_POST['taxes'] : 12;
$grand_total    = isset($_POST['grand_total']) ? (float)$_POST['grand_total'] : 0;

if ($landmark_id <= 0 || $landmark_title === '') {
    backWithError("Your booking session has expired. Please start again from the destination page.");
}

// ---------------- Visitor information ----------------
$full_name   = trim($_POST['full_name'] ?? '');
$email       = trim($_POST['email'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');

if ($full_name === '' || $email === '' || $phone === '' || $nationality === '') {
    backWithError("Please fill in all the visitor information fields.");
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    backWithError("Please enter a valid email address.");
}

// ---------------- Payment method ----------------
$payment_method = trim($_POST['payment_method'] ?? '');
$allowed_methods = ["Credit / Debit Card", "E-Wallet", "Pay On-Site"];
if (!in_array($payment_method, $allowed_methods)) {
    backWithError("Please choose a payment method.");
}

$card_last4 = null;
$wallet_number = null;

if ($payment_method === "Credit / Debit Card") {
    $card_number_clean = preg_replace('/\D/', '', $_POST['card_number'] ?? '');
    $card_expiry = trim($_POST['card_expiry'] ?? '');
    $card_cvv = trim($_POST['card_cvv'] ?? '');

    if (strlen($card_number_clean) < 12 || $card_expiry === '' || $card_cvv === '') {
        backWithError("Please fill in your card details correctly.");
    }
    // Only the last 4 digits are stored; full card number & CVV are never saved.
    $card_last4 = substr($card_number_clean, -4);

} elseif ($payment_method === "E-Wallet") {
    $wallet_number = trim($_POST['wallet_number'] ?? '');
    if ($wallet_number === '') {
        backWithError("Please enter your wallet phone number or InstaPay IPA.");
    }
}

// ---------------- Save booking ----------------
$user_id = $_SESSION['user']['id'] ?? null;
$booking_ref = 'GE-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 6));

$sql = "INSERT INTO bookings
    (booking_ref, user_id, landmark_id, landmark_title, region, image, checkin_date, checkout_date,
     adults, children, hotel_name, hotel_price_per_night, nights, entry_ticket_total, transportation_total,
     tour_guide_total, taxes_fees, total_price, full_name, email, phone, nationality, payment_method,
     card_last4, wallet_number)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    backWithError("Something went wrong while saving your booking. Please try again.");
}

$stmt->bind_param(
    "siisssssiisdidddddsssssss",
    $booking_ref,
    $user_id,
    $landmark_id,
    $landmark_title,
    $region,
    $image,
    $checkin_date,
    $checkout_date,
    $adults,
    $children,
    $hotel_name,
    $hotel_price,
    $nights,
    $entry_total,
    $trans_total,
    $guide_total,
    $taxes,
    $grand_total,
    $full_name,
    $email,
    $phone,
    $nationality,
    $payment_method,
    $card_last4,
    $wallet_number
);

if ($stmt->execute()) {
    unset($_SESSION['checkout_booking']);

    $_SESSION['last_booking'] = [
        'booking_ref'    => $booking_ref,
        'landmark_title' => $landmark_title,
        'adults'         => $adults,
        'children'       => $children,
        'hotel_name'     => $hotel_name,
        'payment_method' => $payment_method,
        'total_price'    => $grand_total,
        'full_name'      => $full_name,
        'email'          => $email,
    ];

    $stmt->close();
    $conn->close();
    header("Location: ../pages/checkout.php");
    exit();
} else {
    $stmt->close();
    backWithError("We couldn't complete your booking. Please try again.");
}
