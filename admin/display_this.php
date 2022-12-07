<?php
include "../config/dbh.php";
if(isset($_GET["employee_id"]) && isset($_GET["product_id"])){
    $sql = "UPDATE products SET employee_id='{$_GET["employee_id"]}' WHERE product_id='{$_GET["product_id"]}'";
    if(mysqli_query($conn, $sql)){
        header("Location: ./displayed.php");
    }else{
        header("Location: ./products.php");
    }
}else{
    header("Location: ./products.php");
}

