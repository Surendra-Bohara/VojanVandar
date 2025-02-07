<?php include('menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>
        <br/> <br/>
        <?php
        // get the id of selected admin
        $id =$_GET['id'];
        // create sql query to get details
        $sql="SELECT  * FROM admin WHERE id = $id";
        // execute query
        $res = mysqli_query($conn, $sql);
        // check whether the query is executed or not
        if($res==true){
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                // get details
                $row=mysqli_fetch_assoc($res);
                $full_name = $row['username'];
                $Email = $row['Email'];
            }
            else{
                //redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }

        ?>



        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo$full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email" value="<?php echo $Email; ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <input type="hidden" name="id"value="<?php echo $id;?>">
                        <input type="submit" name="submit"value = "update admin" class="btn-warning">
                    </td>
                </tr>

            </table>


        </form>
    </div>
</div>
<?php
// whether the submit buttion is clicket or not
        if(isset($_POST['submit']))
        {
            $id = $_POST['id'];
            $Name  = $_POST['full_name'];
            $Email = $_POST['email'];

            $sql = "UPDATE admin SET
            username = '$Name',
            Email = '$Email'
            WHERE id = '$id'
            ";
            $res = mysqli_query($conn, $sql);
            if($res==true)
            {
                echo"<script>
            alert('Admin Updated successfully.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-admin.php';
        </script>";

            }else{
                echo"<script>
            alert('Failed to Update Admin.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-admin.php';
        </script>";
            }
        }
?>

<?php include('partials/footer.php'); ?>
