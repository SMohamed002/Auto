<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    if(isset($_POST['url']) && !empty($_POST['url'])){
        $_SESSION['furl'] = $_POST['url'];
    }
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
$acc_info = Info::getQuery("select id,f_name,l_name,username,email,phone,notes from clients where id = ? limit 1",["i_". $_SESSION['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | Auto-Pharamcy</title>
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
            <h1>My Account</h1>
        </div>
    </section>
    <section class="container-fluid mt-3">
        <form action="javascript:save_data(`save_data`);" id="save_data" name="save_data" method="post">
            <div class="row mt-2">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="fname">First Name <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['f_name'] ?>" type="text" class="form-control" placeholder="First Name..." id="fname" name="fname" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="lname">Last Name <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['l_name'] ?>" type="text" class="form-control" placeholder="Last Name..." id="lname" name="lname" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="username">Username <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['username'] ?>" type="text" class="form-control" placeholder="Username..." id="username" name="username" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['email'] ?>" type="email" class="form-control" placeholder="Email..." id="email" name="email" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="phone">Phone <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['phone'] ?>" type="tel" class="form-control" placeholder="Phone..." id="phone" name="phone" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="old_pass">Old Password</label>
                        <input type="password" class="form-control" placeholder="Old Password..." id="old_pass" name="old_pass" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="n_pass">New Password</label>
                        <input type="password" class="form-control" placeholder="New Password..." id="n_pass" name="n_pass" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                    <label for="cn_pass">Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password..." id="cn_pass" name="cn_pass" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <button type="submit" class="btn btn-dark">Save</button>
                </div>
            </div>
        </form>
    </section>

    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="main.js"></script>
</body>

</html>