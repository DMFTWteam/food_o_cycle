<?php

/**
 * Log_transaction.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
require "../inc/db_connect.php";
session_start();

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


    $query2 = 'INSERT INTO transactions (business_id, trans_total_price, trans_date)
            VALUES (:business_id, :trans_total_price, DATE_FORMAT(NOW(), "%Y-%m-%d"))';
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':business_id', $_SESSION['business']['business_id']);
    $statement2->bindValue(':trans_total_price', $trans_total_price);
    $statement2->execute();
        $statement2->closeCursor();

        $query3 = 'SELECT    *
        FROM      transactions
        WHERE     business_id = :business_id
        ORDER BY  trans_id DESC
        LIMIT     1';
        $statement3 = $db->prepare($query3);
        $statement3->bindValue(':business_id', $_SESSION['business']['business_id']);
        $statement3->execute();
        $trans_id = $statement3->fetch();
        $statement3->closeCursor();
        
    
    

    foreach ($_SESSION['cart'] as $item) {
        $query4 = 'INSERT INTO transaction_line (trans_id, item_id, item_quantity)
            VALUES (:trans_id, :item_id, :item_quantity)';
        $statement4 = $db->prepare($query4);
        $statement4->bindValue(':trans_id', $trans_id['trans_id']);
        $statement4->bindValue(':item_id', $item['item_id']);
        $statement4->bindValue(':item_quantity', $item['quantity']);
        $statement4->execute();
        $statement4->closeCursor();

        $query5 = 'UPDATE food_item SET item_qty_avail = (item_qty_avail - :item_quantity)
            WHERE item_id = :item_id';
        $statement5 = $db->prepare($query5);
        $statement5->bindValue(':item_id', $item['item_id']);
        $statement5->bindValue(':item_quantity', $item['quantity']);
        $statement5->execute();
        $statement5->closeCursor();
    }
    unset($_SESSION['cart']);
    header("Location: ../index.php?msg=" .urlencode("Transaction placed successfully!"));
} catch(Exception $e) {
    header("Location: ../error.php?msg=" .urlencode($e->getMessage()));
}

?>
