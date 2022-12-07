<?php
    session_start();
    include "./config/dbh.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Shop Website</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./utils/utils.css">
</head>
<body>

    <section>
        <header>
            <div class="circle"></div>
            <a href="#" class="logo">Beauty<span>Shop</span></a>
            <ul>
                <li><a href="./">Home</a></li>
                <li><a href="./my_order.php">Orders</a></li>
                <li><a href="./my_cart.php">Cart</a></li>
            </ul>

            <div class="login_signup">
                <?php 
                    if(isset($_SESSION["customer"])){
                        ?>
                            <a class="my_account" href="#">
                                <?php
                                    echo $_SESSION["customer"]["fname"][0]."".$_SESSION["customer"]["lname"][0];
                                ?>
                            </a>
                            <a class="logout" href="./logout.php">Log out</a>
                        <?php
                    }else{
                        ?>
                            <a class="login" href="./signup.php">Sign up</a>
                            <a class="signup" href="./login.php">Login</a>
                        <?php
                    }
                ?>
                
            </div>
        </header>

        <div class="banner">
            <img src="./img/banner.jpg">
        </div>
    </section>

    <!-- Brands -->
    <div class="brands">
        <ul>
            <li><span>Brands &#8702</span></li>
            <?php
                $brand_sql = "SELECT * FROM brands";
                $result = mysqli_query($conn, $brand_sql);
                if(mysqli_num_rows($result) > 0){
                    while($brand = mysqli_fetch_assoc($result)){
                        echo '<li><a href="./?brand_id='.$brand["brand_id"].'">'.$brand["brand_name"].'</a></li>';
                    }
                }
            ?>
        </ul>
    </div>    

    <h2 class="products_title">Products</h2>
    <div class="products">
        <?php
            if(isset($_GET["brand_id"])){
                $products_sql = "SELECT * FROM products WHERE employee_id != '' and brand_id='{$_GET["brand_id"]}' ";
            }else{
                $products_sql = "SELECT * FROM products WHERE employee_id != '' ";
            }
            $result = mysqli_query($conn, $products_sql);
            if(mysqli_num_rows($result) > 0){
                while($product = mysqli_fetch_assoc($result)){
                    echo '
                        <div class="product">
                            <a href="./view_product.php?product_id='.$product["product_id"].'">
                                <img src="./uploads/'.$product["product_image"].'" alt="">
                            </a>
        
                            <div class="product_info">
                                <h4>'.$product["product_name"].'</h4>
                                <p>Php <span>'.number_format($product["selling_price"], 2).'</span></p>
                            </div>
                        </div>
                    ';
                }
            }
        ?>
    </div>

    <!--fotter-->
    <footer class="footer">
        <div class="main">
            <div class="row">
                <div class="footer_col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">about us</a></li>
                        <li><a href="#">our services</a></li>
                        <li><a href="#">privacy policy</a></li>
                        <li><a href="#">affiliate program</a></li>
                    </ul>
                </div>


                <div class="footer_col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">shiping</a></li>
                        <li><a href="#">returns</a></li>
                        <li><a href="#">payment options</a></li>
                    </ul>
                </div>

                <div class="footer_col">
                    <h4>Online</h4>
                    <ul>
                        <li><a href="#">Toner</a></li>
                        <li><a href="#">Sunblock </a></li>
                        <li><a href="#">Cream</a></li>
                        <li><a href="#">Soap</a></li>
                    </ul>
                </div>

                <div class="footer_col">
                    <h4>Follow us</h4>
                    <div class="social">
                        <a href="#"><img src="./img/fb.jpg"></a>
                        <a href="#"><img src="./img/google.jpg"></a>
                        <a href="#"><img src="./img/twitter.jpg"></a>
                        <a href="#"><img src="./img/instagram.jpg"></a>
                    </div>               
                </div>
            </div>
        </div>
    </footer>
    <script src="./app.js"></script>
</body>
</html>