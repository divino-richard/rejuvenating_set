
<?php include "./inc/sidebar.php"; ?>
    <div class="products_con">
        <div class="product_list_con">
            <h3>Product List</h3>
            <div class="product_list">
                <?php
                    $sql = "SELECT product_id, employee_id, product_image, product_name FROM products";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($result) > 0){
                        while($product = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="product">
                                <?php
                                if(isset($_SESSION["admin"])){ 
                                    echo '<div class="product_action">
                                        <a href="./edit_product.php?product_id='.$product["product_id"].'"><img src="../img/edit.png" alt=""></a>
                                    </div>';
                                }
                                ?>
                                <a href="./view_product.php?product_id=<?php echo $product["product_id"]; ?>">
                                    <img src="../uploads/<?php echo $product["product_image"]; ?>" alt="">
                                </a>
                                <span><?php echo $product["product_name"]; ?></span>
                                <?php
                                    if(isset($_SESSION["employee"])){ 
                                        echo empty($product["employee_id"]) ? 
                                            '<a class="display_this_btn" href="./display_this.php?employee_id='.$_SESSION["employee"]["employee_id"].'&product_id='.$product["product_id"].'">Display This</a>'
                                        : '<p style="color:green;padding:5px;font-size:15px;">Displayed</p>';
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    }
                ?>
            </div>
        </div>

        <?php
            if(isset($_SESSION["admin"])){
                include "./add_product.php";
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


