<?php

/**
 * UpdateQuan.php Doc Comment
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
updateQuan($_POST['index'], $_POST['quantity']);
function updateQuan($index, $quantity)
{
    if (isset($index) && $index != '' && isset($quantity) && $quantity != '') {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        echo "The quantity was updated successfully!";
    } else {
        echo "There was an error with your request.";
    }
}

?>
