<?php
	include 'inc/header.php';
	$_SESSION['email']=filter_input(INPUT_POST, 'InputEmail', FILTER_VALIDATE_EMAIL);
	if(isset($_SESSION['email'])){
		var_dump($_SESSION['email']);
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
                    <h2>Forgot Password</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="login.php">Sign In</a></li>
                        <li class="breadcrumb-item active">Forgot Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
	<div class="container">
		<form class="mt-3 review-form-box" name="formRegister" action='forgotPassword.php' method='post'>
		
            <div class="row">
                <div class="col-lg-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">First Name</label>
                        <input type="text" class="form-control" name="InputName" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputLastname" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" name="InputLastname" placeholder="Last Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email"> </div>
                </div>
				<button type="submit" class="btn hvr-hover">Submit</button>
        </div>
		</div>
		</form>
	<?php if(isset($_SESSION['email'])){ ?>
		<form class="mt-3 review-form-box" name="formRegister" style="margin-bottom: 10%;" action='resetPassword.php' method='post'>
            <div class="row">
                <div class="col-lg-12">
            <div class="title-left">
                <h3>Verification Code</h3>
            </div>
				<div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Code" class="mb-0">Enter code below:</label>
                        <input type="text" class="form-control" name="Code" placeholder="Verification Code"> </div>
                </div>
				<button type="submit" class="btn hvr-hover">Submit</button>
        </div>
		</div>
		</form>
	<?php  }  ?>
		</div>
	</body>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
?>