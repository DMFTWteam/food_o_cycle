<!-- COMPLETE -->

<?php
/**
 * Login.php Doc Comment
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
    include 'inc/db_connect.php';
    session_start();
    if ($_SESSION['path'] == '/register.php') {
        $first_name=filter_input(INPUT_POST, 'InputName');
        $last_name=filter_input(INPUT_POST, 'InputLastname');
        $initial=filter_input(INPUT_POST, 'initial');
        $phone=filter_input(INPUT_POST, 'Phone');
        $username=filter_input(INPUT_POST, 'Username');
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        ) {
            echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $email=filter_input(INPUT_POST, 'InputEmail', FILTER_VALIDATE_EMAIL);
        $password=filter_input(INPUT_POST, 'InputPassword');
        $donor_box=filter_input(INPUT_POST, 'DonorBox', FILTER_VALIDATE_BOOLEAN);
        $bank_box=filter_input(INPUT_POST, 'BankBox', FILTER_VALIDATE_BOOLEAN);
        $business_id=filter_input(INPUT_POST, 'Business');
        $ein=filter_input(INPUT_POST, 'EIN', FILTER_VALIDATE_INT);
        
        $query = 'INSERT INTO users
                 (u_fname, u_lname, u_mi, u_username, u_password, 
				 u_phone, u_email, u_photo, u_is_admin, u_is_standard)
              VALUES
              (:first_name, :last_name, :initial, :username, :upassword, 
              :phone, :email, LOAD_FILE(:image), \'0\', \'1\')';
        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':initial', $initial);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':phone', $phone);
        $statement->bindValue(':image', $target_file);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':upassword', password_hash($password, PASSWORD_DEFAULT));
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();

        $query2 = 'SELECT u_id
					FROM users
					WHERE u_email = :email';
        $statement2 = $db->prepare($query2);
        $statement2->bindValue(':email', $email);
        $statement2->execute();
        $u_id = $statement2->fetch();
        //var_dump((int)$u_id['u_id']);
        $statement2->closeCursor();

        $query3 = 'INSERT INTO user_to_business
                 (u_id, business_id)
              VALUES
                 (:u_id, :business_id)';
        $statement3 = $db->prepare($query3);
        $statement3->bindValue(':u_id', $u_id['u_id']);
        $statement3->bindValue(':business_id', $business_id);
        $statement3->execute();
        $statement3->closeCursor();

    } else if ($_SESSION['path'] == '/resetPassword.php') {
        $password=filter_input(INPUT_POST, 'InputPassword');
        $u_id = filter_input(INPUT_POST, 'u_id', FILTER_VALIDATE_INT);
        $query = 'UPDATE users
				SET u_password = :u_password
				WHERE u_id = :u_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':u_id', $u_id);
        $statement->bindValue(':u_password', password_hash($password, PASSWORD_DEFAULT));
        $statement->execute();
        $statement->closeCursor();
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
                    <h2>Sign In</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Sign In</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <form class="mt-3 review-form-box" name="formLogin" style="margin-bottom: 30%;"
                    action='php/account.php' method='post'>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" name="InputEmail" placeholder="Enter Email"
                                required>
                            <div class="invalid-feedback"> Valid email is required. </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" name="InputPassword" placeholder="Password">
                            <div class="invalid-feedback"> Valid password is required. </div>
                        </div>
                    </div>
                    <button type="submit" class="btn hvr-hover" name='login' value='Login'>Login</button>
                    <div>
                        <a href="register.php"><br>Create New Account</a>
                        <a href="forgotPassword.php"><br>Forgot Login Information?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<?php
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: error.php?msg=" .urlencode($e->getMessage()));
}
?>