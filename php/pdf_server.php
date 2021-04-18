<?php 

/**
 * Pdf_Server.php Doc Comment
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
 header("Content-Type: application/octet-stream");

    $file = $_GET["file"] .".pdf";
    header("Content-Disposition: attachment; filename=" . urlencode($file));
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Description: File Transfer");
    header("Content-Length: " . filesize($file));

    flush(); 

    $fp = fopen($file, "r");

while (!feof($fp)) {
    echo fread($fp, 65536);
    flush(); 
}

    fclose($fp);
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>
