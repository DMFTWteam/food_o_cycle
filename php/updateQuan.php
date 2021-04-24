<?php

function updateQuan($item_id, $quantity) {
    $item = array_search($item_id, $_SESSION['cart']);
    if (isset($item) && $item != '') {
        $_SESSION['cart'][$item]['quantity'] = $quantity;
        echo "The quantity was updated successfully!";
    } else {
        echo "There was an error with your request.";
    }
}

?>