<?php include('config/constants.php');?>
<html>
<head>
    <title>Vojan Vandara login</title>
    <link rel="stylesheet" type="text/css" href="partials/Style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h1 class="text-center">Login</h1>
            <form action="" method="POST" class="login-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username">
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password">

                <input type="submit" name="submit" value="Login" class="btn-secondry">
            </form>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
   // $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    // sql to check whether  the user with username of password exists or not
    $sql = "SELECT * FROM admin WHERE username= '$username' AND password = '$password' ";
    // execute query
    $res = mysqli_query($conn, $sql);
    // count rown to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        // this session for check loged in or not
        $_SESSION['user1'] = $username;
        // user available
        echo"
        <script>
        alert('Login Successfull');
        window.location.href='http://localhost:808/project%20ii/admin/';
        </script>
        ";
    }else{
        //user not available
        echo"
        <script>
        alert('Username or Password did not match');
        window.location.href='http://localhost:808/project%20ii/admin/login.php';
        </script>
        ";
    }
}

?>
