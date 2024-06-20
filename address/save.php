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
$govern = strip_tags($_POST['govern']);
$city = strip_tags($_POST['city']);
$mob = strip_tags($_POST['mob']);
$add_mob = strip_tags($_POST['add_mob']);
$address = strip_tags($_POST['address']);
$notes = strip_tags($_POST['notes']);
if(empty($govern) || mb_strlen(trim($govern)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Government.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#govern").addClass(`is-invalid`);
            $("#govern").select();
            $("#govern").focus();
        </script>';
}else if(empty($mob) || mb_strlen(trim($mob)) <= 9) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Mobile.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#mob").addClass(`is-invalid`);
            $("#mob").select();
            $("#mob").focus();
        </script>';
}else if(!empty($add_mob) && mb_strlen(trim($add_mob)) <= 9) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Additional Mobile.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#add_mob").addClass(`is-invalid`);
            $("#add_mob").select();
            $("#add_mob").focus();
        </script>';
}else if(empty($address) || mb_strlen(trim($address)) <= 6) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Address.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#address").addClass(`is-invalid`);
            $("#address").select();
            $("#address").focus();
        </script>';
}else{
    if(Info::executeQuery("update clients set govern = ?,city = ?,mob = ?,add_mob = ?,address = ?,add_mob = ?,notes = ?,updated_at = sysdate() where deleted = 'N' and id = ?;",
                        ["s_" . $govern, "s_" . $city, "s_" . $mob, "s_" . $add_mob, "s_" . $address,"s_".$add_mob,"s_".$notes, "i_" . $_SESSION['client_id']])){
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
                $("#govern").focus();
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