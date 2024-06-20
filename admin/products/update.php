<?php
if (session_id() == false || empty(session_id())) {
    session_start();
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
$id = isset($_POST['id']) ? strip_tags($_POST['id']) : 0;
$cat_id = isset($_POST['cat_id']) ? strip_tags($_POST['cat_id']) : "";
$p_name = strip_tags($_POST['p_name']);
$actv_ing = strip_tags($_POST['actv_ing']);
$dose = strip_tags($_POST['dose']);
$p_desc = strip_tags($_POST['p_desc']);
$price = strip_tags($_POST['price']);
$qty = strip_tags($_POST['qty']);
$m_image = $_FILES["m_image"];
$sec_image = $_FILES["sec_image"];
$notes = strip_tags($_POST['notes']);
if(empty($id) || !is_numeric($id) || $id <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "This record does not exist.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
        </script>';
}else if (empty($cat_id) || !is_numeric($cat_id) || $cat_id <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Category.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#cat_id").addClass(`is-invalid`);
            $("#cat_id").select();
            $("#cat_id").focus();
        </script>';
}else if (empty($p_name) || mb_strlen(trim($p_name)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Product Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#p_name").addClass(`is-invalid`);
            $("#p_name").select();
            $("#p_name").focus();
        </script>';
}else if (!empty($actv_ing) && mb_strlen(trim($actv_ing)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Active Ingredient.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#actv_ing").addClass(`is-invalid`);
            $("#actv_ing").select();
            $("#actv_ing").focus();
        </script>';
}else if (!empty($dose) && mb_strlen(trim($dose)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Dose.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#dose").addClass(`is-invalid`);
            $("#dose").select();
            $("#dose").focus();
        </script>';
}else if (!empty($p_desc) && mb_strlen(trim($p_desc)) <= 8) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Product Description.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#p_desc").addClass(`is-invalid`);
            $("#p_desc").select();
            $("#p_desc").focus();
        </script>';
} else if (empty($price) || !is_numeric($price) || $price <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Price.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#price").addClass(`is-invalid`);
            $("#price").select();
            $("#price").focus();
        </script>';
} else if (empty($qty) || !is_numeric($qty) || $qty <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Quantity.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#qty").addClass(`is-invalid`);
            $("#qty").select();
            $("#qty").focus();
        </script>';
}else if(isset($m_image) && !empty($m_image) && !empty($m_image['name']) && (!is_uploaded_file($m_image['tmp_name']) || empty($m_image['type']) || !str_starts_with($m_image['type'], 'image/') || getimagesize($m_image["tmp_name"]) == false)) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Image.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#m_image").addClass(`is-invalid`);
            $("#m_image").select();
            $("#m_image").focus();
        </script>';
}else if(isset($m_image) && !empty($m_image['name']) && !empty($m_image) && ($m_image['size']/1024) >= 5120) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Choose Smaller Image Size.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#m_image").addClass(`is-invalid`);
            $("#m_image").select();
            $("#m_image").focus();
        </script>';
}else if(isset($sec_image) && !empty($sec_image) && !empty($sec_image['name']) && (!is_uploaded_file($sec_image['tmp_name']) || empty($sec_image['type']) || !str_starts_with($sec_image['type'], 'image/') || getimagesize($sec_image["tmp_name"]) == false)) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Image.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#sec_image").addClass(`is-invalid`);
            $("#sec_image").select();
            $("#sec_image").focus();
        </script>';
}else if(isset($sec_image) && !empty($sec_image['name']) && !empty($sec_image) && ($sec_image['size']/1024) >= 5120) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Choose Smaller Image Size.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#sec_image").addClass(`is-invalid`);
            $("#sec_image").select();
            $("#sec_image").focus();
        </script>';
}else{
    $saved = Info::executeQuery("update products set name = ?, actv_ing = ?, p_desc = ?, dose = ?, price = ?,qty = ?, cat_id = ?, notes = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",
                ["s_".$p_name,"s_".$actv_ing,"s_".$p_desc,"s_".$dose,"d_".$price,"d_".$qty,"i_".$cat_id,"s_".$notes,"i_".$id]);
    if(isset($m_image) && !empty($m_image) && !empty($m_image['name'])){
        $imageFileType = strtolower(pathinfo($m_image["name"],PATHINFO_EXTENSION));
        $site_dir = $_SERVER['DOCUMENT_ROOT'];
        $image_dir = "/uploads/products/".$id."/";
        if (!is_dir($site_dir.$image_dir)){
            mkdir($site_dir.$image_dir, 0777, true);
        }
        $target_file = $image_dir."main".time() . "." . $imageFileType;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if(move_uploaded_file($m_image["tmp_name"], $site_dir.$target_file)){
            $saved = Info::executeQuery("update products set img_path = ?,img_name = ?,updated_at = sysdate() where id = ?;", ["s_" . $target_file, "s_" .$m_image['name'], "i_" . $id]);
        }else{
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred while uploading main image.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#m_image").addClass(`is-invalid`);
                $("#m_image").select();
                $("#m_image").focus();
            </script>';
            die();
        }
    }
    if(isset($sec_image) && !empty($sec_image) && !empty($sec_image['name'])){
        $imageFileType = strtolower(pathinfo($sec_image["name"],PATHINFO_EXTENSION));
        $site_dir = $_SERVER['DOCUMENT_ROOT'];
        $image_dir = "/uploads/products/".$id."/";
        if (!is_dir($site_dir.$image_dir)){
            mkdir($site_dir.$image_dir, 0777, true);
        }
        $target_file = $image_dir."main".time() . "." . $imageFileType;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if(move_uploaded_file($sec_image["tmp_name"], $site_dir.$target_file)){
            $saved = Info::executeQuery("update products set img_path_p = ?,img_name_p = ?,updated_at = sysdate() where id = ?;", ["s_" . $target_file, "s_" .$sec_image['name'], "i_" . $id]);
        }else{
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred while uploading main image.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#sec_image").addClass(`is-invalid`);
                $("#sec_image").select();
                $("#sec_image").focus();
            </script>';
            die();
        }
    }
    if($saved){
        echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data has been saved.",
                        toast: true,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 3000
                    });
                    $("#m_image,#sec_image").val(null).change();
                    eform_data = $("#save_data").serialize();
                    $("#cat_id").focus();
                </script>';
    }else{
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred while saving data.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
            </script>';
    }
}