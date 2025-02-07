<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br> <br>
        <form action="" method ="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                      <textarea name="discription" cols="30" rows="5" placeholder="Discription of the Food" ></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            //Create Php code to display categories form database
                            // create sql to get all active categoris from database
                            $sql = "SELECT * FROM category WHERE active='Yes'";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id = $row['id'];
                                    $title = $row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                    <?php
                                }

                            }else{
                                ?>
                                <option value="0">No Category Found</option>
                                <?php

                            }
                            // display on dropdown

                            ?>
                            
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
<input type="submit" name="submit" value="Add Food" class="btn-warning">
                    </td>
                </tr>

            </table>

        </form>
        <?php
        // check whether the buttion is clicked or not
        if(isset($_POST['submit']))
        {
            // add food in database
            //echo "clicked";
            // get the data from form
            $title = $_POST['title'];
            $discription = $_POST['discription'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            //check whether radio buttion for featured and aactive are checked or not
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];
            }else{
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }else{
                $active = "No";
            }


            //upload image if selected
            // check whether the select image is clicked or not and upload the image if the image is selected
            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];
                // check whether the image is select or not and upload image only if selected
                if($image_name!=""){
                    // image is selected
                     // get the extension of our image(jpg, gif, png etc) e.g."special.food.jpg"
                     $parts = explode('.', $image_name);
                     $ext = end($parts);
                     //rename name
                    $image_name = "Food_Name_".rand(000, 999).'.'.$ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "image/Food/".$image_name;
                    $upload = move_uploaded_file($source_path,$destination_path);
                    if($upload==false)
                        {
                            echo"
                        <script>
                        alert('Failed to Upload Image');
                        window.location.href= 'http://localhost:808/project%20ii/admin/add-food.php';
                        </script>";
                        die();
                        }
                }

            }else{
                $image_name = ""; // setting default value as blank
            }

            //insert into database
            $sql2 = "INSERT INTO tbl_food SET
            title = '$title',
            discription = '$discription',
            price = $price,
            image_name = '$image_name',
            categori_id = $category,
            feature = '$featured',
            active = '$active'
            ";
            $res2 = mysqli_query($conn, $sql2);
            if($res2 == true)
            {
                echo"
                <script>
                alert('Food Added Successfully');
                window.location.href= 'http://localhost:808/project%20ii/admin/manage-food.php';
                </script>";
            }else{
                echo"
                <script>
                alert('Failed to Add Food');
                window.location.href= 'http://localhost:808/project%20ii/admin/add-food.php';
                </script>";
            }
        }


        ?>
    </div>
</div>

<?php include('partials/footer.php');?>