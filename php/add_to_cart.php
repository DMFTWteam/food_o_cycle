<?php

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
    if (!in_array($item['item_desc'], $_SESSION['cart'])) {
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

