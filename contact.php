<?php
	//Start the session
	session_start();
	include 'inc/header.php';

	if(isset($_SESSION)){
		if(isset($_SESSION['msgSuccess']) && $_SESSION['msgSuccess'] == True){
			$msgSuccess = True;
		}
		else {
			$msgSuccess = False;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<body>
		<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Contact</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Contact</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
		<form class="mt-3 review-form-box" action='php\email_contact_process.php' method='post'>
		<div class="container">
            <div class="row">
                <div class="col-lg-12">
				<?php if ($msgSuccess == True) {
					echo '<div class="alert alert-success" role="alert"> Message Succesfully Sent! </div>'; } 
				?>
            <div class="title-middle">
                <h3>Contact Us!</h3>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">Contact Name</label>
                        <input type="text" class="form-control" name="InputName" id="" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" name="InputEmail" id="" placeholder="Enter Email"> </div>
                </div>
				<div class="form-group">
					<label for="ContactMessage">Message</label>
					<textarea class="form-control" name="ContactMessage" id="" rows="3"></textarea>
				</div>
			<button type="submit" class="btn hvr-hover">Submit Message</button>
        </div>
		</div>
		</div>
			
		</form>
	</body>
</html>

<?php

	include 'inc/js_to_include.php';
	include 'inc/footer.php';
	session_destroy();
?>
