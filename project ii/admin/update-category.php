<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br> <br>
        <?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                $row =mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            }
            else{
                echo"<script>
                alert('Category Not Found.');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
                </script>";
            }
        }else{

        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class = "tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">

                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if($current_image!="")
                        {
                            ?>
                            <img src="http://localhost:808/project%20ii/admin/image/<?php echo $current_image;?>"width="150px">
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
            $current_image = $_POST['current_image'];
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
                    $destination_path = "image/".$image_name;
                    $upload = move_uploaded_file($source_path,$destination_path);
                    // check whether the image is uploaded or not
                    if($upload==false)
                        {
                            echo"
                        <script>
                        alert('Failed to Upload Image');
                        window.location.href= 'http://localhost:808/project%20ii/admin/manage-category.php';
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

                        }
                }else{
                    $image_name = $current_image;

                }
            }else{
                
            }

            // update the database
            $sql2 = "UPDATE category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            WHERE id = $id
            ";
            //ececute query
            $res2 = mysqli_query($conn, $sql2);

            // redirect to manage-category with message
            if($res2==true)
            {
                echo"<script>
                alert('Category Udated Successfully');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
                </script>";

            }else{
                echo"<script>
                alert('Failed to Update Category.');
                window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
                </script>";

            }

        }

        ?>
    

    </div>
</div>

<?php include('partials/footer.php');?>
