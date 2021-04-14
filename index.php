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

require 'inc/header.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<body>
    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        

    <div id='anchor'></div>
        <ul class="slides-container">

            <li class="text-center">
                <img src="images/banner-01.jpg"
                    alt="https://via.placeholder.com/300.jpg?text=No+Image+Found?text=No+Image+Found">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Food O' Cycle</strong></h1>
                            <p class="m-b-40">Connecting food banks and local restaurants since 2021!</p>
                            <p><a class="btn hvr-hover" href="#">Shop</a></p>
                            <p><a class="btn hvr-hover" href="#">Donate</a></p>
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
                            <p><a class="btn hvr-hover" href="#">Shop</a></p>
                            <p><a class="btn hvr-hover" href="#">Donate</a></p>
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
                            <p><a class="btn hvr-hover" href="#">Shop</a></p>
                            <p><a class="btn hvr-hover" href="#">Donate</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
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
                <?php  $action = isset($_GET['action']) ? $_GET['action'] : "";
 
                echo "<div class='col-md-12'>";
                if ($action=='removed') {
                    echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                    echo "Product was removed from your cart!";
                    echo "</div>";
                } else if ($action=='quantity_updated') {
                    echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                    echo "Product quantity was updated!";
                    echo "</div>";
                }
                echo "</div>";

                echo "<div class='col-md-12'>";
                if ($action=='added') {
                    echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                    echo "Product was added to your cart!";
                    echo "</div>";
                }

                if ($action=='exists') {
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
                    if (strtotime(date("Y-m-d")) >= strtotime($item['item_added']) && strtotime(date("Y-m-d")) <= strtotime($item['item_expiration']. ' - 2 days')) {
                        echo "<div class='col-lg-3 col-md-6 special-grid top-featured'>";
                        echo "<div class='products-single fix'>";
                        echo "<div class='box-img-hover'>";
                        echo "<div class='type-lb'>";
                        echo "    <p class='new'>New</p>";
                        echo "</div>";
                    } else if (strtotime(date("Y-m-d")) > strtotime($item['item_expiration']. ' - 2 days') && strtotime(date("Y-m-d")) <= strtotime($item['item_expiration'])) {
                        echo "<div class='col-lg-3 col-md-6 special-grid best-seller'>";
                        echo "<div class='products-single fix'>";
                        echo "<div class='box-img-hover'>";
                        echo "<div class='type-lb'>";
                        echo "    <p class='sale'>Expires Soon!</p>";
                        echo "</div>";
                    } else if (strtotime(date("Y-m-d")) > strtotime($item['item_expiration'])) {
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
                        echo "<img src='data:image/jpeg;charset=utf8;base64," .base64_encode($item['item_image']). "' class='img-fluid' />";
                    }
                    
                    echo "        <div class='mask-icon'>";
                    echo "<form class='add-to-cart-form'>";
                    $serialized_item = urlencode(serialize($item));

                    echo "<div style='display: none;'>{$serialized_item}</div>";
         
                    // enable add to cart button
                    echo "<button style='background: #b0b435; border: 1px solid #b0b435; position: absolute; bottom: 0; left: 0px; padding: 10px 20px; font-weight: 700; color: #ffffff;' onMouseOver='this.style.backgroundColor=\"#000000\"' onMouseOut='this.style.backgroundColor=\"#b0b435\"' type='submit' class='btn btn-primary'>";
                        echo "Add to cart";
                    echo "</button>";
         
                    echo "</form>";
                    echo "      </div>";
                    echo "  </div>";
                    echo "   <div class='why-text'>";
                    echo "       <h5>{$item['item_desc']}</h5>";
                    echo "       <h4>{$item['business_name']}</h4>";
                    echo "   </div>";
                    echo "</div>";
                    echo "</div>";
                }


                ?>
            </div>
        </div>
    </div>
    <!-- <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Expires Soon!</p>
                            </div>
                            <img src="images/img-pro-01.jpg" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                            title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>Carrots</h4>
                            <h5> Company A</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 special-grid top-featured">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="new">New</p>
                            </div>
                            <img src="images/img-pro-02.jpg" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                            title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>Tomatoes</h4>
                            <h5> Company A</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 special-grid top-featured">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="new">New</p>
                            </div>
                            <img src="images/img-pro-03.jpg" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                            title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>Grapes</h4>
                            <h5> Company B</h5>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 special-grid best-seller">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                <p class="sale">Expires Soon!</p>
                            </div>
                            <img src="images/img-pro-04.jpg" class="img-fluid" alt="Image">
                            <div class="mask-icon">
                                <ul>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i
                                                class="fas fa-eye"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i
                                                class="fas fa-sync-alt"></i></a></li>
                                    <li><a href="#" data-toggle="tooltip" data-placement="right"
                                            title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                </ul>
                                <a class="cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="why-text">
                            <h4>Papaya</h4>
                            <h5> Company B</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>latest blog</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog-img.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog-img-01.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="images/blog-img-02.jpg" alt="https://via.placeholder.com/300.jpg?text=No+Image+Found" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>Fusce in augue non nisi fringilla</h3>
                                <p>Nulla ut urna egestas, porta libero id, suscipit orci. Quisque in lectus sit amet urna dignissim feugiat. Mauris molestie egestas pharetra. Ut finibus cursus nunc sed mollis. Praesent laoreet lacinia elit id lobortis.</p>
                            </div>
                            <ul class="option-blog">
                                <li><a href="#"><i class="far fa-heart"></i></a></li>
                                <li><a href="#"><i class="fas fa-eye"></i></a></li>
                                <li><a href="#"><i class="far fa-comments"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> End Blog  -->
    <?php 
    require 'inc/js_to_include.php';
    ?>
    <script>
    $(document).ready(function() {
        // add to cart button listener
        $('.add-to-cart-form').on('submit', function() {

            // info is in the table / single product layout
            var item = $(this).find('.item').text();

            // redirect to add_to_cart.php, with parameter values to process the request
            window.location.href = "php/add_to_cart.php?item=" + item;
            return false;
        });
    });
    </script>
</body>

</html>
<?php
require 'inc/footer.php';
?>
