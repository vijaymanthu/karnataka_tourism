<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Template</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>

    <div class="back">


        <div class="div-center">


            <div class="content">


                <h3>Reset Password</h3>
                <hr />
                <form method="POST">
                    <div id="gen_otp">

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email" required placeholder="Email">
                        </div>
                        <p id="msg"></p>
                        <button type="submit" id="otp" name="otp" class="btn btn-primary">Get Otp</button>
                        <hr />

                    </div>

                </form>
            </div>


            </span>
        </div>

</body>

</html>


<?php
require "./Phpmailer/class.phpmailer.php";
require "./Phpmailer/class.smtp.php";
include './includes/db.php';
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
        //echo "sent";
    }
}
if (isset($_POST['otp'])) {
    $generator = "1357902468";
    $otp = "";

    for ($i = 1; $i <= 4; $i++) {
        $otp .= substr($generator, (rand() % (strlen($generator))), 1);
    }
    $email = $_POST['email'];
    $exist = mysqli_query($conn, "select * from register where email_id = '$email' ");
    $res = 0;
    if (mysqli_num_rows($exist) > 0) {
        $sql = "Update register set password = '$otp' where email_id = '$email'";
        $res = mysqli_query($conn, $sql);
    }
    if ($res) {
        $subject = "Karnataka Tourism Otp";
        $content = "Your Otp is : $otp";
        phpmailsend($email, $subject, $content);

        echo '<script>document.getElementById("msg").innerHTML = "Password sent to Your Email"</script>';

        echo "<script> window.location='./changepassword.php?email=$email';</script>";
    } else {
        echo "<script>alert('User Does not Exist Please register..');
              window.location='./index.php'
              </script>";
    }
}


?>