<?php
if (session_id() == false || empty(session_id())) {
    session_start();
}
if (!isset($_SESSION['client_id']) || empty($_SESSION['client_id']) || !is_numeric($_SESSION['client_id']) || $_SESSION['client_id'] <= 0) {
    $_SESSION['furl'] = "/cart/";
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
$client_info = Info::getQuery("select concat(f_name,' ',l_name) name,govern,city,address,mob,add_mob from clients where deleted = 'N' and id = ?",["i_". $_SESSION['client_id']]);
if(!empty($client_info) && is_countable($client_info) && count($client_info) > 0) {
    if(!empty($client_info[0]['name']) && !empty($client_info[0]['govern']) && !empty($client_info[0]['city']) && !empty($client_info[0]['address']) && !empty($client_info[0]['mob'])) {
        $cart = Info::getQuery("select c.id,
                                        c.item_id,
                                        c.qty,
                                        p.price,
                                        p.name 
                                    from cart c 
                                left join products p on c.item_id = p.id and p.deleted = c.deleted
                                where c.deleted = 'n' 
                                    and c.client_id = ?",["i_". $_SESSION['client_id']]);
        $qtys = Info::getQuery("SELECT IF(P.QTY IS NULL OR P.QTY = '',0,P.QTY) QTY,C.QTY CRT_QTY
                                    FROM PRODUCTS P,CART C 
                                WHERE C.ITEM_ID = P.ID
                                    AND P.DELETED = C.DELETED 
                                    AND P.DELETED = 'N'
                                    AND C.CLIENT_ID = ?",["i_". $_SESSION['client_id']]);
        if(!empty($cart) && is_countable($cart) && count($cart) > 0) {
            $all_qtys = true;
            foreach($qtys as $q){
                if((double)$q['CRT_QTY'] > (double)$q['QTY']){
                    $all_qtys = false;
                    break;
                }
            }
            if($all_qtys){
                if(Info::executeQuery("insert into orders_hd(client_id,payer,govern,city,mob,add_mob,address) values(?,?,?,?,?,?,?);",
                        ["i_".$_SESSION['client_id'],"s_".$client_info[0]['name'],"s_". $client_info[0]['govern'],"s_". $client_info[0]['city'],"s_". $client_info[0]['mob'],"s_". $client_info[0]['add_mob'],"s_". $client_info[0]['address']])){
                    $hd_id = Info::getQuery("select id from orders_hd where deleted = 'N' order by id desc limit 1")[0]['id'];
                    $sql_i = "insert into orders_dt(hd_id,item_id,qty,price,item_name) values";
                    foreach($cart as $c){
                        $sql_i .= "(".$hd_id.",".$c['item_id'].",".$c['qty'].",".$c['price'].",'".$c['name']."'),";
                        Info::executeQuery("update products set qty = qty - ".$c['qty']." where deleted = 'N' and id = ?",["i_".$c['item_id']]);
                    }
                    if(str_ends_with($sql_i,",")){
                        $sql_i = rtrim($sql_i, ",").";";
                        Info::executeQuery($sql_i);
                        Info::executeQuery("update cart set deleted='Y',updated_at = SYSDATE() where deleted = 'N' and client_id = ?",["i_".$_SESSION['client_id']]);
                        echo '<script>window.location.reload();</script>';
                    }
                }
            }else{
                echo '<script>
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "There is no stock.",
                            toast: true,
                            timerProgressBar: true,
                            showConfirmButton: false,
                            showCloseButton: true,
                            timer: 3000
                        }).then(function(){
                            window.location.reload();
                        });
                    </script>';
            }
        }else{
            echo '<script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "There is no products in your cart.",
                    toast: true,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    showCloseButton: true,
                    timer: 3000
                });
            </script>';
        }
    }else{
        echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "Please Complete Your Personal Information.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
        </script>';
    }
}else{
    echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "There is no data found for this account.",
                toast: true,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 3000
            });
        </script>';
}