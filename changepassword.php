<?php
require './includes/db.php';
if (isset($_POST['change'])) {
    $email = $_GET['email'];
    $res = mysqli_query($conn, "select password from register where email = '$email'");
    while ($row = mysqli_fetch_array($res)) $otp = $row['password'];
    $pass = $_POST['pass'];
    $opt_pass = $_['text_otp'];
    if ($otp == $opt_pass) {
        $res2 = mysqli_query($conn, "Update register set password = '$pass' where email_id = '$email' ");
        if ($res2) {

            echo "<script>alert('Password Changed Successfully..');
              window.location='./index.php'
              </script>";
        }
    }
}


?>

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
                <div id="change_pass">
                    <form method="post">
                        <div class="form-group">
                            <label for="text_otp">OTP</label>
                            <input type="text" class="form-control" id="text_otp" required name="text_otp" placeholder="Enter OTP">
                        </div>
                        <div class="form-group">
                            <label for="pass">New Password</label>
                            <input type="password" class="form-control" required id="pass" name="pass" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="cpass">Confirm Password</label>
                            <input type="text" class="form-control" id="cpass" required name="cpass" placeholder="">
                        </div>
                        <div class="form-group">
                            <p class="text-danger" id="msg"></p>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="change" name="change" class="btn btn-primary">Change Password</button>
                        </div>
                    </form>
                </div>
                <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
                <script src="js/jquery.slim.min.js"></script>
                <script src="js/jquery.min.js"></script>
                <script src="js/popper.min.js"></script>
                <script src="js/bootstrap.min.js"></script>
</body>

</html>

<script>
    $('#cpass').keyup(function() {
        var password = $('#pass').val();
        if (password != $(this).val()) {
            $('#msg').html("password does not match");
        } else {
            $('#msg').html("");
        }
    })
</script>