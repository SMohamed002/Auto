<?php
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once './classes/' . $class . '.php';
        } else {
            require_once '../classes/' . $class . '.php';
        }
    }
});
?>
<section class="footer">
    <div class="footer-social">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6955.047092475192!2d31.230690926313397!3d29.354956061742033!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145993341ac067c9%3A0x5003042644754896!2z2YXYs9is2K8g2LXZhNin2K0g2KfZhNmG2YHYsdmK!5e0!3m2!1sen!2seg!4v1701212484756!5m2!1sen!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <p>183 Don Street, Invercargill 9810, New York, NY 10012, United States.</p>

            <a target="_blank" href="https://www.google.com/maps/place/%D9%85%D8%B3%D8%AC%D8%AF+%D8%B5%D9%84%D8%A7%D8%AD+%D8%A7%D9%84%D9%86%D9%81%D8%B1%D9%8A%E2%80%AD/@29.3558386,31.2327179,16.75z/data=!4m6!3m5!1s0x145993341ac067c9:0x5003042644754896!8m2!3d29.3549555!4d31.2358414!16s%2Fg%2F11rcs5y5j4?entry=ttu">Show On Map</a>
        </div>
        <div class="social-media">
            <a href="javascript:void(0);"><i class="fa-brands fa-facebook"></i></a>
            <a href="javascript:void(0);"><i class="fa-brands fa-twitter"></i></a>
            <a href="javascript:void(0);"><i class="fa-brands fa-instagram"></i></a>
            <a href="javascript:void(0);"><i class="fa-brands fa-whatsapp"></i></a>
        </div>
    </div>
    <div class="need-help">
        <h5>Need Help!</h5>
        <h4><a href="tel:(880) 423 456 789" target="_blank">(880) 423 456 789</a></h4>
        <p>Sunday – Thrusday: 9.00am- 12.00pm</p>
        <p>Friday: 11.00am- 12.00pm</p>
        <p><a href="mailto:contact@bedozin.com" target="_blank">contact@bedozin.com</a></p>
    </div>
    <div class="need-links">
        <h5>Information</h5>
        <div class="likat">
            <a href="javascript:void(0)">Returns</a>
            <a href="javascript:void(0)">Delivery Information</a>
            <a href="javascript:void(0)">Privacy Policy</a>
            <a href="javascript:void(0)">Sales</a>
            <a href="javascript:void(0)">Terms & Conditions</a>
        </div>
    </div>
    <div class="emails">
        <h5>Newsletter</h5>
        <p>Sign up and get 15% off your first order</p>
        <div class="sign-form">
            <form action="javascript:save_email(`email_n_form`);" method="POST" id="email_n_form">
                <input type="email" placeholder="Enter your mail.." name="nemail" id="nemail" />
                <button type="submit">
                    <i class="fa-regular fa-envelope"></i>
                </button>
            </form>
        </div>
    </div>
</section>
<div id="ext_code"></div>
<?php
Info::close_conn();
?>