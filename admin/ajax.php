<?php
include "../config/dbh.php";

if(isset($_POST["action"])){
    if($_POST["action"] == "ChangeDeliveryStatus"){
        $sql1 = "UPDATE orders SET order_status='{$_POST["status"]}' WHERE order_id='{$_POST["order_id"]}' ";
        if(mysqli_query($conn, $sql1)){
            echo "Status Changed";
        }
    }
}


