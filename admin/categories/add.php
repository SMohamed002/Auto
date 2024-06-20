<?php require_once '../pages/main.php' ?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Categories | Auto Pharmacy CPanel</title>
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
                            Add Category
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="javascript:$('#btn_save').click();" class="btn btn-dark float-end">Save</a>
                            <a href="/admin/categories/" class="btn btn-light float-end" style="margin-right: 10px;">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="save_data" method="POST" action="javascript:add_data(`save_data`);">
                        <div class="row">
                            <div class="col-12">
                                <label for="cat_name" class="form-control-label">Category Name <span class="text-danger">*</span></label>
                                <input type="text" id="cat_name" placeholder="Category Name..." class="form-control" name="cat_name" autofocus="" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="notes" class="form-control-label">Notes</label>
                                <textarea name="notes" id="notes" rows="3" placeholder="Notes..." class="form-control" oninput="this.classList.remove(`is-invalid`);"></textarea>
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