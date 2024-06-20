<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    if(isset($_POST['url']) && !empty($_POST['url'])){
        $_SESSION['furl'] = $_POST['url'];
    }
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
$cart_id = isset($_POST['cart_id']) ? strip_tags(trim($_POST['cart_id'])) : 0;
$way = isset($_POST['way']) ? strtoupper(strip_tags(trim($_POST['way']))) : 0;
if (!empty($cart_id) && is_numeric($cart_id) && $cart_id > 0 && in_array($way,['U','D'])) {
    $exist = Info::getQuery("select id,qty from cart where deleted = 'N' and id = ? and client_id = ? limit 1", ["i_" . $cart_id, "i_" . $_SESSION['client_id']]);
    if(!empty($exist) && is_countable($exist) && count($exist) > 0 && $exist[0]['id'] > 0){
        if($way == "D" && $exist[0]['qty'] > 1){
            Info::executeQuery("update cart set qty = qty-1,updated_at = sysdate() where id = ?;", ["i_".$exist[0]['id']]);
            echo '<script>window.location.reload();</script>';
            die();
        }else if($way == "U"){
            Info::executeQuery("update cart set qty = qty+1,updated_at = sysdate() where id = ?;", ["i_".$exist[0]['id']]);
            echo '<script>window.location.reload();</script>';
            die();
        }
    }
}
?>