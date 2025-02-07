<?php include('menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">      
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name = "featured" value="yes"> Yes
                        <input type="radio" name = "featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active"value="Yes">Yes
                        <input type="radio" name="active"value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <input type="submit" name="submit" value="Add Category"class="btn-warning">

                    </td>
                </tr>

            </table>


        </form>
        <?php 
        if(isset($_POST['submit']))
        {
            $title = $_POST['title'];
            if(isset($_POST['featured'])){
                $featured = $_POST['featured'];

            }else{
                $featured = "No";

            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }else{
                $active = "NO";
            }
            //print_r($_FILES['image']);
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                // upload the image only if image is selected
                if($image_name!="")
                {
                    // get the extension of our image(jpg, gif, png etc) e.g."special.food.jpg"
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
                        window.location.href= 'http://localhost:808/project%20ii/admin/add-category.php';
                        </script>";
                        die();
                        }
                }

            }else{
                $image_name = "";
            }
            
            $sql = "INSERT INTO category SET
            title = '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";
            // execute query
            $res = mysqli_query($conn, $sql);
            if($res == true)
            {
                echo"
                <script>
                alert('Category Added Successfully');
                window.location.href= 'http://localhost:808/project%20ii/admin/manage-category.php';
                </script>";
            }else{
                echo"
                <script>
                alert('Failed to Add Category');
                window.location.href= 'http://localhost:808/project%20ii/admin/add-category.php';
                </script>";
            }
        }

        ?>
    </div>
</div>


<?php include('partials/footer.php') ;?>
