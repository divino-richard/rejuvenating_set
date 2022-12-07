<?php include "./inc/sidebar.php"; ?>
<div class="table_con">
        <h3>Customers List</h3>
        <div>
            <table>
                <tr>
                    <th>Name</th>
                    <th>E-mail</th>
                    <th>Address</th>
                    <th>Phone number</th>
                </tr>

                <?php
                    $customers_sql = "SELECT * FROM customers";
                    $result = mysqli_query($conn, $customers_sql);
                    if(mysqli_num_rows($result) > 0){
                        while($customer = mysqli_fetch_assoc($result)){
                            echo '
                            <tr>
                                <td>'.$customer["fname"].' '.$customer["lname"].'</td>
                                <td>'.$customer["email"].'</td>
                                <td>'.$customer["address"].'</td>
                                <td>'.$customer["phonenumber"].'</td>
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