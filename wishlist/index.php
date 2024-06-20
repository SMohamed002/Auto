<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    $_SESSION['furl'] = "/wishlist/";
    echo '<script>window.location.href="/login";</script>';
    die();
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
$sql_q = "SELECT w.id,
                    p.id p_id,
                    p.name,
                    p.img_path,
                    p.price,
                    c.id cart_id 
                FROM wishlist w 
            LEFT JOIN products p ON w.item_id = p.id AND w.deleted = p.deleted
            LEFT JOIN cart c ON c.item_id = w.item_id AND w.deleted = c.deleted and c.client_id = w.client_id
            WHERE w.deleted = 'N'
                AND w.client_id = ?
            ORDER BY w.id desc";
$wish_products = Info::getQuery($sql_q,["i_".$_SESSION['client_id']]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist | Auto-Pharamcy</title>
    <?php require_once '../pages/h-scripts.php'; ?>
    <link rel="stylesheet" href="/assets/css/wishlist.css">
</head>

<body>
    <?php require_once '../pages/header.php'; ?>
    <div class="container-fluid mb-5 mt-3">
        <div class="cart-container">
            <div class="cart-header">
                <h5>Your Wishlist</h5>
            </div>
            <table class="the_cart w-100">
                <tbody>
                    <?php
                        $w_count = $t_price = 0;
                        foreach($wish_products as $p){
                            echo '<tr class="cart-product">
                                    <td>
                                        <div class="d-flex gap-3 align-items-center">
                                            <img class="cart-product-image" src="'.$p['img_path'].'">
                                            <a style="color:#000;" href="/product/?item_n='.$p['name'].'"><h5>'.$p['name'].'</h5></a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="mb-2 d-flex text-end justify-content-end align-items-end">
                                            <span class="cart-product-price">'.$p['price'].' EGP</span>
                                            '.(empty($p['cart_id']) ? '<span style="margin-right: 10px"><button class="btn btn-sm btn-light" onclick="add_to_cart(`'.$p['p_id'].'`);">Add To Cart</button></span>' : '').'
                                            <span style="margin-right: 10px"><button class="btn btn-sm btn-danger" onclick="rm_from_wishlist(`'.$p['p_id'].'`);">Remove</button></span>
                                        </div>
                                    </td>
                                </tr>';
                                $w_count++;
                                $t_price += (double) $p['price'];
                        }
                        if($w_count == 0){
                            echo '<h1 class="text-center fw-bolder">No products yet!</h1>';
                        }
                    ?>
                </tbody>
            </table>

            <div class="check-out-container">
                <h5>Total: <span class="items"><?php echo $w_count <= 1 ? $w_count." Item" : $w_count." Items"; ?></span></h5>

                <div class="total-price">
                    <div class="price-fee text-center">
                        <span class="fees"><?php echo $t_price; ?> EGP</span>
                        <p>delivery Fee. 10%</p>
                    </div>
                </div>
            </div>

            <!-- popup checkout -->
            <div class="popup-checkout" id="popupCheckout">
                <div class="right-sign">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="done-details">
                    <h3>Process completed successfully</h3>
                    <p>your details has been successfully submit. thanks!</p>
                    <button type="button" onclick="closePopupCheck()">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="banner">
        <?php require_once '../pages/footer.php'; ?>
    </div>

    <script src="/assets/js/main.js"></script>
    <script src="/assets/js/wishlist.js"></script>
</body>

</html>