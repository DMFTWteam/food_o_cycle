<?php
// start session 
session_start();
 
// get the product id
$encoded_item = isset($_GET['item']) ? $_GET['item'] : "";
$item = json_decode($encoded_item);

$item['quantity'] = 1;
 
/*
 * check if the 'cart' session array was created
 * if it is NOT, create the 'cart' session array
 */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
 
// check if the item is in the array, if it is, do not add
if (array_key_exists($id, $_SESSION['cart'])) {
    // redirect to product list and tell the user it was added to cart
    header('Location: ../index.php?action=exists&id=' . $item['item_id']);
} else {
    array_push($_SESSION['cart'], $item);
 
    // redirect to product list and tell the user it was added to cart
    header('Location: ../index.php?action=added');
}
?>
