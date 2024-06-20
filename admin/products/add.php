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
$cats = Info::getQuery("select id,name from cats where deleted = 'N'");
?>
<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Products | Auto Pharmacy CPanel</title>
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
                            Add Products
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-4">
                            <a href="javascript:$('#btn_save').click();" class="btn btn-dark float-end">Save</a>
                            <a href="/admin/products/" class="btn btn-light float-end" style="margin-right: 10px;">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="save_data" method="POST" action="javascript:add_data(`save_data`);" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-12">
                                <label for="cat_id" class="form-control-label">Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="cat_id" name="cat_id" autofocus="" onchange="this.classList.remove(`is-invalid`);" required">
                                    <option disabled selected>Choose Category...</option>
                                    <?php
                                    if (!empty($cats) && is_countable($cats) && count($cats) > 0) {
                                        foreach ($cats as $cat) {
                                            echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="p_name" class="form-control-label">Product Name <span class="text-danger">*</span></label>
                                <input type="text" id="p_name" placeholder="Product Name..." class="form-control" name="p_name" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="actv_ing" class="form-control-label">Active Ingredient</label>
                                <input type="text" id="actv_ing" placeholder="Active Ingredient..." class="form-control" name="actv_ing" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="dose" class="form-control-label">Dose</label>
                                <input type="text" id="dose" placeholder="Dose..." class="form-control" name="dose" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="p_desc" class="form-control-label">Product Description</label>
                                <textarea name="p_desc" id="p_desc" rows="3" placeholder="Product Description..." class="form-control" oninput="this.classList.remove(`is-invalid`);"></textarea>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="price" class="form-control-label">Price <span class="text-danger">*</span></label>
                                <input type="number" step="any" min="0" id="price" placeholder="Price..." class="form-control" name="price" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="qty" class="form-control-label">Quantity <span class="text-danger">*</span></label>
                                <input type="number" step="any" min="0" id="qty" placeholder="Quantity..." class="form-control" name="qty" oninput="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="m_image" class="form-label">Main Image <span class="text-danger">*</span></label>
                                <input class="form-control" type="file" id="m_image" name="m_image" accept="image/*" onchange="this.classList.remove(`is-invalid`);" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <label for="sec_image" class="form-label">Second Image</label>
                                <input class="form-control" type="file" id="sec_image" name="sec_image" accept="image/*" onchange="this.classList.remove(`is-invalid`);" />
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
        $("#products_link").addClass('active');
    </script>
</body>

</html>