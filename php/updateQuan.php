<?php
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
