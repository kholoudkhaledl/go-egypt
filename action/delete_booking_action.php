<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/config.php';
include '../config/db.php';

// Only logged-in users can delete their own bookings.
if (!isset($_SESSION['user']['id'])) {
    header("Location: " . BASE_URL . "pages/login.php");
    exit();
}

$user_id = $_SESSION['user']['id'];

function backToProfile($message, $isError = false) {
    global $conn;
    if ($isError) {
        $_SESSION['profile_error'] = $message;
    } else {
        $_SESSION['profile_success'] = $message;
    }
    if (isset($conn)) { $conn->close(); }
    header("Location: ../pages/profile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../pages/profile.php");
    exit();
}

// ---------------- Clear all bookings for this user ----------------
if (isset($_POST['clear_all'])) {
    $sql = "DELETE FROM bookings WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $stmt->close();
        backToProfile("All your bookings have been deleted.");
    } else {
        $stmt->close();
        backToProfile("Something went wrong while clearing your bookings. Please try again.", true);
    }
}

// ---------------- Delete a single booking ----------------
$booking_id = isset($_POST['booking_id']) ? (int)$_POST['booking_id'] : 0;

if ($booking_id <= 0) {
    backToProfile("Invalid booking.", true);
}

// Scoped to user_id so a user can only ever delete their own bookings.
$sql = "DELETE FROM bookings WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $booking_id, $user_id);

if ($stmt->execute() && $stmt->affected_rows > 0) {
    $stmt->close();
    backToProfile("Booking deleted successfully.");
} else {
    $stmt->close();
    backToProfile("We couldn't find that booking, or it was already deleted.", true);
}
