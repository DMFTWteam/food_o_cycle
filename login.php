<?php
	include 'inc/header.php';
	
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
	<body>
		<div class="Center col-sm-6 col-lg-6 mb-3" >
                    <div class="title-center">
                        <h3>Account Login</h3>
                    </div>
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
				
	</body>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
	
?>