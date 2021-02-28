<?php
	include 'inc/header.php';
	
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
		<form class="mt-3 review-form-box" id="formRegister">
		
            <div class="row">
                <div class="col-lg-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">First Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputLastname" class="mb-0">Last Name</label>
                        <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                </div>
				<button type="submit" class="btn hvr-hover">Submit</button>
        </div>
		</div>
		</form>
		<form class="mt-3 review-form-box" id="formRegister" style="margin-bottom: 10%;">
            <div class="row">
                <div class="col-lg-12">
            <div class="title-left">
                <h3>Verification Code</h3>
            </div>
				<div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="Code" class="mb-0">Enter code below:</label>
                        <input type="text" class="form-control" id="Code" placeholder="Verification Code"> </div>
                </div>
				<button type="submit" class="btn hvr-hover">Submit</button>
        </div>
		</div>
		</form>
		</div>
	</body>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
?>