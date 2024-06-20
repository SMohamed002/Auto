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
            window.location.href = `/admin/orders/`;
        </script>';
}else{
    $deleted = Info::executeQuery("update orders_hd set cncld = 'N',updated_at = sysdate() where cncld = 'Y' and deleted = 'N' and id = ?;",["i_".$id]);
    if($deleted){
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Order has been cancelled.",
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