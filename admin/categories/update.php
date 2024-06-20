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
$cat_name = strip_tags($_POST['cat_name']);
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
}else if(empty($cat_name) || mb_strlen(trim($cat_name)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Category Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#cat_name").addClass(`is-invalid`);
            $("#cat_name").select();
            $("#cat_name").focus();
        </script>';
}else{
    if(Info::executeQuery("update cats set name = ?, notes = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",["s_".$cat_name,"s_".$notes,"i_".$id])){
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
                eform_data = $("#save_data").serialize();
                $("#cat_name").focus();
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