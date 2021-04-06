<?php

/**
 * Admin.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */
    session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
    
    require 'inc/header.php';

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
                    <h2>Welcome <?php echo $_SESSION['user']['u_fname']; ?>!</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Administration</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Food Banks</th>
                                <th>Food Donors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="#">Sample Food Bank #1</a></td>
                                <td><a href="#">Sample Food Donor #1</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">Sample Food Bank #2</a></td>
                                <td><a href="#">Sample Food Donor #2</a></td>
                            </tr>
                            <tr>
                                <td><a href="#">Sample Food Bank #3</a></td>
                                <td><a href="#">Sample Food Donor #3</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-main table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>E-Mail</th>
                                <th>Date/Time Accessed</th>
                                <th>Successful?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                            </tr>
                            <tr>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                            </tr>
                            <tr>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn hvr-hover" style="margin-bottom: 10%;">Download Logs</button>
            </div>
        </div>
    </div>

</body>

</html>

<?php
    require 'inc/js_to_include.php';
    require 'inc/footer.php';
    
?>
