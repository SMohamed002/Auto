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
$data = Info::getQuery("select id,
                                concat(f_name,' ',l_name) name,
                                username,
                                email,
                                phone,
                                govern,
                                city,
                                address,
                                mob,
                                add_mob,
                                blocked,
                                date_format(created_at, '%d/%m/%Y %r') as created_at
                            from clients  
                        where deleted = 'N' 
                        order by id desc");
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clients | Auto Pharmacy CPanel</title>
    <?php require_once '../pages/h-scripts.php' ?>
    <link href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.2/css/responsive.bootstrap5.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.bootstrap5.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">
    <?php require_once '../pages/header.php' ?>
    <main class="flex-shrink-0">
        <div class="container-fluid mt-3 mb-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 align-self-center">
                            Clients
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="tbl_data" class="table table-striped table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Government</th>
                                <th class="text-center">City</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Additional Mobile</th>
                                <th class="text-center">Blocked</th>
                                <th class="text-center">Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($data) && is_countable($data) && count($data) > 0) {
                                foreach ($data as $row) {
                                    echo '<tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['name'] . '</td>
                                            <td>' . $row['username'] . '</td>
                                            <td>' . $row['email'] . '</td>
                                            <td>' . $row['phone'] . '</td>
                                            <td>' . $row['govern'] . '</td>
                                            <td>' . $row['city'] . '</td>
                                            <td>' . $row['address'] . '</td>
                                            <td>' . $row['mob'] . '</td>
                                            <td>' . $row['add_mob'] . '</td>
                                            <td>' . ($row['blocked'] == 'Y' ? '<span class="text-danger">Blocked</span>' : '') . '</td>
                                            <td>' . $row['created_at'] . '</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    '.($row['blocked'] == 'N' ? '<button type="button" class="ml-2 btn btn-sm btn-danger" onclick="delete_row(' . $row['id'] . ');">Block</button>' : '').'
                                                    '.($row['blocked'] == 'Y' ? '<button type="button" class="ml-2 btn btn-sm btn-light" onclick="unblock(' . $row['id'] . ');">Un Block</button>' : '').'
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
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="main.js"></script>
    <script>
        $("#clients_link").addClass('active');
        $("#tbl_data").DataTable({
            // dom: 'Blfrtip',
            responsive: true,
            fixedHeader: true,
            // layout: {
            //     topStart: {
            //         buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            //     }
            // },
            columnDefs: [{
                targets: [12],
                orderable: false,
                searchable: false
            }],
            order: [0, 'desc']
        });
    </script>
</body>

</html>