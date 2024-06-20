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
$username = strip_tags($_POST['username']);
$email = strip_tags($_POST['email']);
$phone = strip_tags($_POST['phone']);
$old_pwd = strip_tags($_POST['old_pwd']);
$new_pwd = strip_tags($_POST['new_pwd']);
$new_cpwd = strip_tags($_POST['new_cpwd']);
$notes = strip_tags($_POST['notes']);
$user_info = Info::getQuery("select id,pass from users where deleted = 'N' limit 1")[0];
$id = $user_info['id'];
if(empty($id) || !is_numeric($id) || $id <= 0) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "This record does not exist.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
        </script>';
}else if(empty($username) || mb_strlen(trim($username)) <= 3) {
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
            $("#username").addClass(`is-invalid`);
            $("#username").select();
            $("#username").focus();
        </script>';
}else if(empty($email) || mb_strlen(trim($email)) <= 3 || filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
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
            $("#email").addClass(`is-invalid`);
            $("#email").select();
            $("#email").focus();
        </script>';
}else if(!empty($phone) && mb_strlen(trim($phone)) <= 9) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Phone Number.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#phone").addClass(`is-invalid`);
            $("#phone").select();
            $("#phone").focus();
        </script>';
}else if(!empty($old_pwd) && (empty($new_cpwd) || empty($new_pwd))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter Old Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#old_pwd").addClass(`is-invalid`);
            $("#old_pwd").select();
            $("#old_pwd").focus();
        </script>';
}else if(!empty($old_pwd) && !password_verify($old_pwd, $user_info['pass'])) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Old Password Does Not Match.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#old_pwd").addClass(`is-invalid`);
            $("#old_pwd").select();
            $("#old_pwd").focus();
        </script>';
}else if(!empty($new_pwd) && (empty($new_cpwd) || empty($old_pwd))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter New Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#new_pwd").addClass(`is-invalid`);
            $("#new_pwd").select();
            $("#new_pwd").focus();
        </script>';
}else if(!empty($new_cpwd) && (empty($new_pwd) || empty($old_pwd))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter Confirm Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#new_cpwd").addClass(`is-invalid`);
            $("#new_cpwd").select();
            $("#new_cpwd").focus();
        </script>';
}else if(!empty($new_cpwd) && $new_pwd !== $new_cpwd) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Confirm Password Does Not Match.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#new_cpwd").addClass(`is-invalid`);
            $("#new_cpwd").select();
            $("#new_cpwd").focus();
        </script>';
}else{
    $saved = false;
    if(!empty($new_pwd)){
        $saved = Info::executeQuery("update users set username = ?,email = ?,phone = ?,notes = ?,pass = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",["s_".$username,"s_".$email,"s_".$phone,"s_".$notes,"s_".password_hash($new_pwd,PASSWORD_DEFAULT),"i_".$id]);
    }else{
        $saved = Info::executeQuery("update users set username = ?,email = ?,phone = ?,notes = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",["s_".$username,"s_".$email,"s_".$phone,"s_".$notes,"i_".$id]);
    }
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
                eform_data = $("#save_data").serialize();
                $("#new_cpwd ,#new_pwd, #old_pwd").val(null);
                $("#username").focus();
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