<?php
	include 'inc/header.php';
	
?>

<!DOCTYPE html>
<html lang="en">
	<body>
	<div class="col-sm-6 col-lg-6 mb-3"></div>
		<form class="mt-3 review-form-box" id="formRegister">
		<div class="Center col-sm-6 col-lg-6 mb-3">
            <div class="title-middle">
                <h3>Contact Us!</h3>
            </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="InputName" class="mb-0">Contact Name</label>
                        <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                    <div class="form-group col-md-6">
                        <label for="InputEmail1" class="mb-0">Email Address</label>
                        <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                </div>
        </div>
			<button type="submit" class="btn hvr-hover">Submit Message</button>
        </div>
		</form>
	</body>
</html>

<?php

	include 'inc/js_to_include.php';
	include 'inc/footer.php';
?>