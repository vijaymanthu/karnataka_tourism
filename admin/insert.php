<?php
session_start();
if (!isset($_SESSION['name']))
    header('location:index.php');
require '.././includes/db.php';

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == "add_district") {
        $add_d = false;
        $p_type = $_POST['p_type'];
        $pr = $_POST['price'];
        $nod = $_POST['nod'];
        if ($_POST['dist_name'] == "others") {
            $dn = $_POST['text_dist_name'];
            $add_d = mysqli_query($conn, "INSERT INTO district(dist_name) VALUES('$dn')");
        }
        if ($add_d)
            $dist_id = mysqli_insert_id($conn);
        else
            $dist_id = $_POST['dist_name'];
        $add_details = mysqli_query($conn, "INSERT INTO `district_package_details`(`dist_id`, `p_type`, `price`, `no_of_days`) values('$dist_id','$p_type','$pr','$nod')");
        if ($add_details)
            $data = "success";
        //$data = array('responce' => 'success');
        else
            $data = "fail";
        // $data = array("responce" => "fail");
        echo $data;
    }



    if ($_POST['operation'] == 'fetch') {

        $fetch_dist = mysqli_query($conn, "SELECT d.dist_name,details.p_type,details.price from district d,district_package_details details where d.id=details.dist_id");
        if (mysqli_num_rows($fetch_dist) > 0)
            $data = array('responce' => 'success', 'fetch' => $fetch_dist->fetch_all());
        else
            $data = array('responce' => 'no data available');
        echo json_encode($data);
    }
}
