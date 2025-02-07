<?php include('menu.php');?>
   
    <!--Food search section ends here-->

     <!--Categores section starts here-->
     <section class="categories" >
        <div class="container">
            <h2 class="text-center" >Explore Foods</h2>

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


    </section>
    <!--Food menu section ends here-->
    <?php include('footer.php');?>

    