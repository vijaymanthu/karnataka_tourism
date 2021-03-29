<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/login.css">

</head>

<body>
    <?php
    session_start();
    require './admin_navbar.php';
    require '.././includes/db.php';
    $sql_res = mysqli_query($conn, "SELECT * FROM `register` ");
    $i = 1;
    ?>
    <table id="userTable" class=" table table-bordered">
        <h4 class="text-center m-3">
            USER INFORMATION
        </h4>
        <thead class="thead-dark">
            <th>Sl.no</th>
            <th>Fname</th>
            <th>Lname</th>
            <th>Email</th>
            <th>Mobile</th>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($sql_res) > 0) {
                while ($row = $sql_res->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $row['fname'] ?></td>
                        <td><?php echo $row['lname'] ?></td>
                        <td><?php echo $row['email_id'] ?></td>
                        <td><?php echo $row['mobile_no'] ?></td>
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