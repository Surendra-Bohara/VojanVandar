<?php
include('config/constants.php');
    // check whether the id and image_name value are set or not
    if(isset($_GET['id'])AND isset($_GET['image_name']))
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        if($image_name!="")
        {
            // image is available so remove it
            $path = "image/".$image_name;
           // remove the image
           $remove = unlink($path);
           // if failed to remove image 
           if($remove==false)
           {
            echo"<script>
            alert('Failed to Remove Category Image.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
            </script>";
            die();

           }



        }
        $sql = "DELETE FROM category WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res==true)
        {
            echo"<script>
            alert('Category Deleted successfully.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
            </script>";
        }else{
            echo"<script>
            alert('Failed to Delet Category.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
            </script>";
        }
        
    }else{
        echo"<script>
        window.location.href = 'http://localhost:808/project%20ii/admin/manage-category.php';
    </script>";

    }

?>