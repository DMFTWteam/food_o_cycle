<!-- COMPLETE -->

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
    require 'inc/header.php';

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
                    <div class="form-row" id="radiocb" onclick="cbclick(event)">
                        <div class="form-group col-md-6">
                            <label for="DonorBox" class="mb-0">Donor</label>
                            <input type="checkbox" class="form-control" name="DonorBox" id="cb1">
                            <input type="radio" class="form-control-sm" name="terms_agreement" id="terms_agreement"
                                style='display: none;'>
                            <label for="terms_agreement" class="mb-0" name="terms_agreement_label"
                                id="terms_agreement_label" style='display: none;'>I have read and agree
                                to Food O' Cycle's <a href="php/pdf_server.php?file=Terms_And_Conditions.pdf"
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
<script src="js/register.js"></script>

</html>

<?php
    require 'inc/js_to_include.php';
    require 'inc/footer.php';
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>
