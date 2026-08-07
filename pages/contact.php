<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$contact_success = $_SESSION['contact_success'] ?? null;
unset($_SESSION['contact_success']);
$contact_error = $_SESSION['contact_error'] ?? null;
unset($_SESSION['contact_error']);
$old = $_SESSION['contact_old'] ?? [];
unset($_SESSION['contact_old']);
?>
<?php include("../include/head.php"); ?>
<link rel="stylesheet" href="../assets/css/contact.css">

<body>

<?php include("../include/header.php"); ?>

<!-- Hero Section -->
<section class="contact-hero">

    <div class="overlay"></div>

    <div class="hero-content">

        <p>HOME / CONTACT</p>

        <h1>Get In Touch</h1>

        <span>
            Have questions or need help planning your Egyptian adventure?
            Fill out the form below and our team will get back to you as soon as possible.
        </span>

    </div>

</section>

<!-- Contact Form -->

<section class="contact-section">

    <div class="contact-box">

        <h2>Send us a Message</h2>

        <?php if ($contact_success): ?>
            <div class="contact-alert contact-alert-success">
                <i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($contact_success); ?>
            </div>
        <?php endif; ?>

        <?php if ($contact_error): ?>
            <div class="contact-alert contact-alert-error">
                <i class="fa-solid fa-circle-exclamation"></i> <?php echo htmlspecialchars($contact_error); ?>
            </div>
        <?php endif; ?>

        <form action="../action/contact_action.php" method="POST">

            <div class="input-box">
                <input type="text" name="full_name" placeholder="Full Name" value="<?php echo htmlspecialchars($old['full_name'] ?? ''); ?>" required>
            </div>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email Address" value="<?php echo htmlspecialchars($old['email'] ?? ''); ?>" required>
            </div>

            <div class="input-box">
                <input type="text" name="phone" placeholder="Phone Number (Optional)" value="<?php echo htmlspecialchars($old['phone'] ?? ''); ?>">
            </div>

            <div class="input-box">
                <select name="subject" required>
                    <option value="" <?php echo empty($old['subject']) ? 'selected' : ''; ?> disabled>Select Subject</option>
                    <option <?php echo (($old['subject'] ?? '') === 'Tour Inquiry') ? 'selected' : ''; ?>>Tour Inquiry</option>
                    <option <?php echo (($old['subject'] ?? '') === 'Booking') ? 'selected' : ''; ?>>Booking</option>
                    <option <?php echo (($old['subject'] ?? '') === 'Support') ? 'selected' : ''; ?>>Support</option>
                    <option <?php echo (($old['subject'] ?? '') === 'Feedback') ? 'selected' : ''; ?>>Feedback</option>
                </select>
            </div>

            <div class="input-box">
                <textarea name="message" placeholder="Write your message..." required><?php echo htmlspecialchars($old['message'] ?? ''); ?></textarea>
            </div>

            <button type="submit">Send Message</button>

        </form>

    </div>

</section>

<?php include("../include/footer.php"); ?>

</body>