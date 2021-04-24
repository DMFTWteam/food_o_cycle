<?php
/**
 * fbhome.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   A Camuti <cam6579@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
try {
    session_start();
    $_SESSION['path'] = $_SERVER['PHP_SELF'];
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    include 'inc/header.php';
    include_once 'inc/db_connect.php';
    //List items by business ID or list ALL items
    $biz_id = filter_input(INPUT_GET, 'ID');
    $BusinessName = filter_input(INPUT_GET, 'BusinessName');
    if (isset($biz_id) && $biz_id>=1) {
        //By business Items Section
        $query = 'SELECT * FROM food_item
			  WHERE :biz_id = business_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':biz_id', $biz_id);
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();

    }
    else
    {
        //All Items Section
        $query = 'SELECT * FROM food_item, business
			  WHERE food_item.business_id = business.business_id';
        $statement = $db->prepare($query);
        $statement->execute();
        $items = $statement->fetchAll();
        $statement->closeCursor();    
    }
    //User Information
    $u_id = $_SESSION['user']['u_id'];
    $query = 'SELECT u_id, u_photo, u_username, u_fname, u_lname FROM users
		  WHERE u_id = :u_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':u_id', $u_id);
    $statement->execute();
    $userInfo = $statement->fetchAll();
    $statement->closeCursor();
    //My Cart Section & Awaiting Pickup
    $query = 'SELECT * FROM food_item
		  WHERE pickup_user_id = :u_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':u_id', $u_id);
    $statement->execute();
    $cartItems = $statement->fetchAll();
    $statement->closeCursor();
    ?>

<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <?php  if ($_SESSION['user']['u_photo'] == null || $_SESSION['user']['u_photo'] == '') {
                            echo "<img class=\"rounded-circle\" width=\"45\" src='images/Profile-no-Found.png'/>";
                    } else {
                        echo "<img class=\"rounded-circle\" width=\"45\"
                        src='data:image/jpeg;base64," .base64_encode($_SESSION['user']['u_photo']). "' />";
                    } ?>
                    <div class="h5">@<?php echo $_SESSION['user']['u_username']; ?> </div>
                    <div class="h7 text-muted">Fullname :
                        <?php echo $_SESSION['user']['u_fname'] . ' ' . $_SESSION['user']['u_lname']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 gedf-main">

            <!-- Zipcode Search Bar -->
            <div class="card gedf-card">
                <form action="php/user_actions.php" method="get">
                    <input type="hidden" name="usertype" value="foodbank">
                    <div class="card-header">
                    </div>
                    <h2>Search by business name for food items!</h2>
                    <div class="form-group col-md-2">
                        <input type="text" class="form-control" name="inputBizName">
                    </div>
                    <div class="form-group row" action=>
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Results will be either all or a specific business -->
            <div class="d-flex justify-content-center">
                <h1 class="user-post-head">Items Currently Available</h1>
            </div>

            <!--- \\\\\\\Post-->
            <form action="php/user_actions.php" method="get">
                <input type="hidden" name="usertype" value="foodbank">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center"></div>
                    </div>
                    <div class="card-body">
                        <?php foreach($items as $item): ?>
                            <?php if($item['picked_up']!=1 AND $item['pickup_user_id']==0) : ?>
                        <div class="text-muted h7">
                            <h5 class="card-title">
                                <ul class="food-bullets">
                                    <li>Item Description: <?php echo $item['item_desc']; ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <i class="fa fa-clock-o"></i>Expiration: <?php echo $item['item_expiration']; ?>
                                    </li>
                                    <br>
                                    Item ID: <?php echo $item['item_id']; ?>
                                    &emsp;
                                    Business Name: <?php if(!isset($BusinessName)) :echo $item['business_name']; ?>
                                    <?php else: echo $BusinessName; ?>
                                    <?php endif; ?>
                                    <input type="hidden" id="ID" name="ID" value=<?php echo $u_id ?>>
                                    &emsp;
                                    <button type="submit" class="btn btn-primary btn-sm" name="pickup_confirmed"
                                        value="<?php echo $item['item_id']?>">Add to cart</button>
                            </h5>
                            </ul>
                        </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <i class="fa fa-mail-forward"></i>
                    </div>
                </div>
            </form>
            <!-- Post /////-->

            <!-- Items requested from donor -->
            <div class="d-flex justify-content-center">
                <h1 class="user-post-head">My Cart</h1>
            </div>

            <!--- \\\\\\\Post-->
            <div class="card gedf-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center"></div>
                </div>
                <div class="card-body">
                    <?php foreach($cartItems as $item): ?>
                        <?php if($item['picked_up']!=1) : ?>
                    <div class="text-muted h7">
                        <h5 class="card-title">
                            <ul class="food-bullets">
                                <li>Item Description: <?php echo $item['item_desc']; ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-clock-o"></i>Expiration: <?php echo $item['item_expiration']; ?>
                                </li>
                                <br>
                                Item ID: <?php echo $item['item_id']; ?>
                                &emsp;
                        </h5>
                        </ul>
                    </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <i class="fa fa-mail-forward"></i>
                </div>
            </div>
            <!-- Post /////-->
            <!-- Food Confirmed for Pickup -->
            <div class="d-flex justify-content-center">
                <h1 class="user-post-head">Food Confirmed for Pickup
            </div>
            <!--- \\\\\\\Post-->
            <div class="card gedf-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center"></div>
                </div>
                <div class="card-body">
                    <?php foreach($cartItems as $item): ?>
                        <?php if($item['picked_up']==1) : ?>
                    <div class="text-muted h7">
                        <h5 class="card-title">
                            <ul class="food-bullets">
                                <li>Item Description: <?php echo $item['item_desc']; ?>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <i class="fa fa-clock-o"></i>Expiration: <?php echo $item['item_expiration']; ?>
                                </li>
                                <br>
                                Item ID: <?php echo $item['item_id']; ?>
                                &emsp;
                        </h5>
                        </ul>
                    </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="card-footer">
                    <i class="fa fa-mail-forward"></i>
                </div>
            </div>
            <!-- Post /////-->
        </div>
    </div>
</div>
</div>
    <?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
