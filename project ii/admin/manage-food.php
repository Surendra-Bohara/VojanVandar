<?php include('menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Manage Food </h1>
    <br/> <br/>
        <!-- Button to add admin -->
         <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
         <br/> <br/>
        <Table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            //Create a Sql quary to get all the food
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn =1;
            if($count>0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['feature'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo htmlspecialchars($title); ?></td>
                        <td><?php echo $price ?></td>
                        <td>
                            <?php
                            if($image_name != "")
                            {
                                ?>
                                <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $image_name;?>" width="100px">
                                <?php
                            }
                            else
                            {
                                echo "Image not Added";
                            }
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($featured); ?></td>
                        <td><?php echo htmlspecialchars($active); ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-warning">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this Food?');">Delete</a>
                        </td>
                        </tr>
                        <?php
                    
                }

            }else{
                ?>
                <tr>
                    <td colspan="6">No Category Added.</td>
                </tr>
                <?php
                
            }
            ?>
            
        </Table>
    </div>
    
</div>
<?php include('partials/footer.php'); ?>