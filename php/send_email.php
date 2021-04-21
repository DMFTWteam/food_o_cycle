<?php
    ob_start();
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);

if (isset($email) && $email != '') {
    $from_email         = 'info@foodocycle.com'; //from mail, sender email addrress
    $file = "../docs/may_newsletter.jpg";
    //Load POST data from HTML form
    $recipient_name    = $_POST["Name"]; //sender name
    $subject = "Check out the Food O' Cycle May Newsletter!";// Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  

    // Email body content 
    $htmlContent = '<h1>Hello</h1>'; 
 
    // Header for sender info 
    $headers = "From: Info - Food O' Cycle"." <".$from_email.">"; 
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
    // Preparing attachment 
    if (!empty($file) > 0) { 
        if (is_file($file)) { 
            $message .= "--{$mime_boundary}\n"; 
            $fp =    fopen($file, "rb"); 
            $data =  fread($fp, filesize($file)); 
 
            fclose($fp); 
            $data = chunk_split(base64_encode($data)); 
            $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" .  
            "Content-Description: ".basename($file)."\n" . 
            "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" .  
            "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        } 
    } 
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $from_email; 

    // Send email 
    mail($email, $subject, $message, $headers, $returnpath);
}
?>
