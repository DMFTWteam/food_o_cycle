<?php 

session_start();
$_SESSION['path'] = $_SERVER['PHP_SELF']; 
$item_id = filter_input(INPUT_GET, 'item_id');

require "inc/header.php";
require "inc/js_to_include.php";
require "inc/db_connect.php";

$query = 'SELECT * 
    FROM food_item 
    LEFT JOIN business 
    ON food_item.business_id = business.business_id 
    WHERE item_id = :item_id';
$statement = $db->prepare($query);
$statement->bindValue(':item_id', $item_id);
$statement->execute();
$item_info = $statement->fetch();
$statement->closeCursor();



?>

<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Shop Detail</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active">Shop Detail </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start Shop Detail  -->
<div class="shop-detail-box-main">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-5 col-md-6">
                
            </div>
            <div class="col-xl-7 col-lg-7 col-md-6">
                <div class="single-product-details">
                    <h2>Fachion Lorem ipsum dolor sit amet</h2>
                    <h5> <del>$ 60.00</del> $40.79</h5>
                    <p class="available-stock"><span> More than 20 available / <a href="#">8 sold </a></span>
                    <p>
                    <h4>Short Description:</h4>
                    <p>Nam sagittis a augue eget scelerisque. Nullam lacinia consectetur sagittis. Nam sed neque id eros
                        fermentum dignissim quis at tortor. Nullam ultricies urna quis sem sagittis pharetra. Nam erat
                        turpis, cursus in ipsum at,
                        tempor imperdiet metus. In interdum id nulla tristique accumsan. Ut semper in quam nec pretium.
                        Donec egestas finibus suscipit. Curabitur tincidunt convallis arcu. </p>
                    <ul>
                        <li>
                            <div class="form-group quantity-box">
                                <label class="control-label">Quantity</label>
                                <input class="form-control" value="0" min="0" max="20" type="number">
                            </div>
                        </li>
                    </ul>

                    <div class="price-box-bar">
                        <div class="cart-and-bay-btn">
                            <a class="btn hvr-hover" data-fancybox-close="" href="#">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>
<!-- End Cart -->

<?php 
    require "inc/footer.php";
?>