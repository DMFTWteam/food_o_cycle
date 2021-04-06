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
function tableBusinessNames()
{
    include "../inc/db_connect.php";
    $query = 'SELECT business_id, business_name, business_is_donor 
            FROM business
		    ORDER BY business_name';
    $statement = $db->prepare($query);
    $statement->execute();
    $businesses = $statement->fetchAll();
    $statement->closeCursor();
    
    print_r($businesses);
    $donors = array();
    $banks = array();
    $tableString = '';

    foreach ($businesses as $item) {
        if ($item['business_is_donor'] === 1) {
            array_push($donors, $item);
        } else {
            array_push($banks, $item);
        }
    }
    print_r($donors);
    print_r($banks);
    $min_num = min(count($donors), count($banks));
    $i = 0;
    while ($i < $min_num) {
        $tableString += '<tr>
                <td>$banks[$i][\'business_name\']</td>
                <td>$donors[$i][\'business_name\']</td>
                </tr>';
        $i++;
    }
    
    foreach (max($donors, $banks) as $item) {
        if ($item['business_is_donor'] == 1) {
            $tableString += '<tr>
                <td></td>
                <td>$item[\'business_name\']</td>
                </tr>';
        } else {
            $tableString += '<tr>
                <td>$item[\'business_name\']</td>
                <td></td>
                </tr>';
        }
    }
    echo $tableString;
    return $tableString;
}

function tableAccessLogs($business)
{
    
}

?>
