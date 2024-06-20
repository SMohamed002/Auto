<?php require_once './pages/main.php' ?>
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
$counts = Info::getQuery("SELECT count(id) cc FROM products WHERE deleted = 'N'
                            UNION ALL 
                            SELECT count(id) cc FROM orders_hd WHERE deleted = 'N' and cncld = 'N'
                            UNION ALL 
                            SELECT count(id) cc FROM orders_hd WHERE deleted = 'N' and cncld = 'Y'
                            UNION ALL 
                            SELECT count(id) cc FROM clients WHERE deleted = 'N'
                            UNION ALL
                            SELECT sum(od.price*od.qty) cc
                                FROM orders_dt od,orders_hd oh 
                            WHERE od.deleted = oh.deleted 
                                AND oh.cncld = 'N'
                                AND oh.deleted = 'N'
                            UNION ALL
                            SELECT ifnull(sum(od.price*od.qty),0) cc
                                FROM orders_dt od,orders_hd oh 
                            WHERE od.deleted = oh.deleted 
                                AND oh.cncld = 'Y'
                                AND oh.deleted = 'N'
                            UNION ALL
                            SELECT count(id) cc FROM doctors WHERE deleted = 'N'
                            UNION ALL
                            SELECT count(id) cc FROM rate_us WHERE deleted = 'N'
                            UNION ALL
                            SELECT count(id) cc FROM contact_us WHERE deleted = 'N'
                            ");
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page | Auto Pharmacy CPanel</title>
    <?php require_once './pages/h-scripts.php' ?>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php require_once './pages/header.php' ?>
    <main class="flex-shrink-0">
        <section class="p-3">
            <div class="row mb-3">
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Products</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[0]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-box fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Doctors</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[6]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Reviews</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[7]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-star-half fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Contact Us</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[8]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person-lines-fill fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Sales</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[4]['cc']; ?> EGP</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-truck fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Cancelled Orders</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo '(' . $counts[2]['cc'] . ') / ' . $counts[5]['cc']; ?> EGP</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Clients</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[3]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-person fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card widget-card border-light shadow-sm">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-8">
                                    <h5 class="card-title widget-card-title mb-3">Orders</h5>
                                    <h4 class="card-subtitle text-body-secondary m-0"><?php echo $counts[1]['cc']; ?></h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-cart fs-4"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php require_once './pages/footer.php' ?>
    <?php require_once './pages/f-scripts.php' ?>
    <script>
        $("#home_link").addClass('active');
    </script>
</body>

</html>