<?php
session_start();
$user_id = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$_SESSION=array();
session_destroy();
session_start();
session_regenerate_id(true);
if(!empty($user_id) && is_numeric($user_id) && $user_id > 0){
    $_SESSION['user_id'] = $user_id;
}
echo '<script> window.location.reload(); </script>';