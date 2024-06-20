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
$item_id = isset($_POST['item_id']) ? strip_tags(trim($_POST['item_id'])) : 0;
$qty = isset($_POST['qty']) ? strip_tags(trim($_POST['qty'])) : 0;
if (!empty($item_id) && is_numeric($item_id) && $item_id > 0) {
    $exist = Info::getQuery("select id from cart where deleted = 'N' and item_id = ? and client_id = ? limit 1", ["i_" . $item_id, "i_" . $_SESSION['client_id']]);
    if(!empty($exist) && is_countable($exist) && count($exist) > 0 && $exist[0]['id'] > 0){
        Info::executeQuery("update cart set qty = qty+".(empty($qty) ? "1" : $qty).",updated_at = sysdate() where id = ?;", ["i_".$exist[0]['id']]);
    }else{
        Info::executeQuery("insert into cart(item_id,client_id,qty) value(?,?,?);", ["i_".$item_id, "i_".$_SESSION['client_id'],"i_".(empty($qty) ? "1" : $qty)]);
    }
    echo '<script>window.location.reload();</script>';
    die();
}
?>