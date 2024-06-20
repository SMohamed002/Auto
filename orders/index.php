<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    if (isset($_POST['url']) && !empty($_POST['url'])) {
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
$orders = Info::getQuery("select id,
                                date_format(doc_date,'%d/%m/%Y') doc_date,
                                payer,
                                govern,
                                city,
                                mob,
                                add_mob,
                                cncld,
                                address 
                                from orders_hd 
                            where deleted = 'N' 
                                and client_id = ? ", ["i_" . $_SESSION['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders | Auto-Pharamcy</title>
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
            <h1>My Orders</h1>
        </div>
    </section>
    <section class="container-fluid mt-3">
        <div class="accordion" id="accordions">
            <?php
            $cntr = 0;
            foreach ($orders as $o) {
                $dt = Info::getQuery("select item_name,qty,price from orders_dt where hd_id = ? and deleted = 'N'", ["i_" . $o['id']]);
                $tbdy = '';
                $totals = 0;
                foreach($dt as $d){
                    $total = ((double)$d['price']*(double)$d['qty']);
                    $tbdy .= '<tr>
                                <td>' . $d['item_name'] . '</td>
                                <td>' . $d['qty'] . '</td>
                                <td>' . $d['price'] . ' EGP</td>
                                <td>' . $total . ' EGP</td>
                            </tr>';
                    $totals += $total;
                }
                echo '<div class="card">
                            <div class="card-header" id="heading_' . $cntr . '">
                                <h2 class="mb-0">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <button class="btn btn-light" type="button" data-toggle="collapse" data-target="#collapse_' . $cntr . '" aria-expanded="true">
                                                # ' . $o['id'] . ' - ' . $o['doc_date'] . ($o['cncld'] == 'Y' ? ' - <span class="text-danger">Canceled</span>' : '') . '
                                            </button>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            '.($o['cncld'] == 'N' ? '<button class="btn btn-danger" type="button" onclick="cncl_ordr('.$o['id'].');">Cancel Order</button>' : '').'
                                        </div>
                                    </div>
                                </h2>
                            </div>
                            <div id="collapse_' . $cntr . '" class="collapse" aria-labelledby="heading_' . $cntr . '" data-parent="#accordions">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Name:</strong> ' . $o['payer'] . '
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Mobile:</strong> ' . $o['mob'] . '
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Additional Mobile:</strong> ' . $o['add_mob'] . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>Government:</strong> ' . $o['govern'] . '
                                        </div>
                                        <div class="col-md-4">
                                            <strong>City:</strong> ' . $o['city'] . '
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Address:</strong> ' . $o['address'] . '
                                        </div>
                                    </div>
                                    <table class="table table-bordered table-hover table-striped text-center mt-2">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Product</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            '.$tbdy.'
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <td colspan="3"></td>
                                            <td>'.$totals.' EGP</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>';
                $cntr++;
            }
            ?>
        </div>
    </section>

    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <script src="/assets/js/main.js"></script>
    <script src="main.js"></script>
</body>

</html>