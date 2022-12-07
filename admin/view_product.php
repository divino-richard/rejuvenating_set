<?php include "./inc/sidebar.php"; ?>
    <?php 
        if(!isset($_GET["product_id"])){
            header("Location: ./products.php");
            exit();
        }
        // GET PRODUCT
        $product_sql = "SELECT * FROM products WHERE product_id='{$_GET["product_id"]}'";
        $result1 = mysqli_query($conn, $product_sql);
        if(mysqli_num_rows($result1) > 0){
            $product = mysqli_fetch_assoc($result1);
        }
        // GET BRAND
        $brand_sql = "SELECT * FROM brands WHERE brand_id='{$product["brand_id"]}'";
        $result2 = mysqli_query($conn, $brand_sql);
        if(mysqli_num_rows($result2) > 0){
            $brand = mysqli_fetch_assoc($result2);
        }
    ?>
    <div class="view_product_con">
        <img src="../uploads/<?php echo $product["product_image"]; ?>" alt="">
        <section>
            <div class="product_info">
                <h3><?php echo $product["product_name"]; ?></h3>
                <p>Brand: <?php echo $brand["brand_name"]; ?></p>
                <p>Buying Price: PHP <span><?php echo number_format($product["buying_price"], 2); ?></span></p>
                <p>Selling Price: PHP <span><?php echo number_format($product["selling_price"], 2);  ?></span></p>
                <p>Quantity in the stock: <?php echo $product["qty_in_stock"]; ?></p>
                <p>Description: <?php echo $product["product_description"]; ?></p><br>
                <?php
                    if(isset($_SESSION["admin"])){
                        echo '<a href="./edit_product.php?product_id='.$product["product_id"].'">Edit Product</a>';
                    }                
                ?>
            </div>
            <div class="seller_info">
                <h3>Seller Info</h3>
                <?php
                    if(empty($product["employee_id"])){
                        echo "<p>Product does not been displayed by any seller!</p>";
                    }else{
                        $employee_sql = "SELECT * FROM employees WHERE employee_id = '{$product["employee_id"]}' ";
                        $result3 = mysqli_query($conn, $employee_sql);
                        if(mysqli_num_rows($result3) > 0){
                            $employee = mysqli_fetch_assoc($result3);
                            echo '
                                <p>Name: '.$employee["fname"].' '.$employee["lname"].'</p>
                                <p>Position: '.$employee["position"].'</p>
                                <p>Email: '.$employee["email"].'</p>
                            ';
                        }else{
                            echo "<p>Product does not been displayed by any seller";
                        }
                    }
                ?>
            </div>
        </section>
    </div>
</body>
</html>