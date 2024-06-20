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
$p_info = Info::getQuery("select id,file_name,file_path,date_format(created_at,'%d/%m/%Y %r') created_at,notes,is_ordered,is_done from prescriptions where deleted = 'N'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Prescriptions | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/contact.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="contactUs">
        <div class="contact-image">
            <img src="/assets/images/bg-breadcrumb.jpg" alt="">
        </div>
        <div class="contact-head">
            <h1>My Prescriptions</h1>
        </div>
    </section>
    <section class="container-fluid mt-3">
        <form action="javascript:save_data(`save_data`);" id="save_data" name="save_data" method="post">
            <div class="row mt-2">
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="form-group">
                        <label for="doc_image">Prescription Image <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="doc_image" name="doc_image" />
                                <label class="custom-file-label" for="doc_image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea id="notes" name="notes" placeholder="Notes..." class="form-control" rows="1" oninput="this.classList.remove(`is-invalid`);"></textarea>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-2 align-content-center">
                    <button type="submit" class="btn btn-dark">Save</button>
                </div>
            </div>
        </form>
    </section>
    <section class="container-fluid mt-3">
        <div class="row">
            <?php
            $cntr = 0;
            foreach ($p_info as $p) {
                // '.($p['is_ordered'] == 'Y' ? '' : '<button class="btn btn-success" onclick="ordr_prescription(' . $p['id'] . ');">Order</button>').'
                // '.($p['is_ordered'] == 'Y' && $p['is_done'] == 'N' ? '<button class="btn btn-info" onclick="cncl_prescription(' . $p['id'] . ');">Cancel Order</button>' : '').'
                echo '<div class="col-md-4">
                            <div class="card mb-4 shadow-sm">
                                <img src="' . $p['file_path'] . '" alt="P Image" style="max-width:420px;max-height:235px"/>
                                <div class="card-body">
                                    <p class="card-text">' . str_replace(array("\n", "\r", PHP_EOL), '<br/>', $p['notes']) . '</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <small>' . $p['file_name'] . '</small>
                                        </div>
                                        <small class="text-muted">' . $p['created_at'] . '</small>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted" id="img_txt_'.++$cntr.'"></span>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-success" onclick="get_prescription('.$cntr.',`'.$p['file_path'].'`);">Get</button>
                                    <a class="btn btn-light" download href="'.$p['file_path'].'" target="_blank">Download</a>
                                    <button class="btn btn-danger" onclick="rm_prescription(' . $p['id'] . ');">Delete</button>
                                </div>
                            </div>
                        </div>';
            }
            ?>
        </div>
    </section>

    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="main.js"></script>
</body>

</html>