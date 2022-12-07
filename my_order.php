<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        .my_order_con{
            padding: 2rem;
            font-family: "Lato", sans-serif;
            color: #414141;
        }
        .my_order_con a{
            color: #414141;
            text-decoration: none;
        }
        .my_order_con a:hover{
            color: #f9004d;
        }
        .orders{
            width: 85%;
            margin: 0 auto;
        }
        .orders li{
            display: flex;
            align-items: center;
            justify-content: space-between;
            list-style: none;
            background-color: #f8f8f8; 
            border: 1px solid #d8d8d8;
            font-size: 13px;
            padding: 5px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .orders img{
            height: 50px;
            width: 60px;
            border: 1px solid #d8d8d8;
            border-radius: 5px;
        }
        .orders p{
            padding: 0 25px;
        }
    </style>
</head>
<body>
    <div class="my_order_con">
        <a href="./">&#8592 Back</a>
        <ul class="orders">
            <h3>Order List</h3>
            <?php
                session_start();
                include "./config/dbh.php";

                if(!isset($_SESSION["customer"])){
                    header("Location: ./login.php");
                    exit();
                }
                $order_sql = "SELECT * FROM orders WHERE customer_id = '{$_SESSION["customer"]["customer_id"]}' ";
                $result1 = mysqli_query($conn, $order_sql);
                if(mysqli_num_rows($result1) > 0){
                    while($order = mysqli_fetch_assoc($result1)){
                        $product_sql = "SELECT * FROM products WHERE product_id = '{$order["product_id"]}' ";
                        
                        $result2 = mysqli_query($conn, $product_sql);
                        if(mysqli_num_rows($result2) > 0){
                            $product = mysqli_fetch_assoc($result2);
                        }
                        echo '
                            <li>
                                <img src="./uploads/'.$product["product_image"].'" alt="">
                                <p>'.$product["product_name"].'</p>
                                <p>Shipping pay: PHP 140.00</p>
                                <p>Price: PHP '.number_format($product["selling_price"], 2).'</p>
                                <p>Qty: '.$order["quantity"].'</p>
                                <p>Amount: PHP '.number_format($order["amount"], 2).'</p>
                                <p>Status: '.$order["order_status"].'</p>
                            </li>
                        ';
                    }
                }else{
                    echo '
                        <li>
                            <p>Order is empty</p>
                        </li>
                    ';
                }
            ?>
           
        </ul>
    </div>
</body>
</html>