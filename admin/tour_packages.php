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


</head>

<body>
    <?php
    require './admin_navbar.php';
    if (!isset($_SESSION['name']))
        header('location:index.php');
    require '.././includes/db.php';


    if (isset($_POST['add'])) {
        $target_dir = '../upload/images/';
        $pname = $_POST['pname'];
        $price = $_POST['price'];
        $file_name = $_FILES['pimages']['name'];
        $tmp_name = $_FILES['pimages']['tmp_name'];
        $desc = $_POST['description'];
        $nod = $_POST['nod'];
        $type = explode(".", $file_name);
        $type = $type[1];
        $f = false;
        $filepaths = "";
        $nop = $_POST['nop'];
        $place_name = $_POST['place_names'];
        $about = $_POST['about_places'];
        $ext = array("JPEG", "PNG", "JPG", "jpg", "png", "jpeg");
        if (in_array($type, $ext)) {
            $file_path = $target_dir . basename($file_name);
            if (move_uploaded_file($tmp_name, $file_path)) {
                $sql = "INSERT INTO `packages`(`pname`, `description`, `price`, `image`,`no_of_days`) VALUES ('$pname','$desc','$price','$file_path','$nod')";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $temp_id = mysqli_insert_id($conn);
                    $sql2 = "Select no_of_places from package_details where p_id='$temp_id'";
                    for ($i = 1; $i < 2; $i++) {
                        $file =
                            $_FILES["image$i"]['name'];
                        $tmpname =
                            $_FILES["image$i"]['tmp_name'];
                        $type = explode(".", $file);
                        $t1 = $type[1];
                        if (in_array(
                            $t1,
                            $ext
                        )) {
                            ${"file_path$i"} = $target_dir . basename("$file");
                            if (move_uploaded_file($tmpname, ${"file_path$i"})) {
                                $f = true;
                                $filepaths .= ${"file_path$i"} . ";";
                            } else {
                                $f = false;
                                break;
                            }
                        } else {
                            $f = false;
                            echo "<script>alert('Upload Only PDF XLS or DOC File Type')</script>";
                        }
                    }

                    $sql3 = "INSERT INTO `package_details`(`p_id`, `no_of_places`, `name_place`, `images`, `about_package`) VALUES ('$temp_id','$nop','$place_name','$filepaths','$about') ";
                    $result = mysqli_query($conn, $sql3);

                    if ($f && $result)
                        echo "<script>alert('Package added Successfully')</script>";
                    else
                        echo "<script>alert('Package not Added')</script>";
                } else {
                    echo mysqli_error($result);
                }
            }
        } else {
            echo '<script>alert("Please Upload only image...")</script>';
        }
    }
    ?>
    <br>
    <ul class="nav nav-tabs">
        <li class="active font-weight-bold ml-3 mr-3"><a data-toggle="tab" href="#add_places">View Package</a></li>
        <li><a class="ml-3 mr-3 font-weight-bold" data-toggle="tab" href="#add_package">Add Package</a></li>

    </ul>

    <div class="tab-content">

        <div id="add_package" class="tab-pane fade">
            <div style="vertical-align: middle" id="add_packages" class="container">
                <form method="post" enctype="multipart/form-data">
                    <div class="row row-header">
                        <div class="col col-lg-12 col-sm-6">
                            <p style="text-align:center" class="text-uppercase text-secondary h4">Add packages</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ">
                            <label for="pname" class="col-form-label ">Package Name</label>
                            <input type=" text" class="form-control" name="pname" id="pname">
                        </div>
                        <div class="col ">
                            <label for="description" class="col-form-label ">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col ">
                            <label for="pimage" class="col-form-label ">Upload Image</label>
                            <input type="file" class="form-control" required id="pimages" name="pimages">
                        </div>
                        <div class="col ">
                            <label for="price" class="col-form-label ">Price</label>
                            <input type="text" class="form-control" required id="price" name="price" id="price">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <label for="nod" class="col-form-label ">NO of days</label>
                            <input type="number" class="form-control" required id="nod" name="nod">
                        </div>

                    </div>
                    <br>

                    <div style="vertical-align: middle" class="container">

                        <div class="row">

                            <div class="col col-6">
                                <label for="nop" class="col-form-label ">Number Of Places</label>
                                <input type="number" class="form-control" required id="nop" name="nop">
                            </div>
                            <div class="col col-6">
                                <label for="nod" class="col-form-label ">Name of the Places</label>
                                <input type="text" class="form-control" required id="place_names" name="place_names">
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <label for="nop" class="col-form-label ">About Places</label>
                                    <textarea class="form-control" cols="150" required id="about_places" name="about_places"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-form-label ">Images for Respective Places</label>
                            </div>

                            <div id="imagebody">

                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-info" name="add" type="submit"> ADD </button>
                        </div>
                    </div>
                    <br>
            </div>
            </form>
        </div>
        <div id="add_places" class="tab-pane fade">
            <p style="text-align:center" class="text-uppercase text-secondary h4">Manage packages</p>
            <table class="table m-2" id="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Sl No</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Price</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sql = "SELECT * from packages";
                    $query = mysqli_query($conn, $sql);
                    //$query -> bindParam(':city', $city, PDO::PARAM_STR);


                    $cnt = 1;
                    if (mysqli_num_rows($query) > 0) {
                        while ($result = $query->fetch_assoc()) {                ?>
                            <tr>
                                <td><?php echo htmlentities($cnt); ?></td>
                                <td><?php echo htmlentities($result['pname']); ?></td>
                                <td><?php echo htmlentities($result['PackageLocation']); ?></td>
                                <td><?php echo htmlentities($result['price']); ?></td>
                                <td><?php echo htmlentities($result['description']); ?></td>
                                <td><a href="update-package.php?pid=<?php echo htmlentities($result['p_id']); ?>"><button type="button" class="btn btn-primary">View Details</button></a></td>
                            </tr>
                    <?php $cnt = $cnt + 1;
                        }
                    } ?>
                </tbody>
            </table>
        </div>


    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <script>
        $(function() {
            $('#nop').change(function() {

                var nb = $(this).val();

                var i = 1;
                var element2 = $('#imagebody').empty();
                while (i <= nb) {

                    element2.append($('<div class="col"> <input type="file" name="image' + (i) + '" id="image' + (i) + '"/></div>'));
                    i++;
                }

            });


        });
    </script>
</body>

</html>