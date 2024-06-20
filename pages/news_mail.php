<?php
if (session_id() == false || empty(session_id())) {
    session_start();
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
$mail = $_POST['nemail'];
if(empty($mail) || filter_var($mail, FILTER_VALIDATE_EMAIL) == false){
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Email.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#nemail").focus();
        </script>';
}else{
    if(!Info::checkQuery("select id from news_emails where deleted = 'N' and email = ?;", ["s_".$mail])){
        if(Info::executeQuery("insert into news_emails(email) values(?);", ["s_".$mail])){
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Thank You For Subscribing.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#nemail").val(null);
                $("#nemail").focus();
            </script>';
        }
    }else{
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "This Email Already Exists.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#nemail").select();
                $("#nemail").focus();
            </script>';
    }
}