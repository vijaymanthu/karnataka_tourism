<?php

session_start();
error_reporting(0);
include('includes/config.php');
include('includes/db.php');
if (strlen($_SESSION['login']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['send'])) {
        $email = $_POST['email'];
        $book_id = $_POST['book_id'];
        $comment
            = $_POST['comment'];
        $d_id
            = $_POST['d_id'];
        $p_type = $_POST['p_type'];
        $ratings
            = $_POST['rating'];
        $insert = mysqli_query($conn, "INSERT INTO `feedback`(`d_id`, `user_id`, `rating`, `comments`, `p_type`,`book_id`) VALUES('$d_id','$email','$ratings','$comment','$p_type','$book_id')");
        if ($insert) {
            $_SESSION['feedback'] = "Thank you for ur feedback";
            header('location:tour-history.php');
        } else {
            $data = array("responce" => "failure");
        }
    }
}

?>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <meta name="keywords" content="Tourism Management System In PHP" />
    <script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Custom Theme files -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--animate-->
    <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
    <script src="js/wow.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script type="text/javascript">
        $(document).ready(function() {
            $("#exampleModal").modal('show');
        });
    </script>
</head>
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="text-right cross"><a href="#" id="close"> <i class="fa fa-times mr-2"></i></a> </div>
        <div class="card-body text-center"> <img src=" https://i.imgur.com/d2dKtI7.png" height="100" width="100">
            <div class="comment-box text-center">
                <form method="post">
                    <h4>Add a comment <?php  ?></h4>
                    <input type="hidden" value="<?php echo $_POST['d_id'] ?>" id="d_id" name="d_id">
                    <input type="hidden" value="<?php echo $_POST['p_type']; ?>" id="p_type" name="p_type">
                    <input type="hidden" value="<?php echo $_POST['book_id']; ?>" name="book_id" class="booking_id">
                    <input type="hidden" value="<?php echo $_POST['email']; ?>" name="email" id="user_id">


                    <div class="rating"> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> </div>
                    <div class="comment-area"> <textarea class="form-control" name="comment" id="comment" placeholder="what is your view?" rows="4"></textarea> </div>
                    <div class="text-center mt-4"> <button name="send" type="submit" class="btn btn-success send px-5">Send message <i class="fa fa-long-arrow-right ml-1"></i></button> </div>
                </form>

            </div>
        </div>
    </div>
</div>