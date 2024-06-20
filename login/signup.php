<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (isset($_SESSION['client_id']) && !empty($_SESSION['client_id']) && is_numeric($_SESSION['client_id']) && $_SESSION['client_id'] > 0) {
    echo '<script>window.location.href="/profile";</script>';
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
$firstname = strip_tags($_POST['firstname']);
$lastname = strip_tags($_POST['lastname']);
$email = strip_tags($_POST['email']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
if(empty($firstname) || mb_strlen(trim($firstname)) < 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Firstname.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#firstname").select();
            $("#firstname").focus();
        </script>';
}else if(empty($lastname) || mb_strlen(trim($lastname)) < 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Lastname.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#lastname").select();
            $("#lastname").focus();
        </script>';
}else if(empty($email) || mb_strlen(trim($email)) < 3 || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
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
            $("#email").select();
            $("#email").focus();
        </script>';
}else if(empty($username) || mb_strlen(trim($username)) < 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Username.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#username").select();
            $("#username").focus();
        </script>';
}else if(empty($password) || mb_strlen(trim($password)) <= 3) {
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
            $("#password").select();
            $("#password").focus();
        </script>';
}else{
    $user = Info::getQuery("select username,email from clients where deleted = 'N' and (email = ? or username = ?) limit 1;", ["s_".$email, "" => "s_".$username]);
    if(!empty($user) && is_countable($user) && count($user) > 0) {
        if($user[0]['email'] == $email){
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
                    $("#email").select();
                    $("#email").focus();
                </script>';
        }else{
            echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "This Username Already Exists.",
                        toast: true,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 3000
                    });
                    $("#username").select();
                    $("#username").focus();
                </script>';
        }
        die();
    }
    $saved = Info::executeQuery("insert into clients(f_name,l_name,username,pass,email) values(?,?,?,?,?);", 
        ["s_" . $firstname, "s_" . $lastname, "s_" . $username, "s_" . password_hash($password, PASSWORD_DEFAULT), "s_" . $email]);
    if($saved){
        $c_id = Info::getQuery("select id from clients where deleted = 'N' order by id desc limit 1;")[0]['id'];
        $_SESSION['client_id'] = $c_id;
        if(isset($_SESSION['furl']) && !empty($_SESSION['furl'])){
            $furl = $_SESSION['furl'];
            $_SESSION['furl'] = "";
            echo '<script>window.location.href="'.$_SESSION['furl'].'";</script>';
        }else{
            echo '<script>window.location.href="/";</script>';
        }
        die();
    }else{
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred while saving data.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
            </script>';
    }
}