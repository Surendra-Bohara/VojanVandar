<?php include('menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br> <br>
        <?php
        // check whether id is set or not
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
            $sql = "SELECT * FROM tbl_order WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if($count==1)
            {
                //Details available
                $row = mysqli_fetch_assoc($res);
                $food = $row['food'];
                $price = $row['price'];
                $qty = $row['qty'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

        
            }else{
                //detail not available
                header('location:'.SITEURL.'admin/manage-order.php');
            }


        }else{
            header('location:'.SITEURL.'admin/manage-order.php');
        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <b><td>RS:<?php echo $price; ?></td></b>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>" >
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo"selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo"selected";} ?>  value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo"selected";} ?>  value="Delivered">Delivered</option>
                            <option <?php if($status=="Candelled"){echo"selected";} ?>  value="Candelled">Cancalled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                       <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-warning" >

                    </td>
                </tr>


            </table>

        </form>
        <?php
        //check whether update button is clicked or not
        if(isset($_POST['submit']))
        {
           // echo "clicked";
           // Get all the value form form
            $id = $_POST['id'];
             $price = $_POST['price'];
            $qty = $_POST['qty'];
            $status = $_POST['status'];
            $total = $price * $qty;
            $customer_name = $_POST['customer_name'];
            $customer_contact = $_POST['customer_contact'];
            $customer_email = $_POST['customer_email'];
            $customer_address = $_POST['customer_address'];
           //update value from form
           $sql2 = "UPDATE tbl_order SET
           qty = $qty,
           total = $total,
           status = '$status',
           customer_name = '$customer_name',
           customer_contact = '$customer_contact',
           customer_email = '$customer_email',
           customer_address = '$customer_address'
            WHERE id=$id;
           ";
           //execute query
           $res2 = mysqli_query($conn, $sql2);
           //check whether update or not
           if($res2==true)
           {
            echo"<script>
            alert('Order Updated Successfully.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-order.php';
            </script>";

           }else{
            echo"<script>
            alert('Failed to Update Order.');
            window.location.href = 'http://localhost:808/project%20ii/admin/manage-order.php';
            </script>";

           }
           //redirect to manage order with message
        }

        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>