<?php require_once '../pages/main.php' ?>
<?php
    spl_autoload_register(function ($class) {
        if (in_array($class, ["Info"])) {
            if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
                require_once '../classes/' . $class . '.php';
            } else {
                require_once '../../classes/' . $class . '.php';
            }
        }
    });
    $data = Info::getQuery("SELECT id,
                                    username,
                                    email,
                                    phone,
                                    notes
                                FROM users u
                            WHERE u.deleted = 'N'
                            LIMIT 1");
?>
<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Account Info | Auto Pharmacy CPanel</title>
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
                            Account Info
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="javascript:$('#btn_save').click();" class="btn btn-dark float-end">Save</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="save_data" method="POST" action="javascript:edit_data(`save_data`);" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="username" class="form-control-label">Username <span class="text-danger">*</span></label>
                                <input value="<?php echo $data[0]['username'] ?>" type="text" id="username" placeholder="Username..." class="form-control" name="username" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                                <input value="<?php echo $data[0]['email'] ?>" type="email" id="email" placeholder="Username..." class="form-control" name="email" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="phone" class="form-control-label">Phone</label>
                                <input value="<?php echo $data[0]['phone'] ?>" type="tel" id="phone" placeholder="Phone..." class="form-control" name="phone" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="old_pwd" class="form-control-label">Old Password</label>
                                <input type="password" id="old_pwd" placeholder="Old Password..." class="form-control" name="old_pwd" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="new_pwd" class="form-control-label">New Password</label>
                                <input type="password" id="new_pwd" placeholder="New Password..." class="form-control" name="new_pwd" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="new_cpwd" class="form-control-label">Confirm Password</label>
                                <input type="password" id="new_cpwd" placeholder="Confirm Password..." class="form-control" name="new_cpwd" oninput="this.classList.remove(`is-invalid`);" />
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