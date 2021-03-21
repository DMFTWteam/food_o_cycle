<!-- COMPLETE -->

<?php
	include 'inc/header.php';

    $query = 'SELECT business_id, business_name
        FROM business
        WHERE business_is_donor = 1';
    $statement = $db->prepare($query);
    $statement->execute();
    $food_donors = $statement->fetchAll();
    //print_r($food_donors);
    $statement->closeCursor();

    $query2 = 'SELECT business_id, business_name
                FROM business
                WHERE business_is_donor = 0';
    $statement2 = $db->prepare($query2);
    $statement2->execute();
    $food_banks = $statement2->fetchAll();
    //print_r($food_banks);
    $statement2->closeCursor();
    
	//include 'inc/footer.php';
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
        <form class="mt-3 review-form-box" name="formRegister" style="margin-bottom: 10%;" action="login.php"
            method="post">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" name="InputName" placeholder="First Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputLastname" class="mb-0">Last Name</label>
                            <input type="text" class="form-control" name="InputLastname" placeholder="Last Name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" name="InputPassword" placeholder="Password">
                            <input type="hidden" name="path" value="<?php echo $_SERVER['PHP_SELF']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="DonorBox" class="mb-0">Donor</label>
                            <input type="radio" class="form-control" name="Radio" id="DonorBox">
                            <input type="checkbox" class="form-control-sm" name="terms_agreement" onchange="donorSelect();">
                            <label for="terms_agreement" class="mb-0" name="terms_agreement_label">I have read and agree
                                to Food O' Cycle's <a href="php/pdf_server.php?file=Terms_And_Conditions.pdf">Terms and
                                    Conditions</a></label>
                            <script>
                            function donorSelect() {
                                var x = document.getElementsByName("terms_agreement");
                                var y = document.getElementsByName("terms_agreement_label");
                                if (x.checked) {
                                    x.style.display = "block";
                                    y.style.display = "block";
                                } else {
                                    x.style.display = "none";
                                    y.style.display = "none";
                                }
                            }
                            </script>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="BankBox" class="mb-0">Food Bank</label>
                            <input type="radio" class="form-control" name="Radio" id="BankBox">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Business" class="mb-0">Busines Name</label>
                            <select class="form-control" name='Business' placeholder="Enter Busines Name">
                                <optgroup label='Food Donors'>
                                    <?php foreach($food_donors as $business): ?>
                                    <option value='<?php echo $business['business_id']; ?>'>
                                        <?php echo $business['business_name']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                                <optgroup label='Food Banks'>
                                    <?php foreach($food_banks as $business): ?>
                                    <option value='<?php echo $business['business_id']; ?>'>
                                        <?php echo $business['business_name']; ?></option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="EIN" class="mb-0">Tax ID (EIN)</label>
                            <input type="text" class="form-control" name="EIN" placeholder="Enter EIN">
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Create Account</button>
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