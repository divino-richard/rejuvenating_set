<?php
    session_start();
    include "../config/dbh.php";
    include "../utils/utils.php";

    if(!isset($_SESSION["admin"]) && !isset($_SESSION["employee"])){
        header("Location: ./login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <link rel="stylesheet" href="./styles/sidebar.css">
    <link rel="stylesheet" href="./styles/products.css">
    <link rel="stylesheet" href="./styles/view_product.css">
    <link rel="stylesheet" href="./styles/employees.css">
    <link rel="stylesheet" href="./styles/tables.css">
    <link rel="stylesheet" href="./styles/edit_product.css">
    <link rel="stylesheet" href="../utils/utils.css">
    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <?php
            if(isset($_SESSION["admin"])){
                echo "<h3>ADMIN</h3>";
                echo "<p>HI, ".$_SESSION["admin"]["fname"]." ".$_SESSION["admin"]["lname"]."</p>";
            }
            if(isset($_SESSION["employee"])){
                echo "<h3>SELLER</h3>";
                echo "<p>HI, ".$_SESSION["employee"]["fname"]." ".$_SESSION["employee"]["lname"]."</p>";
            }
        ?>
        <div class="sidenav">

            <a href="./">Home</a>
            <a href="./products.php">Products</a>
            <?php
                if(isset($_SESSION["admin"])){
                    ?>
                    <a href="./employees.php">Employees</a>
                    <a href="./customers.php">Customers</a>
                    <?php
                }
                if(isset($_SESSION["employee"])){
                    ?>
                    <a href="./displayed.php">Displayed</a>
                    <?php
                }
            ?>
            <a href="./orders.php">Orders</a>
            <a href="./carts.php">Carts</a>
            <a href="./logout.php">Logout</a>
        </div>
    </div>