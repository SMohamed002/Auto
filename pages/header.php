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
$count_cart = $count_wishlist = 0;
if(isset($_SESSION['client_id']) && !empty($_SESSION['client_id']) && is_numeric($_SESSION['client_id']) && $_SESSION['client_id'] > 0) {
  $count_data = Info::getQuery("select count(id) cnt from cart where client_id = ? and deleted = 'N'
                  union all 
                  select count(id) cnt from wishlist where client_id = ? and deleted = 'N'", ["i_".$_SESSION['client_id'],"i_".$_SESSION['client_id']]);
  $count_cart = $count_data[0]['cnt'];
  $count_wishlist = $count_data[1]['cnt'];
}
?>
<header>
  <div class="top-header">
    <div class="header-container d-flex justify-content-between align-items-center">
      <div class="paraghraph">
        <p>Express Delivery: Bringing Quality Medications To Your Doorstep</p>
      </div>
      <div class="location-contact d-flex">
        <div class="location d-flex">
          <i class="fa-solid fa-location-arrow"></i>
          <p>Store Location</p>
        </div>
        <div class="contact">
          <p>Need to help?:</p>
          <p>+(880) 423 456 789</p>
        </div>
      </div>
    </div>
  </div>

  <hr />

  <div class="bottom-header d-flex align-items-center justify-content-around">
    <div class="logo">
      <img src="/assets/images/png-transparent-pharmacist-pharmacy-health-care-bowl-of-hygieia-pharmacy-logo-removebg-preview.png" alt="main logo">
    </div>
    <div class="menu" id="main-header">
      <a href="/" class="menuea">Home</a>
      <a href="/shop/" class="menuea">Shop</a>
      <a href="/about/" class="menuea">About Us</a>
      <a href="/contact/" class="menuea">Contact Us</a>
      <a href="/rate/" class="menuea">Rate Us</a>
      <?php
      if (isset($_SESSION['client_id']) && !empty($_SESSION['client_id'])) {
        echo '<a href="javascript:logout();" class="menuea">Logout</a>';
      }
      ?>
    </div>
    <div class="search-bar d-flex">
      <form method="get" action="/shop/">
        <input type="search" name="search" placeholder="Search for any product..." />
        <button type="submit" class="search-btn">
          <div class="search-icon">
            <i class="fa-solid fa-magnifying-glass"></i>
          </div>
        </button>
      </form>
    </div>
    <div class="icons">
      <div class="profile">
        <a href="/profile/"> <i class="fa-regular fa-user"></i></a>
      </div>
      <div class="favorite">
        <a href="/wishlist/"><i class="fa-solid fa-heart"></i></a>
        <div class="cart-nomber">
          <p><?php echo $count_wishlist; ?></p>
        </div>

      </div>
      <div class="cart">
        <a href="/cart/"><i class="fa-solid fa-cart-shopping"></i></a>
        <div class="cart-nomber">
        <p><?php echo $count_cart; ?></p>
        </div>
      </div>
    </div>
  </div>
</header>
<br />
<div id="ext_code"></div>