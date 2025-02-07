<?php
//echo "delete food page";
include('config/constants.php');
if(isset($_GET['id'])&& isset($_GET['image_name']))
{
    // get id and image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //remove the image if available
    if($image_name != "")
    {
        $path = "image/Food/".$image_name;
        //remove image file from folder
        $remove = unlink($path);
        if($remove==false)
           {
            echo"<script>
            alert('Failed to Remove Category Image.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
            </script>";
            die();

           }
    }
    // delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);
    if($res==true)
    {
        echo"<script>
        alert('Food Deleted successfully.');
        window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
        </script>";
    }else{
        echo"<script>
        alert('Failed to Delet Food.');
        window.location.href = 'http://localhost:808/project%20ii/admin/manage-food.php';
        </script>";
    }

}

?>