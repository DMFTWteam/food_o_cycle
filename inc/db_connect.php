<?php
  $dsn1 = 'mysql:host=localhost:3306;dbname=food_o_cycle';
    $username1 = 'root';
    $password1 = 'root';
   	
    try {
        $db = new PDO($dsn1, $username1, $password1);
		echo '<p> You are connected to the database.</p>';
    } 
	catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo  '<p> Connection error.: '.$error_message.'</p>';
    }
	
?>