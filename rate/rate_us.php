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
$stars = strip_tags($_POST['stars']);
$comment = strip_tags($_POST['comment']);
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
            $("#name").addClass(`is-invalid`);
            $("#name").select();
            $("#name").focus();
        </script>';
}else if(empty($stars) || !is_numeric($stars) || $stars <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Stars.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#stars").addClass(`is-invalid`);
            $("#stars").select();
            $("#stars").focus();
        </script>';
}else if(empty($comment) || mb_strlen(trim($comment)) <= 6) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Comment.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#comment").addClass(`is-invalid`);
            $("#comment").select();
            $("#comment").focus();
        </script>';
}else{
    if(Info::executeQuery("insert into rate_us(name,stars,msg) values(?,?,?);", ["s_" . $name, "i_" . $stars, "s_" . $comment])){
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
                $("#rate_form")[0].reset();
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