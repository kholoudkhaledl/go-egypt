<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $first_name   = trim($_POST['first_name']);
    $last_name    = trim($_POST['last_name']);
    $email        = trim($_POST['email']);
    $phone        = trim($_POST['phone']);
    $password     = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_pass) {
        die("<script>
                alert('Passwords do not match!');
                window.history.back();
             </script>");
    }

    // 1. Check if email already exists in database
    $check_email_sql = "SELECT id FROM users WHERE email = ?";
    $check_stmt = $conn->prepare($check_email_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Email already registered
        $check_stmt->close();
        die("<script>
                alert('This email is already registered! Please use another email or login.');
                window.history.back();
             </script>");
    }
    $check_stmt->close();

    // 2. Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 3. Insert new user into database (تم تعديل أسماء الأعمدة هنا لـ Fname و Lname)
    $sql = "INSERT INTO users (Fname, Lname, email, phone, pass) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        echo "<script>
                alert('Account created successfully!');
                window.location.href = '../pages/login.php';
              </script>";
    } else {
        echo "<script>
                alert('Registration error: " . addslashes($stmt->error) . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>