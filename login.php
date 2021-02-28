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
                    <form class="mt-3 review-form-box" id="formLogin" style="margin-bottom: 30%;">
                        <div class="form-row" >
                            <div class="form-group col-md-6">
                                <label for="InputEmail" class="mb-0">Email Address</label>
                                <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email"> </div>
                            <div class="form-group col-md-6">
                                <label for="InputPassword" class="mb-0">Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Login</button>
						<div>
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