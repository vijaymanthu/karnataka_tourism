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
    session_start();
    require './admin_navbar.php';
    if (!isset($_SESSION['name']))
        header('location:index.php');
    require '.././includes/db.php';


    if (isset($_POST['add'])) {

        $pname = $_POST['pname'];
        $dist = $_POST['dist'];
        if (isset($_POST['district'])) $distname = $_POST['district'];
        $price = "";
        // $file_name = $_FILES['pimages']['name'];
        // $tmp_name = $_FILES['pimages']['tmp_name'];
        $desc = $_POST['description'];
        $nod = "";
        $ptype = $_POST['packageType'];

        if (!file_exists(".././uploads/images/$ptype")) {
            mkdir(".././uploads/images/$ptype", 0755, true);
        }
        $target_dir = ".././uploads/images/$ptype/";
        // $type = explode(".", $file_name);
        // $type = $type[1];
        $f = false;
        $filepaths = "";
        $nop = $_POST['nop'];
        $place_name = "";
        $about = $_POST['about_places'];
        $ext = array("JPEG", "PNG", "JPG", "jpg", "png", "jpeg");
        if (true) {
            // $file_path = $target_dir . basename($file_name);
            if (true) {
                $check_district_available = mysqli_query($conn, "SELECT * from district where id = '$dist'");
                if (!mysqli_num_rows($check_district_available) > 0) {
                    $insert_dist = mysqli_query($conn, "Insert into district(dist_name) values ('$distname')");
                }

                $sql = "INSERT INTO `packages`(`pname`, `description`, `price`,`no_of_days`,`district_id`,`ptype`,`about`) VALUES ('$pname','$desc','$price','$nod','$dist','$ptype','$about')";
                $res = mysqli_query($conn, $sql);
                if ($res) {
                    $temp_id = mysqli_insert_id($conn);
                    for ($i = 1; $i <= $nop; $i++) {
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
                            $file_path = $target_dir . basename("$file");
                            if (move_uploaded_file($tmpname, $file_path)) {
                                $f = true;
                                $image_name = basename("$file");
                                $insert_image = mysqli_query($conn, "Insert into images(p_id,image) values('$temp_id','$image_name')");
                            } else {
                                $f = false;
                                break;
                            }
                        } else {
                            $f = false;
                            echo "<script>alert('Upload Only PDF XLS or DOC File Type')</script>";
                        }
                    }


                    if ($f)
                        echo "<script>alert('Package added Successfully')</script>";
                    else
                        echo "<script>alert('Package not Added')</script>";
                } else {
                    echo mysqli_error($res);
                }
            }
        } else {
            echo '<script>alert("Please Upload only image...")</script>';
        }
    }
    ?>
    <br>
    <ul class="nav nav-tabs">
        <li class="active font-weight-bold ml-3 mr-3"><a data-toggle="tab" href="#add_places">View Places</a></li>
        <li><a class="ml-3 mr-3 font-weight-bold" data-toggle="tab" href="#add_package">Add Places</a></li>
        <li><a class="ml-3 mr-3 font-weight-bold" data-toggle="tab" href="#add_dist">Add District</a></li>
    </ul>

    <div class="tab-content">

        <div id="add_dist" class="tab-pane fade">
            <div class="container m-5">
                <div class="row">
                    <div class="col-sm-3 col-md-6 col-lg-4">
                        <div class=" container">
                            <div class="row row-header">
                                <div class="col col-lg-12 col-sm-6">
                                    <p style="text-align:center" class="text-uppercase text-secondary h4">Districts Added</p>
                                </div>
                            </div>
                            <ol style="height: 250px; overflow-y: scroll;">
                                <div id="dist_list"></div>

                            </ol>
                        </div>
                    </div>
                    <div class="ml-5 col-sm-9 col-md-5 col-lg-5">
                        <form id="add_dist_form">
                            <div class="row row-header">
                                <div class="col col-lg-12 col-sm-6">
                                    <p style="text-align:center" class="text-uppercase text-secondary h4">Add District</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col ">
                                    <label for="dist_name" class="col-form-label "> District Name</label>
                                    <select class="form-control" required name="dist_name" id="dist_name">
                                        <option value="" selected>SELECT District</option>
                                        <?php
                                        $dist = mysqli_query($conn, "SELECT * from district");
                                        if (mysqli_num_rows($dist) > 0) {
                                            while ($row = $dist->fetch_assoc()) {
                                        ?><option value="<?php echo $row['id'] ?>"><?php echo $row['dist_name'] ?></option>

                                        <?php

                                            }
                                        } ?>
                                        <option value="others">Others</option>
                                    </select>
                                    <div class="col">
                                        <input type="text" class="form-control " hidden name="text_dist_name" id="text_dist_name">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="p_type" class="col-form-label ">Package Type</label>
                                    <select class="form-control" required id="p_type" name="p_type">
                                        <option value="" selected>SELECT District</option>
                                        <option value="Heritage">Heritage</option>
                                        <option value="Yatra">Yatra</option>
                                        <option value="Treking">Treking</option>
                                        <option value="Picnic">Picnic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ">
                                    <label for="p_price" class="col-form-label "> Price</label>
                                    <input type=" text" class="form-control" name="p_price" id="p_price">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ">
                                    <label for="nod" class="col-form-label "> No of Days</label>
                                    <input type="number" class="form-control" name="nod" id="nod">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ">
                                    <p id="msg"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col ">
                                    <button name="add_district" id="add_district" class="btn btn-primary">ADD DISTRICT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <div id="add_package" class="tab-pane fade">
            <div style="vertical-align: middle" id="add_packages" class="container">
                <!-- <ul class="nav nav-tabs">
                    <li class="active font-weight-bold ml-3 mr-3"><a data-toggle="tab" href="#heritage">Heritage</a></li>
                    <li><a class="ml-3 mr-3 font-weight-bold" data-toggle="tab" href="#yatra">Yatra</a></li>
                    <li> <a class="ml-3 mr-3 font-weight-bold" data-toggle="tab" href="#picnic">trekking</a></li>

                </ul> -->

                <form method="post" enctype="multipart/form-data">
                    <div class="row row-header">
                        <div class="col col-lg-12 col-sm-6">
                            <p style="text-align:center" class="text-uppercase text-secondary h4">Add Places</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-6">
                            <label for="dist" class="col-form-label ">District</label>
                            <select class="form-control" required id="dist" name="dist">
                                <option value="" selected>SELECT District</option>
                                <?php
                                $dist = mysqli_query($conn, "SELECT * from district");
                                if (mysqli_num_rows($dist) > 0) {
                                    while ($row = $dist->fetch_assoc()) {
                                ?><option value="<?php echo $row['id'] ?>"><?php echo $row['dist_name'] ?></option>

                                <?php

                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col ">
                            <label for="pname" class="col-form-label ">Place Name</label>
                            <input type=" text" class="form-control" name="pname" id="pname">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col ">
                            <label for="description" class="col-form-label ">Description</label>
                            <input type="text" class="form-control" name="description" id="description">
                        </div>

                        <div class="col col-6">
                            <label for="packageType" class="col-form-label ">Package Type</label>
                            <select class="form-control" required id="packageType" name="packageType">
                                <option value="" selected>SELECT District</option>
                                <option value="Heritage">Heritage</option>
                                <option value="Yatra">Yatra</option>
                                <option value="Treking">Treking</option>
                                <option value="Picnic">Picnic</option>
                            </select>
                        </div>
                    </div>
                    <br>

                    <div style="vertical-align: middle" class="container">

                        <div class="row">

                            <div class="col col-6">
                                <label for="nop" class="col-form-label ">Number Of Images</label>
                                <input type="number" class="form-control" required id="nop" name="nop">
                            </div>
                            <div class="col col-6">
                                <label for="nop" class="col-form-label ">About Places</label>
                                <textarea class="form-control" cols="150" required id="about_places" name="about_places"></textarea>
                            </div>
                            <div class="row">
                                <div class="col col-12">
                                    <label class="col-form-label ">Images for Respective Places</label>
                                </div>
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
            <div class="table-responsive">
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


    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(function() {
            $('#dist_name').change(function() {
                if ($(this).val() == "others") {
                    $('#text_dist_name').prop('hidden', false)
                } else {
                    $('#text_dist_name').prop('hidden', true)
                }
            });
            $('#district').prop("disabled", true);
            $('#nop').change(function() {

                var nb = $(this).val();

                var i = 1;
                var element2 = $('#imagebody').empty();
                while (i <= nb) {

                    element2.append($('<div class="col"> <input type="file" name="image' + (i) + '" id="image' + (i) + '"/></div>'));
                    i++;
                }

            });
            $('#dist').change(function() {

                if (this.value == 'others') {
                    $('#district').prop("disabled", false);
                } else {
                    $('#district').prop("disabled", true);
                }
            });

            function fetch_district() {
                $.ajax({
                    url: "insert.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        operation: "fetch"
                    },
                    success: function(data) {
                        if (data.responce == 'success')
                            console.log(data.fetch);
                        var dist_body = "";
                        var i = 0;
                        for (var k in data.fetch) {
                            dist_body += "<li class='h6 text-uppercase'>" + data.fetch[i++] + "</li>";
                        }
                        $('#dist_list').html(dist_body);
                    }
                });

            }


            $(document).on("click", "#add_district", function(e) {
                e.preventDefault();
                var dist_name = $('#dist_name').val();
                var p_type = $('#p_type').val();
                var price = $('#p_price').val();
                var nod = $('#nod').val();
                var text_dist_name = $('#text_dist_name').val();
                console.log(text_dist_name);
                console.log(dist_name + p_type)
                if (dist_name != "" ||
                    p_type != "" ||
                    price != "") {
                    $.ajax({
                        url: "insert.php",
                        type: "post",
                        data: {
                            operation: "add_district",
                            dist_name: dist_name,
                            price: price,
                            p_type: p_type,
                            nod: nod,
                            text_dist_name: text_dist_name

                        },
                        success: function(data) {
                            console.log(data);
                            fetch_district();
                            if (data == 'success') {
                                // console.log("inser");
                                Swal.fire(
                                    '',
                                    'District Added',
                                    'success'
                                )
                            }
                        }
                    });
                } else {
                    $('#msg').empty();
                    $('#msg').append("<h6 class='text-danger'>*all feilds are required</h6>");
                }
                $('#add_dist_form')[0].reset();
            });
            fetch_district();
        });
    </script>
</body>

</html>