<?php include "./inc/sidebar.php"; ?>
    <div class="edit_product_con">
        <h3>Edit Product</h3>
        <form class="edit_product" action="" method="POST" enctype="multipart/form-data">
            <?php
                if(!isset($_GET["product_id"])){
                    header("Location: ./index.php");
                    exit();
                }
                $product_sql = "SELECT * FROM products WHERE product_id='{$_GET["product_id"]}' ";
                $result1 = mysqli_query($conn, $product_sql);
                if(mysqli_num_rows($result1) > 0){
                    $product = mysqli_fetch_assoc($result1);
                }
            ?>
            <img id="image_viewer" src="../uploads/<?php echo $product["product_image"]; ?>" alt="">
            <input type="file" name="product_image" accept="image/*" id="product_image" name="product_image">
            <input type="text" value="<?php echo $product["product_name"]; ?>" name ="product_name" placeholder="Product name" required>
            <input type="number" value="<?php echo $product["buying_price"]; ?>" name="buying_price" placeholder="Buying price (Php)" required>
            <input type="number" value="<?php echo $product["selling_price"]; ?>" name="selling_price" placeholder="Selling price (Php)" reqiured>
            <input type="number" value="<?php echo $product["qty_in_stock"]; ?>" name="qty_in_stock" placeholder="Quantity in the stock" required>
            <select name="brand_id" required>
                <option value="">--Select a brand--</option>
                <?php
                    $get_brand_sql = "SELECT * FROM brands";
                    $result2 = mysqli_query($conn, $get_brand_sql);
                    if(mysqli_num_rows($result2) > 0){
                        while($row = mysqli_fetch_assoc($result2)){
                            ?>
                                <option <?php echo $product["brand_id"] == $row["brand_id"] ? "selected": ""; ?> value="<?php echo $row["brand_id"];?>"> <?php echo $row["brand_name"]; ?></option>
                            <?php
                        }
                    }else {
                        echo "Error: " . $get_brand_sql . "<br>" . mysqli_error($conn);
                    }
                ?>
            </select>
            <textarea name="description" placeholder="Product description"><?php echo $product["product_description"]; ?></textarea>
            <input type="submit" name="edit_product_btn" value="Submit">
        </form>

        <?php
            if(isset($_POST["edit_product_btn"])){
                $product_sql = "SELECT product_image FROM products WHERE product_id='{$_GET["product_id"]}' ";
                $result3 = mysqli_query($conn, $product_sql);
                if(mysqli_num_rows($result3)){
                    $product = mysqli_fetch_assoc($result3);
                    $current_image_name = $product["product_image"];
                }

                if($_FILES["product_image"]["error"] == 4){
                   $image_name = $current_image_name;
                }else{
                    $exploded = explode(".", $_FILES["product_image"]["name"]);
                    $extension = end($exploded);
                    // Create a new filname
                    $new_image_name = "product_".uniqid().".".$extension;
                    $target_file = "../uploads/".$new_image_name;

                    # DELETE THE PREVIOUS IMAGE IN product_img FOLDER
                    if(unlink($_SERVER['DOCUMENT_ROOT'] . "/rejuvenating_set/uploads/". $current_image_name)){
                        # MOVE THE NEW IMAGE TO product_img FOLDER AND CHECK IF IT IS SUCCESSFULL
                        if(move_uploaded_file($_FILES["product_image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/rejuvenating_set/uploads/". $new_image_name)){
                            $image_name = $new_image_name;
                        }
                    }
                }

                $edit_product_sql = "UPDATE products SET 
                    brand_id ='{$_POST["brand_id"]}',
                    product_image='$image_name',
                    product_name='{$_POST["product_name"]}',
                    buying_price={$_POST["buying_price"]},
                    selling_price={$_POST["selling_price"]},
                    qty_in_stock={$_POST["qty_in_stock"]},
                    product_description='{$_POST["description"]}'
                WHERE product_id='{$_GET["product_id"]}'";

                if(mysqli_query($conn, $edit_product_sql)){
                    header("Location: ./products.php");
                }else{
                    popup_message("Update error", "ERROR");
                }
            }
        ?>
    </div>
    <script>
        // Preview Product Image
        let viewer = document.getElementById("image_viewer");
        let imageFile = document.getElementById("product_image");
        viewer.addEventListener("click", ()=> {
            imageFile.click();
        });
        imageFile.addEventListener("change", (event) => {
            file = URL.createObjectURL(event.target.files[0]);
            viewer.src = file;
        })
    </script>
</body>
</html>