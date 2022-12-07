<?php
    session_start();
    include "../config/dbh.php";
    include "../utils/utils.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../utils/utils.css">
    <title>Admin Login</title>
    <style>
        .form_con{
            padding: 2rem 5rem;
            font-family: Arial, Helvetica, sans-serif;
        }
        form{
            width: 20rem;
            height: max-content;
            margin:5rem auto;
            display: flex;
            padding: 2rem;
            flex-direction: column;
            background-color: #d4d3d3;
            border-radius: 5px; 
            box-shadow: 0 0 7px 1px;
        }
        input{
            padding: 10px 15px;
            margin: 5px 0;
            font-size: 15px;
            border-radius: 5px; 
            border: none;
            outline-color: #172e51;
        }
        input[type="submit"]{
            background: #172e51;
            color: #FFF;
            cursor: pointer;
            border: 1px solid #172e51;
            margin-top: 1rem;
        }
        input[type="submit"]:hover{
            background-color: #FFF;
            color: #2d2d2d;
        }

        h2{
            color: #172e51;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="form_con">
        <form action="" method="POST">
            <h2>Login </h2>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="login" value="Log in">
        </form>
        <?php
            if(isset($_POST["login"])){
                // Get the costumer
                $sql = "SELECT * FROM employees WHERE email = '{$_POST["email"]}' ";
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);

                    if($_POST["password"] == $row["password"]){
                        if($row["position"] == "admin"){
                            $_SESSION["admin"] = $row;
                        }else{
                            $_SESSION["employee"] = $row;
                        }
                        header("Location: ./");
                    }else{
                        popup_message("Incorrect password", "ERROR");
                    }
                }else{
                    popup_message("Account doesn't exist", "ERROR");
                }
            }
        ?>
    </div>
</body>
</html> 