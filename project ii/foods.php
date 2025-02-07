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
            <h2 class="text-center" >Categories</h2>

            <?php
            // display all the categories the are active
            $sql = "SELECT * FROM category WHERE active='Yes'";
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
                            echo "image is not available";
                        }else{
                            ?>
                            <img src="http://localhost:808/project%20ii/admin/image/<?php echo $image_name;?>" class="img-responsive img-curve" height="300px">
                            <?php
                        }

                        ?>
                    
                        <h3 class="float-text text-white" ><?php echo $title; ?></h3>
                    </div>
                    </a>
        </a>
                    <?php
                }
                


            }else{
                echo"category not found";
            }


            ?>
            
      
            <div class="clearfix"></div>
        </div>

     </section>
     <!--category section ends here-->
        <!--Food menu section starts here-->
    <section class="food-menu" >
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        // display all the categories the are active
        $sql2 = "SELECT * FROM tbl_food WHERE active='Yes'";
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

   
    