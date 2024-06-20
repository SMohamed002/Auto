<?php
if (session_id() == false || empty(session_id())) {
  session_start();
}
spl_autoload_register(function ($class) {
  if (in_array($class, ["Info", "Tools"])) {
    if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
      require_once './classes/' . $class . '.php';
    } else {
      require_once '../classes/' . $class . '.php';
    }
  }
});
$cats = [];
$fproducts = Info::getQuery("select p.id,
                                    p.name,
                                    c.name cat_name,
                                    p.dose,
                                    p.price,
                                    p.img_path,
                                    p.img_path_p
                                from products p
                              left outer join cats c on p.cat_id = c.id and c.deleted = p.deleted
                              where p.deleted = 'N'
                              order by RAND() 
                              limit 8;");
if (!empty($fproducts) && is_countable($fproducts) && count($fproducts) > 0) {
  foreach ($fproducts as $p) {
    if (!in_array($p['cat_name'], $cats)) {
      $cats[] = $p['cat_name'];
    }
  }
}
$reviews = Info::getQuery("select id,name,stars,msg from rate_us where deleted = 'N' order by RAND() limit 9;");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home | Auto-Pharamcy</title>
  <?php require_once 'pages/h-scripts.php'; ?>
</head>

<body>
  <?php require_once 'pages/header.php' ?>
  <div class="banner">

    <section class="splide" id="home">
      <div class="splide__track">
        <div class="overlay">
          <div class="content">
            <h2>Ultrasonic Nebulizer Equipment</h2>
            <p>Now with special Price -25%</p>
            <div class="btn-shop">
              <a href="/shop/">Shop Now</a>
            </div>
          </div>


          <div class="anomated-image">
            <img src="assets/images/31-18-scaled-removebg-preview (1).png" alt="">
          </div>


          <!-- <div class="social-icons">
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-twitter"></i></a>
            <a href=""><i class="fa-brands fa-whatsapp"></i></a>
          </div> -->
        </div>
        <ul class="splide__list">
          <li class="splide__slide">
            <img src="assets/images/19f637d9-0274-0d70-bf9f-e390a21bea02.jpg" alt="">
          </li>
          <li class="splide__slide">
            <img src="assets/images/apteka.jpg" alt="">
          </li>
          <li class="splide__slide">
            <img src="assets/images/1674800458_top-fon-com-p-fon-dlya-slaidov-v-prezentatsii-meditsina-111.jpg" alt="">
          </li>
          <li class="splide__slide">
            <img src="assets/images/Are-Multivitamins-Good-for-You-5-Harmful-Nutrients.jpg" alt="">
          </li>
        </ul>
      </div>
    </section>

    <hr />

    <section class="products">
      <div class="features-title">
        <h3>Features Products</h3>
        <div class="pages">
          <?php
          foreach ($cats as $c) {
            echo '<a href="/shop/?cat_n=' . $c . '">' . $c . '</a>';
          }
          ?>
        </div>
      </div>
      <div class="products-cart">
        <?php
        foreach ($fproducts as $p) {
          echo '<div class="one-product">
                      <div class="product-image">
                        ' . (!empty($p['img_path']) ? '<img src="' . $p['img_path'] . '" alt="" class="image-home">' : '') . '
                        ' . (!empty($p['img_path_p']) ? '<img src="' . $p['img_path_p'] . '" alt="" class="image-back">' : '') . '
                        <div class="favourite-icons">
                        </div>
                      </div>
                      <div class="product-description">
                        <h5>' . $p['name'] . '</h5>
                        ' . (!empty($p['dose']) ? '<p>' . $p['dose'] . '</p>' : '') . '
                        ' . (!empty($p['p_desc']) ? '<p>' . str_replace(array("\n", "\r", PHP_EOL), '<br/>', $p['p_desc']) . '</p>' : '') . '
                        <div class="one-icon">
                          <span>' . $p['price'] . ' EGP</span>
                          <a href="javascript:add_to_cart(' . $p['id'] . ')"><i class="fa-solid fa-cart-shopping"></i></a>
                        </div>
                      </div>
                    </div>';
        }
        ?>
      </div>
    </section>

    <section class="anther-shop">
      <div class="left-app">
        <div class="left-image">
          <img src="assets/images/banner-5.jpg" alt="">

          <div class="anyher-content">
            <p class="week">WEEKEND OFFERS 50%</p>
            <h5>Popular HealthCare</h5>
            <div class="price">
              <p>289 EGP <span>350 EGP</span></p>
            </div>
            <a href="">Shop Now</a>
          </div>
        </div>
      </div>
      <div class="right-app">
        <div class="right-image">
          <img src="assets/images/apteka.jpg" alt="">
          <div class="anyher-content">
            <p class="week">WEEKEND OFFERS 25%</p>
            <h5>Popular HealthCare</h5>
            <div class="price">
              <p>500 EGP <span>450 EGP</span></p>
            </div>
            <a href="">Shop Now</a>
          </div>
        </div>
      </div>
    </section>

    <hr />

    <section class="products-sliders">
      <div class="product-box">
        <div class="p-image">
          <img src="assets/images/kk.jpg" alt="">
        </div>
        <div class="p-des text-center">
          <p></p>
        </div>
      </div>
      <div class="product-box">
        <div class="p-image">
          <img src="assets/images/vv.jpg" alt="">
        </div>
        <div class="p-des text-center">
          <p></p>
        </div>
      </div>
      <div class="product-box">
        <div class="p-image">
          <img src="assets/images/k.jpg" alt="">
        </div>
        <div class="p-des text-center">
          <p></p>
        </div>
      </div>
      <div class="product-box">
        <div class="p-image">
          <img src="assets/images/l.jpg" alt="">
        </div>
        <div class="p-des text-center">
          <p></p>
        </div>
      </div>
      <div class="product-box">
        <div class="p-image">
          <img src="assets/images/ll.jpg" alt="">
        </div>
        <div class="p-des text-center">
          <p></p>
        </div>
      </div>
    </section>

    <hr />

    <section class="reviews">
      <div class="review-title">
        <i class="fa-solid fa-star-half-stroke"></i>
        <h4>Latest Reviews</h4>
      </div>
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">
          <?php
          foreach ($reviews as $r) {
            $stars = '';
            for ($i = 0; $i < $r['stars']; $i++) {
              $stars .= '<i class="fa-solid fa-star"></i>';
            }
            echo '<div class="swiper-slide">
                    <p>' . str_replace(array("\n", "\r", PHP_EOL), '<br/>', $r['msg']) . '</p>
                    <div class="re-title">
                      <h5>' . $r['name'] . '</h5>
                    </div>
                    <div class="five-stars">
                      ' . $stars . '
                    </div>
                  </div>';
          }
          ?>


        </div>
      </div>
    </section>

    <hr />

    <?php require_once 'pages/footer.php'; ?>

  </div>
  <?php require_once 'pages/f-scripts.php'; ?>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var splide = new Splide(".splide", {
        type: "loop",
        perPage: 1,
        height: "100",
        pagination: false,
        autoplay: true,
        interval: 2000,
      });
      splide.mount();
    });

    var swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      coverflowEffect: {
        rotate: 50,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      pagination: {
        el: ".swiper-pagination",
      },
    });
  </script>
</body>

</html>