<?php

if($_POST && isset($_FILES['exampleInputFile']))
{

    $from_email = $_POST['email1']; //sender email
    $recipient_email = 'temmyrelf@yahoo.com'; //recipient email
    $subject = $_POST['subject1']; //subject of email
    $message =  $_POST['editor1']; //message body

    //get file details we need
    $file_tmp_name    = $_FILES['exampleInputFile']['tmp_name'];
    $file_name        = $_FILES['exampleInputFile']['name'];
    $file_size        = $_FILES['exampleInputFile']['size'];
    $file_type        = $_FILES['exampleInputFile']['type'];
    $file_error       = $_FILES['exampleInputFile']['error'];

    $user_email = filter_var($_POST["email1"], FILTER_SANITIZE_EMAIL);

    if($file_error>0)
    {
        die('upload error');
    }
    //read from the uploaded file & base64_encode content for the mail
    $handle = fopen($file_tmp_name, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $encoded_content = chunk_split(base64_encode($content));


    $boundary = md5("sanwebe");
    //header
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "From:".$from_email."\r\n";
    $headers .= "Reply-To: ".$user_email."" . "\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n";
    $headers .= 'From: '.$from_email."\r\n".

        $headers .='Reply-To: '.$from_email."\r\n" .

            $headers .='X-Mailer: PHP/' . phpversion();


    //plain text
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
    $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
    $body .= chunk_split(base64_encode($message));

    //attachment
    $body .= "--$boundary\r\n";
    $body .="Content-Type: $file_type; name=\"$file_name\"\r\n";
    $body .="Content-Disposition: attachment; filename=\"$file_name\"\r\n";
    $body .="Content-Transfer-Encoding: base64\r\n";
    $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n";
    $body .= $encoded_content;

    function died($error) {

        // your error code can go here

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";

        echo "These errors appear below.<br /><br />";

        echo $error."<br /><br />";

        echo "Please go back and fix these errors.<br /><br />";

        die();

    }



    // validation expected data exists

    if(!isset($_POST['subject1']) ||

        !isset($_POST['editor1'])||

        !isset($_POST['email1'])) {

        died('We are sorry, but there appears to be a problem with the form you submitted.');

    }


    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

    if(!preg_match($email_exp,$from_email)) {

        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';

    }

    if(strlen($message) < 2) {

        $error_message .= 'The message you entered do not appear to be valid.<br />';

    }

    if(strlen($subject) < 2) {

        $error_message .= 'The subject you entered do not appear to be valid.<br />';

    }

    $sentMail = @mail($recipient_email, $subject, $body, $headers);
    if($sentMail) //output success or failure messages
    {

        die('Thank you for your email');
    }else{
        die('Could not send mail! Please check your PHP mail configuration.');
    }

}
?>



    <!-- include your own success html here -->


    Thank you for contacting us. We will be in touch with you very soon.



<?php



?>