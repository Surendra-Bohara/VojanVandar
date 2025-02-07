<?php
// authorization or access control
// Check Whether the user is logged in or not 
if(!isset($_SESSION['user1']))
{
    //user is not logged in
    // redirect to login page with message
    echo"
    <script>
    alert('Please login to access Admin Panel');
     window.location.href='http://localhost:808/project%20ii/admin/login.php';
    </script>
    ";
}
?>