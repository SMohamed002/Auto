<?php
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info", "Tools"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once './classes/' . $class . '.php';
        } else {
            require_once '../classes/' . $class . '.php';
        }
    }
});
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/contact.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="contactUs">

        <div class="contact-image">
            <img src="/assets/images/bg-breadcrumb.jpg" alt="">
        </div>
        <div class="contact-head">
            <h1>Contact Us</h1>
        </div>
    </section>
    <section class="map2">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52913038.383717686!2d-161.83343629807604!3d35.95784059977629!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2seg!4v1702304723947!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    <section class="get-in-touch">
        <div class="email-forms">
            <form action="javascript:contact_us(`contact_form`);" id="contact_form" name="contact_form" method="post">
                <div class="forms">
                    <div class="one-form">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <br>
                        <input type="text" placeholder="Name..." id="name" name="name" autofocus=""/>
                    </div>
                    <div class="one-form">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <br>
                        <input type="email" placeholder="Email address..." name="email" id="email" />
                    </div>
                    <div class="one-form">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <br>
                        <input type="tel" placeholder="Phone Number..." name="phone" id="phone" />
                    </div>
                </div>
                <div class="text-message">
                    <p><label for="msg">Message <span class="text-danger">*</span></label></p>
                    <textarea cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required" placeholder="Comment or Message..." name="msg" id="msg"></textarea>
                </div>
                <div class="text-btn">
                    <button class="check-btn" type="submit">Send Massege</button>
                </div>
            </form>
        </div>
        <div class="left-bar">
            <div class="one-bar">
                <h2>Address</h2>
                <p>14 LE Gounlburn St, Sydney 1198NSA.</p>
            </div>
            <hr>
            <div class="one-bar">
                <h2>Phone</h2>
                <p>(+089) 19918989</p>
            </div>
            <hr>
            <div class="one-bar">
                <h2>Email</h2>
                <p>support@bedozin.com</p>
            </div>
            <hr>
            <div class="one-bar">
                <h2>Opening Time</h2>
                <p>8:00Am – 10:00Pm, Sunday Close</p>
            </div>
            <hr>
            <div class="one-bar">
                <h2>Follow Us On</h2>
                <div class="follow">
                    <a href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a>
                    <a href="javascript:void(0);"><i class="fa-brands fa-dribbble"></i></a>
                    <a href="javascript:void(0);"><i class="fa-brands fa-behance"></i></a>
                    <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <hr>
        </div>
    </section>

    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/contact.js"></script>
</body>

</html>