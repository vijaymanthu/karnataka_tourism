<?php
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>

<body>
    <?php
    session_start();
    require './admin_navbar.php';
    if (!isset($_SESSION['name']))
        header('location:index.php');
    require '.././includes/db.php';
    $sql_res = mysqli_query($conn, "SELECT * FROM `feedback` ");
    $i = 1;
    ?>
    <table id="userTable" class=" table table-bordered">
        <h4 class="text-center m-3">
            Feedbacks
        </h4>
        <thead class="thead-dark">
            <th>Sl.no</th>
            <th>District Name</th>
            <th>Package Type</th>
            <th>Name</th>
            <th>Comments</th>
            <th>Email</th>
            <th>Ratings</th>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($sql_res) > 0) {
                while ($row = $sql_res->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <?php
                        $sql2  = mysqli_query($conn, "SELECT dist_name from district where id = '" . $row['d_id'] . "'");
                        $ar = $sql2->fetch_assoc();

                        ?>
                        <td><?php echo $ar['dist_name'] ?></td>
                        <td><?php echo $row['p_type'] ?></td>
                        <?php
                        $fetch_name = mysqli_query($conn, "SELECT fname,lname from register where email_id ='" . $row['user_id'] . "'");
                        $names = $fetch_name->fetch_assoc();
                        $name = $names['fname'] . " " . $names['lname'];
                        ?>
                        <td><?php echo $name ?></td>
                        <td><?php echo $row['comments'] ?></td>
                        <td><?php echo $row['user_id'] ?></td>
                        <td><?php
                            for ($i = 0; $i < $row['rating']; $i++) {
                            ?>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            <?php
                }
            } ?>
        </tbody>
    </table>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- <script>
        $(document).ready(function() {
            $('#userTable').DataTable();
        });
    </script> -->
</body>