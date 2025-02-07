<?php include('menu.php'); ?>
<?php
// authorization or access control
// Check Whether the user is logged in or not 
if(!isset($_SESSION['user']))
{
    //user is not logged in
    // redirect to login page with message
    echo"
    <script>
    alert('Please login First');
     window.location.href='http://localhost:808/project%20ii/login.php';
    </script>
    ";
}
?>

<?php
// check whether food id is set or not
if(isset($_GET['food_id']))
{
    // get tje food id and details of the selected food
    $food_id = $_GET['food_id'];
    // get the detail of the selected food
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if($count==1)
    {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];

    }else{
       // header('location:'.SITEURL);
    }

}else{
    //redirect to home page
    header('location:'.SITEURL);
}

?>

<section class="form-section-center">
    <div class="form-container-box">
        <h2 class="order-title">Fill this form to confirm your order.</h2>
        <form action="" method="POST" class="order-confirmation-form">
            <fieldset class="food-selection-box">
                <legend class="food-selection-title">Select Food</legend>

                <div class="menu-item-image">
                    <?php
                    //check whether the image is available or not
                    if($image_name=="")
                    {
                        //imgae not available
                        echo "<div class 'error'>Image Not Available</div>";
                    }else{
                        ?>
                        <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $image_name; ?>" alt="Chicken Hawaiian Pizza" class="food-image-responsive food-image-curve">

                        <?php

                    }

                    ?>
                    
                </div>
                <div class="menu-item-description">
                    <h3 class="menu-item-title"><?php echo $title; ?></h3>
                    <input type="hidden" name="food" value="<?php echo $title; ?>">
                    <p class="menu-item-price"><?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="quantity-label">Quantity</div>
                    <input type="number" name="qty" class="quantity-input" value="1" required>
                </div>
            </fieldset>
            <?php
            $user_name = $_SESSION['user'];
            $sql2 = "SELECT * FROM tbl_user WHERE UserName = '$user_name'";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if($count2==1){
                $row2 = mysqli_fetch_assoc($res2);
                $name = $row2['UserName'];
                $phone = $row2['Number'];
                $email = $row2['Email'];
            }
            ?>

            <fieldset class="delivery-details-box">
                <legend class="delivery-details-title">Delivery Details</legend>

                <div class="label-fullname">Full Name</div>
                <input type="text" name="full-name" value="<?php echo $name; ?>"  class="input-fullname">

                <div class="label-phone">Phone Number</div>
                <input type="tel" name="contact" value="<?php echo $phone; ?>"  class="input-phone" required>

                <div class="label-email">Email</div>
                <input type="email" name="email" value="<?php echo $email; ?>" class="input-email" required>

                <div class="label-address">Address</div>
                <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-address" required></textarea>

                <br>
                <input type="submit" name="submit1" value="Confirm Order" class="confirm-button">
             
            </fieldset>
            
        </form>
        <?php
        // check whether the submit button is clicked or not
        if(isset($_POST['submit1']))
        {
            // get the all details form the form
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d H:i:s");  // Using 24-hour format
            $status = "Ordered";
            $customer_name = $_POST['full-name'];
            $customer_contect = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
            
            
            
        


        }
        if(isset($_POST['submit1']))
        {
             
                // Save the order in database
        $sql2 = "INSERT INTO tbl_order SET
        food = '$food',
        price = $price,
        qty = $qty,
        total = $total,
        order_date = '$order_date',
        status = '$status',
        customer_name = '$customer_name',
        customer_contact = '$customer_contect',
        customer_email = '$customer_email',
        customer_address = '$customer_address'
        ";
        $res2 = mysqli_query($conn, $sql2);

        // check whether the query executed successfully or not
        if($res2==true)
        {
           echo"
           <script>
           alert('Food Ordered Successfully.');
           window.location.href= 'http://localhost:808/project%20ii/';
           </script>";

        }else{
           echo"
           <script>
           alert('Failed to Order Food.');
           window.location.href= 'http://localhost:808/project%20ii/';
           </script>";

        }

          
        

        }
            
           
        
             




     
        
?>
       
        
    </div>
</section>

<!-- Food menu section ends here -->
<?php include('footer.php'); ?>