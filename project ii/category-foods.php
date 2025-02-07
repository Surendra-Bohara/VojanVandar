<?php include('menu.php'); ?>
<?php
//check whether id is passed or not
if(isset($_GET['category_id']))
{
    // category id is set and get the id
    $category_id = $_GET['category_id'];
    //GET the category title based on category id
    $sql = "SELECT title FROM category WHERE id=$category_id";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];

}else{
    //category not passed
    //redirect to home page
   header('location:'.SITEURL);
}

?>

    <!--Food search section starts here-->
    <section class="food-search text-center" >
        <div class="container">
        <h2 class="text-center" >Foods on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>
        
        </div>

    </section>
    <!--Food search section ends here-->


        <!--Food menu section starts here-->
    <section class="food-menu" >
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

        <?php
        // display all the categories the are active
        $sql2 = "SELECT * FROM tbl_food WHERE categori_id=$category_id";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);
            if($count2>0)
            {
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $discription = $row2['discription'];
                    $image_name = $row2['image_name'];
                    ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                    if($image_name==""){
                        echo "<div class ='error'>Image Not Available</div>";

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
                echo "<div class ='error'>Foods Not Available</div>";
            }

        ?>
       
            <div class="clearfix"></div>
        </div>
        

    </section>
    <!--Food menu section ends here-->
    <?php include('footer.php');?>

   
    