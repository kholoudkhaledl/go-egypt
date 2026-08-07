<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);
    $password     = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];


    function backWithError($message) {
        $_SESSION['error'] = $message;
        $_SESSION['old'] = $_POST; 
        header("Location: ../pages/register.php");
        exit();
    }

    if ($password !== $confirm_pass) {
        backWithError("Passwords do not match!");
    }

  //  check phone number on database

    $phone_pattern = "/^\+?[1-9]\d{6,14}$/";
    $clean_phone = preg_replace('/[\s\-\(\)]/', '', $phone);

    if (empty($phone) || !preg_match($phone_pattern, $clean_phone)) {
        backWithError("Please enter a valid phone number with country code (e.g., +1234567890)!");
    }

//  check email on database 
    $check_email_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_email_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        $check_stmt->close();
        backWithError("This email is already registered!");
    }
    $check_stmt->close();
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (Fname, Lname, email, phone, pass) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        // if it success delete data 
        unset($_SESSION['old']); 
        $_SESSION['success'] = "Account created successfully!";
        header("Location: ../pages/login.php");
        exit();
    } else {
        backWithError("Registration error. Please try again.");
    }

    $stmt->close();
}

$conn->close();
?>