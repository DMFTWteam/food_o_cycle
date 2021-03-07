<?php
	include "../inc/db_connect.php";
	session_start(); 

	if(!isset($username)){
		$username = filter_input(INPUT_POST,'InputEmail');
	}
	
	if(!isset($password)){
		$password = filter_input(INPUT_POST,'InputPassword');
	}
	
	$login = filter_input(INPUT_POST, 'login');
	
	if(isset($login))  
		  {  
			   if(empty($username) || empty($password))  
			   {  
					echo '<label>All fields are required</label>';  
			   }  
			   
			   else
			   {
				 // Get the userName and passWord
					$query = 'SELECT u_email, u_password
							  FROM users
							  WHERE u_email = :emailAddress';
					$statement = $db->prepare($query);
					$statement->bindValue(':emailAddress', $username);
					$statement->execute();
					$login= $statement->fetch();
					print_r($login);
					$count = $statement->rowCount();
					$statement->closeCursor();
					
					if($count > 0){
					 
					 $validPassword = password_verify($password , $login['password']);
					 if($validPassword){
					 	$_SESSION["email"] = $username;
					  	header("Location: https://foodocycle.com/admin.php");
					  }
					}
					
					else{
					   echo '<label>Invalid Username or Password.</label>'; 
					}
			   }
			   
		 }	   
	
	
?>