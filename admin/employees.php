
<?php include "./inc/sidebar.php"; ?>
    <div class="employees_con">
        <form class="add_employee" action="" method="POST">
            <h3>Add Employee</h3>
            <input type="text" name="fname" placeholder="First name" required>
            <input type="text" name="lname" placeholder="Last name" required>
            <input type="text" name="position" placeholder="Position" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="add_employee_btn" value="Add Now" required>
        </form>
        <?php
            if(isset($_POST["add_employee_btn"])){
                $employee_id = uniqid();
                $position = strtolower($_POST["position"]);
                $employee_sql = "INSERT INTO employees(
                    employee_id,
                    fname,
                    lname,
                    position,
                    email,
                    password
                ) VALUES (
                    '$employee_id',
                    '{$_POST["fname"]}',
                    '{$_POST["lname"]}',
                    '{$position}',
                    '{$_POST["email"]}',
                    '{$_POST["password"]}'
                )";

                if (mysqli_query($conn, $employee_sql)) {
                    //Show success message
                    popup_message("Employee added successfully", "SUCCESS");
                } else {
                    echo "Error: " . $employee_sql . "<br>" . mysqli_error($conn);
                }
            }
        ?>
        
        <div class="employee_list_con">
            <h3>Employees</h3>
            <div>
                <table>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Email</th>
                    </tr>
                    <?php
                        $get_employees_sql = "SELECT * FROM employees WHERE position != 'admin' ";
                        $result = mysqli_query($conn, $get_employees_sql);
                        if(mysqli_num_rows($result) > 0){
                            while($employee = mysqli_fetch_assoc($result)){
                                echo '
                                <tr>
                                    <td>'.$employee["fname"].' '.$employee["lname"].'</td>
                                    <td>'.$employee["position"].'</td>
                                    <td>'.$employee["email"].'</td>
                                </tr>
                                ';
                            }
                        }
                        mysqli_close($conn);
                    ?>
                </table>
            </div>
        </div>
    </div>

</body>
</html>


