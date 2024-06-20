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
$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);
if(empty($email) || mb_strlen(trim($email)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Username or email.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#email").addClass(`is-invalid`);
            $("#email").select();
            $("#email").focus();
        </script>';
}else if(empty($password) || mb_strlen(trim($password)) <= 2) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#password").addClass(`is-invalid`);
            $("#password").select();
            $("#password").focus();
        </script>';
}else{
    $user = Info::getQuery("select id,pass from users where deleted = 'N' and (email = ? or username = ?) limit 1;", ["s_".$email, "" => "s_".$email]);
    $st = false;
    if(!empty($user) && is_countable($user) && count($user) > 0) {
        if(password_verify($password, $user[0]['pass'])) {
            $_SESSION['user_id'] = $user[0]['id'];
            $st = true;
            echo '<script> window.location.reload(); </script>';
        }
    }
    if(!$st){
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "Please Check Your Username/Email or Password.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#password,#email").addClass(`is-invalid`);
                $("#password").select();
                $("#password").focus();
            </script>';
    }
}