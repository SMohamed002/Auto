<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    $_SESSION['furl'] = "/profile/";
    echo '<script>window.location.href="/login";</script>';
    die();
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
$data = Info::getQuery("select id,concat(f_name,' ',l_name) name from clients where deleted = 'N' and id = ?", ["i_" . $_SESSION['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/profile.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <div class="container-fluid mb-5">
        <div class="profile-container">
            <div class="profile-name">
                <p>Hello <?php echo $data[0]['name']; ?><span id="profileName"></span><span class="heart"><i class="fa-solid fa-heart"></i></span></p>
            </div>
            <div class="profile-cookies">
                <p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.</p>
            </div>
            <div class="user-information">
                <a class="user-box" href="/account/">
                    <i class="fa-regular fa-user"></i>
                    <p>Account Details</p>
                </a>
                <a class="user-box" href="/address/">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>Address</p>
                </a>
                <a class="user-box" href="/orders/">
                    <i class="fa-solid fa-box-open"></i>
                    <p>Orders</p>
                </a>
                <a class="user-box" href="/prescription/">
                    <i class="fa-solid fa-upload"></i>
                    <p>Prescription</p>
                </a>
                <a class="user-box" href="/wishlist/">
                    <i class="fa-solid fa-heart"></i>
                    <p>Wishlist</p>
                </a>
                <a class="user-box" href="javascript:logout();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Log out</p>
                </a>
            </div>
        </div>
    </div>
    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/profile.js"></script>
</body>

</html>