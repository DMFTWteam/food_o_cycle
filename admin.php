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
    
    include 'inc/js_to_include.php';
    include "inc/db_connect.php";
    include 'php/functions.php';
    include 'inc/header.php';
    ?>

<!DOCTYPE html>
<html lang="en">
<!-- Basic -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.6/jspdf.plugin.autotable.min.js"></script>

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
                                $min_num = min(count($donors), count($banks));
                                $index = 0;
                            while ($index < $min_num) {
                                echo "<tr>
                                <td><button onclick=\"filterTable({$banks[$index]['business_id']})\">{$banks[$index]['business_name']}</button></td>
                                <td><button onclick=\"filterTable({$donors[$index]['business_id']})\">{$donors[$index]['business_name']}</button></td>
                                </tr>";
                                $index++;
                            }
                    
                            for ($i = $index; $i < max(count($donors), count($banks)); $i++) {
                                if (max($donors, $banks) == $donors) {
                                    echo "<tr>
                                    <td></td>
                                    <td><button onclick=\"filterTable({$donors[$i]['business_id']})\">{$donors[$i]['business_name']}</button></td>
                                    </tr>";
                                } else if (max($donors, $banks) == $banks) {
                                    echo "<tr>
                                    <td><button onclick=\"filterTable({$banks[$index]['business_id']})\">{$banks[$i]['business_name']}</button></td>
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
                <div class="table-secondary table-responsive special-list">
                    <table class="table" id="log_table">
                        <thead>
                            <tr>
                                <th>Business Name</th>
                                <th>E-Mail Address Used</th>
                                <th>Date/Time Accessed</th>
                                <th>Successful?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                             $query2 = 'SELECT * FROM access_log
                             LEFT JOIN users ON access_log.u_id = users.u_id
                             LEFT JOIN user_to_business ON access_log.u_id = user_to_business.u_id
                             LEFT JOIN business ON user_to_business.business_id = business.business_id
                             ORDER BY log_id ASC';
                         
                             $statement2 = $db->prepare($query2);
                             $statement2->execute();
                             $logs = $statement2->fetchAll();
                             $statement2->closeCursor();
                             
                            foreach ($logs as $log) {
                                echo "<input type=\"hidden\" name=\"inputs\" value=\"{$log['business_id']}\" />";
                                echo "<tr>";
                                echo "<td>{$log['business_name']}</td>";
                                echo "<td>{$log['u_email']}</td>";
                                echo "<td>{$log['log_datetime']}</td>";
                                if ($log['log_authsuccessful'] == '1') {
                                    $successful = 'Yes';
                                } else {
                                    $successful = 'No';
                                }
                                echo "<td>{$successful}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <input type="button" class="btn hvr-hover" id="download" onclick='generate()'
                    style="margin-bottom: 10%; color: #FFFFFF;" value='Download Logs' />
            </div>
        </div>
    </div>
    <script type='text/javascript'>
    function filterTable(business_id) {
        console.log(business_id);
        // Declare variables
        var table, tr, td, i;
        table = document.getElementById("log_table");
        tr = table.getElementsByTagName("tr");
        var ids = document.querySelectorAll("input[type=hidden]");
        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];

            console.log(ids[i].value);
            if (td) {
                if (ids[i].value + 1 == business_id) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }


    function generate() {
        var doc = new jsPDF();
        doc.autoTable({
            html: '#log_table',
            styles: {
                halign: 'center',
                theme: 'grid'
            }
        });
        doc.save('access_logs.pdf');
    }
    </script>

</body>

</html>

<?php
    include 'inc/footer.php';
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
    
?>