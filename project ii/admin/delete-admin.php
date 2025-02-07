<?php
include('config/constants.php');
$id = $_GET['id'];

$sql = "DELETE FROM admin WHERE id = $id";
$res = mysqli_query($conn, $sql);
if($res==true)
{
    echo"<script>
            alert('User deleted successfully.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-admin.php';
        </script>";

}
else{
    echo"not delete";
}
    ?>



   