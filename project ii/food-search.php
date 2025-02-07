<?php include('menu.php'); ?>

    <!--Food search section starts here-->
    <section class="food-search text-center" >
        <div class="container">
            <?php
             // get the search keyword
             $search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>
        <h2>Foods on your search <a href="#" class="text-white" ><?php echo $search; ?> </a></h2>
        </div>

    </section>
    <!--Food search section ends here-->


      <!--Food menu section starts here-->
    <section class="food-menu" >
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
           
            //Sql query to get food based on search keyword
            $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR discription LIKE '%$search%'";
            //execute query
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                //food available
                while($row=mysqli_fetch_assoc($res))
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
                            //check whether the image is availabel or not
                            if($image_name=="")
                            {
                                //image not available
                                echo"<script>
                                alert('Food Not Found.');
                                window.location.href = 'http://localhost:808/project%20ii/index.php';
                                </script>";
                            }
                            else{
                                //image available
                                ?>
                                <img src="http://localhost:808/project%20ii/admin/image/Food/<?php echo $image_name;?>" class="img-responsive img-curve" >
                                
                                

                                <?php

                            }

                            ?>
                            
                        </div>
                
                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price"><?php echo $price; ?></p>
                            <div class="food-detail">
                                <?php echo $discription; ?>
                            </p>
                            <br>
                            <a href="#" class=" btn btn-primary" > Order Now </a>
                        </div>
                        </div>
                        </div>


                        <?php
                        
                        

                }

            }else{
                echo "<div class ='error'>Food Not Found!</div>";
              

            }


            ?>


            
            <div class="clearfix"></div>
        </div>

    </section>
    <!--Food menu section ends here-->
    <?php include('footer.php');?>

    