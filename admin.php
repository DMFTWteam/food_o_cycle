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

try {
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }
    include "inc/db_connect.php";
    include 'php/functions.php';
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
                            <?php 
                            $query = 'SELECT business_id, business_name, business_is_donor 
                            FROM business
                            ORDER BY business_name';
                        
                            $statement = $db->prepare($query);
                            $statement->execute();
                            $names = $statement->fetchAll();
                            print_r($names);
                            $statement->closeCursor();
                            $donors = array();
                            $banks = array();
                            foreach ($names as $item) {
                                if ($item['business_is_donor'] == 1) {
                                    array_push($donors, $item);
                                } else {
                                    array_push($banks, $item);
                                }
                            }
                            print_r($donors);
                            echo "<br>";
                            print_r($banks);
                            $min_num = min(count($donors), count($banks));
                            $index = 0;
                            while ($index < $min_num) {
                                echo "<tr>
                                <td>{$banks[$index]['business_name']}</td>
                                <td>{$donors[$index]['business_name']}</td>
                                </tr>";
                                $index++;
                            }
                    
                            for ($i = $index; $i < max(count($donors), count($banks)); $i++) {
                                if (max($donors, $banks) == $donors) {
                                    echo "<tr>
                                    <td></td>
                                    <td>{$donors[$i]['business_name']}</td>
                                    </tr>";
                                } else if (max($donors, $banks) == $banks) {
                                    echo "<tr>
                                    <td>{$banks[$i]['business_name']}</td>
                                    <td></td>
                                    </tr>";
                                }
                            }?>
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
    include 'inc/js_to_include.php';
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
    
?>