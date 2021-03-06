<?php
require './includes/db.php';
session_start();
if (isset($_POST['change'])) {
    $email = $_SESSION['login'];
    $res = mysqli_query($conn, "select password from register where email_id = '$email'");
    while ($row = mysqli_fetch_assoc($res))
        $old_pass = $row['password'];
    $pass = $_POST['pass'];
    $entered_pass = $_POST['old_pass'];
    if ($old_pass == $entered_pass) {
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
                            <label for="text_otp">Old Password</label>
                            <input type="password" class="form-control" id="old_pass" required name="old_pass" placeholder="Enter Password">
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
                            <p class="text-danger" id="result"></p>
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
            </div>
        </div>
    </div>
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

    $(document).ready(function() {
        $('#pass').keyup(function() {
            $('#result').html(checkStrength($('#pass').val()))
        })

        function checkStrength(password) {
            var strength = 0
            if (password.length < 6) {
                $('#result').removeClass()
                $('#result').addClass('short text-danger')
                return 'Too short'
            }
            if (password.length > 7) strength += 1
            // If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
            // If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
            // If it has one special character, increase strength value.
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
            // If it has two special characters, increase strength value.
            if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
            // Calculated strength value, we can return messages
            // If value is less than 2
            if (strength < 2) {
                $('#result').removeClass()
                $('#result').addClass('weak text-danger')
                return 'Weak'
            } else if (strength == 2) {
                $('#result').removeClass()
                $('#result').addClass('good text-primary')
                return 'Good'
            } else {
                $('#result').removeClass()
                $('#result').addClass('strong text-success')
                return 'Strong'
            }
        }
    });
</script>