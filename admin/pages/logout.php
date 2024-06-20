<?php
session_start();
$client_id = isset($_SESSION['client_id']) && !empty($_SESSION['client_id']) ? $_SESSION['client_id'] : 0;
$_SESSION=array();
session_destroy();
session_start();
session_regenerate_id(true);
if(!empty($client_id) && is_numeric($client_id) && $client_id > 0){
    $_SESSION['client_id'] = $client_id;
}
echo '<script> window.location.href="/admin/login"; </script>';