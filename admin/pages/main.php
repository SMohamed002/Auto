<?php
    if (session_id() == false || empty(session_id())) {
        session_start();
    }
    if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]) || !is_numeric($_SESSION["user_id"]) || $_SESSION["user_id"] <= 0) {
        echo "<script>window.location.href='/admin/login/';</script>";
        die();
    }
?>