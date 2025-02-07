<?php include('menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/><br/>
        <!-- Button to add admin -->
        <a href="<?php echo SITEURL;?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br/><br/>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Category</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1;
            if($count > 0)
            {
                while($row = mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                    ?>
                    <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo htmlspecialchars($title); ?></td>
                        <td>
                            <?php
                            if($image_name != "")
                            {
                                ?>
                                <img src="http://localhost:808/project%20ii/admin/image/<?php echo $image_name;?>" width="100px">
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
                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-warning">Update</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="6">No Category Added.</td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>
