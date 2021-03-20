<?php
session_start();
error_reporting(0);
include('includes/db.php');
require "./Phpmailer/class.phpmailer.php";
require "./Phpmailer/class.smtp.php";
require './files/functions.php';
if (isset($_POST['submit2'])) {
	$pid = intval($_GET['pkgid']);
	$useremail = $_SESSION['login'];
	$fromdate = $_POST['fromdate'];
	// $todate = $_POST['todate'];
	$comment = $_POST['comment'];
	$status = 0;
	$sql = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,Todate,Comment,status) VALUES('$pid','$useremail','$fromdate','','$comment','$status')";
	$lastInsertId = mysqli_query($conn, $sql);

	if ($lastInsertId) {
		$res = mysqli_query($conn, "Select * from packages where p_id = '$pid'");
		$ar = $res->fetch_assoc();
		$pname = $ar['pname'];
		$msg = "Booked Successfully";
		$subject = "Package Booked Successfully";
		$content = "<html>
		<body>
		<table>
		<tr>
		<th>Package ID </th>
		<td>$pid</td>
		</tr>
		
		<tr>
		<th>Package Name</th>
		<td>$pname</td>
		</tr>
		</table>
		</body>
		";
		phpmailsend($useremail, $subject, $content);
	} else {
		$error = "Something went wrong. Please try again";
	}
}
