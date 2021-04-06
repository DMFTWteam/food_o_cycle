<?php
    $description = filter_input(INPUT_GET, 'item_desc');
    $quantity = filter_input(INPUT_GET, 'qty', FILTER_VALIDATE_INT);
    $value = filter_input(INPUT_GET, 'est_val');
    $value = filter_input(INPUT_GET, 'perish');
    $value = filter_input(INPUT_GET, 'expDate');
    
    require "../donorhome.php";
?>
