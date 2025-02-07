<?php include('config/constants.php'); ?>
<?php
$Name = $_POST['name'];
$Password = $_POST['password'];


$sql = "SELECT * FROM `tbl_user` WHERE (UserName = '$Name') AND Password = '$Password'";
$res= mysqli_query($conn, $sql);

session_start();
if(mysqli_num_rows($res)){

    $_SESSION['user'] = $Name;
    echo"
    <script>
    alert('Successfullu login');
    window.location.href= 'index.php';
    </script>
    ";
}
else{
    echo"
    <script>
    alert('incorrect username/password');
    window.location.href= 'login.php';
    </script>
    ";
}

?>
