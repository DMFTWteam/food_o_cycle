<?php
	ini_set("session.use_trans_sid",true);
	session_start();
	$_SESSION['cookie_support']=0;
	
	$_SESSION['email']=filter_input(INPUT_POST, 'InputEmail', FILTER_VALIDATE_EMAIL);
	$_SESSION['password']=filter_input(INPUT_POST, 'InputPassword');
	$path=filter_input(INPUT_POST, 'path');
	$_SESSION['account_type']= '';
	
	/*
		TO-DO: query database to find type of account - admin, food bank, donor
	*/
	
	if($_SESSION['email'] == null || $_SESSION['email'] == false || $_SESSION['password'] == null){
		header('Location: https://foodocycle.com/login.php');
	}else{
		header('Location: https://foodocycle.com/fbhome.php');
		/*if($_SESSION['account_type'] === 'admin'){
			header('Location: https://foodocycle.com/admin.php');
		}else if($_SESSION['account_type'] === 'food_bank'){
			header('Location: https://foodocycle.com/fbhome.php');
		}else if($_SESSION['account_type'] === 'donor'){
			header('Location: https://foodocycle.com/donorhome.php');
		}*/
	}
	
?>