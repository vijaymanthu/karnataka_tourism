<?php
require '.././includes/db.php';
$pid=$_GET['pid'];
$dlt = mysqli_query($conn,"DELETE from packages where p_id = '$pid'");
if($dlt)
header('location:tour-packages.php');
