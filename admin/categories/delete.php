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
$id = strip_tags($_GET['id']);
if(empty($id) || !is_numeric($id) || $id <= 0) {
    echo '<script>
            window.location.href = `/admin/categories/`;
        </script>';
        die();
}else{
    $p_id = Info::getQuery("select id from products where cat_id = ? and deleted = 'N' limit 1;",["i_".$id]);
    if(!empty($p_id) && is_countable($p_id) && count($p_id) > 0 && $p_id[0]["id"] > 0) {
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "You can not delete this category because it has products.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
            </script>';
    }else{
        $deleted = Info::executeQuery("update cats set deleted = 'Y',updated_at = sysdate() where deleted = 'N' and id = ?;",["i_".$id]);
        if($deleted){
            echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: "Data has been deleted.",
                        toast: true,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 3000
                    });
                    window.location.reload();
                </script>';
        }else{
            echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "An error occurred while deleting record.",
                        toast: true,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 3000
                    });
                </script>';
        }
    }
}