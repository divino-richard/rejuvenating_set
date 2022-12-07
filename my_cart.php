<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <style>
        .my_cart_con{
            padding: 2rem;
            font-family: "Lato", sans-serif;
            color: #414141;
        }
        .back_btn{
            color: #414141;
            text-decoration: none;
        }
        .my_cart_con a:hover{
            color: #f9004d;
        }
        .cart_items{
            width: 75%;
            margin: 0 auto;
        }
        .cart_items li{
            display: flex;
            align-items: center;
            justify-content: space-between;
            list-style: none;
            background-color: #f8f8f8; 
            border: 1px solid #d8d8d8;
            padding: 5px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .cart_items img{
            height: 50px;
            width: 60px;
            border: 1px solid #d8d8d8;
            border-radius: 5px;
        }
        .cart_items p{
            padding: 0 25px;
        }
        .order_now_btn{
            padding: 10px 15px;
            background-color: #f9004d;
            border: 1px solid #f9004d;
            margin-right: 1rem;
            border-radius: 7px;
            text-decoration: none;
            color: #FFF;
        }
        .order_now_btn:hover{
            background-color: #FFF;
        }
    </style>
</head>
<body>
    <div class="my_cart_con">
        <a class="back_btn" href="./">&#8592 Back</a>
        <ul class="cart_items">
            <h3>Cart List</h3>
            <?php
                session_start();
                include "./config/dbh.php";

                if(!isset($_SESSION["customer"])){
                    header("Location: ./login.php");
                    exit();
                }
                $cart_sql = "SELECT * FROM carts WHERE customer_id = '{$_SESSION["customer"]["customer_id"]}' ";
                $result1 = mysqli_query($conn, $cart_sql);
                if(mysqli_num_rows($result1) > 0){
                    while($cart_item = mysqli_fetch_assoc($result1)){
                        $product_sql = "SELECT * FROM products WHERE product_id = '{$cart_item["product_id"]}' ";
                        
                        $result2 = mysqli_query($conn, $product_sql);
                        if(mysqli_num_rows($result2) > 0){
                            $product = mysqli_fetch_assoc($result2);
                        }
                        echo '
                            <li>
                                <img src="./uploads/'.$product["product_image"].'" alt="">
                                <p>'.$product["product_name"].'</p>
                                <p>'.$cart_item["quantity"].' items</p>
                                <a class="order_now_btn" href="./view_product.php?product_id='.$product["product_id"].'&order='.$cart_item["quantity"].'">
                                    Order now
                                </a>
                            </li>
                        ';
                    }
                }else{
                    echo '
                        <li>
                            <p>Cart is empty</p>
                        </li>
                    ';
                }
            ?>
           
        </ul>
    </div>
</body>
</html>