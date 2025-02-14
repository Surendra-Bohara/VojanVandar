<?php
include('menu.php'); // Include your menu or common header

// Assuming user is logged in and their user_id is stored in session
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
            echo "No recommendations available.";
        }
        ?>

    </div>
</section>

<?php include('footer.php'); ?>
