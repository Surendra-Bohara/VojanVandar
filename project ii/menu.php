<?php include('config/constants.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vojan Vandar</title>
    <link rel="stylesheet" href="CSS/Style.css">
    

</head>
<body>
    <!--Navbar section starts here-->
    <section class="navbar" >
        <div class="container">
            <div class="logo">
                <img src="images/logo1.png" alt="Resturant logo"class="img-responsive" >
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                    <li><a href="http://localhost:808/project%20ii/categories.php">Categories</a></li>
                    <li><a href="<?php echo SITEURL; ?>foods.php">Foods</a></li> 
                    <li><a href="<?php echo SITEURL; ?>vieworder.php">Orders</a></li> 
                    <?php
                    if(isset($_SESSION['user'])){
                    echo $_SESSION['user'];
                    echo" |
                    <a href='http://localhost:808/project%20ii/logout.php'>Logout</a>
                    ";
                    }
                    else{
                    echo"|
                    <a href=http://localhost:808/project%20ii/login.php>Login</a>
                    ";

                    }
                    ?>
                    </li>
                </ul>
            </div>
            <div class="clearfix">

            </div>
            

        </div>

    </section>
    <!--Navbar section ends here-->
    
