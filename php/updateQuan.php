<?php
updateQuan($_POST['index'], $_POST['item_id'], $_POST['quantity']);
function updateQuan($index, $item_id, $quantity) {
    if (isset($index) && $index != '' && isset($item_id) && $item_id != '' && isset($quantity) && $quantity != '') {
        $_SESSION['cart'][$item]['quantity'] = $quantity;
        echo "The quantity was updated successfully!";
    } else {
        echo "There was an error with your request.";
    }
}

?>