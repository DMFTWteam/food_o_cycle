<?php
/**
 * User_actions.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Adrian Camuti <cam6579@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
    require_once '../inc/db_connect.php';
    //Food item_id for deletion
    $item_id = filter_input(INPUT_POST, 'deleteFromDb');
    //Food to be confirmed for pickup
    $confirmed_pickup_food_id = filter_input(INPUT_POST, 'pickup_confirmed');
    $confirmed_pickup_user_id = filter_input(INPUT_POST, 'ID');
    //Business search
    $inputBizName = filter_input(INPUT_POST, 'inputBizName', FILTER_SANITIZE_STRING);
    //Donor or FB
    $usertype = filter_input(INPUT_POST, 'usertype');
    //Grabbing the values the user input
if($usertype == "donor") {
    $biz_id = filter_input(INPUT_POST, 'ID');
    $desc = filter_input(INPUT_POST, 'item_desc');
    $qty_avail = filter_input(INPUT_POST, 'qty', FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, 'est_val');
    $perish = filter_input(INPUT_POST, 'perish');
    $expiration = filter_input(INPUT_POST, 'expDate');
    $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["itemfileToUpload"]["name"]);
        //print_r($_FILES['itemfileToUpload']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["itemfileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

        // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

        // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    ) {
        echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
        $uploadOk = 0;
    }

        // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        $blob = fopen($_FILES["itemfileToUpload"]["tmp_name"], 'rb');
        if (isset($blob) && $blob != '') {
            //echo "The file ". htmlspecialchars(basename($_FILES["itemfileToUpload"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    if (isset($perish)) {
        $perish = 1;
    } else {
        $perish = 0;
    }
}
    //Adding to the DB
if (isset($biz_id) AND !isset($confirmed_pickup_food_id) AND !isset($item_id)) {
    $query = 'INSERT INTO food_item 
					(item_desc, business_id, item_qty_avail, item_price, item_image, item_perishable, item_expiration, item_added)
				  VALUES
					(:desc, :biz_id, :qty_avail, :price, :blob, :perish, :expiration, CURDATE())';
    $statement = $db->prepare($query);
    $statement->bindValue(':desc', $desc);
    $statement->bindValue(':biz_id', $biz_id);
    $statement->bindValue(':qty_avail', $qty_avail);
    $statement->bindParam(':blob', $blob, PDO::PARAM_LOB);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':perish', $perish);
    if ($perish == 1) {
        $statement->bindValue(':expiration', $expiration);
    } else if ($perish == 0) {
        $statement->bindValue(':expiration', '2040-01-01');
    }
    $statement->execute();
    $statement->closeCursor();
    header("location: ../donorhome.php");
}
elseif (isset($item_id)) {
    $query = 'DELETE FROM food_item
					  WHERE :item_id = item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_id', $item_id);
    $statement->execute();
    $statement->closeCursor();
    header("location: ../donorhome.php");
}
elseif (isset($confirmed_pickup_food_id) AND $usertype == "donor") {
            
    $query = 'UPDATE food_item
					  SET picked_up=1, awaiting_pickup=0
					  WHERE :confirmed_pickup_food_id = item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
    $statement->execute();
    $statement->closeCursor();
            
            
    //Getting item information
    $itemQuery = 'SELECT item_price, item_qty_avail
					  FROM food_item
					  WHERE :confirmed_pickup_food_id = item_id';
    $itemStatement = $db->prepare($itemQuery);
    $itemStatement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
    $itemStatement->execute();
    $itemInfo = $itemStatement->fetchAll();
    $itemStatement->closeCursor();            
    foreach($itemInfo as $result)
    {
        $totalPrice = $result['item_price'] * $result['item_qty_avail'];
    }
            
    //Inserting confirmation into transcations
    $todaysDate = date("Y-m-d");
    $transQuery = 'INSERT INTO transactions (trans_id, business_id, trans_total_price, trans_date) VALUES (NULL, :biz_id, :totalPrice, :todaysDate)';
    $transStatement = $db->prepare($transQuery);
    $transStatement->bindValue(':biz_id', $biz_id);
    $transStatement->bindValue(':totalPrice', $totalPrice);
    $transStatement->bindValue(':todaysDate', $todaysDate);
    $transStatement->execute();
    $transStatement->closeCursor();
    //Grabbing just made trans_id
    $transIDQuery = 'SELECT trans_id
							 FROM transactions
							 WHERE :biz_id = business_id';
    $transIdStatement = $db->prepare($transIDQuery);
    $transIdStatement->bindValue(':biz_id', $biz_id);
    $transIdStatement->execute();
    $transIdStatementResults = $transIdStatement->fetchAll();
    $transIdStatement->closeCursor();    
    foreach($transIdStatementResults as $transId)
    {
        $transactionID = $transId['trans_id'];
    }            
    //Inserting confirmation into transcation line
    $transLineQuery = 'INSERT INTO transaction_line (line_id, trans_id, item_id, item_quantity) VALUES (NULL, :transactionID, :confirmed_pickup_food_id, :qty_avail)';
    $transLineStatement = $db->prepare($transLineQuery);
    $transLineStatement->bindValue(':transactionID', $transactionID);
    $transLineStatement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
    $transLineStatement->bindValue(':qty_avail', $qty_avail);
    $transLineStatement->execute();
    $transLineStatement->closeCursor();
    header("location: ../donorhome.php");
}
elseif (isset($confirmed_pickup_food_id) AND $usertype == "foodbank") {
    $query = 'UPDATE food_item
					  SET awaiting_pickup=1, pickup_user_id=:confirmed_pickup_user_id
					  WHERE :confirmed_pickup_food_id = item_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':confirmed_pickup_user_id', $confirmed_pickup_user_id);
    $statement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
    $statement->execute();
    $statement->closeCursor();
    // get the product id
    $encoded_item = isset($_POST['item']) ? $_POST['item'] : "";
    $item = unserialize(urldecode($encoded_item));
    $item['quantity'] = 1;
    /*
    * check if the 'cart' session array was created
    * if it is NOT, create the 'cart' session array
    */
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
 
    // check if the item is in the array, if it is, do not add
    if (!in_array($item['item_desc'], array_column($_SESSION['cart'], 'item_desc'))) {
        array_push($_SESSION['cart'], $item);
 
        // redirect to product list and tell the user it was added to cart
        header("location: ../fbhome.php");
    } else {
        // redirect to product list and tell the user it was added to cart
        header("location: ../fbhome.php");
    }
    
}
elseif (isset($inputBizName) AND (!empty($inputBizName))) {
    $query = 'SELECT business_id
					  FROM business
					  WHERE :inputBizName = business_name';
    $statement = $db->prepare($query);
    $statement->bindValue(':inputBizName', $inputBizName);
    $statement->execute();
    $idResults = $statement->fetchAll();
    $statement->closeCursor();
    foreach($idResults as $id)
    {
        $found_id = $id['business_id'];
    }    
    $head = "location: ../fbhome.php?ID=";
    $concatOne = "{$head}{$found_id}";
    $concatTwo = "{$concatOne}&BusinessName={$inputBizName}";
    header($concatTwo);
}
else
 {
    header("location: ../fbhome.php");    
}

?>
