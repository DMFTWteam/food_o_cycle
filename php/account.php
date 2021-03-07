<?php
	require "../inc/db_connect.php";
	session_start(); 

	if(!isset($username)){
		$username = filter_input(INPUT_POST,'InputEmail');
	}
	
	if(!isset($password)){
		$password = filter_input(INPUT_POST,'InputPassword');
	}
	
	$user_info = filter_input(INPUT_POST, 'login');
	
	if(isset($user_info))  
		  {  
			   if(empty($username) || empty($password))  
			   {  
					echo '<label>All fields are required</label>';  
			   }  
			   
			   else
			   {
				 // Get the userName and passWord
					$query = 'SELECT *
							  FROM users
							  WHERE u_email = :emailAddress';
					$statement = $db->prepare($query);
					$statement->bindValue(':emailAddress', $username);
					$statement->execute();
					$user_info= $statement->fetch();
					print_r($user_info);
					$user_count = $statement->rowCount();
					$statement->closeCursor();
					

					if($user_count > 0){
					 
					 $validPassword = password_verify($password , password_hash($user_info['u_password'], PASSWORD_DEFAULT));
					 if($validPassword){
						 $_SESSION['user'] = $user_info;
					  	if($user_info['u_is_admin'] === 1){
							  header("Location: ../admin.php");
						}else if($user_info['u_is_standard'] === 1){
							$query2 = 'SELECT *
							  			FROM user_to_business, business
							 			WHERE user_to_business.u_id = :u_id
										AND user_to_business.business_id = business.business_id';
							$statement2 = $db->prepare($query2);
							$statement2->bindValue(':u_id', $user_info['u_id']);
							$statement2->execute();
							$bus_info= $statement2->fetch();
							$statement2->closeCursor();
							print_r($bus_info);
							if($business_count > 0){
						 		$_SESSION['business'] = $bus_info;
								if($_SESSION['business']['business_is_donor'] === 1){
									header("Location: ../donorhome.php");
								}else{
									header("Location: ../fbhome.php");
								}
							}
						}
					  }
					  else{
						echo '<label>Invalid Password.</label>'; 
					 }
					}else{
						echo '<label>Invalid Username.</label>'; 
					 }
					
					
			   }
			   
		 }	   
	
	
?>