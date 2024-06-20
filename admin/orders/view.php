<?php require_once '../pages/main.php' ?>
<?php
$id = isset($_GET['id']) ? strip_tags($_GET['id']) : 0;
if (empty($id) || !is_numeric($id) || $id <= 0) {
    echo '<script>window.location = "/admin/orders/"</script>';
    die();
}
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once '../classes/' . $class . '.php';
        } else {
            require_once '../../classes/' . $class . '.php';
        }
    }
});
$data = Info::getQuery("select oh.id,
                                date_format(oh.doc_date,'%d/%m/%Y') as doc_date,
                                oh.payer,
                                oh.govern,
                                oh.city,
                                oh.mob,
                                oh.add_mob,
                                oh.cncld,
                                oh.address,
                                concat(c.id,' - ',c.f_name,' ',c.l_name) client,
                                od.item_name,
                                od.price,
                                od.qty 
                            from orders_hd oh
                        left join orders_dt od on od.hd_id = oh.id and od.deleted = oh.deleted
                        left join clients c on oh.client_id = c.id and c.deleted = oh.deleted
                        where oh.deleted = 'N' 
                            and oh.id = ?", ["i_" . $id]);
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Order | Auto Pharmacy CPanel</title>
    <?php require_once '../pages/h-scripts.php' ?>
</head>

<body class="d-flex flex-column h-100">
    <?php require_once '../pages/header.php' ?>
    <main class="flex-shrink-0">
        <div class="container-fluid mt-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 align-self-center">
                            View Order
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="/admin/orders/" class="btn btn-light float-end" style="margin-right: 10px;">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <strong>#</strong><?php echo $data[0]['id']; ?>
                        </div>
                        <div class="col-md-4">
                            <strong>Date:</strong> <?php echo $data[0]['doc_date']; ?>
                        </div>
                        <div class="col-md-3">
                            <strong>Client:</strong> <?php echo $data[0]['client']; ?>
                        </div>
                        <div class="col-md-3">
                            <strong>Status:</strong> <?php echo ($data[0]['cncld'] == 'Y' ? '<span class="badge bg-danger">Cancelled</span>' : '<span class="badge bg-success">Active</span></span>'); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Name:</strong> <?php echo $data[0]['payer']; ?>
                        </div>
                        <div class="col-md-4">
                            <strong>Mobile:</strong> <?php echo $data[0]['mob']; ?>
                        </div>
                        <div class="col-md-4">
                            <strong>Additional Mobile:</strong> <?php echo $data[0]['add_mob']; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Government:</strong> <?php echo $data[0]['govern']; ?>
                        </div>
                        <div class="col-md-4">
                            <strong>City:</strong> <?php echo $data[0]['city']; ?>
                        </div>
                        <div class="col-md-4">
                            <strong>Address:</strong> <?php echo $data[0]['address']; ?>
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
                            <?php
                                $totals = 0;
                                foreach($data as $d){
                                    $total = ((double)$d['price']*(double)$d['qty']);
                                    echo '<tr>
                                                <td>' . $d['item_name'] . '</td>
                                                <td>' . $d['qty'] . '</td>
                                                <td>' . $d['price'] . ' EGP</td>
                                                <td>' . $total . ' EGP</td>
                                            </tr>';
                                    $totals += $total;
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                            <td colspan="3"></td>
                            <td><?php echo $totals; ?> EGP</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php require_once '../pages/footer.php' ?>
    <?php require_once '../pages/f-scripts.php' ?>
    <script src="main.js"></script>
    <script>
        $("#doc_link").addClass('active');
    </script>
</body>

</html>