<?php
	include 'inc/header.php';
	
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
		<form class="mt-3 review-form-box" id="formRegister">
		<div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">Contact Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
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
?>
