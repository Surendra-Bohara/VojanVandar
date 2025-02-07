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
                $price = $row['qty'];
                $total = $row['total'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contect = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

                header('location:'.SITEURL.'admin/manage-order.php');
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
                    <td><?php echo $food; ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="qty" value="" >
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option value="Ordered">Ordered</option>
                            <option value="On Delivery">On Delivery</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Candelled">Cancalled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td>
                        <input type="text" name="customer_name" value="">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td>
                        <input type="text" name="customer_contact" value="">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td>
                        <input type="text" name="customer_email" value="">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td>
                       <textarea name="customer_address" cols="30" rows="5"></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-warning" >

                    </td>
                </tr>


            </table>

        </form>
    </div>
</div>