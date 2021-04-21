<?php

try {
    //Starting a session
    session_start();
    $errorMSG = "";
    $msgSuccess = false;
    // NAME
    if (empty($_POST["InputName"])) {
        $errorMSG = "Name is required ";
    } else {
        $name = $_POST["InputName"];
    }

    // EMAIL
    if (empty($_POST["InputEmail"])) {
        $errorMSG .= "Email is required ";
    } else {
        $email = $_POST["InputEmail"];
    }

    // MESSAGE
    if (empty($_POST["ContactMessage"])) {
        $errorMSG .= "Message is required ";
    } else {
        $message = $_POST["ContactMessage"];
    }


    $EmailTo = "giddingsra0@gmail.com";
    $Subject = "Food O' Cycle - Customer Message Received";

    // prepare email body text
    $Body = "";
    $Body .= "Name: ";
    $Body .= $name;
    $Body .= "\n";
    $Body .= "Email: ";
    $Body .= $email;
    $Body .= "\n";
    $Body .= "Message: ";
    $Body .= $message;
    $Body .= "\n";

    // send email
    // SETTING TO TRUE UNTIL SERVER IS SETUP FOR EMAIL
    $success = mail($EmailTo, $Subject, $Body, "From: {$name} <{$email}>");
    

    // redirect to success page
    if ($success && $errorMSG == "") {
        $_SESSION['msgSuccess'] = true;
        header("Location: ..\contact.php");
    } else {
        //TO DO: Create failure alerts
        if ($errorMSG == "") {
            $errorMSG = "Something went wrong :(";
            //Unsuccessful
            header("Location: ..\contact.php");
        } else {
            //Unsuccessful
            header("Location: ..\contact.php");
        }
    }
    //D
} catch(Exception $e) {
    header("Location: inc/error.php?msg=" .urlencode($e->getMessage()));
}
?>