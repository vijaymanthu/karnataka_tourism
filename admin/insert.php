<?php
session_start();
if (!isset($_SESSION['name']))
    header('location:index.php');
require '.././includes/db.php';

if (isset($_POST['operation'])) {
    if ($_POST['operation'] == "add_district") {
        $dn = $_POST['dist_name'];
        $p_type = $_POST['p_type'];
        $pr = $_POST['price'];
        $add_d = mysqli_query($conn, "INSERT INTO district(dist_name,p_type,price) VALUES('$dn','$p_type','$pr')");
        if ($add_d) $data = "success";
        //$data = array('responce' => 'success');
        else
            $data = "fail";
        // $data = array("responce" => "fail");
        echo $data;
    }



    if ($_POST['operation'] == 'fetch') {

        $fetch_dist = mysqli_query($conn, "SELECT dist_name,p_type,price from district");
        if (mysqli_num_rows($fetch_dist) > 0)
            $data = array('responce' => 'success', 'fetch' => $fetch_dist->fetch_all());
        else
            $data = array('responce' => 'no data available');
        echo json_encode($data);
    }
}
