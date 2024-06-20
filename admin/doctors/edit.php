<?php require_once '../pages/main.php' ?>
<?php
    $id = isset($_GET['id']) ? strip_tags($_GET['id']): 0;
    if(empty($id) || !is_numeric($id) || $id <= 0){
        echo '<script>window.location = "/admin/doctors/"</script>';
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
    $data = Info::getQuery("select id,
                                name,
                                job_title,
                                img_path,
                                fb_link,
                                x_link,
                                insta_link,
                                wp_link,
                                notes 
                            from doctors 
                        where deleted = 'N' 
                            and id = ?
                        limit 1",["i_".$id]);
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Doctor | Auto Pharmacy CPanel</title>
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
                            Edit Doctor
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="javascript:$('#btn_save').click();" class="btn btn-dark float-end">Save</a>
                            <a href="/admin/doctors/" class="btn btn-light float-end" style="margin-right: 10px;">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <form id="save_data" method="POST" action="javascript:edit_data(`save_data`,<?php echo $id; ?>);" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="doc_name" class="form-control-label">Doctor Name <span class="text-danger">*</span></label>
                                <input value="<?php echo $data[0]['name'] ?>" type="text" id="doc_name" placeholder="Doctor Name..." class="form-control" name="doc_name" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="doc_image" class="form-label">Doctor Image <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="doc_image" name="doc_image" accept="image/*" onchange="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="job_title" class="form-control-label">Job Title <span class="text-danger">*</span></label>
                                <input value="<?php echo $data[0]['job_title'] ?>" type="text" id="job_title" placeholder="Job Title..." class="form-control" name="job_title" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="fb_link" class="form-control-label">Facbook Username</label>
                                <input value="<?php echo $data[0]['fb_link'] ?>" type="text" id="fb_link" placeholder="Facbook Username..." class="form-control" name="fb_link" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="insta_link" class="form-control-label">Instagram Username</label>
                                <input value="<?php echo $data[0]['insta_link'] ?>" type="text" id="insta_link" placeholder="Instagram Username..." class="form-control" name="insta_link" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="x_link" class="form-control-label">X Username</label>
                                <input value="<?php echo $data[0]['x_link'] ?>" type="text" id="x_link" placeholder="X Username..." class="form-control" name="x_link" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="wp_link" class="form-control-label">Whatsapp Number</label>
                                <input value="<?php echo $data[0]['wp_link'] ?>" type="tel" id="wp_link" placeholder="Whatsapp Number..." class="form-control" name="wp_link" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="notes" class="form-control-label">Notes</label>
                                <textarea name="notes" id="notes" rows="3" placeholder="Notes..." class="form-control" oninput="this.classList.remove(`is-invalid`);"><?php echo $data[0]['notes'] ?></textarea>
                            </div>
                        </div>
                        <input type="submit" class="d-none" />
                    </form>
                </div>
                <div class="card-footer text-muted">
                    <button type="button" onclick="$('#save_data').submit();" class="btn btn-dark float-end" id="btn_save">Save</button>
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