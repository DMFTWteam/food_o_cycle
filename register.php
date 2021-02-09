<?php
	include 'inc/header.php';
	
?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->
	<body>
		<form class="mt-3 collapse review-form-box" id="formRegister">
		<div class="col-sm-6 col-lg-6 mb-3">
            <div class="title-left">
                <h3>Create New Account</h3>
            </div>
            <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Click here to Register</a></h5>
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
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Password</label>
                        <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                </div>
        </div>
		<div class="col-sm-6 col-lg-6 mb-3">
            <div class="form-row">
				<div class="form-group col-md-6">
                    <label for="DonorBox" class="mb-0">Donor</label>
                    <input type="checkbox" class="form-control" id="DonorBox"> </div>
                <div class="form-group col-md-6">
                    <label for="BankBox" class="mb-0">Food Bank</label>
                    <input type="checkbox" class="form-control" id="BankBox"> </div>
            </div>
        </div>
		<div class="col-sm-6 col-lg-6 mb-3">
            <div class="form-row">
				<div class="form-group col-md-6">
                    <label for="BusinesName" class="mb-0">Busines Name</label>
                    <input type="text" class="form-control" id="BusinesName" placeholder="Enter Busines Name"> </div>
                <div class="form-group col-md-6">
                    <label for="EIN" class="mb-0">Tax ID (EIN)</label>
                    <input type="text" class="form-control" id="EIN" placeholder="Enter EIN"> </div>
            </div>
			<button type="submit" class="btn hvr-hover">Create Account</button>
        </div>
		</form>
	</body>
</html>

<?php
	include 'inc/footer.php';
	include 'inc/js_to_include.php';
?>