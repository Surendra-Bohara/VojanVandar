<?php include('menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br/> <br/>
        <form action="" method="POST" >
            <table class="tbl-30">
                <tr>
                    <td>Full Name:</td>
                    <td><input type="text" name="full_name"placeholder="Enter Your Name" ></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>
                        <input type="email" name="email"placeholder="Your Email">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password"placeholder="Enter Password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin"class="btn-warning">
                    </td>
                </tr>
                
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php');?>


<?php
// get data from Form
if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password= md5($_POST['password']);//password encryption with md5
    
    //SQL Query to save the data into database
    $sql= "INSERT INTO admin SET
    username='$full_name',
    Email = '$email',
    password='$password'
    ";
    //execute query and save data in database
    
    $res = mysqli_query($conn,$sql) or die(mysqly_connect_error());

    // check whether the data is inserted or not 
    if($res = true)
    {
      // data inserted  
      //echo"data inserted successfully";
      //Create a session variable to display message
      
      echo"
      <script>
      alert('Admin Added Successfully');
      window.location.href= 'http://localhost:808/project%20ii/admin/manage-admin.php';


      </script>";
        

    }
    else{
        //failed to insert data
        $_SESSION['add'] = "Failed to Add Admin";
        echo"
      <script>
      alert('Failed to Add Admin');
      window.location.href= 'http://localhost:808/project%20ii/admin/add-admin.php';
      </script>";
        
    }

}



?>