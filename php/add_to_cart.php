<?php

/**
 * Add_to_cart.php Doc Comment
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
    // start session 
    session_start();
 
    // get the product id
    $encoded_item = isset($_POST['item']) ? $_POST['item'] : "";
    $item = unserialize(urldecode($encoded_item));
    $item['quantity'] = 1;
    /*
    * check if the 'cart' session array was created
    * if it is NOT, create the 'cart' session array
    */
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
 
    // check if the item is in the array, if it is, do not add
    if (!in_array($item['item_desc'], array_column($_SESSION['cart'], 'item_desc'))) {
        array_push($_SESSION['cart'], $item);
 
        // redirect to product list and tell the user it was added to cart
        header('Location: ../index.php?action=added#anchor');
    } else {
        // redirect to product list and tell the user it was added to cart
        header('Location: ../index.php?action=exists#anchor');
    }
} catch(Exception $e) {
    header("Location: ../error.php?msg=" .urlencode($e->getMessage()));
}
?>

