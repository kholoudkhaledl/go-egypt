<?php
session_start();
include '../config/db.php';

function backWithError($message) {
    global $conn;
    $_SESSION['contact_error'] = $message;
    $_SESSION['contact_old'] = $_POST;
    if (isset($conn)) { $conn->close(); }
    header("Location: ../pages/contact.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $phone     = trim($_POST['phone'] ?? '');
    $subject   = trim($_POST['subject'] ?? '');
    $message   = trim($_POST['message'] ?? '');

    if ($full_name === '' || $email === '' || $subject === '' || $message === '') {
        backWithError("Please fill in all the required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        backWithError("Please enter a valid email address.");
    }

    $sql = "INSERT INTO contact_messages (full_name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        backWithError("Something went wrong. Please try again.");
    }

    $stmt->bind_param("sssss", $full_name, $email, $phone, $subject, $message);

    if ($stmt->execute()) {
        unset($_SESSION['contact_old']);
        $_SESSION['contact_success'] = "Thank you, $full_name! Your message has been sent successfully. Our team will get back to you soon.";
        $stmt->close();
        $conn->close();
        header("Location: ../pages/contact.php");
        exit();
    } else {
        $stmt->close();
        backWithError("We couldn't send your message. Please try again.");
    }

} else {
    header("Location: ../pages/contact.php");
    exit();
}
