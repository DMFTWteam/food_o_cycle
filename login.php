<?php
	include 'inc/header.php';
	$path=filter_input(INPUT_POST, "path");
	//var_dump($path);
	
	if($path === '/register.php'){
		$first_name=filter_input(INPUT_POST,'InputName');
		$last_name=filter_input(INPUT_POST,'InputLastname');
		$email=filter_input(INPUT_POST,'InputEmail', FILTER_VALIDATE_EMAIL);
		$password=filter_input(INPUT_POST,'InputPassword');
		$donor_box=filter_input(INPUT_POST,'DonorBox', FILTER_VALIDATE_BOOLEAN);
		$bank_box=filter_input(INPUT_POST,'BankBox', FILTER_VALIDATE_BOOLEAN);
		$business_name=filter_input(INPUT_POST,'BusinesName');
		$ein=filter_input(INPUT_POST,'EIN', FILTER_VALIDATE_INT);
		var_dump($first_name);
		var_dump($last_name);
		var_dump($email);
		var_dump($password);
		var_dump($donor_box);
		var_dump($bank_box);
		var_dump($business_name);
		var_dump($ein);
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
                        <button type="submit" class="btn hvr-hover">Login</button>
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
