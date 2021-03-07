<?php
  $dsn1 = 'mysql:host=localhost;dbname=food_o_cycle';
    $username1 = 'site';
    $password1 = 'O9m1NbIwkGiAlUIE';
   	
    try {
        $db = new PDO($dsn1, $username1, $password1);
		echo '<p> You are connected to the database.</p>';
    } 
	catch (PDOException $e) {
        $error_message = $e->getMessage();
        echo  '<p> Connection error.: '.$error_message.'</p>';
    }
	
?>