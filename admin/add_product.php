<section class="product_forms">
    <form class="add_product" action="" method="POST" enctype="multipart/form-data">
        <h3>Add Product</h3>
        <img id="image_viewer" src="../img/image_placeholder.jpg" alt="">
        <input type="file" name="product_image" accept="image/*" id="product_image" name="product_image">
        <input type="text" name ="product_name" placeholder="Product name" required>
        <input type="number" name="buying_price" placeholder="Buying price (Php)" required>
        <input type="number" name="selling_price" placeholder="Selling price (Php)" reqiured>
        <input type="number" name="qty_in_stock" placeholder="Quantity in the stock" required>
        <select name="brand_id" required>
            <option value="">--Select a brand--</option>
            <?php
                $get_brand_sql = "SELECT * FROM brands";
                $result = mysqli_query($conn, $get_brand_sql);
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
                    }
                }else {
                    echo "Error: " . $get_brand_sql . "<br>" . mysqli_error($conn);
                }
            ?>
        </select>
        <textarea name="description" placeholder="Product description"></textarea>
        <input type="submit" name="add_product_btn" value="Add Now">
    </form>

    <form class="add_brand" action="" method="POST">
        <h3>Add Brand</h3>
        <input type="text" name="brand_name" placeholder="Brand name" required/>
        <input type="submit" name="add_brand_btn" value="Add Now">
    </form>
</section>

<?php
    // ADD PRODUCT
    if(isset($_POST["add_product_btn"])){
        // print_r($_FILES["product_image"]);
        if($_FILES["product_image"]["error"] == 4){
            popup_message("Product image should not be empty", "ERROR");
            die();
        }
        $exploded = explode(".", $_FILES["product_image"]["name"]);
        $extension = end($exploded);
        // Create a new filname
        $new_imagename = "product_".uniqid().".".$extension;
        $target_file = "../uploads/".$new_imagename;
        // Upload the product image
        if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)){
            $product_id = uniqid();
            // Value of employee id will be empty as default
            $add_product_sql = "INSERT INTO products(
                product_id, 
                employee_id, 
                brand_id, 
                product_image, 
                product_name, 
                buying_price, 
                selling_price, 
                qty_in_stock, 
                product_description
            ) VALUES (
                '$product_id',
                '',
                '{$_POST["brand_id"]}',
                '$new_imagename',
                '{$_POST["product_name"]}',
                {$_POST["buying_price"]},
                {$_POST["selling_price"]},
                {$_POST["qty_in_stock"]},
                '{$_POST["description"]}'
            )";

            if (mysqli_query($conn, $add_product_sql)) {
                //Show success message
                popup_message("Product added successfully", "SUCCESS");
            } else {
                echo "Error: " . $add_product_sql . "<br>" . mysqli_error($conn);
            }
        }else{
            popup_message("Error uploading file", "ERROR");
        }
    }
?>

<?php
    if(isset($_POST["add_brand_btn"])){
        $brand_id = uniqid();
        $sql = "INSERT INTO brands(brand_id, brand_name) VALUES('$brand_id', '{$_POST["brand_name"]}') ";
        if (mysqli_query($conn, $sql)) {
            //Show success message
            popup_message("Brand added successfully", "SUCCESS");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>