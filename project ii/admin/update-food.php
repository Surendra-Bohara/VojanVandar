<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br> <br>
        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
            $res2 = mysqli_query($conn, $sql2); 
                $row2 =mysqli_fetch_assoc($res2);
                $title = $row2['title'];
                $discription = $row2['discription'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['categori_id'];
                $featured = $row2['feature'];
                $active = $row2['active'];
            
        
        }else{
            echo"<script>
                alert('Category Not Found.');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
                </script>";

        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>" placeholder="Title goes here" >

                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="discription" cols="30" rows="5"> <?php echo $discription; ?> </textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type= "number" name="price" value="<?php echo $price; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!="")
                        {
                            ?>
                            <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $current_image;?>"width="150px">
                            <?php
                            //display the image
                        }
                        else{
                            //display message
                            echo "<div class = 'error'> Image not added</div>";

                        }

                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                        
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category" >
                            <?php
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];
                                    //echo "<option value='$category_id'>$category_title</option>";
                                    ?>
                                    <option value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                    <?php

                                }

                            }else{
                                echo "<option value ='0'>Category Not Available.</option>";
                            }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured"value="Yes">Yes
                        <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes"){ echo "checked";}?> type="radio" name="active"value="Yes">Yes
                        <input <?php if($active=="No"){ echo "checked";}?> type="radio" name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"> 
                        <input type="submit" name="submit"value="Update Category"class="btn-warning">
                    </td>
                </tr>

            </table>
        </form>
        <?php
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $discription = $_POST['discription'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            // updating new image if selected 
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                if($image_name!="")
                {
                    //upload new image
                    
                    $parts = explode('.', $image_name);
                    $ext = end($parts);
                    //rename name
                    $image_name = "Food_category_".rand(000, 999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "image/Food/".$image_name;
                    $upload = move_uploaded_file($source_path,$destination_path);
                    // check whether the image is uploaded or not
                    if($upload==false)
                        {
                            echo"
                        <script>
                        alert('Failed to Upload Image');
                        window.location.href= 'http://localhost:808/project%20ii/admin/manage-food.php';
                        </script>";
                        die();
                        }
                        //remove current image
                        if($current_image="")
                        {
                            $remove_path = "image/".$current_image;

                            $remove = unlink($remove_path);
                            // check image is remove or not
                            if($remove==false)
                            {
                                echo"
                            <script>
                            alert('Failed to Remove Current Image');
                            window.location.href= 'http://localhost:808/project%20ii/admin/manage-category.php';
                            </script>";
                            die();
                            }

                            if($current_image!="")
                            {
                                // current image is available remove it
                                $remove_path = "image/Food/".$current_image;
                                $remove = unlink($remove_path);
                                if($remove==false)
                                {
                                    echo"<script>
                                    alert('Failed to remove Current image');
                                    window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
                                    </script>";
                                    die();

                                }

                            }

                        }
                }else{
                    $image_name =$current_image;
                }
            }else{
                $image_name = $current_image;
            }

            // update the database
            $sql3 = "UPDATE tbl_food SET
            title = '$title',
            discription = '$discription',
            price = $price,
            image_name = '$image_name',
            categori_id = '$category',
            feature = '$featured',
            active = '$active'
            WHERE id = $id
            ";
            //ececute query
            $res3 = mysqli_query($conn, $sql3);

            // redirect to manage-category with message
            if($res3==true)
            {
                echo"<script>
                alert('Food Udated Successfully');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
                </script>";

            }else{
                echo"<script>
                alert('Failed to Update Food.');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
                </script>";

            }

        }

        ?>
    

    </div>
</div>

<?php include('partials/footer.php');?>
