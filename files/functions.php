<?php

function phpmailsend($to, $subject, $content)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com'; //
    $mail->SMTPAuth = TRUE;
    $mail->Username = "karnatakatourism20@gmail.com";
    $mail->Password = "karnatakatourism";
    $mail->SMTPSecure = 'ssl'; // tls or ssl 
    $mail->Port     = "465"; //465

    $mail->SMTPDebug = 0;
    $mail->SetFrom('karnatakatourism20@gmail.com', "Karnatak Tourism");

    $mail->AddAddress($to); //we can add here multiple email 

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $content;


    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        return true;
    }
}
?>