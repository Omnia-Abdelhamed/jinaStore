<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header("location: ../../adminLogin.php");
}else{
    $id = (isset($_GET['id'])) ? (int)$_GET['id'] : 0;
    include_once "../../database_class.php";
    $db=new Database();
    include_once "../../product_class.php";
    $the_products= new Products();
    include_once "../../orders_class.php";
    $the_orders= new Orders();
    $product_data=$the_products->select_by_id($id);
    $product_code=$product_data['product_code'];
    $orders_details_data=$the_orders->select_products_from_order_details($product_code);

    if(empty($orders_details_data)){
        if($db->runDml("DElETE FROM clothes_size WHERE product_code= '$product_code'")){
            if($db->runDml("DElETE FROM product_images WHERE product_code= '$product_code'")){
                if($db->runDml("DElETE FROM review WHERE product_code= '$product_code'")){
                    if($db->runDml("DElETE FROM wish_list WHERE product_code= '$product_code'")){
                        if($db->runDml("DElETE FROM products WHERE product_code= '$product_code'")){
                            header('location: index.php?result=1');
                        }
                    }
                }
            }
        }
    }else{
        $orders_id=array();
        foreach($orders_details_data as $order_detail){
            $order_id=$order_detail['order_id'];
            $orders_id[]=$order_id;
        }
        $count=0;
        foreach($orders_id as $order){
            $orderData=$the_orders->select_by_order($order);
            $the_done=$orderData['done'];
            if($the_done==0){
                $count++;
            }
        }
        if($count > 0){
            header('location: index.php?result=2');
        }else{
            if($db->runDml("DElETE FROM clothes_size WHERE product_code= '$product_code'")){
                if($db->runDml("DElETE FROM order_details WHERE product_code= '$product_code'")){
                    if($db->runDml("DElETE FROM product_images WHERE product_code= '$product_code'")){
                        if($db->runDml("DElETE FROM review WHERE product_code= '$product_code'")){
                            if($db->runDml("DElETE FROM wish_list WHERE product_code= '$product_code'")){
                                if($db->runDml("DElETE FROM products WHERE product_code= '$product_code'")){
                                    header('location: index.php?result=1');
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

?>