
<?php include('menu.php'); ?>

            <div class="main_content">
                <div class="wrapper">
                <h1>Your Orders </h1>
                <br/> <br/>
                <table class="tbl-full">
                    <tr>
                <th>Order id</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Status</th>
                <th>Order Date</th>
                </tr>
                <?php
                if (isset($_SESSION['user'])) {
                    $user_id = $_SESSION['user']; // Retrieve user id from session
                
                    // SQL query to get all orders of the logged-in user
                    $sql_orders = "SELECT * FROM tbl_order WHERE customer_name = '$user_id'";
                    $res_orders = mysqli_query($conn, $sql_orders);
                    $count = mysqli_num_rows($res_orders);
                
                    if ($count>0) {
                        while ($order = mysqli_fetch_assoc($res_orders))
                         {
                            $order_id = $order['id'];
                            $food = $order['food'];
                            $quantity = $order['qty'];
                            $total_price = $order['total'];
                            $status = $order['status'];
                            $order_date = $order['order_date'];
                            ?>
                     <tr>
                    <td><?php echo $order_id; ?></php></td>
                    <td><?php echo $food; ?></td>
                    <td><?php echo $quantity; ?></td>
                    <td><?php echo $total_price; ?></td>
                    <td><?php echo $status; ?></td>
                    <td><?php echo $order_date; ?></td>
                </tr>

                
            <?php
            
          
            
        }
        ?>
        </table>
        </div>
    </div>
    <?php
    
        
       
    } else {
        echo "<div class='text-center'>No orders found.</div>";
    }
} else {
    echo "<div class='text-center'>Please log in to view your orders.</div>";
}
?>
   <?php include('footer.php');?>
