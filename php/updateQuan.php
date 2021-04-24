<?php
updateQuan($_POST['index'], $_POST['item_id'], $_POST['quantity']);
function updateQuan($index, $item_id, $quantity) {
    $item = array_search($item_id, $_SESSION['cart']);
    if (isset($index) && $index != '' && isset($item_id) && $item_id != '' && isset($quantity) && $quantity != '') {
        $_SESSION['cart'][$item]['quantity'] = $quantity;
        echo "The quantity was updated successfully!";
    } else {
        echo "There was an error with your request.";
    }
}

?>