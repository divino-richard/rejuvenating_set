<?php include "./inc/sidebar.php"; ?>
    <div class="dashboard">
        <h3>Dashboard</h3>
        <section>
            <section class="sales">
                <h4>Sales</h4>
                <?php
                    $sales_sql = "SELECT * FROM orders WHERE order_status='Delivered' ";
                    $result1 = mysqli_query($conn, $sales_sql);
                    if(mysqli_num_rows($result1) > 0){
                        $sum = 0;
                        while($sale = mysqli_fetch_assoc($result1)){
                            $product_sql1 = "SELECT employee_id FROM products WHERE product_id='{$sale["product_id"]}'";
                            $p_res1 = mysqli_query($conn, $product_sql1);
                            if(mysqli_num_rows($p_res1) > 0){
                                $product = mysqli_fetch_assoc($p_res1);
                                if(isset($_SESSION["employee"])){
                                    if($_SESSION["employee"]["employee_id"] != $product["employee_id"]){
                                        continue;
                                    }
                                }
                            }
                            $sum += $sale["amount"];
                        }
                        echo '<span>'.number_format($sum, 2).'</span>';
                    }else{
                        echo '<span>00.00</span>';
                    }
                ?>
            </section>
            <div>
                <h4>Orders</h4>
                <?php
                    $order_sql = "SELECT * FROM orders ";
                    $result2 = mysqli_query($conn, $order_sql);
                    if(mysqli_num_rows($result2) > 0){
                        $order_count = 0;
                        while($order = mysqli_fetch_assoc($result2)){
                            $product_sql2 = "SELECT employee_id FROM products WHERE product_id='{$order["product_id"]}'";
                            $p_res2 = mysqli_query($conn, $product_sql2);
                            if(mysqli_num_rows($p_res2) > 0){
                                $product = mysqli_fetch_assoc($p_res2);
                                if(isset($_SESSION["employee"])){
                                    if($_SESSION["employee"]["employee_id"] != $product["employee_id"]){
                                        continue;
                                    }
                                }
                            }
                            $order_count++;
                        }
                        echo '<span>'.number_format($order_count).'</span>';
                    }else{
                        echo '<span>00.00</span>';
                    }               
                ?>
            </div>
            <div>
                <h4>Carts</h4>
                <?php
                    $cart_sql = "SELECT * FROM carts ";
                    $result3 = mysqli_query($conn, $cart_sql);
                    if(mysqli_num_rows($result3) > 0){
                        $cart_count = 0;
                        while($cart = mysqli_fetch_assoc($result3)){
                            $product_sql3 = "SELECT employee_id FROM products WHERE product_id='{$cart["product_id"]}'";
                            $p_res3 = mysqli_query($conn, $product_sql3);
                            if(mysqli_num_rows($p_res3) > 0){
                                $product = mysqli_fetch_assoc($p_res3);
                                if(isset($_SESSION["employee"])){
                                    if($_SESSION["employee"]["employee_id"] != $product["employee_id"]){
                                        continue;
                                    }
                                }
                            }
                            $cart_count++;
                        }
                        echo '<span>'.number_format($cart_count).'</span>';
                    }else{
                        echo '<span>00.00</span>';
                    }            
                ?>
            </div>
            <?php
                if(isset($_SESSION["admin"])){
                    ?>
                    <div>
                        <h4>Employees</h4>
                        <?php
                            $employees_sql = "SELECT * FROM employees";
                            $result4 = mysqli_query($conn, $employees_sql);
                            echo '<span>'.mysqli_num_rows($result4).'</span>';                
                        ?>
                    </div>
                    <div>
                        <h4>Costumers</h4>
                        <?php
                            $customer_sql = "SELECT * FROM customers";
                            $result5 = mysqli_query($conn, $customer_sql);
                            echo '<span>'.mysqli_num_rows($result5).'</span>';                
                        ?>
                    </div>
                    <?php
                }
                if(isset($_SESSION["employee"])){
                    ?>
                    <div>
                        <h4>Displayed Product</h4>
                        <?php
                            $products_sql = "SELECT * FROM products WHERE employee_id='{$_SESSION["employee"]["employee_id"]}' ";
                            $result6 = mysqli_query($conn, $products_sql);
                            echo '<span>'.mysqli_num_rows($result6).'</span>';                
                        ?>
                    </div>
                    <?php
                }
            ?>
        </section>
    </div>
</body>
</html>