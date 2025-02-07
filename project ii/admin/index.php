<?php include('menu.php');?>
    <div class="main-content">
        <div class="wrapper">
        <h1>Dashboard</h1>
        <div class="col-4 text-center">
          <?php
          $sql = "SELECT * FROM category";
          $res = mysqli_query($conn, $sql);
          $count = mysqli_num_rows($res);
          ?>
          
          <?php echo $count; ?>
          <br>
          Categories
        </div>
        <div class="col-4 text-center">
        <?php
          $sql2 = "SELECT * FROM tbl_food";
          $res2 = mysqli_query($conn, $sql2);
          $count2 = mysqli_num_rows($res2);
          ?>
          <?php echo $count2; ?>
          <br/>
          Foods
          
        </div>
        <div class="col-4 text-center">
        <?php
          $sql3 = "SELECT * FROM tbl_order";
          $res3 = mysqli_query($conn, $sql3);
          $count3 = mysqli_num_rows($res3);
          ?>
          <?php echo $count3; ?>
          <br/>
          Total orders 
        </div>
        <div class="col-4 text-center">
          <?php
          // create sql query to get total reveneue generated
          //aggregate function in sql
          $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
          $res4 = mysqli_query($conn, $sql4);
          $row4 = mysqli_fetch_assoc($res4);
          //Get the total revenue
          $total_revenue = $row4['Total'];
          ?>
          RS:
          <?php echo $total_revenue; ?>
          <br/>
          Revenue Generated
        </div>
        <div class="clearfix"> </div>
        </div>
    </div> 
    <!-- mani content section ends -->

     <!-- footer section start-->
   <?php include('partials/footer.php'); ?>