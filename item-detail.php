<?php 

session_start();
$_SESSION['path'] = $_SERVER['PHP_SELF']; 
$item_id = filter_input(INPUT_GET, 'item_id');

require "inc/header.php";
require "inc/js_to_include.php";
require "inc/db_connect.php";

$query = 'SELECT * 
    FROM food_item 
    LEFT JOIN business 
    ON food_item.business_id = business.business_id 
    WHERE item_id = :item_id';
$statement = $db->prepare($query);
$statement->bindValue(':item_id', $item_id);
$statement->execute();
$item_info = $statement->fetch();
$statement->closeCursor();

print_r($_SESSION['cart'][0]['quantity']);

?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop Detail</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Item Detail </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div id="carousel-example-1" class="single-product-slider carousel slide">
                    <div class="carousel-inner" role="listbox">
                        <?php 
                        if ($item_info['item_image'] == null || $item_info['item_image'] == '') {
                            echo "<img class=\"d-block w-100 img-fluid\" src='https://via.placeholder.com/300.jpg?text=No+Image+Found' />";
                        } else {
                            echo "<img class=\"d-block w-100 img-fluid\" src='data:image/jpeg;charset=utf8;base64," . base64_encode($item_info['item_image']) . "' />";
                        } ?>
                    </div>


                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <div class="single-product-details">
                        <h2><?php echo $item_info['item_desc']; ?></h2>
                        <h5><?php echo $item_info['business_name']; ?></h5>
                        <p class="available-stock"><span><?php echo $item_info['item_qty_avail']; ?> available</span>
                        <p>
                            <?php 
                            if ($item_info['item_perishable'] == 1) {
                                $date = date("m-d-Y", strtotime($item_info['item_expiration']));
                                echo "<h4>Expiration: {$date}</h4>";
                            } else {
                                echo "<h4>Non-perishable Item</h4>";
                            } ?>
                        <p></p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    <label class="control-label">Quantity</label>
                                    <input class="form-control" value="0" min="0" max="<?php echo $item_info['item_qty_avail']; ?>" type="number">
                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn">
                                <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- End Cart -->

    <?php 
    require "inc/footer.php";
    ?>
