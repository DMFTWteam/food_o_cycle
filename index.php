<?php

/**
 * Index.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */

try {
    
    //ob_start();
    include 'inc/header.php';
    
    session_start();
    ?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<body>
    <!-- Start Slider -->
    <?php
    $msg = isset($_GET['msg']) ? $_GET['msg'] : "";

    if (isset($msg) && $msg != "") {
        echo "<div class='col-md-12'>";
        echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
        echo urldecode($msg);
        echo "</div>";
        echo "</div>";
    } ?>
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">

            <li class="text-center">
                <img src="images/banner-01.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found?text=No+Image+Found">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food O' Cycle</strong></h1>
                            <p class="m-b-40">Connecting food banks and local restaurants since 2021!</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-02.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food O' Cycle</strong></h1>
                            <p class="m-b-40">Connecting food banks and local restaurants since 2021!</p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="images/banner-03.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food O' Cycle</strong></h1>
                            <p class="m-b-40">Connecting food banks and local restaurants since 2021!</p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div id='anchor'></div>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>


    </div>
    <!-- End Slider -->




    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Products</h1>
                        <p>Look through the plethora of quality ingredients ready for donation!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            <button data-filter=".top-featured">New additions</button>
                            <button data-filter=".best-seller">Expires soon!</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <?php $action = isset($_GET['action']) ? $_GET['action'] : "";

                echo "<div class='col-md-12'>";
                if ($action == 'added') {
                    echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                    echo "Product was added to your cart!";
                    echo "</div>";
                }

                if ($action == 'exists') {
                    echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                    echo "Product already exists in your cart!";
                    echo "</div>";
                }
                echo "</div>"; ?>
            </div>

            <div class="row special-list">
                <?php

                $query = 'SELECT * FROM food_item, business WHERE food_item.business_id = business.business_id ORDER BY item_desc';

                $statement = $db->prepare($query);
                $statement->execute();
                $items = $statement->fetchAll();
                $statement->closeCursor();

                foreach ($items as $item) {

                    if (($item['item_qty_avail'] <= 0 || $item['item_qty_avail'] <= '0')) {
                        $query2 = 'DELETE FROM food_item WHERE item_id = :item_id';
                        
                        $statement2 = $db->prepare($query2);
                        $statement2->bindValue(':item_id', $item['item_id']);
                        $statement2->execute();
                        $statement2->closeCursor();
                        continue;
                    }
                    
                    if (strtotime(date("Y-m-d")) > strtotime($item['item_expiration'] . ' - 2 days') && strtotime(date("Y-m-d")) < strtotime($item['item_expiration'])) {
                        echo "<div class='col-lg-3 col-md-6 special-grid best-seller'>";
                        echo "<div class='products-single fix'>";
                        echo "<div class='box-img-hover'>";
                        echo "<div class='type-lb'>";
                        echo "    <p class='sale'>Expires Soon!</p>";
                        echo "</div>";
                    } else if (strtotime(date("Y-m-d")) >= strtotime($item['item_added']) && strtotime(date("Y-m-d")) <= strtotime($item['item_added'] ."+ 5 days")) {
                        echo "<div class='col-lg-3 col-md-6 special-grid top-featured'>";
                        echo "<div class='products-single fix'>";
                        echo "<div class='box-img-hover'>";
                        echo "<div class='type-lb'>";
                        echo "    <p class='new'>New</p>";
                        echo "</div>";
                    } else if ((strtotime(date("Y-m-d")) >= strtotime($item['item_expiration']))) {
                        $query2 = 'DELETE FROM food_item WHERE item_id = :item_id';
                        
                        $statement2 = $db->prepare($query2);
                        $statement2->bindValue(':item_id', $item['item_id']);
                        $statement2->execute();
                        $statement2->closeCursor();
                        continue;
                    } else {
                        echo "<div class='col-lg-3 col-md-6 special-grid'>";
                        echo "<div class='products-single fix'>";
                        echo "<div class='box-img-hover'>";
                    }
                    //var_dump(base64_encode($image));
                    if ($item['item_image'] == null || $item['item_image'] == '') {
                        echo "<img src='https://via.placeholder.com/300.jpg?text=No+Image+Found' class='img-fluid'  />";
                    } else {
                        echo "<img src='data:image/jpeg;charset=utf8;base64," . base64_encode($item['item_image']) . "' class='img-fluid' />";
                    }

                    echo "        <div class='mask-icon'>";
                    echo "<form class='add-to-cart-form' name='add_item' action='php/add_to_cart.php' method='post'>";
                    $serialized_item = urlencode(serialize($item));

                    echo "<input name='item' style='display: none;' value='{$serialized_item}' />";

                    // enable add to cart button
                    echo "<button style='background: #b0b435; border: 1px solid #b0b435; position: absolute; bottom: 0; left: 0px; padding: 10px 20px; font-weight: 700; color: #ffffff;' onMouseOver='this.style.backgroundColor=\"#000000\"' onMouseOut='this.style.backgroundColor=\"#b0b435\"' type='submit' class='btn btn-primary'>";
                    echo "Add to cart";
                    echo "</button>";

                    echo "</form>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "   <div class='why-text'>";
                    echo "       <h2>{$item['item_desc']}</h2>";
                    echo "       <h4>{$item['business_name']}</h4>";
                    
                    if ($item['item_perishable'] == 1) {
                        $date = date("F j, Y", strtotime($item['item_expiration']));
                        echo "       <h6>Expiration: {$date}</h6>";
                    } else {
                        echo "<h6>Non-perishable Item</h6>";
                    }
                    echo "   </div>";
                    echo "</div>";
                    echo "</div>";
                }


                ?>
            </div>
        </div>
    </div>
    <?php
    include 'inc/js_to_include.php';
    ?>
    <script>
        $(document).ready(function() {
            // add to cart button listener
            $('.add-to-cart-form').on('submit', function() {

                document.forms['add_item'].submit();
            });
        });
    </script>
</body>

</html>
    <?php
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
