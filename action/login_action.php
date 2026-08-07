<?php
session_start();
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

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
        
        // Redirect to the homepage after successful login
        // echo "<script>window.location.replace('../index.php');</script>";
        echo "<h1>Login successful! Welcome " . htmlspecialchars($user['Fname']) . "</h1>";
        exit();
    } else {
        $error = "Invalid email or password";
        echo "<div class='alert alert-danger text-center m-3' role='alert'> $error </div>";
    }

    $stmt->close();
}
$conn->close();
?>