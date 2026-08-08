<?php
session_start();
require_once '../config/config.php';
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    // Only allow safe, internal redirect targets like "pages/details.php?id=5"
    $redirect = $_POST['redirect'] ?? '';
    if ($redirect !== '' && !preg_match('/^pages\/[a-zA-Z0-9_\-.]+\.php(\?[a-zA-Z0-9_\-.=&]*)?$/', $redirect)) {
        $redirect = '';
    }

    // 1. Use Prepared Statements to prevent SQL Injection
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // 2. Use password_verify to check hashed passwords
    if ($user && password_verify($pass, $user['pass'])) {
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['Fname'] . ' ' . $user['Lname']
        ];
        
        // Redirect back to the page the user wanted (e.g. a landmark's
        // details page), or the homepage if there wasn't one.
        header("Location: " . BASE_URL . ($redirect !== '' ? $redirect : 'index.php'));
        exit();
    } else {
        // Show the error on login.php itself instead of this action page.
        $_SESSION['login_error'] = "Invalid email or password";
        $_SESSION['login_email'] = $email;
        $_SESSION['login_redirect'] = $redirect;
        header("Location: " . BASE_URL . "pages/login.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>