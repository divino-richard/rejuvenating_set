<?php include "./inc/sidebar.php"; ?>
    <div class="table_con">
        <h3>Customers Orders</h3>
        <div>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                    $orders_sql = "SELECT * FROM orders";
                    $result1 = mysqli_query($conn, $orders_sql);
                    if(mysqli_num_rows($result1) > 0){
                        while($order = mysqli_fetch_assoc($result1)){
                            $product_sql = "SELECT * FROM products WHERE product_id = '{$order["product_id"]}' ";
                            $result2 = mysqli_query($conn, $product_sql);
                            if(mysqli_num_rows($result2) > 0){
                                $product = mysqli_fetch_assoc($result2);
                                if(isset($_SESSION["employee"])){
                                    if($_SESSION["employee"]["employee_id"] != $product["employee_id"]){
                                        continue;
                                    }
                                }
                            }

                            ?>
                            <tr>
                                <td>
                                    <img src="../uploads/<?php echo $product["product_image"]; ?>" alt="">
                                </td>
                                <td><?php echo $product["product_name"]; ?></td>
                                <td>PHP <?php echo number_format($product["selling_price"], 2); ?></td>
                                <td><?php echo $order["quantity"]; ?></td>
                                <td>PHP <?php echo number_format($order["amount"], 2); ?></td>
                                <td><?php echo $order["order_status"]; ?></td>
                                <td>
                                    Mark as
                                    <select id="<?php echo $order['order_id']; ?>" onchange="deliveryStatusChange(`<?php echo $order['order_id']; ?>`);" <?php echo $order["order_status"] == "Delivered" ? "disabled" : ""; ?>>
                                        <option value="On Process" <?php echo $order["order_status"] == "On Process" ? "selected" : ""; ?> >On Process</option>
                                        <option value="Shipped" <?php echo $order["order_status"] == "Shipped" ? "selected" : ""; ?> >Shipped</option>
                                        <option value="Delivered" <?php echo $order["order_status"] == "Delivered" ? "selected" : ""; ?> >Delivered</option>
                                    </select>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <script>
        function deliveryStatusChange(orderID){
            let status = document.getElementById(orderID).value
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    location.reload();
                }
            };
            xhttp.open("POST", "./ajax.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(`action=ChangeDeliveryStatus&order_id=${orderID}&status=${status}`);
        }
    </script>
</body>
</html>