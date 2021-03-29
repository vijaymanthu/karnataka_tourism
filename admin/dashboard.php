<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        #submenu:hover {
            background-color: blue;
            color: white;
        }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tourism Admin Panel</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href=".././vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <script type="application/x-javascript">
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/morris.css" type="text/css" />
    <!-- Graph CSS -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery-2.1.4.min.js"></script>
    <!-- //jQuery -->
    <link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- lined-icons -->
    <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- //lined-icons -->
</head>

<body>
    <?php
    session_start();
    require './admin_navbar.php' ?>
    <?php
    require '.././includes/db.php';
    require '.././includes/config.php';
    $name = $_SESSION['name'];


    ?>

    <div id="head">

        <p style="text-align:center ;text-decoration:underline" class="h3 text-dark font-weight-bold"> ADMIN PANEL</p>
    </div>

    <div id="Bodycontent" class="container-fluid">

        <div class="four-grids">
            <div class="col-md-3 four-grid">
                <div class="four-agileits">
                    <div class="icon">
                        <i class="glyphicon glyphicon-user" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>User</h3>

                        <?php $sql = "SELECT id from register";
                        $query = $dbh->prepare($sql);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = $query->rowCount();
                        ?> <h4> <?php echo htmlentities($cnt); ?> </h4>


                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-agileinfo">
                    <div class="icon">
                        <i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Bookings</h3>
                        <?php $sql1 = "SELECT BookingId from tblbooking";
                        $query1 = $dbh->prepare($sql1);
                        $query1->execute();
                        $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                        $cnt1 = $query1->rowCount();
                        ?>
                        <h4><?php echo htmlentities($cnt1); ?></h4>

                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-w3ls">
                    <div class="icon">
                        <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Enquiries</h3>
                        <?php $sql2 = "SELECT id from tblenquiry";
                        $query2 = $dbh->prepare($sql2);
                        $query2->execute();
                        $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
                        $cnt2 = $query2->rowCount();
                        ?>
                        <h4><?php echo htmlentities($cnt2); ?></h4>

                    </div>

                </div>
            </div>
            <div class="col-md-3 four-grid">
                <div class="four-wthree">
                    <div class="icon">
                        <i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>Toatal packages</h3>
                        <?php $sql3 = "SELECT p_id from packages";
                        $query3 = $dbh->prepare($sql3);
                        $query3->execute();
                        $results3 = $query3->fetchAll(PDO::FETCH_OBJ);
                        $cnt3 = $query3->rowCount();
                        ?>
                        <h4><?php echo htmlentities($cnt3); ?></h4>

                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="four-grids">
            <div class="col-md-3 four-grid">
                <div class="four-w3ls">
                    <div class="icon">
                        <i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
                    </div>
                    <div class="four-text">
                        <h3>feedbacks</h3>
                        <?php $sql5 = "SELECT id from feedback";
                        $query5 = $dbh->prepare($sql5);
                        $query5->execute();
                        $results5 = $query5->fetchAll(PDO::FETCH_OBJ);
                        $cnt5 = $query5->rowCount();
                        ?>
                        <h4><?php echo htmlentities($cnt5); ?></h4>

                    </div>

                </div>
            </div>


            <div class="clearfix"></div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>