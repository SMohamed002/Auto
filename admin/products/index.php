<?php require_once '../pages/main.php' ?>
<?php
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info", "Tools"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once '../classes/' . $class . '.php';
        } else {
            require_once '../../classes/' . $class . '.php';
        }
    }
});
$data = Info::getQuery("select p.id,
                                p.name,
                                c.name cat_name,
                                p.actv_ing,
                                p.p_desc,
                                p.dose,
                                p.price,
                                if(p.qty is null or p.qty = '',0,p.qty) qty,
                                p.img_path,
                                p.img_path_p,
                                p.notes,
                                date_format(p.created_at, '%d/%m/%Y %r') as created_at,
                                date_format(p.updated_at, '%d/%m/%Y %r') as updated_at 
                            from products p
                        left outer join cats c on p.cat_id = c.id and c.deleted = p.deleted
                        where p.deleted = 'N' 
                        order by p.id desc");
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Auto Pharmacy CPanel</title>
    <?php require_once '../pages/h-scripts.php' ?>
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php require_once '../pages/header.php' ?>
    <main class="flex-shrink-0">
        <div class="container-fluid mt-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8 col-md-8 align-self-center">
                        Products
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="add.php" class="btn btn-dark float-end">Add New Product</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tbl_data" class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Category</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Active Ingredient</th>
                                <th class="text-center">Product Description</th>
                                <th class="text-center">Dose</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Main Image</th>
                                <th class="text-center">Second Image</th>
                                <th class="text-center">Notes</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Last Updated At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($data) && is_countable($data) && count($data) > 0) {
                                foreach ($data as $row) {
                                    echo '<tr>
                                                            <td>' . $row['id'] . '</td>
                                                            <td>' . $row['cat_name'] . '</td>
                                                            <td>' . $row['name'] . '</td>
                                                            <td>' . $row['actv_ing'] . '</td>
                                                            <td>' . $row['p_desc'] . '</td>
                                                            <td>' . $row['dose'] . '</td>
                                                            <td>' . $row['price'] . ' EGP</td>
                                                            <td>' . $row['qty'] . '</td>
                                                            <td>' . (!empty($row['img_path']) ? '<img src="' . $row['img_path'] . '" width="100px" height="100px" onclick="window.open(this.src);">' : '') . '</td>
                                                            <td>' . (!empty($row['img_path_p']) ? '<img src="' . $row['img_path_p'] . '" width="100px" height="100px" onclick="window.open(this.src);">' : '') . '</td>
                                                            <td>' . $row['notes'] . '</td>
                                                            <td>' . $row['created_at'] . '</td>
                                                            <td>' . $row['updated_at'] . '</td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <button type="button" class="btn btn-sm btn-warning" onclick="window.location.href = `edit.php?id=' . $row['id'] . '`">Edit</button>
                                                                    <button type="button" class="ml-2 btn btn-sm btn-danger" onclick="delete_row(' . $row['id'] . ');">Delete</button>
                                                                </div>
                                                            </td>
                                                        </tr>';
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <?php require_once '../pages/footer.php' ?>
    <?php require_once '../pages/f-scripts.php' ?>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>
    <script src="main.js"></script>
    <script>
        $("#products_link").addClass('active');
        $("#tbl_data").DataTable({
            responsive: true,
            fixedHeader: true,
            columnDefs: [{
                targets: [13],
                orderable: false,
                searchable: false
            }],
            order: [0, 'desc']
        });
    </script>
</body>

</html>