<?php
spl_autoload_register(function ($class) {
    if (in_array($class, ["Info", "Tools"])) {
        if ($_SERVER['REQUEST_URI'] == '/' || $_SERVER['REQUEST_URI'] == "") {
            require_once './classes/' . $class . '.php';
        } else {
            require_once '../classes/' . $class . '.php';
        }
    }
});
$sql_q = "select p.id,
                    p.name,
                    c.name cat_name,
                    p.dose,
                    p.price,
                    p.img_path,
                    p.img_path_p,
                    p.p_desc,
                    p.actv_ing 
                from products p
            left outer join cats c on p.cat_id = c.id and c.deleted = p.deleted
            where p.deleted = 'N'";
$cat_n = isset($_GET['cat_n']) ? addslashes(strip_tags(trim($_GET['cat_n']))) :'';
if(!empty($cat_n)){
    $sql_q .= " and (c.name = '".$cat_n."') ";
}
$srch = isset($_GET['search']) ? addslashes(strip_tags(trim($_GET['search']))) :'';
if(!empty($srch)){
    $sql_q .= " and (c.name like '%".$srch."%' 
                        or p.name like '%".$srch."%' 
                        or (p.p_desc like '%".$srch."%' and p.p_desc is not null)
                        or (p.dose like '%".$srch."%' and p.dose is not null)
                        or (p.actv_ing like '%".$srch."%' and p.actv_ing is not null)) ";
}
$sql_q .= " order by RAND();";
$data = Info::getQuery($sql_q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Products | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/shop.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <section class="shop-slider">
        <div class="shop-image">
            <div class="container">
                <h2>Shop Now</h2>
                <?php
                    if(!empty($srch)){
                        echo '<h5>You Searched For : '.$_GET['search'].'</h5>';
                    }
                    if(!empty($cat_n)){
                        echo '<h5>Category : '.$_GET['cat_n'].'</h5>';
                    }
                ?>
            </div>
        </div>
    </section>
    <section class="products-card">
        <div class="products">
            <?php
                if(!empty($data) && is_countable($data) && count($data) > 0){
                    foreach($data as $p){
                        echo '<div class="products-box">
                                <div class="products-image">
                                    <img src="'.$p['img_path'].'" class="image-home">
                                    <img src="'.$p['img_path_p'].'" class="image-back">
                                </div>
                                <div class="products-details">
                                    <a href="/shop/?cat_n='.$p['cat_name'].'"><p>'.$p['cat_name'].'</p></a>
                                    <a href="/product/?item_n='.$p['name'].'" style="color:#000;"><h5>'.$p['name'].'</h5></a>
                                    '.(!empty($p['dose']) ? '<p>'.$p['dose'].'</p>' : '').'
                                    <div class="cart-price">
                                        <div class="the-price">
                                            <span>'.$p['price'].' EGP</span>
                                        </div>
                                    </div>
                                    <div class="product_more">
                                        <a class="popup-btn" href="/product/?item_n='.$p['name'].'">View Info</a>
                                    </div>
                                </div>
                            </div>';
                    }
                }else{
                    echo "No Products Found.";
                }
            ?>
        </div>
    </section>
    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
</body>

</html>