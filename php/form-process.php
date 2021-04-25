<?php

/**
 * Form-process.php Doc Comment
 * 
 * PHP version 7.4.8
 * 
 * @category File
 * @package  Food_O_Cycle
 * @author   Adrian Camuti <cam6579@calu.edu>
 * @license  https://www.gnu.org/licenses/gpl-3.0.en.html GNU Public License v3.0
 * @link     https://github.com/DMFTWteam/food_o_cycle
 */

try {
    $errorMSG = "";

    // NAME
    if (empty($_POST["name"])) {
        $errorMSG = "Name is required ";
    } else {
        $name = $_POST["name"];
    }

    // EMAIL
    if (empty($_POST["email"])) {
        $errorMSG .= "Email is required ";
    } else {
        $email = $_POST["email"];
    }

    // Subject
    if (empty($_POST["subject"])) {
        $errorMSG .= "Subject is required ";
    } else {
        $subject = $_POST["guest"];
    }

    // MESSAGE
    if (empty($_POST["message"])) {
        $errorMSG .= "Message is required ";
    } else {
        $message = $_POST["message"];
    }


    $EmailTo = "armanmia7@gmail.com";
    $Subject = "New Message Received";

    // prepare email body text
    $Body = "";
    $Body .= "Name: ";
    $Body .= $name;
    $Body .= "\n";
    $Body .= "Email: ";
    $Body .= $email;
    $Body .= "\n";
    $Body .= "guest: ";
    $Body .= $guest;
    $Body .= "\n";
    $Body .= "event: ";
    $Body .= $event;
    $Body .= "\n";
    $Body .= "Message: ";
    $Body .= $message;
    $Body .= "\n";

    // send email
    $success = mail($EmailTo, $Subject, $Body, "From:".$email);

    // redirect to success page
    if ($success && $errorMSG == "") {
        echo "success";
    }else{
        if($errorMSG == "") {
            echo "Something went wrong :(";
        } else {
            echo $errorMSG;
        }
    }
} catch(Exception $e) {
    header("Location: ../error.php?msg=" .urlencode($e->getMessage()));
}
?>
