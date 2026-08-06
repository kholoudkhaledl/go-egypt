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

        <form>

            <div class="input-box">
                <input type="text" placeholder="Full Name" required>
            </div>

            <div class="input-box">
                <input type="email" placeholder="Email Address" required>
            </div>

            <div class="input-box">
                <input type="text" placeholder="Phone Number (Optional)">
            </div>

            <div class="input-box">
                <select required>
                    <option selected disabled>Select Subject</option>
                    <option>Tour Inquiry</option>
                    <option>Booking</option>
                    <option>Support</option>
                    <option>Feedback</option>
                </select>
            </div>

            <div class="input-box">
                <textarea placeholder="Write your message..." required></textarea>
            </div>

            <button type="submit">Send Message</button>

        </form>

    </div>

</section>

<?php include("../include/footer.php"); ?>

</body>