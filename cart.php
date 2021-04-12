<?php

/**
 * Cart.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */

session_start();
if (!isset($_SESSION['user']) || $_SESSION['business']['business_is_donor'] == 1) {
    header('Location: login.php');
    exit();
}

require 'inc/header.php';
$remove = urldecode($_GET['remove']);
print_r($_SESSION['cart']);
if (isset($remove) && $remove != '') {
    $key = array_search($remove, array_column($_SESSION['cart'], 'item_desc'));
    var_dump($remove);
    var_dump($key);
    if (($item = array_search($remove, $_SESSION['cart'])) !== false) {
        array_splice($_SESSION['cart'], $key-1, 1);
    }
}
$total_items = 0;
foreach ($_SESSION['cart'] as $item) {
    $i = 0;
    $item['quantity'] = $_POST['quantity' . $i];
    $total_items += $item['quantity'];
    $i++;
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<body>


    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">

        <form action="cart.php" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-main table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i = 0;
                                    foreach ($_SESSION['cart'] as $item) {
                                        echo "<tr>";
                                        echo "<td class='thumbnail-img'>";
                                        echo "<img class='img-fluid' src='https://via.placeholder.com/300.jpg?text=No+Image+Found' alt='https://via.placeholder.com/300.jpg?text=No+Image+Found' />";
                                        echo "</td>";

                                        echo "<td class='name-pr'>";
                                        echo $item['item_desc'];
                                        echo "</td>";
                                        echo "<td class='quantity-box'><input type='number' name='quantity{$i}' size='4' value='{$item['quantity']}' min='0' max='{$item['item_qty_avail']}' step='1'";
                                        echo "        class='c-input-text qty text'></td>";
                                        echo "<td class='remove-pr'>";
                                        echo "    <a href='cart.php?remove={$item['item_desc']}'>";
                                        echo "        <i class='fas fa-times'></i>";
                                        echo "    </a>";
                                        echo "</td>";
                                        echo "</tr>";
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-lg-6 col-sm-6">
                        <div class="update-box">
                            <input value="Update Cart" type="submit">
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-lg-8 col-sm-12"></div>
                    <div class="col-lg-4 col-sm-12">
                        <div class="order-box">
                            <h3>Order summary</h3>
                            <hr>
                            <div class="d-flex gr-total">
                                <h5>Grand Total</h5>
                                <div id='total' class="ml-auto h5"><?php echo $total_items; ?></div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12 d-flex shopping-box"><a href="checkout.php" class="ml-auto btn hvr-hover">Reserve
                            Items</a> </div>
                </div>

            </div>
        </form>
    </div>
    <!-- End Cart -->
</body>

</html>


<?php
    require 'inc/js_to_include.php';
    require 'inc/footer.php';
?>
