<?php
    $email = filter_input(INPUT_POST, 'Email', FILTER_VALIDATE_EMAIL);

if (isset($email) && $email != '') {
    $from_email         = 'info@foodocycle.com'; //from mail, sender email addrress
      
    //Load POST data from HTML form
    $recipient_name    = $_POST["Name"]; //sender name
    $size = filesize("../docs/may_newsletter.jpg");
    $mime = mime_content_type("../docs/may_newsletter.jpg");
    $subject = "Check out the Food O' Cycle May Newsletter!";
    $boundary = md5("random");
    $handle = fopen("../docs/may_newsletter", "r");  // set the file handle only for reading the file
    $content = fread($handle, $size); // reading the file
    $encoded_content = chunk_split(base64_encode($content));

    //header
    $headers = "MIME-Version: 1.0\r\n"; // Defining the MIME version
    $headers .= "From:".$from_email."\r\n"; // Sender Email
    $headers .= "Reply-To: ".$from_email."\r\n"; // Email addrress to reach back
    $headers .= "Content-Type: multipart/mixed;\r\n"; // Defining Content-Type
    $headers .= "boundary = $boundary\r\n"; //Defining the Boundary
          
    //HTML text 
    $body = "--$boundary\r\n";
    $body .= "Content-type:text/html;charset=UTF-8\r\n";
          
    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $mime; name=may_newsletter.jpg\r\n";
    $body .="Content-Disposition: attachment; filename=may_newsletter.jpg\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000, 99999)."\r\n\r\n"; 
    $body .= $encoded_content; // Attaching the encoded file with email
 
              mail($email, $subject, $body, $headers);
}

?>