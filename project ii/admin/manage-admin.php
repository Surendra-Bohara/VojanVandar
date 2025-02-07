    <?php include('menu.php'); ?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br/> <br/>
        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];// displaying session
            unset($_SESSION['add']);// removing session message
        }

        ?>
        <br/>
        <!-- Button to add admin -->
         <a href="add-admin.php" class="btn-primary">Add Admin</a>
         <br/> <br/>
        <Table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            
            <?php
            $sql = "SELECT * FROM admin";
            $res =mysqli_query($conn,$sql);
            if($res==TRUE)
            {
                $rows=mysqli_num_rows($res);
                $count =1;
                if($rows>0)
                {
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        $id = $rows['id'];
                        $Name = $rows['username'];
                        $Email = $rows['Email'];
                        ?>
                        <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $Name; ?></td>
                        <td><?php echo $Email; ?></td>
                
                        <td>
                        <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary" >Change Password</a>
                        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-warning" >Update</a>
                        <a href="http://localhost:808/project%20ii/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger" onclick="return confirm('Are you sure you want to delete this Admin?');" >Delete</a>
                        </td>
                        </tr>


                        <?php
                        
                    }
                }
            }else{
                // do not have data
            }
                
         
            ?>  
            
        </Table>
        </div>
    </div>
    <!-- mani content section ends -->

     <!-- footer section start-->
  <?php include('partials/footer.php'); ?>