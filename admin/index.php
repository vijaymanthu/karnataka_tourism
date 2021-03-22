<?php
require '.././includes/db.php';
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $res = mysqli_query($conn, "Select * from users where email_id = '$email' and password = '$password' and utype='admin' ");
    if (mysqli_num_rows($res) > 0) {
        session_start();
        $name = "";
        while ($row = mysqli_fetch_array($res)) {
            $name = $row['name'];
        }
        if ($name != "")    $_SESSION['name'] = $name;
        header("location:./dashboard.php");
    } else {
        echo "<script>alert('Password Does not Match');
              window.location='../admin/'
              </script>";
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
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="back">


        <div class="div-center">


            <div class="content">


                <h3>Login</h3>
                <hr />
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="pass" id="pass" placeholder="Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <hr />
                    <!-- <button type="button" class="btn btn-link">Signup</button> -->
                  
                </form>

            </div>


            </span>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>