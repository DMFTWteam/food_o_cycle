<?php

/**
 * ForgotPassword.php Doc Comment
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
    
    $user_code=filter_input(INPUT_POST, 'Code', FILTER_VALIDATE_INT);
    $user_id = filter_input(INPUT_POST, 'u_id');
    if (isset($user_code) && $user_code != '') {
        if ($user_code == $_SESSION['code']) {
            
            header("Location: https://foodocycle.com/resetPassword.php?" .urlencode("u_id=" .$user_id));
            exit();
        } else {
            echo "code is incorrect";
        }
    } else {
        
        $email=filter_input(INPUT_POST, 'InputEmail', FILTER_VALIDATE_EMAIL);
        if (isset($email) && $email != '') {
            //echo "got here";
            $query = 'SELECT u_id
                 FROM users
                 WHERE u_email = :email';
                 //echo "got here";
            $statement = $db->prepare($query);
            //echo "got here";
            $statement->bindValue(':email', $email);
            //echo "got here";
            $statement->execute();
            //echo "got here";
            $u_id = $statement->fetch();
            //echo "got here";
            $row = $statement->rowCount();
            //echo "got here";
            $statement->closeCursor();
            //echo "got here";
 
            if ($row <= 0) {
                 unset($email);
                 echo "email not found";
            } else {
                
                session_start();
                  $_SESSION['code'] = mt_rand(100000, 999999);
                  $subject = "Verification Code";
                  $message = "<html>
                             <head>
                                 <title>
                                     Food O' Cycle Password Reset Verification
                                 </title>
                             </head>
                             <h3>
                                 Your verification code for Food O' Cycle account <strong>" .$email. "</strong> is:<br>
                             </h3>
                             <h1>
                                 " .$_SESSION['code']. "
                             </h1>
                         </html>";
                  // Always set content-type when sending HTML email
                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
                  // More headers
                  $headers .= 'From: <no-reply@foodocycle.com>' . "\r\n";
 
                  mail($email, $subject, $message, $headers);
            }
        
        }
    }
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
                    <h2>Forgot Password</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="login.php">Sign In</a></li>
                        <li class="breadcrumb-item active">Forgot Password</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="container">
        <form class="mt-3 review-form-box" name="formRegister" action='forgotPassword.php' method='post'>

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
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email"
                                required>
                            <div class="invalid-feedback"> Valid email is required. </div>
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Submit</button>
                </div>
            </div>
        </form>
        <?php if (isset($email)) { ?>
        <form class="mt-3 review-form-box" name="formRegister" style="margin-bottom: 10%;" action='forgotPassword.php'
            method='post'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-left">
                        <h3>Verification Code</h3>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="Code" class="mb-0">Enter code below:</label>
                            <input type="number" minlength="6" maxlength="6" class="form-control" name="Code"
                                placeholder="Verification Code" required>
                            <div class="invalid-feedback"> Valid verification code is required. </div>
                            <input type='hidden' name='u_id' value='<?php echo (int)$u_id; ?>'>
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Submit</button>
                </div>
            </div>
        </form>
        <?php  }  ?>
    </div>
</body>

</html>

<?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>