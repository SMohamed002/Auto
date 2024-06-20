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
$acc_info = Info::getQuery("select id,govern,city,address,mob,add_mob,notes from clients where id = ? limit 1",["i_". $_SESSION['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Address | Auto-Pharamcy</title>
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
            <h1>My Address</h1>
        </div>
    </section>
    <section class="container-fluid mt-3">
        <form action="javascript:save_data(`save_data`);" id="save_data" name="save_data" method="post">
            <div class="row mt-2">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="govern">Goverment <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['govern'] ?>" type="text" class="form-control" placeholder="Goverment..." id="govern" name="govern" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="city">City <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['city'] ?>" type="text" class="form-control" placeholder="Last Name..." id="city" name="city" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="mob">Mobile <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['mob'] ?>" type="tel" class="form-control" placeholder="Mobile..." id="mob" name="mob" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="add_mob">Additional Mobile</label>
                        <input value="<?php echo $acc_info[0]['add_mob'] ?>" type="tel" class="form-control" placeholder="Additional Mobile..." id="add_mob" name="add_mob" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="address">Address <span class="text-danger">*</span></label>
                        <input value="<?php echo $acc_info[0]['address'] ?>" type="text" class="form-control" placeholder="Address..." id="address" name="address" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" oninput="this.classList.remove(`is-invalid`);" placeholder="Notes..."><?php echo $acc_info[0]['notes'] ?></textarea>
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