<?php
	include 'inc/header.php';
	
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
	<body>
	<div class="container">
		<form class="mt-3 review-form-box" id="formRegister">
		
            <div class="row">
                <div class="col-lg-12">
            <div class="title-left">
                <h3>Verify Account Information</h3>
            </div>
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