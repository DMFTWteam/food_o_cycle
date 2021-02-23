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
                    <h2>Reset Password</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Reset Password</li>
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
                                <label for="InputPassword" class="mb-0">New Password</label>
                                <input type="password" class="form-control" id="InputPassword" placeholder="Enter Password"> </div>
                            <div class="form-group col-md-6">
                                <label for="ConfirmPassword" class="mb-0">Confirm Password</label>
                                <input type="password" class="form-control" id="ConfirmPassword" placeholder="Confirm Password"> </div>
                        </div>
                        <button type="submit" class="btn hvr-hover">Submit</button>
						<button type="submit" class="btn hvr-hover">Cancel</button>
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