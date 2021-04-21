<?php
	require_once('../inc/db_connect.php');
	//Food item_id for deletion
	$item_id = filter_input(INPUT_GET, 'deleteFromDb');
	//Food to be confirmed for pickup
	$confirmed_pickup_food_id = filter_input(INPUT_GET, 'pickup_confirmed');
	$confirmed_pickup_user_id = filter_input(INPUT_GET, 'ID');
	//Business search
	$inputBizName = filter_input(INPUT_GET, 'inputBizName',FILTER_SANITIZE_STRING);
	//Donor or FB
	$usertype = filter_input(INPUT_GET, 'usertype');
	//Grabbing the values the user input
	if($usertype == "donor"){
		$biz_id = filter_input(INPUT_GET, 'ID');
		$desc = filter_input(INPUT_GET, 'item_desc');
		$qty_avail = filter_input(INPUT_GET, 'qty', FILTER_VALIDATE_INT);
		$price = filter_input(INPUT_GET, 'est_val');
		$perish = filter_input(INPUT_GET, 'perish');
		$expiration = filter_input(INPUT_GET, 'expDate');
		if (isset($perish)){$perish = 1;}
		else {$perish = 0;}
	}
	//Adding to the DB
	if (isset($biz_id))
		{
			$query = 'INSERT INTO food_item 
					(item_desc, business_id, item_qty_avail, item_price, item_perishable, item_expiration)
				  VALUES
					(:desc, :biz_id, :qty_avail, :price, :perish, :expiration)';
			$statement = $db->prepare($query);
			$statement->bindValue(':desc', $desc);
			$statement->bindValue(':biz_id', $biz_id);
			$statement->bindValue(':qty_avail', $qty_avail);
			$statement->bindValue(':price', $price);
			$statement->bindValue(':perish', $perish);
			$statement->bindValue(':expiration', $expiration);
			$statement->execute();
			$statement->closeCursor();
			header("location: ../donorhome.php");
		}
	elseif (isset($item_id))
		{
			$query = 'DELETE FROM food_item
					  WHERE :item_id = item_id';
			$statement = $db->prepare($query);
			$statement->bindValue(':item_id', $item_id);
			$statement->execute();
			$statement->closeCursor();
			header("location: ../donorhome.php");
		}
	elseif (isset($confirmed_pickup_food_id) AND $usertype == "donor")
		{
			$query = 'UPDATE food_item
					  SET picked_up=1, awaiting_pickup=0
					  WHERE :confirmed_pickup_food_id = item_id';
			$statement = $db->prepare($query);
			$statement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
			$statement->execute();
			$statement->closeCursor();

			//Inserting confirmation into transcations
			$totalPrice = $price * $qty_avail;
			$todaysDate = date("Y-m-d");
			$transQuery = 'INSERT INTO transcations (trans_id, business_id, trans_total_price, trans_date)
					  VALUES (NULL, :biz_id, :totalPrice, :todaysDate)';
			$transStatement = $db->prepare($transQuery);
			$transStatement->bindValue(':biz_id', $biz_id);
			$transStatement->bindValue(':totalPrice', $totalPrice);
			$transStatement->bindValue(':todaysDate', $todaysDate);
			$transStatement->execute();
			$transStatement->closeCursor();
			header("location: ../donorhome.php");
		}
	elseif (isset($confirmed_pickup_food_id) AND $usertype == "foodbank")
		{
			$query = 'UPDATE food_item
					  SET awaiting_pickup=1, pickup_user_id=:confirmed_pickup_user_id
					  WHERE :confirmed_pickup_food_id = item_id';
			$statement = $db->prepare($query);
			$statement->bindValue(':confirmed_pickup_user_id', $confirmed_pickup_user_id);
			$statement->bindValue(':confirmed_pickup_food_id', $confirmed_pickup_food_id);
			$statement->execute();
			$statement->closeCursor();
			header("location: ../fbhome.php");
		}
	elseif (isset($inputBizName) AND (!empty($inputBizName)))
		{
			$query = 'SELECT business_id
					  FROM business
					  WHERE :inputBizName = business_name';
			$statement = $db->prepare($query);
			$statement->bindValue(':inputBizName', $inputBizName);
			$statement->execute();
			$businessID = $statement->fetchColumn();
			$statement->closeCursor();
			
			$head = "location: ../fbhome.php?ID=";
			$concatOne = "{$head}{$businessID}";
			$concatTwo = "{$concatOne}&BusinessName={$inputBizName}";
			header($concatTwo);
		}
	else
		{
			header("location: ../fbhome.php");	
		}

?>