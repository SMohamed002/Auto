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
$data = Info::getQuery("select id,
                                name,
                                job_title,
                                img_path,
                                fb_link,
                                x_link,
                                insta_link,
                                wp_link,
                                notes,
                                date_format(created_at, '%d/%m/%Y %r') as created_at,
                                date_format(updated_at, '%d/%m/%Y %r') as updated_at 
                            from doctors 
                        where deleted = 'N' 
                        order by id desc");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/about.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="about-image">
        <img src="/assets/images/GettyImages-1151915829-[Converted].jpg" alt="">
        <div class="overlay">
            <h1>About Us</h1>
        </div>
    </section>
    <section class="home-medicine">
        <div class="medicine-title">
            <h2>Your home medical provider now also online!</h2>
        </div>
        <div class="about-des">
            <div class="des-image">
                <img src="/assets/images/iStock-962094986.jpg" alt="">
            </div>
            <div class="describtion">
                <h4>Why Are We The Most Preferred Online Pharmacy?</h4>
                <p>Lucrative offers on our platform allow you to make payment online and via various payment wallets at a discounted price. Alternatively, you can also choose to pay cash on delivery as we deliver the products at your doorstep. We cater to all your pharmaceutical needs and also make ordering medicines online a hassle-free experience for you.</p>
                <div class="list">
                    <div class="one-list">
                        <div class="list-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p>Certificate 2000 professional care.</p>
                    </div>
                    <div class="one-list">
                        <div class="list-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p>Certificate 2000 professional care.</p>
                    </div>
                    <div class="one-list">
                        <div class="list-icon">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <p>Certificate 2000 professional care.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="Explore">
        <img src="/assets/images/Depositphotos_23805509_XL-scaled.jpg" alt="">
        <div class="over-lay">

        </div>
    </section>
    <section class="target">
        <div class="target-title">
            <h3>Our target market</h3>
        </div>
        <div class="target-acco">
            <div class="counter">
                <h3>
                    <radwa id="counter1">120</radwa> <span>+</span>
                </h3>
                <p>Stores around the world</p>
            </div>
            <div class="counter">
                <h3>
                    <radwa id="counter2">15</radwa> <span>M</span>
                </h3>
                <p>Products sold till date</p>
            </div>
            <div class="counter">
                <h3>
                    <radwa id="counter3">200</radwa> <span>K</span>
                </h3>
                <p>Registered users</p>
            </div>
            <div class="counter">
                <h3>
                    <radwa id="counter4">300</radwa> <span>+</span>
                </h3>
                <p>Brands available in store</p>
            </div>
        </div>
    </section>
    <section class="brands">
        <div class="brnd-box">
            <div class="the-brand">
                <img src="/assets/images/brand-6.png" alt="">
            </div>
        </div>
        <div class="brnd-box">
            <div class="the-brand">
                <img src="/assets/images/brand-1.png" alt="">
            </div>
        </div>
        <div class="brnd-box">
            <div class="the-brand">
                <img src="/assets/images/brand-5.png" alt="">
            </div>
        </div>
        <div class="brnd-box">
            <div class="the-brand">
                <img src="/assets/images/brand-2.png" alt="">
            </div>
        </div>
    </section>
    <section class="the-describtion">
        <h4>About Our Store</h4>
        <h5>Since 1985, we’re creating the awesome products & promise to give high quality in the eCommerce market for all our customers
            residing any part of the world.</h5>
        <p>Bedozin is a consumer healthcare “super app” that provides consumers with on-demand, home delivered access to a wide range of prescription, OTC pharmaceutical,
            other consumer healthcare products, comprehensive diagnostic test services, and teleconsultations thereby serving their healthcare needs. Bedozin delivers reliable
            and accurate medical information that has been carefully written, vetted and validated by our health experts. Our specialists curate high-quality and most reliable
            literature about medicines, illnesses, lab tests, Ayurvedic and over the counter health products.</p>

    </section>
    <section class="doctors">
        <?php
            if (!empty($data) && is_countable($data) && count($data) > 0) {
                foreach ($data as $row) {
                    echo '<div class="doctor-box">
                                <div class="doc-image">
                                    <img src="'.$row['img_path'].'" alt="">
                                    <div class="socialM">
                                        '.(!empty($row['fb_link']) ? '<a target="_blank" href="https://facebook.com/'.$row['fb_link'].'"><i class="fa-brands fa-facebook"></i></a>' : '').'
                                        '.(!empty($row['insta_link']) ? '<a target="_blank" href="https://instagram.com/'.$row['insta_link'].'"><i class="fa-brands fa-instagram"></i></a>' : '').'
                                        '.(!empty($row['x_link']) ? '<a target="_blank" href="https://x.com/'.$row['x_link'].'"><i class="fa-brands fa-twitter"></i></a>' : '').'
                                        '.(!empty($row['wp_link']) ? '<a target="_blank" href="https://wa.me/'.$row['wp_link'].'"><i class="fa-brands fa-whatsapp"></i></a>' : '').'
                                    </div>
                                </div>
                                <div class="doc-des">
                                    <h5>'.$row['name'].'</h5>
                                    <p>'.$row['job_title'].'</p>
                                </div>
                            </div>';
                }
            }
        ?>
    </section>
    <hr />
    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script>
        function startSlowCounter(id, endValue, interval) {
            let counter = 0;
            const element = document.getElementById(id);

            function updateCounter() {
                element.innerText = counter;
                counter++;
                if (counter <= endValue) {
                    setTimeout(updateCounter, interval);
                }
            }
            updateCounter();
        }
        // Adjust interval (in milliseconds) for a slower counting speed
        const slowInterval = 500;
        startSlowCounter('counter1', 120);
        startSlowCounter('counter2', 15);
        startSlowCounter('counter3', 200);
        startSlowCounter('counter4', 300);
    </script>
</body>

</html>