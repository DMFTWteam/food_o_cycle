<?php

try {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    include 'inc/header.php';
    include_once 'inc/db_connect.php';
    //Userinfo Section
    $u_id = 2;
    $biz_id = 1000;
    $query = 'SELECT u_id, u_photo, u_username, u_fname, u_lname FROM users
		  WHERE u_id = :u_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':u_id', $u_id);
    $statement->execute();
    $userInfo = $statement->fetchAll();
    $statement->closeCursor();
    //Item Section
    $query = 'SELECT * FROM food_item
		  WHERE business_id = :u_id
		  ORDER BY item_desc';
    $statement = $db->prepare($query);
    $statement->bindValue(':u_id', $biz_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    ?>
<script src="js/datetime.js"></script>
<!-- To do: Change information to represent queries to db -->
<div class="container-fluid gedf-wrapper">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <img class="rounded-circle" width="45"
                        src="data:image/jpeg;base64,<?php echo base64_encode($userInfo[0]['u_photo']); ?>" alt="">
                    <div class="h5">@<?php echo $userInfo[0]['u_username']; ?> </div>
                    <div class="h7 text-muted">Fullname :
                        <?php echo $userInfo[0]['u_fname'] . ' ' . $userInfo[0]['u_lname']; ?> </div>
                </div>
            </div>
        </div>
        <!--- \\\\\\\Post-->
        <div class="col-md-6 gedf-main">
            <form action="php/user_actions.php" method="get">
                <div class="card gedf-card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item-post">
                                <h1 class="user-post-form-head">
                                    Post an Item
                                </h1>
                            </li>
                        </ul>
                    </div>
                    <div class="form-group row">
                        <label for="item_desc" class="col-sm-2 col-form-label">Item Description</label>
                        <div class="col-sm-10">
                            <input type="item_desc" class="form-control" name="item_desc" id="item_desc"
                                placeholder="item_desc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qty" class="col-sm-2 col-form-label">Quantity Avaliable</label>
                        <div class="col-sm-10">
                            <input type="qty" class="form-control" name="qty" id="qty" placeholder="qty">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="est_val" class="col-sm-2 col-form-label">Estimated Value</label>
                        <div class="col-sm-10">
                            <input type="est_val" class="form-control" name="est_val" id="est_val"
                                placeholder="est_val">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-2">Checkbox</div>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="perish" name="perish">
                                <label class="form-check-label" for="perish">
                                    Item(s) Perishable?
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="expDate">
                        <label for="expDate">Expiration Date:</label>
                        <input type="date" id="expDate" name="expDate" class="expDate">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Post Item</button>
                        </div>
                    </div>

            </form>
        </div>
        <!-- Post /////-->

        <!-- My Posted Items or Food View -->
        <div class="d-flex justify-content-center">
            <h1 class="user-post-head">My Posted Food Items</h1>
        </div>

        <!--- \\\\\\\Post-->
        <div class="card gedf-card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                </div>

            </div>
            <div class="card-body">
                <?php foreach($items as $item): ?>
                <div class="text-muted h7">
                    <h5 class="card-title">&#9862;Item Description: <?php echo $item['item_desc']; ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-clock-o"></i>Expiration: <?php echo $item['item_expiration']; ?>
                        <br>
                        &nbsp;&nbsp;&nbsp;&nbsp; Item ID: <?php echo $item['item_id']; ?>
                        &emsp;
                <?php endforeach; ?>
                        <a href="#" <i class="fa fa-trash"></i>
                        </a>
                    </h5>
                </div>
            </div>
            <div class="card-footer">
                <i class="fa fa-mail-forward"></i>
            </div>
        </div>
        <!-- Post /////-->

        <!-- Items requested from donor -->
        <div class="d-flex justify-content-center">
            <h1 class="user-post-head">My Requested Food Items</h1>
        </div>

        <!--- \\\\\\\Post-->
        <div class="card gedf-card">
            <div class="card-header">
            </div>
            <form class="form-inline">
                <div class="request-box">
                    This is a description of the item&emsp;
                    <i class="fa fa-trash"></i>
                    &emsp;
                    <input class="form-check-input" type="checkbox" id="inlineFormCheck"> Confirm Pickup

                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>

            <form class="form-inline">
                <div class="request-box">
                    This is a description of the item&emsp;
                    <i class="fa fa-trash"></i>
                    &emsp;
                    <input class="form-check-input" type="checkbox" id="inlineFormCheck"> Confirm Pickup

                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                </div>
            </form>
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
            </div>
            <div class="card-body">
                <a class="card-link" href="#">
                    <h5 class="card-title">This is the food to be picked up</h5>
                </a>
                <a class="card-link" href="#">
                    <h5 class="card-title">This is the food to be picked up</h5>
                </a>
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
<script src="js/userpages.js" />
    <?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>
