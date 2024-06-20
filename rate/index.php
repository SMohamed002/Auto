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
    <title>Rate Us | Auto-Pharamcy</title>
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
            <h1>Rate Us</h1>
        </div>
    </section>
    <section class="container-fluid mt-3">
        <form action="javascript:rate_us(`rate_form`);" id="rate_form" name="rate_form" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="name">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Name..." id="name" name="name" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="stars">Stars <span class="text-danger">*</span></label>
                        <select class="form-control" id="stars" name="stars">
                            <option disabled>Choose...</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option selected>5</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="form-group">
                        <label for="comment">Comment <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Comment..." oninput="this.classList.remove(`is-invalid`);"></textarea>
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
</body>

</html>