<?php
// 1. الاتصال بقاعدة البيانات
include '../config/db.php';

// 2. التأكد إن الطلب تم عن طريق زرار "Complete Payment"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 3. استقبال البيانات اللي جاية من الفورم
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $landmark_id = intval($_POST['landmark_id']);
    $adults = intval($_POST['adults']);
    $children = intval($_POST['children']);
    $hotel = mysqli_real_escape_string($conn, $_POST['hotel_name']);
    $total = floatval($_POST['total']);

    // 4. كتابة أمر الإدخال في قاعدة البيانات
    $sql = "INSERT INTO bookings (full_name, email, phone, landmark_id, adults, children, hotel_name, total_price) 
            VALUES ('$name', '$email', '$phone', $landmark_id, $adults, $children, '$hotel', $total)";

    // 5. تنفيذ الأمر وتأكيد النجاح باللغة الإنجليزية
    if ($conn->query($sql) === TRUE) {
        echo "<div style='font-family: Arial, sans-serif; text-align: center; margin-top: 50px;'>";
        echo "<h1 style='color: #2e7d32;'>Booking Successful!</h1>";
        echo "<p style='color: #555;'>Thank you, your reservation has been successfully recorded.</p>";
        echo "<a href='../index.php' style='display: inline-block; margin-top: 20px; padding: 10px 20px; background-color: #d97706; color: white; text-decoration: none; border-radius: 5px;'>Back to Home</a>";
        echo "</div>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>