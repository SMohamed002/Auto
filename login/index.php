<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (isset($_SESSION['client_id']) && !empty($_SESSION['client_id']) && is_numeric($_SESSION['client_id']) && $_SESSION['client_id'] > 0) {
    echo '<script>window.location.href="/profile";</script>';
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign Up | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/signin.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="login-register">
        <div class="form-box">
            <!-- login form -->
            <form class="login-container" id="login_form" method="get" name="login_form" action="javascript:clogin(`login_form`);">
                <div class="top">
                    <span>don't have an account? <a href="javascript:void(0);" onclick="register()">Sign Up</a></span>
                    <header class="sign-title">Login</header>
                </div>
                <div class="input-box">
                    <div class="input-icon">
                        <input type="text" class="input-field" placeholder="Username or email" name="email" id="email" autocomplete="off" autofocus="">
                        <i class="fa-regular fa-user user-login"></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-icon">
                        <input type="password" class="password-field" placeholder="Password" name="password" id="password">
                        <i class="fa fa-lock user-login"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Sign In">
                </div>
            </form>


            <form class="register-container" id="sign_up_form" method="get" name="sign_up_form" action="javascript:cregister(`sign_up_form`);">
                <div class="top">
                    <span>Have an account? <a href="javascript:void(0);" onclick="login()">Login</a></span>
                    <header class="sign-title">Sign Up</header>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <div class="input-icon">
                            <input type="text" class="input-field" placeholder="Firstname" id="firstname" name="firstname" autocomplete="off" required>
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                    <div class="input-box">
                        <div class="input-icon">
                            <input type="text" class="input-field" placeholder="Lastname" id="lastname" name="lastname" autocomplete="off" required>
                            <i class="fa-regular fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-icon">
                        <input type="email" class="input-field" name="email" placeholder="Email" id="emailUp" required>
                        <i class="fa-regular fa-envelope user-login"></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-icon">
                        <input type="text" class="input-field" name="username" placeholder="Username" id="username" required>
                        <i class="fa-regular fa-user user-login"></i>
                    </div>
                </div>
                <div class="input-box">
                    <div class="input-icon">
                        <input type="password" name="password" class="input-field" placeholder="Password" id="passwordUp" required>
                        <i class="fa fa-lock user-login"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register">
                </div>
            </form>
        </div>
    </section>

    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/sign.js"></script>
</body>

</html>