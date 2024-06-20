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
$fname = strip_tags($_POST['fname']);
$lname = strip_tags($_POST['lname']);
$username = strip_tags($_POST['username']);
$email = strip_tags($_POST['email']);
$phone = strip_tags($_POST['phone']);
$old_pass = strip_tags($_POST['old_pass']);
$n_pass = strip_tags($_POST['n_pass']);
$cn_pass = strip_tags($_POST['cn_pass']);
if(empty($fname) || mb_strlen(trim($fname)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid First Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#fname").addClass(`is-invalid`);
            $("#fname").select();
            $("#fname").focus();
        </script>';
}else if(empty($lname) || mb_strlen(trim($lname)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Last Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#lname").addClass(`is-invalid`);
            $("#lname").select();
            $("#lname").focus();
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
            $("#phone").addClass(`is-invalid`);
            $("#phone").select();
            $("#phone").focus();
        </script>';
}else if(!empty($old_pass) && (mb_strlen(trim($old_pass)) <= 3 || empty($n_pass) || empty($cn_pass))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Old Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#old_pass").addClass(`is-invalid`);
            $("#old_pass").select();
            $("#old_pass").focus();
        </script>';
}else if(!empty($n_pass) && (mb_strlen(trim($n_pass)) <= 3 || empty($old_pass) || empty($cn_pass))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid New Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#n_pass").addClass(`is-invalid`);
            $("#n_pass").select();
            $("#n_pass").focus();
        </script>';
}else if(!empty($cn_pass) && (mb_strlen(trim($cn_pass)) <= 3 || empty($old_pass) || empty($n_pass))) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid New Password.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#cn_pass").addClass(`is-invalid`);
            $("#cn_pass").select();
            $("#cn_pass").focus();
        </script>';
}else if(!empty($cn_pass) && $n_pass !== $cn_pass) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "The New Passwords Do Not Match.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#cn_pass").addClass(`is-invalid`);
            $("#cn_pass").select();
            $("#cn_pass").focus();
        </script>';
}else{
    if(!empty($old_pass)) {
        $crnt_pwd = Info::getQuery("select pass from clients where deleted = 'N' and id = ? limit 1;", ["i_" . $_SESSION['client_id']])[0]['pass'];
        if(!password_verify($old_pass, $crnt_pwd)) {
            echo '<script>
                    Swal.fire({
                        position: "top-end",
                        icon: "error",
                        title: "The Old Password Is Incorrect.",
                        toast: true,
                        timerProgressBar: true,
                        showConfirmButton: false,
                        showCloseButton: true,
                        timer: 3000
                    });
                    $("#old_pass").addClass(`is-invalid`);
                    $("#old_pass").select();
                    $("#old_pass").focus();
                </script>';
            die();
        }
    }
    $user = Info::getQuery("select username,email from clients where deleted = 'N' and (email = ? or username = ?) and id <> ? limit 1;", ["s_".$email, "" => "s_".$username,"i_" . $_SESSION['client_id']]);
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
                    $("#email").addClass(`is-invalid`);
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
                    $("#username").addClass(`is-invalid`);
                    $("#username").select();
                    $("#username").focus();
                </script>';
        }
        die();
    }
    if(Info::executeQuery("update clients set f_name = ?,l_name = ?,username = ?,email = ?,phone = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",
                        ["s_" . $fname, "s_" . $lname, "s_" . $username, "s_" . $email, "s_" . $phone, "i_" . $_SESSION['client_id']])){
        if(!empty($n_pass) && $n_pass === $cn_pass){
            Info::executeQuery("update clients set pass = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",
                ["s_" . password_hash($n_pass, PASSWORD_DEFAULT), "i_" . $_SESSION['client_id']]);
        }
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
                $("#old_pass, #n_pass, #cn_pass").val(null);
                eform_data = $("#save_data").serialize();
                $("#fname").focus();
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