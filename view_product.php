<?php
    session_start();
    include "./config/dbh.php";
    include "./utils/utils.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./utils/utils.css">
    <title>Product Details</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        a{
            text-decoration: none;
            color: #505050;
        }
        .product_details_con{
            padding: 2rem;
        }
        
        .back_btn{
            font-size: 17px;
        }
        .back_btn:hover{
            color: #f9004d;
        }
        .product_details{
            display: flex;
            margin-top: 1.5rem;
        }
        .product_details img{
            height: 400px;
            width: 450px;
            margin-right: 2rem;
            border-radius: 7px;
            border: 1px solid #b8b8b8;
        }
        .add_cart_btn,
        .order_btn{
            color: #FFF;
            border-radius: 5px;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        .add_cart_btn{
            background-color: #ff42aa;
        }
        .order_btn{
            background-color: #c8265f;
        }
        .action_form{
            color: #6a6666;
        }
        .action_form input{
            padding: 5px 10px;
            border-radius: 5px;
            border: 1px solid #6a6666;
        }
        .action_form input[type="submit"]{
            background-color: #c8265f;
            color: #FFF;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
        if(!isset($_GET["product_id"])){
            header("Location: ./");
            exit();
        }

        $sql = "SELECT * FROM products WHERE product_id='{$_GET["product_id"]}'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $product = mysqli_fetch_assoc($result);
        }
    ?>
    <div class="product_details_con">
        <a class="back_btn" href="./">&#8592 Back</a>
        <div class="product_details">
            <img src="./uploads/<?php echo $product["product_image"]; ?>" alt="">
            <section>
                <h3><?php echo $product["product_name"]; ?></h3>
                <p>PHP <span><?php echo number_format($product["selling_price"], 2); ?></span></p>
                <p>Description: <?php echo $product["product_description"]; ?></p>
                <p>Quantity from stock: <?php echo $product["qty_in_stock"]; ?></p>
                <div class="action">
                    <button class="add_cart_btn">&#43 Add to cart</button>
                    <button class="order_btn">Order now</button>
                </div>
                <div class="action_form">
                    <?php
                        if(isset($_GET["order"])){
                            echo '
                                <form action="" method="POST">
                                    <h3>Order Details</h3>
                                    <input type="number" readonly="readonly" name="order_quantity" value="'.$_GET["order"].'" placeholder="Quantity" required min=1>
                                    <p>Payment Method: Cash On Delivery</p>
                                    <p>Shipping pay: PHP 140.00</p>
                                    <input type="submit" name="order_now" value="Place Order">
                                </form>
                            ';
                        }
                    ?>
                    <!-- Forms be rendered here -->
                </div>
                <?php
                    // PROCESS CART
                    if(isset($_POST["add_cart"])){
                        if($product["qty_in_stock"] <= 0){
                            popup_message("Product is out of stock", "ERROR");

                        }else if($product["qty_in_stock"] < $_POST["cart_quantity"]){
                            popup_message("We only have ".$product["qty_in_stock"]. " available item/s in the stock.", "ERROR");
                        
                        }else if(!isset($_SESSION["customer"])){
                            popup_message("You need to login first", "WARNING");
                        
                        }else{
                            // WILL BE EXECUTED IF EVERYTHING IS OKAY
                            $cart_id = uniqid();
                            $add_cart_sql = "INSERT INTO carts(
                                cart_id,
                                customer_id,
                                product_id,
                                quantity
                            ) VALUES (
                                '$cart_id',
                                '{$_SESSION["customer"]["customer_id"]}',
                                '{$_GET["product_id"]}',
                                '{$_POST["cart_quantity"]}'
                            )";

                            if(mysqli_query($conn, $add_cart_sql)){
                                $new_qty_in_stock = $product["qty_in_stock"] - $_POST["cart_quantity"];
                                $qty_in_stock_sql = "UPDATE products SET qty_in_stock=$new_qty_in_stock WHERE product_id='{$product["product_id"]}' ";
                                if(mysqli_query($conn, $qty_in_stock_sql)){
                                    header("Location: ./my_cart.php");
                                }
                            }
                        }
                    }

                    // PROCESS ORDER
                    if(isset($_POST["order_now"])){
                        // MEANS THE ITEM IS ALREADY IN THE CART AND THE PRODUCT QTY IN STOCK WAS IS ALREADY DEDUCTED
                        if(!isset($_SESSION["customer"])){
                            popup_message("You need to login first", "WARNING");

                        }else{
                            $order_id = uniqid();
                            $std_ship_pay = 140;
                            $order_amount = ($product["selling_price"] * $_POST["order_quantity"]) + $std_ship_pay; 
                            $order_now_sql = "INSERT INTO orders(
                                order_id,
                                customer_id,
                                product_id,
                                quantity,
                                amount,
                                order_status
                            ) VALUES (
                                '$order_id',
                                '{$_SESSION["customer"]["customer_id"]}',
                                '{$_GET["product_id"]}',
                                '{$_POST["order_quantity"]}',
                                '$order_amount',
                                'On Process'
                            )";

                            if(!isset($_GET["order"])){
                                if($product["qty_in_stock"] <= 0){
                                    popup_message("Product is out of stock", "ERROR");
                                    
                                }else if($product["qty_in_stock"] < $_POST["order_quantity"]){
                                    popup_message("We only have ".$product["qty_in_stock"]. " available item/s in the stock.", "ERROR");
                                
                                }else{
                                    if(mysqli_query($conn, $order_now_sql)){
                                        $new_qty_in_stock = $product["qty_in_stock"] - $_POST["order_quantity"];
                                        $qty_in_stock_sql = "UPDATE products SET qty_in_stock=$new_qty_in_stock WHERE product_id='{$product["product_id"]}' ";
                                        if(mysqli_query($conn, $qty_in_stock_sql)){
                                            header("Location: ./my_order.php");
                                        }
                                    }
                                }
                            }else{
                                if(mysqli_query($conn, $order_now_sql)){
                                    header("Location: ./my_order.php");
                                }
                            }
                        }
                    }
                ?>
            </section>
        </div>
    </div>
    <script>
        let actionForm = document.querySelector(".action_form");
        document.querySelector(".add_cart_btn").addEventListener("click", ()=> {
            actionForm.innerHTML = `  
                <form action="" method="POST">
                    <h3>Cart Details</h3>
                    <input type="number" name="cart_quantity" placeholder="Quantity" required min=1>
                    <input type="submit" name="add_cart" value="Add Cart">
                </form>
            `;
        })
        document.querySelector(".order_btn").addEventListener("click", ()=> {
            actionForm.innerHTML = `  
                <form action="" method="POST">
                    <h3>Order Details</h3>
                    <input type="number" name="order_quantity" placeholder="Quantity" required min=1>
                    <p>Payment Method: Cash On Delivery</p>
                    <p>Shipping pay: PHP 140.00</p>
                    <input type="submit" name="order_now" value="Place Order">
                </form>
            `;
        })
    </script>
</body>
</html> 