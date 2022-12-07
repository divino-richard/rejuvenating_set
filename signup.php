<?php
    include "./config/dbh.php";
    include "./utils/utils.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./utils/utils.css">
    <title>Sign up</title>
    <style>
        .form_con{
            padding: 2rem 5rem;
            font-family: Arial, Helvetica, sans-serif;
        }
        .form_con a{
            color: #000;
            text-decoration: none;
        }
        .form_con a:hover{
            color: #ff4aa1;
        }
        form{
            width: 20rem;
            height: max-content;
            margin:2rem auto;
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
            outline-color: #ff4aa1;
        }
        input[type="submit"]{
            background: #ff4aa1;
            color: #FFF;
            cursor: pointer;
            border: 1px solid #ff4aa1;
        }
        input[type="submit"]:hover{
            background-color: #FFF;
            color: #2d2d2d;
        }

        h2{
            color: #ff4aa1;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="form_con">
        <a href="./">&#8592 Back</a>
        <form action="" method="POST">
            <h2>Create Account</h2>
            <input type="text" name="fname" placeholder="First name" required>
            <input type="text" name="lname" placeholder="Last name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm password" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="number" name="phonenumber" placeholder="Phone number" required>
            <input type="submit" name="signup" value="Sign up">
            <p>Already have an account? <a href="./login.php">Log in here</a></p>
        </form>
        <?php
            // Once form being submited
            if(isset($_POST["signup"])){
                if($_POST["confirm_password"] != $_POST["password"]){
                    //Show ERROR Message
                    popup_message("Passwords not match", "ERROR");
                    die();
                }
                $customer_id = uniqid();
                $sql = "INSERT INTO customers(customer_id, fname, lname, email, password, address, phonenumber)
                    VALUES (
                        '$customer_id',
                        '{$_POST["fname"]}', 
                        '{$_POST["lname"]}', 
                        '{$_POST["email"]}', 
                        '{$_POST["password"]}',
                        '{$_POST["address"]}', 
                        '{$_POST["phonenumber"]}' 
                    )
                ";

                if (mysqli_query($conn, $sql)) {
                    //Show success message
                    popup_message("Thank you for signing up", "SUCCESS");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
                
                mysqli_close($conn);
            }

        ?>
    </div>
</body>
</html> 