<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    $_SESSION['furl'] = "/orders/";
    echo '<script>window.location.href="/login";</script>';
    die();
}
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once './classes/' . $class . '.php';
        } else {
            require_once '../classes/' . $class . '.php';
        }
    }
});
$id = strip_tags($_GET['id']);
if(empty($id) || !is_numeric($id) || $id <= 0) {
    echo '<script>
            window.location.href = `/admin/doctors/`;
        </script>';
}else{
    $deleted = Info::executeQuery("update orders_hd set cncld = 'Y',updated_at = sysdate() where cncld = 'N' and deleted = 'N' and id = ?;",["i_".$id]);
    if($deleted){
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Order has been canceled.",
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
                    title: "An error occurred while cancelling record.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
            </script>';
    }
}