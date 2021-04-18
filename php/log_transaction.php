<?php

require "../inc/db_connect.php";


try {
    $firstName = filter_input(INPUT_POST, "firstName");
    $lastName = filter_input(INPUT_POST, "lastName");
    $phone = filter_input(INPUT_POST, "phone", FILTER_VALIDATE_INT);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $address = filter_input(INPUT_POST, "address");
    $country = filter_input(INPUT_POST, "country");
    $state = filter_input(INPUT_POST, "state");
    $zip = filter_input(INPUT_POST, "zip", FILTER_VALIDATE_INT);
    $trans_total_price = filter_input(INPUT_POST, "trans_total_price", FILTER_VALIDATE_FLOAT);

    $query = 'SELECT business_id FROM business WHERE
                business_address = :address AND
                business_country = :country AND
                business_state = :state AND
                business_zip = :zip';
    $statement = $db->prepare($query);
    $statement->bindValue(':address', $address);
    $statement->bindValue(':country', $country);
    $statement->bindValue(':state', $state);
    $statement->bindValue(':zip', $zip);
    $statement->execute();
    $business_id = $statement->fetch();
    $statement->closeCursor();

    $query2 = 'INSERT INTO transactions (business_id, trans_total_price, trans_date)
            VALUES (:business_id, :trans_total_price, DATE_FORMAT(NOW(), "%Y-%m-%d"))';
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':business_id', $business_id);
    $statement2->bindValue(':trans_total_price', $trans_total_price);
    $statement2->execute();
    $statement2->closeCursor();

    header("Location: ../index.php?msg=" .urlencode("Transaction placed successfully!"));
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}

?>
