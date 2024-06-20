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
$name = strip_tags($_POST['name']);
$email = strip_tags($_POST['email']);
$phone = strip_tags($_POST['phone']);
$msg = strip_tags($_POST['msg']);
if(empty($name) || mb_strlen(trim($name)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#name").select();
            $("#name").focus();
        </script>';
}else if(empty($email) || mb_strlen(trim($email)) <= 2 || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Email Address.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#email").select();
            $("#email").focus();
        </script>';
}else if(empty($phone) || mb_strlen(trim($phone)) <= 9) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Phone.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#phone").select();
            $("#phone").focus();
        </script>';
}else{
    $saved = Info::executeQuery("insert into contact_us(name,email,phone,msg) values(?,?,?,?);", ["s_" . $name, "s_" . $email, "s_" . $phone, "s_" . $msg]);
    if($saved){
        echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Data has been saved.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#contact_form")[0].reset();
                $("#name").focus();
            </script>';
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