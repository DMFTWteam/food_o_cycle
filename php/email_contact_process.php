<?php

try {
    //Starting a session
    session_start();
    $errorMSG = "";
    $msgSuccess = false;
    
    $Subject = "Food O' Cycle - Customer Message Received";
                  // Always set content-type when sending HTML email
                  $headers = "MIME-Version: 1.0" . "\r\n";
                  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
                  // More headers
                  $headers .= "From: Food O' Cycle Customer Service <cust-request@foodocycle.com>" . "\r\n";
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

    $EmailTo = "giddingsra0@gmail.com,jakewhitt21@gmail.com";

    // prepare email body text
    $Body = "<html>
                             <head>
                                 <title>
                                     Customer Service Request
                                 </title>
                             </head>
                             <h1>
                             Customer Service Request
                             </h1>
                             <p>";
    $Body .= "Name: ";
    $Body .= "<strong style='color: blue'>{$name}</strong>";
    $Body .= "<br>";
    $Body .= "Email: ";
    $Body .= "<strong style='color: blue'>{$email}</strong>";
    $Body .= "<br>";
    $Body .= "Message: ";
    $Body .= "<b>{$message}</b>";
    $Body .= "<br>";
    
    $Body .="</p>
        </html>";

    $success = mail($EmailTo, $Subject, $Body, $headers);
    

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
    header("Location: ../error.php?msg=" .urlencode($e->getMessage()));
}
?>
