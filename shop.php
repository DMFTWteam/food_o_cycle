<?php

/**
 * Shop.php Doc Comment
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
/*if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}*/
require 'inc/header.php';
// connect to database
require 'inc/db_connect.php';
 
// include objects
require_once "objects/product.php";
require_once "objects/product_image.php";
require 'inc/shop_header.php';

// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);

// to prevent undefined index notice
$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// for pagination purposes
$page = isset($_GET['page']) ? $_GET['page'] : 1; // page is the current page, if there's nothing set, default is page 1
$records_per_page = 6; // set records or rows of data per page
$from_record_num = ($records_per_page * $page) - $records_per_page; // calculate for the query LIMIT clause

echo "<div class='col-md-12'>";
if($action=='added') {
    echo "<div class='alert alert-info'>";
        echo "Product was added to your cart!";
    echo "</div>";
}
 
if($action=='exists') {
    echo "<div class='alert alert-info'>";
        echo "Product already exists in your cart!";
    echo "</div>";
}
echo "</div>";

// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);
 
// count number of retrieved products
$num = $stmt->rowCount();
 
// if products retrieved were more than zero
if($num>0) {
    // needed for paging
    $page_url="products.php?";
    $total_rows=$product->count();
 
    // show products
    include_once "inc/read_products_template.php";
}
 
// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}

require 'inc/shop_footer.php';
?>


<?php

    require 'inc/js_to_include.php';
    require 'inc/footer.php';
?>
