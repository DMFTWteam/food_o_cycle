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
print_r($_POST);

$total_items = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_items += $item['quantity'];
}

require 'inc/header.php';
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
                <form action="cart.php" method='post'>
                    <div class='row'><?php
                    $action = isset($_POST['action']) ? $_POST['action'] : "";
                    $remove = isset($_GET['action']) ? $_GET['action'] : "";
                    echo "<div class='col-md-12'>";
                    if (isset($remove) && $remove=='remove') {
                        $item = urldecode($_GET['remove']);
                        if (isset($item) && $item != '') {
                            if (($key = array_search($item, array_column($_SESSION['cart'], 'item_desc'))) !== false) {
                                array_splice($_SESSION['cart'], $key, 1);
                            }
                            echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                            echo "Product was removed from your cart!";
                            echo "</div>";
                        } else {
                            echo "<div class='alert alert-danger' >";
                            echo "ERROR! Product could not be removed.";
                            echo "</div>";
                        }
                        
                    } else if (isset($action) && $action=='Update Cart') {
                        foreach ($_SESSION['cart'] as $item) {
                            $i = 0;
                            echo 'POST value: ';
                            var_dump($_POST['quantity' .$i]);
                            echo '<br>';
                            $item['quantity'] = (int)$_POST['quantity' .$i];
                            echo 'item quan value: ';
                            var_dump($item['quantity']);
                            echo '<br>';
                            $i++;
                        }
                        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                            echo 'POST value: ';
                            var_dump($_POST['quantity' .$i]);
                            echo '<br>';
                            $_SESSION['cart'][$i]['quantity'] = (int)$_POST['quantity' .$i];
                            echo 'item quan value: ';
                            var_dump($item['quantity']);
                            echo '<br>';
                        }
                        
                        echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                        echo "Product quantity was updated!";
                        echo "</div>";
                    } else if (isset($action) && $action=='Clear Cart') {
                        $_SESSION['cart'] = array();
                        echo "<div class='alert alert-info' style='background: #b0b435; border: 1px solid #b0b435; color: #ffffff;'>";
                        echo "Cart was cleared!";
                        echo "</div>";
                    }
                    echo "</div>";

                    ?></div>
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
                                            if ($item['item_image'] == null || $item['item_image'] == '') {
                                                echo "<img src='https://via.placeholder.com/300.jpg?text=No+Image+Found' class='img-fluid'  />";
                                            } else {
                                                echo "<img src='data:image/jpeg;charset=utf8;base64," .base64_encode($item['item_image']). "' class='img-fluid' />";
                                            }
                                            echo "</td>";

                                            echo "<td class='name-pr'>";
                                            echo $item['item_desc'];
                                            echo "</td>";
                                            echo "<td class='quantity-box'><input type='number' name='quantity{$i}' value='{$item['quantity']}' min='1' max='{$item['item_qty_avail']}' step='1'";
                                            echo "        class='c-input-text qty text'></td>";
                                            echo "<td class='remove-pr'>";
                                            echo "    <a href='?action=remove&remove={$item['item_id']}'>";
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
                                <input name='action' value="Update Cart" type="submit">
                                <input name='action' value="Clear Cart" type="submit">
                            </div>
                        </div>
                    </div>
                </form>
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