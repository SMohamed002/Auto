<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info", "Tools"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once './classes/' . $class . '.php';
        } else {
            require_once '../classes/' . $class . '.php';
        }
    }
});
$item_n = isset($_GET['item_n']) ? addslashes(strip_tags(trim($_GET['item_n']))) : '';
if (empty($item_n) || mb_strlen($item_n) <= 3) {
    echo '<script>window.location.href="/";</script>';
}
$sql_q = "select p.id,
                    p.name,
                    c.name cat_name,
                    p.dose,
                    p.price,
                    p.img_path,
                    p.p_desc,
                    p.actv_ing 
                from products p
            left outer join cats c on p.cat_id = c.id and c.deleted = p.deleted
            where p.deleted = 'N'";
if (!empty($item_n)) {
    $sql_q .= " and p.name = '" . $item_n . "' ";
}
$data = Info::getQuery($sql_q);
if(empty($data) || !is_countable($data) || count($data) < 1){
    echo '<script>window.location.href="/";</script>';
    die();
}
$added_w = false;
if(isset($_SESSION['client_id']) && !empty($_SESSION['client_id']) && is_numeric($_SESSION['client_id']) && $_SESSION['client_id'] > 0){
    Info::executeQuery("insert into v_items(item_id,client_id) values(?,?);",["i_".$data[0]['id'],"i_".$_SESSION['client_id']]);
    $cnt_data = Info::getQuery("select count(id) cnt from wishlist where deleted = 'N' and item_id = ? and client_id = ?",
                                ["i_".$data[0]['id'],"i_".$_SESSION['client_id']]);
    $added_w = $cnt_data[0]['cnt'] > 0 ? true : false;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Product | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/shop.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="shop-slider">
        <div class="shop-image">
            <div class="container">
                <h2>View Procuct</h2>
            </div>
        </div>
    </section>
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="row">
                <div class="col-md-3" style="border-right:1px solid #ccc;">
                    <img src="<?php echo $data[0]['img_path']; ?>" class="card-img" alt="Main Image" style="max-width:300px;max-height:230px;" onclick="window.open(this.src);" />
                </div>
                <div class="col-md-7">
                    <div class="card-body">
                        <p class="card-text"><?php echo $data[0]['cat_name']; ?></p>
                        <h5 class="card-title"><?php echo $data[0]['name']; ?></h5>
                        <p class="card-text"><small class="text-muted"><?php echo $data[0]['dose']; ?></small></p>
                        <p class="card-text"><?php echo str_replace(array("\n", "\r", PHP_EOL), '<br/>', $data[0]['p_desc']); ?></p>
                    </div>
                </div>
                <div class="col-md-2" style="border-left:1px solid #ccc;">
                    <form action="javascript:add_to_cart(`<?php echo $data[0]['id'] ?>`);" method="POST">
                        <input type="number" name="qty" id="qty" value="1" min="0" step="1" class="form-control mt-2 text-center" />
                        <?php
                            echo '<button type="submit" class="btn btn-dark mt-2">Add To Cart</button>';
                        ?>
                        </form>
                    <br />
                    <hr />
                    <?php
                        if(!$added_w){
                            echo '<button type="button" onclick="add_to_wishlist(`'.$data[0]['id'].'`);" class="btn btn-dark mt-2">Add To Wishlist</button>';
                        }else{
                            echo '<button type="button" onclick="rm_from_wishlist(`'.$data[0]['id'].'`);" class="btn btn-danger mt-2">Remove From Wishlist</button>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
</body>

</html>