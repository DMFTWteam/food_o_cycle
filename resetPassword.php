<!-- COMPLETE -->

<?php
/**
 * ResetPassword.php Doc Comment
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
    $u_id = filter_input(INPUT_GET, 'u_id', FILTER_VALIDATE_INT);
    
    session_start();
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
                <form class="mt-3 review-form-box" name="formLogin" style="margin-bottom: 30%;" action='login.php'
                    method='post'>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">New Password</label>
                            <input type="password" class="form-control" name="InputPassword" minlength="8"
                                maxlength="25" id="InputPassword" placeholder="Enter Password" required>

                            <div class="invalid-feedback"> Valid password is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="ConfirmPassword" class="mb-0">Confirm Password</label>
                            <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword"
                                placeholder="Confirm Password" required>
                            <div class="invalid-feedback"> Password must be confirmed. </div>
                            <input type='hidden' name='u_id' value='<?php echo $u_id; ?>' />
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Submit</button>
                    <button href="index.php" class="btn hvr-hover">Cancel</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    var password = document.getElementById("InputPassword"),
        confirm_password = document.getElementById("ConfirmPassword");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>

</body>

</html>

    <?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>
