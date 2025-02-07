<?php include('menu.php'); ?>


    <!--Food search section starts here-->
    <section class="food-search text-center" >
        <div class="container">
            <form action="http://localhost:808/project%20ii/food-search.php" method="POST" >
                <input type="search" name="search" placeholder="Search for food..">
                <input type="submit" name="submit" value="search" class="btn btn-primary" >
            </form>
        </div>

    </section>
    <!--Food search section ends here-->

     <!--Categores section starts here-->
     <section class="categories" >
        <div class="container">
            <h2 class="text-center" >Featured Categories</h2>
            <?php
            //quary to diplay categories from database
            $sql = "SELECT * FROM category WHERE active='Yes' AND featured='Yes'LIMIT 3";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="http://localhost:808/project%20ii/category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container ">
                            <?php
                                if($image_name=="")
                                {
                                echo"image not available";

                                }
                                else{
                                    ?>
                                    <img src="http://localhost:808/project%20ii/admin/image/<?php echo $image_name;?>" class="img-responsive img-curve" height="300px" >
                                    <?php
                                }
                            ?>
                        
                            <h3 class="float-text text-white" ><?php echo $title; ?></h3>
                        </div>
                    </a>

                    <?php

                }

            }else{
                echo"Category Not Available";

            }

            ?>
           
       
            <div class="clearfix"></div>
        </div>

     </section>
     <!--category section ends here-->
     <?php
     
// Assuming user is logged in and their user_id is stored in session
if(isset($_SESSION['user']))
{


$user_id = $_SESSION['user']; // Retrieve user id from session

// Step 1: Retrieve the categories of foods the user has ordered
$sql_orders = "SELECT id FROM tbl_order WHERE customer_name = '$user_id'";
$res_orders = mysqli_query($conn, $sql_orders);
$ordered_foods = [];
while($row = mysqli_fetch_assoc($res_orders)) {
    $ordered_foods[] = $row['id']; // Collect all food ids the user has ordered
}

// Step 2: Get categories of the ordered foods
$ordered_food_categories = [];
foreach ($ordered_foods as $food_id) {
    $sql_food = "SELECT categori_id FROM tbl_food WHERE id = '$food_id'";
    $res_food = mysqli_query($conn, $sql_food);
    if ($row_food = mysqli_fetch_assoc($res_food)) {
        $ordered_food_categories[] = $row_food['categori_id']; // Store category of each ordered food
    }
}

// Step 3: Get recommended foods based on the ordered food categories
$recommended_foods = [];
foreach ($ordered_food_categories as $category_id) {
    $sql_recommended = "SELECT * FROM tbl_food WHERE categori_id = '$category_id' AND active = 'Yes' AND feature = 'Yes' LIMIT 5";
    $res_recommended = mysqli_query($conn, $sql_recommended);
    while($row_recommended = mysqli_fetch_assoc($res_recommended)) {
        $recommended_foods[] = $row_recommended; // Collect recommended foods from the same categories
    }
}

?>

<!-- HTML Code for displaying the food recommendations -->
<section class="food-recommendations">
    <div class="container">
        <h2 class="text-center">Recommended for You</h2>

        <?php
        // Display recommended foods
        if(count($recommended_foods) > 0) {
            foreach($recommended_foods as $food) {
                $id = $food['id'];
                $title = $food['title'];
                $price = $food['price'];
                $description = $food['discription'];
                $image_name = $food['image_name'];
                ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if($image_name == "") {
                            echo "Image Not Available";
                        } else {
                            ?>
                            <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $image_name;?>" class="img-responsive img-curve" height="150px">
                            <?php
                        }
                        ?>  
                    </div>
                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail"><?php echo $description; ?></p>
                        <br>
                        <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class ='text-center' >No recommendations available.</div>";
        }
    }
        ?>

    </div>
</section>
     

      <!--Food menu section starts here-->
    <section class="food-menu" >
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        // display all the food the are active
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND feature='Yes'LIMIT 6";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $discription = $row['discription'];
                    $image_name = $row['image_name'];
                    ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name==""){
                        echo "Image Not Available";

                    }else{
                        ?>
                        <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $image_name;?>" class="img-responsive img-curve" height="150px">
                        <?php

                    }

                    ?>  
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                        <?php echo $discription; ?>
                    </p>
                    <br>
                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class=" btn btn-primary" > Order Now </a>

                </div>
            </div>
                    <?php
                }
            }else{
                echo "food not available";
            }

        ?>
       
            <div class="clearfix"></div>
        </div>
        

    </section>
    
    


    <!--Food menu section ends here-->
    <?php include('footer.php');?>

    