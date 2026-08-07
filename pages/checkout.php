<?php
// استقبال البيانات المرسلة من صفحة التفاصيل عبر الـ URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$adults = isset($_GET['adults']) ? intval($_GET['adults']) : 2;
$children = isset($_GET['children']) ? intval($_GET['children']) : 1;
$hotel = isset($_GET['hotel']) ? htmlspecialchars($_GET['hotel']) : 'None selected';
$total = isset($_GET['total']) ? htmlspecialchars($_GET['total']) : '222';

// الاتصال بقاعدة البيانات لجلب اسم المعلم وصورته بناءً على الـ ID المرسل
include '../config/db.php';
$sql = "SELECT * FROM destinations WHERE id = $id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $dest = $result->fetch_assoc();
    $title = $dest['title'];
    $region = $dest['region'];
    $img_url = $dest['img_url'];
} else {
    $title = "Great Pyramids of Giza";
    $region = "Lower Egypt";
    $img_url = "../assets/images/pyramids.jpg";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Go Egypt</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/checkout.css">
</head>
<body>

    <div class="header">
        <h1>Go Egypt</h1>
    </div>

<form action="process_booking.php" method="POST">
    <!-- البيانات المخفية (لا يراها المستخدم) -->
    <input type="hidden" name="landmark_id" value="<?php echo $id; ?>">
    <input type="hidden" name="adults" value="<?php echo $adults; ?>">
    <input type="hidden" name="children" value="<?php echo $children; ?>">
    <input type="hidden" name="hotel_name" value="<?php echo $hotel; ?>">
    <input type="hidden" name="total" value="<?php echo $total; ?>">
    
    <div class="container">
        
        <div class="left-side">
            <div class="card">
                <h3 class="card-title">Visitor Information</h3>
                
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" placeholder="John Doe" required>
                </div>

                <div class="row">
                    <div class="form-group" style="flex:1;">
                        <label>Email Address</label>
                        <input type="email" name="email" placeholder="john@example.com" required>
                    </div>
                    <div class="form-group" style="flex:1;">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" placeholder="+123456789" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Nationality</label>
                    <select name="nationality">
                        <option value="Egyptian">Egyptian</option>
                        <option value="Foreigner">Foreigner</option>
                    </select>
                </div>
            </div>

            <!-- خيارات الدفع -->
            <div class="card">
                <h3 class="card-title">Payment Method</h3>
                <div class="payment-box">
                    <input type="radio" id="card" name="payment_method" value="Card" checked>
                    <label for="card" class="payment-header">Credit / Debit Card</label>
                </div>
                <div class="payment-box">
                    <input type="radio" id="wallet" name="payment_method" value="Wallet">
                    <label for="wallet" class="payment-header">E-Wallets</label>
                </div>
                <div class="payment-box">
                    <input type="radio" id="onsite" name="payment_method" value="OnSite">
                    <label for="onsite" class="payment-header">Pay On-Site</label>
                </div>
            </div>
        </div>

        <div class="right-side">
            <div class="card">
                <img src="<?php echo htmlspecialchars($img_url); ?>" class="summary-img" style="width:100%; height:160px; object-fit:cover; border-radius:8px;">
                
                <h4><?php echo htmlspecialchars($title); ?></h4>
                <p><?php echo htmlspecialchars($region); ?></p>
                <hr>

                <div class="row-space">
                    <span>Guests:</span>
                    <strong><?php echo $adults; ?> Adults, <?php echo $children; ?> Child</strong>
                </div>
                <div class="row-space">
                    <span>Selected Hotel:</span>
                    <strong><?php echo $hotel; ?></strong>
                </div>
                
                <hr>
                
                <div class="row-space">
                    <strong>Total:</strong>
                    <span class="total-price">$<?php echo $total; ?></span>
                </div>

                <button type="submit" class="btn-submit" style="width:100%; margin-top:15px; cursor:pointer;">
                    Complete Payment & Confirm
                </button>
            </div>
        </div>
    </div>
</form>

</body>
</html>