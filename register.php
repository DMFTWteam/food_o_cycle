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
                    <h2>Create Account</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Create Account</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
		<div class="container">
		<form class="mt-3 review-form-box" name="formRegister" style="margin-bottom: 10%;" action="login.php" method="post">
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
                    <div class="form-group col-md-6">
                        <label for="InputPassword1" class="mb-0">Password</label>
                        <input type="password" class="form-control" name="InputPassword" placeholder="Password">
						<input type="hidden" name="path" value="<?php echo $_SERVER['PHP_SELF']; ?>"/></div>
                </div>
        </div>
		</div>
            <div class="row">
                <div class="col-lg-12">
            <div class="form-row">
				<div class="form-group col-md-6">
                    <label for="DonorBox" class="mb-0">Donor</label>
                    <input type="checkbox" class="form-control" name="DonorBox"> </div>
                <div class="form-group col-md-6">
                    <label for="BankBox" class="mb-0">Food Bank</label>
                    <input type="checkbox" class="form-control" name="BankBox"> </div>
            </div>
        </div>
		</div>
				<div class="row">
                <div class="col-lg-12">
            <div class="form-row">
				<div class="form-group col-md-6">
                    <label for="Business" class="mb-0">Busines Name</label>
                    <select name='Business' placeholder="Enter Busines Name">
                        <optgroup label='Food Donors'>
                            <?php
                                $query = 'SELECT business_id, business_name
                                            FROM business
                                            WHERE business_is_donor = 1';
                                $statement = $db->prepare($query);
                                $statement->execute();
                                $food_donors = $statement->fetchAll();
                                $statment->closeCursor();
                                foreach($food_donors as $business){
                                    echo "<option value=".$business['business_id'].">".$business['business_name']."</option>";
                                }
                            ?>
                        </optgroup>
                        <optgroup label='Food Banks'>
                            <?php
                                $query2 = 'SELECT business_id, business_name
                                            FROM business
                                            WHERE business_is_donor = 0';
                                $statement2 = $db->prepare($query2);
                                $statement2->execute();
                                $food_banks = $statement2->fetchAll();
                                $statment2->closeCursor();
                                foreach($food_banks as $business){
                                    echo "<option value=".$business['business_id'].">".$business['business_name']."</option>";
                                }
                            ?>
                        </optgroup>
                    </select> 
                    <?php print_r($food_donors); ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="EIN" class="mb-0">Tax ID (EIN)</label>
                    <input type="text" class="form-control" name="EIN" placeholder="Enter EIN"> </div>
            </div>
			<button type="submit" class="btn hvr-hover">Create Account</button>
        </div>
		</div>
		</form>
		</div>
	</body>
	<script src="js/register.js"></script>
</html>

<?php
	include 'inc/js_to_include.php';
	include 'inc/footer.php';
?>