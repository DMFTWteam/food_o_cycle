<?php
	include 'inc/header.php';
	$path=filter_input(INPUT_POST, "path");
	
	if($path === '/register.php'){
		$first_name=filter_input(INPUT_POST,'InputName');
		$last_name=filter_input(INPUT_POST,'InputLastname');
		$email=filter_input(INPUT_POST,'InputEmail', FILTER_VALIDATE_EMAIL);
		$password=filter_input(INPUT_POST,'InputPassword');
		$donor_box=filter_input(INPUT_POST,'DonorBox', FILTER_VALIDATE_BOOLEAN);
		$bank_box=filter_input(INPUT_POST,'BankBox', FILTER_VALIDATE_BOOLEAN);
		$business_id=filter_input(INPUT_POST,'Business');
		$ein=filter_input(INPUT_POST,'EIN', FILTER_VALIDATE_INT);
		
		$query = 'INSERT INTO users
                 (u_fname, u_lname, 
				 u_mi, u_password, u_phone, 
				 u_email, u_is_admin, u_is_standard)
              VALUES
                 (:first_name, :last_name, :initial, :password, 
				 :phone, :email, 0, 1)';
    	$statement = $db->prepare($query);
    	$statement->bindValue(':first_name', $first_name);
		$statement->bindValue(':last_name', $last_name);
		$statement->bindValue(':initial', $initial);
		$statement->bindValue(':password', $password);
		$statement->bindValue(':phone', $phone);
		$statement->bindValue(':email', $email);
		$statement->execute();
		$statement->closeCursor();

		$query2 = 'SELECT u_id
					FROM users
					WHERE u_email = :email';
		$statement2 = $db->prepare($query2);
		$statement2->bindValue(':email', $email);
		$statement2->execute();
		$u_id = $statement2->fetch();
		$statement2->closeCursor();

		$query2 = 'SELECT u_id
					FROM users
					WHERE u_email = :email';
		$statement2 = $db->prepare($query2);
		$statement2->bindValue(':email', $email);
		$statement2->execute();
		$u_id = $statement2->fetch();
		$statement2->closeCursor();

	}else if($path === '/resetPassword.php'){
		$password=filter_input(INPUT_POST, 'InputPassword');
		var_dump($password);
	}
	
	
	
	
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
	<body>
	<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Sign In</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Sign In</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
		<div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form class="mt-3 review-form-box" name="formLogin" style="margin-bottom: 30%;" action='php/account.php' method='post'>
                        <div class="form-row" >
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" name="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover" name='login' value='Login'>Login</button>
						<div>
							<a href="register.php"><br>Create New Account</a>
							<a href="forgotPassword.php"><br>Forgot Login Information?</a>
						</div>
                    </form>
                </div>
			</div>
		</div>
				
	</body>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
	
?>
