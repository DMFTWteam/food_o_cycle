<?php

/**
 * Register.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */

try {
    include 'inc/header.php';
    session_start();
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
            method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" name="InputName" placeholder="First Name" required>
                            <div class="invalid-feedback"> Valid first name is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputLastname" class="mb-0">Last Name</label>
                            <input type="text" class="form-control" name="InputLastname" placeholder="Last Name"
                                required>
                            <div class="invalid-feedback"> Valid last name is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="initial" class="mb-0">Middle Initial</label>
                            <input type="text" class="form-control" name="initial" placeholder="Middle Initial">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Phone" class="mb-0">Phone Number</label>
                            <input type="number" minlength='10' maxlength='11' class="form-control" name="Phone"
                                placeholder="Phone Number" required>
                            <div class="invalid-feedback"> Valid phone number is required. </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Username" class="mb-0">Username</label>
                            <input type="text" class="form-control" name="Username" placeholder="Username" required>
                            <div class="invalid-feedback"> Valid username is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email"
                                required>
                            <div class="invalid-feedback"> Valid email is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" name="InputPassword" minlength="8"
                                maxlength="25" placeholder="Password" required>
                            <div class="invalid-feedback"> Valid password is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="fileToUpload" class="mb-0">Profile Picture</label>
                            <input type="file" name="fileToUpload" id="fileToUpload">

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row" id="radiocb" onclick="cbclick(event)">
                        <div class="form-group col-md-6">
                            <label for="DonorBox" class="mb-0">Donor</label>
                            <input type="checkbox" class="form-control" name="DonorBox" id="cb1">
                            <input type="radio" class="form-control-sm" name="terms_agreement" id="terms_agreement"
                                style='display: none;'>
                            <input type='hidden' name='path' value='<?php echo $_SERVER['PHP_SELF']; ?>' />
                            <div class="invalid-feedback"> Terms and conditions must be accepted to continue. </div>
                            <label for="terms_agreement" class="mb-0" name="terms_agreement_label"
                                id="terms_agreement_label" style='display: none;'>I have read and agree
                                to Food O' Cycle's <a
                                    href="php/pdf_server.php?file=<?php echo urlencode("../docs/terms_and_conditions.pdf"); ?>"
                                    class="text-dark font-weight-bold"><u>Terms and
                                        Conditions</u></a></label>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="BankBox" class="mb-0">Food Bank</label>
                            <input type="checkbox" class="form-control" name="BankBox" id="cb2">
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Business" class="mb-0">Busines Name</label>
                            <select class="form-control" name='Business' placeholder="Select Busines Name...">
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
                            <input type="number" class="form-control" name="EIN" minlength="9" maxlength="9"
                                placeholder="Enter EIN" required>
                            <div class="invalid-feedback"> Valid EIN is required. </div>
                        </div>
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
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
