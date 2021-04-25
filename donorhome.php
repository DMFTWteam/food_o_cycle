<?php
/**
 * donorhome.php Doc Comment
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
    //Userinfo Section
    $u_id = $_SESSION['user']['u_id'];
    $query = 'SELECT u_id, u_photo, u_username, u_fname, u_lname FROM users
		  WHERE u_id = :u_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':u_id', $u_id);
    $statement->execute();
    $userInfo = $statement->fetchAll();
    $statement->closeCursor();
    //Business ID section
    $businessIdQuery = 'SELECT business_id FROM user_to_business
		  WHERE u_id = :u_id';
    $statementBId = $db->prepare($businessIdQuery);
    $statementBId->bindValue(':u_id', $u_id);
    $statementBId->execute();
    $idResults = $statementBId->fetchAll();
    $statementBId->closeCursor();
    foreach ($idResults as $id){$biz_id = $id['business_id'];
    }
    //Item Section
    $query = 'SELECT * FROM food_item WHERE
		  :biz_id = business_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':biz_id', $biz_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    //Tax record query
    $query = 'SELECT * FROM transactions 
          INNER JOIN transaction_line
          ON transactions.trans_id = transaction_line.trans_id
          WHERE :biz_id = transactions.business_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':biz_id', $biz_id);
    $statement->execute();
    $logs = $statement->fetchAll();
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
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="button" class="btn hvr-hover" id="download" onclick='generate()'
                                style="margin-bottom: 10%; color: #FFFFFF;" value='Download Logs' />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 gedf-main">

            <div class="card gedf-card">
                <form action="php/user_actions.php" method="POST">
                    <input type="hidden" id="ID" name="ID" value=<?php echo $u_id ?>>
                    <input type="hidden" name="usertype" value="donor">
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
                    <label for="itemfileToUpload" class="col-sm-2 col-form-label">Item Image</label>
                        <div class="col-sm-10">
                            <input type="file" name="itemfileToUpload" id="itemfileToUpload">
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
                            <button type="submit" name="submit" id="submit" class="btn btn-primary">Post Item</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- My Posted Items or Food View -->
            <div class="d-flex justify-content-center">
                <h1 class="user-post-head">My Posted Food Items</h1>
            </div>

            <!--- \\\\\\\Post-->
            <form action="php/user_actions.php" method="POST">
                <input type="hidden" name="usertype" value="donor">
                <div class="card gedf-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center"></div>
                    </div>
                    <div class="card-body">
                        <?php foreach($items as $item): ?>
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

                                    <button type="submit" name="deleteFromDb" value="<?php echo $item['item_id']?>"> <i
                                            class="fa fa-trash"></i>


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
                <h1 class="user-post-head">Awaiting Pickup</h1>
            </div>

            <!--- \\\\\\\Post-->
            <form class="form-inline" action="php/user_actions.php" method="POST">
                <input type="hidden" name="usertype" value="donor">
                <input type="hidden" name="ID" value="<?php echo $biz_id; ?>">
                <div class="card gedf-card">
                    <div class="card-header">
                    </div>
                    <?php foreach($items as $item): ?>
                        <?php if($item['awaiting_pickup']==1) : ?>
                    <div class="request-box">
                        <ul class="food-bullets">
                            <li>Item Description: <?php echo $item['item_desc']; ?>&emsp;
                                <button type="submit" name="deleteFromDb" value="<?php echo $item['item_id']?>"> <i
                                        class="fa fa-trash"></i></button>
                                &emsp;
                                <input class="form-check-input" type="checkbox" id="inlineFormCheck"
                                    name="pickup_confirmed" value="<?php echo $item['item_id']?>"> Confirm Pickup
                                <input type="hidden" name="qty" value="<?php echo $item['item_qty_avail']?>" >

                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </li>
                        </ul>
                    </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <div class="card-footer">
                        <i class="fa fa-mail-forward"></i>
                    </div>
                </div>
            </form>
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
                    <?php foreach($items as $item): ?>
                        <?php if($item['picked_up']==1) : ?>
                    <div class="text-muted h7">
                        <h5 class="card-title">
                            <ul class="food-bullets">
                                <li>Item Description: <?php echo $item['item_desc']; ?>
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
<div>
    <table class="table" id="log_table" style="display: none">
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Transaction ID</th>
                <th>Transaction Date</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php                      
            foreach ($logs as $log) {
                if ($log['business_id'] != '' && $log['business_id'] != null) {
                    echo "<input type=\"hidden\" name=\"inputs\" value=\"{$log['business_id']}\" />";
                } else {
                                    
                    echo "<input type=\"hidden\" name=\"inputs\" value=\"0\" />";
                }
                echo "<tr>";
                echo "<td>{$log['item_id']}</td>";
                echo "<td>{$log['trans_id']}</td>";
                echo "<td>{$log['trans_date']}</td>";
                echo "<td>{$log['trans_total_price']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script type='text/javascript'>
function filterTable(item_id) {
    console.log(item_id);
    // Declare variables
    var table, tr, td, i;
    table = document.getElementById("log_table");
    tr = table.getElementsByTagName("tr");
    var ids = document.querySelectorAll("input[type=hidden]");
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];

        console.log(ids[i].value);
        if (td) {
            if (ids[i].value == item_id) {
                tr[i + 1].style.display = "";
            } else {
                tr[i + 1].style.display = "none";
            }
        }
    }
}


function generate() {
    var doc = new jsPDF();
    doc.autoTable({
        html: '#log_table',
        styles: {
            halign: 'center',
            theme: 'grid'
        }
    });
    doc.save('taxrecords.pdf');
}
</script>
<script src="js/userpages.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>
    <?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
}
catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
