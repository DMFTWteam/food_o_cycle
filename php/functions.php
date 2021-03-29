<?php

/**
 * Functions.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Ryan Giddings <gid3877@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */

 require "../inc/db_connect.php";

function tableBusinessNames()
{
    $query = 'SELECT business_id, business_name, business_is_donor 
            FROM businesses
		    ORDER BY business_name';
    $statement = $db->prepare($query);
    $statement->execute();
    $businesses = $statement->fetchAll();
    $statement->closeCursor();

    $donors = array();
    $banks = array();

    foreach ($businesses as $item) {
        if ($item['business_is_donor'] === 1) {
            array_push($donors, $item);
        } else {
            array_push($banks, $item);
        }
    }

    for ($i = 0; $i < count($businesses)/2; $i++) {
        echo '<tr>
                <td><a data-filter=".businessid'.$banks[$i]['business_id'].'">'.$banks[$i]['business_name'].'</a></td>
                <td><a data-filter=".businessid'.$donors[$i]['business_id'].'">'.$donors[$i]['business_name'].'</a></td>
            </tr>';
    }
}

function tableAccessLogs($business)
{
    
}

?>
