<?php include "./inc/sidebar.php"; ?>
    <div class="table_con">
        <h3>My Displayed Products</h3>
        <div>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Brand</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Qty in Stock</th>
                    <th>Discription</th>
                </tr>

                <?php
                    $products_sql = "SELECT * FROM products WHERE employee_id='{$_SESSION["employee"]["employee_id"]}'";
                    $result1 = mysqli_query($conn, $products_sql);
                    if(mysqli_num_rows($result1) > 0){
                        while($product = mysqli_fetch_assoc($result1)){

                            $brand_sql = "SELECT * FROM brands WHERE brand_id = '{$product["brand_id"]}' ";
                            $result2 = mysqli_query($conn, $brand_sql);
                            if(mysqli_num_rows($result2) > 0){
                                $brand = mysqli_fetch_assoc($result2);
                            }

                            echo '
                            <tr>
                                <td>
                                    <img src="../uploads/'.$product["product_image"].'" alt="">
                                </td>
                                <td>'.$product["product_name"].'</td>
                                <td>'.$brand["brand_name"].'</td>
                                <td>PHP '.number_format($product["buying_price"], 2).'</td>
                                <td>PHP '.number_format($product["selling_price"], 2).'</td>
                                <td>'.$product["qty_in_stock"].'</td>
                                <td>'.$product["product_description"].'</td>
                            </tr>
                            ';
                        }
                    }else{
                        popup_message("No displayed product yet!", "WARNING");
                    }
                ?>
            </table>
        </div>
    </div>
</body>
</html>