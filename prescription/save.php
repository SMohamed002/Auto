<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    if(isset($_POST['url']) && !empty($_POST['url'])){
        $_SESSION['furl'] = $_POST['url'];
    }
    echo '<script>window.location.href="/login";</script>';
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
$doc_image = $_FILES["doc_image"];
$notes = strip_tags($_POST['notes']);
if(!isset($doc_image) || !is_uploaded_file($doc_image['tmp_name']) || empty($doc_image) || empty($doc_image['name']) || empty($doc_image['type']) || !str_starts_with($doc_image['type'], 'image/') || getimagesize($doc_image["tmp_name"]) == false) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Image.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#doc_image").addClass(`is-invalid`);
            $("#doc_image").select();
            $("#doc_image").focus();
        </script>';
}else if(($doc_image['size']/1024) >= 5120) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Choose Smaller Image Size.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#doc_image").addClass(`is-invalid`);
            $("#doc_image").select();
            $("#doc_image").focus();
        </script>';
}else{
    if(Info::executeQuery("insert into prescriptions(notes) values(?);",["s_". $notes])){
        $imageFileType = strtolower(pathinfo($doc_image["name"],PATHINFO_EXTENSION));
        $row_data = Info::getQuery("select id from prescriptions where deleted = 'N' order by id desc limit 1;");
        $site_dir = $_SERVER['DOCUMENT_ROOT'];
        $image_dir = "/uploads/prescriptions/".$row_data[0]["id"]."/";
        if (!is_dir($site_dir.$image_dir)){
            mkdir($site_dir.$image_dir, 0777, true);
        }
        $target_file = $image_dir.time() . "." . $imageFileType;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if(move_uploaded_file($doc_image["tmp_name"], $site_dir.$target_file)){
            Info::executeQuery("update prescriptions set file_path = ?,file_name = ? where id = ?;", ["s_" . $target_file, "s_" .$doc_image['name'], "i_" . $row_data[0]["id"]]);
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
                    window.location.reload();
                </script>';
        }else{
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "An error occurred while uploading image.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
                $("#doc_image").addClass(`is-invalid`);
                $("#doc_image").select();
                $("#doc_image").focus();
            </script>';
        }
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