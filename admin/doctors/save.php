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
$doc_name = strip_tags($_POST['doc_name']);
$doc_image = $_FILES["doc_image"];
$job_title = strip_tags($_POST['job_title']);
$fb_link = strip_tags($_POST['fb_link']);
$insta_link = strip_tags($_POST['insta_link']);
$x_link = strip_tags($_POST['x_link']);
$wp_link = strip_tags($_POST['wp_link']);
$notes = strip_tags($_POST['notes']);
if(empty($doc_name) || mb_strlen(trim($doc_name)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Doctor Name.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#doc_name").addClass(`is-invalid`);
            $("#doc_name").select();
            $("#doc_name").focus();
        </script>';
}else if(!isset($doc_image) || !is_uploaded_file($doc_image['tmp_name']) || empty($doc_image) || empty($doc_image['name']) || empty($doc_image['type']) || !str_starts_with($doc_image['type'], 'image/') || getimagesize($doc_image["tmp_name"]) == false) {
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
}else if(empty($job_title) || mb_strlen(trim($job_title)) <= 3) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Job Title.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#job_title").addClass(`is-invalid`);
            $("#job_title").select();
            $("#job_title").focus();
        </script>';
}else if(!empty($fb_link) && (mb_strlen(trim($fb_link)) <= 3 || filter_var($fb_link, FILTER_VALIDATE_URL) != false)) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Facebook Username.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#fb_link").addClass(`is-invalid`);
            $("#fb_link").select();
            $("#fb_link").focus();
        </script>';
}else if(!empty($insta_link) && (mb_strlen(trim($insta_link)) <= 3 || filter_var($insta_link, FILTER_VALIDATE_URL) != false)) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Instagram Username.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#insta_link").addClass(`is-invalid`);
            $("#insta_link").select();
            $("#insta_link").focus();
        </script>';
}else if(!empty($x_link) && (mb_strlen(trim($x_link)) <= 3 || filter_var($x_link, FILTER_VALIDATE_URL) != false)) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid X Username.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#x_link").addClass(`is-invalid`);
            $("#x_link").select();
            $("#x_link").focus();
        </script>';
}else if(!empty($wp_link) && mb_strlen(trim($wp_link)) <= 9) {
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Enter A Valid Number.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
            $("#wp_link").addClass(`is-invalid`);
            $("#wp_link").select();
            $("#wp_link").focus();
        </script>';
}else{
    $saved = Info::executeQuery("insert into doctors(name,job_title,fb_link,x_link,insta_link,wp_link,notes) values(?,?,?,?,?,?,?);",
                ["s_".$doc_name,"s_".$job_title,"s_". $fb_link,"s_". $x_link,"s_". $insta_link,"s_". $wp_link,"s_". $notes]);
    if($saved){
        $imageFileType = strtolower(pathinfo($doc_image["name"],PATHINFO_EXTENSION));
        $row_data = Info::getQuery("select id from doctors where deleted = 'N' order by id desc limit 1;");
        $site_dir = $_SERVER['DOCUMENT_ROOT'];
        $image_dir = "/uploads/doctors/".$row_data[0]["id"]."/";
        if (!is_dir($site_dir.$image_dir)){
            mkdir($site_dir.$image_dir, 0777, true);
        }
        $target_file = $image_dir.time() . "." . $imageFileType;
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        if(move_uploaded_file($doc_image["tmp_name"], $site_dir.$target_file)){
            Info::executeQuery("update doctors set img_path = ?,img_name = ? where id = ?;", ["s_" . $target_file, "s_" .$doc_image['name'], "i_" . $row_data[0]["id"]]);
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
                    $("#save_data")[0].reset();
                    $("#doc_name").focus();
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