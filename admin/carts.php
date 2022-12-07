<?php include "./inc/sidebar.php"; ?>
    <div class="table_con">
        <h3>Customers Carts</h3>
        <div>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php
                    $carts_sql = "SELECT * FROM carts";
                    $result1 = mysqli_query($conn, $carts_sql);
                    if(mysqli_num_rows($result1) > 0){
                        while($cart = mysqli_fetch_assoc($result1)){
                            $product_sql = "SELECT * FROM products WHERE product_id = '{$cart["product_id"]}' ";
                            $result2 = mysqli_query($conn, $product_sql);
                            if(mysqli_num_rows($result2) > 0){
                                $product = mysqli_fetch_assoc($result2);
                                if(isset($_SESSION["employee"])){
                                    if($_SESSION["employee"]["employee_id"] != $product["employee_id"]){
                                        continue;
                                    }
                                }
                            }
                            
                            echo '
                            <tr>
                                <td>
                                    <img src="../uploads/'.$product["product_image"].'" alt="">
                                </td>
                                <td>'.$product["product_name"].'</td>
                                <td>PHP '.number_format($product["selling_price"], 2).'</td>
                                <td>'.$cart["quantity"].'</td>
                                <td>PHP '.number_format($cart["quantity"] * $product["selling_price"], 2).'</td>
                            </tr>
                            ';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>