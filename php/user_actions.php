<?php

try {
    $description = filter_input(INPUT_GET, 'item_desc');
    $quantity = filter_input(INPUT_GET, 'qty', FILTER_VALIDATE_INT);
    $value = filter_input(INPUT_GET, 'est_val');
    $value = filter_input(INPUT_GET, 'perish');
    $value = filter_input(INPUT_GET, 'expDate');

    include "../inc/header.php";
    include "../donorhome.php";
    include "../inc/js_to_include.php";
    include "../inc/footer.php";

} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>
