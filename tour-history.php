<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/db.php');
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['bkid'])) {
		$bid = intval($_GET['bkid']);
		$email = $_SESSION['login'];
		$sql = "SELECT FromDate FROM tblbooking WHERE UserEmail=:email and BookingId=:bid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':bid', $bid, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			foreach ($results as $result) {
				$fdate = $result->FromDate;

				$a = explode("/", $fdate);
				$val = array_reverse($a);
				$mydate = implode("/", $val);
				$cdate = date('Y/m/d');
				$date1 = date_create("$cdate");
				$date2 = date_create("$fdate");
				$diff = date_diff($date1, $date2);
				echo $df = $diff->format("%a");
				if ($df > 1) {
					$status = 2;
					$cancelby = 'u';
					$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE UserEmail=:email and BookingId=:bid";
					$query = $dbh->prepare($sql);
					$query->bindParam(':status', $status, PDO::PARAM_STR);
					$query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
					$query->bindParam(':email', $email, PDO::PARAM_STR);
					$query->bindParam(':bid', $bid, PDO::PARAM_STR);
					$query->execute();

					$msg = "Booking Cancelled successfully";
				} else {
					$error = "You can't cancel booking before 24 hours";
				}
			}
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>TMS | Tourism Management System</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
		<script>
			new WOW().init();
		</script>

		<style>
			.errorWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #dd3d36;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}

			.succWrap {
				padding: 10px;
				margin: 0 0 20px 0;
				background: #fff;
				border-left: 4px solid #5cb85c;
				-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
				box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			}
		</style>
	</head>

	<body>
		<?php
		if (isset($_SESSION['feedback'])) {
			echo "<script>
		Swal.fire('" . $_SESSION['feedback'] . "');
		</script>";
			unset($_SESSION['feedback']);
		}
		?>
		<!-- top-header -->
		<div class="top-header">
			<?php include('includes/header.php'); ?>

			<!--- /banner-1 ---->
			<!--- privacy ---->
			<div class="privacy">
				<div class="container">
					<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">My Tour History</h3>
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
					<?php
					$email = $_SESSION['login'];
					$c = 1;
					$sql = "SELECT * FROM tblbooking b,packages p,district d,district_package_details det where d.id=det.dist_id and p.district_id = d.id and b.District_Id = p.district_id and b.UserEmail='$email' and det.p_type = p.ptype and b.p_id = p.p_id";
					$booking_fetch = mysqli_query($conn, $sql);
					if (mysqli_num_rows($booking_fetch) > 0) {
					?>
						<table class="table">
							<thead>

								<th>#</th>
								<th>Booking Id</th>
								<th>District Name</th>
								<th>Package Type</th>
								<th>Trip Date</th>
								<th>Status</th>
								<th>Price</th>
								<th>No of Days</th>
								<th>Feedback</th>
							</thead>
							<tbody>

								<?php
								$temp = "";
								while ($row = $booking_fetch->fetch_assoc()) {
									$d = $row['district_id'];

								?>
									<form method="post" action="feedback.php">
										<input type="hidden" value="<?php echo $d ?>" id="d_id" name="d_id">
										<input type="hidden" value="<?php echo htmlentities($row['p_type']) ?>" id="p_type" name="p_type">
										<input type="hidden" value="<?php echo htmlentities($row['BookingId']) ?>" name="book_id" id="booking_id">
										<input type="hidden" value="<?php echo $email ?>" name="email" id="user_id">
										<tr>
											<td><?php echo $c++ ?></td>

											<td><?php $temp = htmlentities($row['BookingId']);
												echo $temp ?></td>
											<td><?php
												// $dstname = mysqli_query($conn, "SELECT * from district where id='$d'");
												//$fd = $dstname->fetch_assoc();
												echo $row['dist_name'];
												?></td>
											<td><?php echo htmlentities($row['p_type']) ?></td>
											<td><?php echo htmlentities($row['TripDate']) ?></td>
											<td><?php echo htmlentities($row['status']) ?></td>
											<?php
											?><td><?php echo htmlentities($row['price']) ?></td>
											<td><?php echo htmlentities($row['no_of_days']) ?></td>
											<!-- <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
											<td><button class="btn btn-outline-primary btn-sm" type="submit"><i class="far fa-comment fa-2x"></i>Review</button></td>

				</div>
				</tr>
				</form>
				<!-- <td><a href="" class="btn btn-danger">Cancel Booking</a></td> -->
			<?php

								}


			?>
			</tbody>
			</table>
		<?php

					} else {
						echo "<p>No Booking Available</p>";
					}
		?>
			</div>
		</div>
		<script>
			$(document).on('click', '#close', function(e) {

				$('#form').modal('hide');
			});
			$(document).on('click', '#send', function(e) {
				e.preventDefault();
				var $el = $(this).closest('tr');
				var d_id = $('#d_id').val();
				var p_type = $('#p_type').val();
				var rate = $("input[name='rating']:checked").val();
				var comment = $('#comment').val();
				var email = $('#user_id').val();
				var booking_id = $('.booking_id').val();
				console.log(booking_id);
				$('#form').modal('hide');
				// $.ajax({
				// 	url: 'feedback.php',
				// 	type: 'post',
				// 	dataType: 'json',
				// 	data: {
				// 		d_id: d_id,
				// 		p_type: p_type,
				// 		rating: rate,
				// 		comment: comment,
				// 		book_id: booking_id,
				// 		email: email

				// 	},
				// 	success: function(data) {
				// 		if (data['responce'] == "success") {
				// 			console.log("success");
				// 		}
				// 	}
				// })


			})
		</script>
		<!--- /privacy ---->
		<!--- footer-top ---->
		<!--- /footer-top ---->
		<?php include('includes/footer.php'); ?>
		<!-- signup -->
		<?php include('includes/signup.php'); ?>
		<!-- //signu -->
		<!-- signin -->
		<?php include('includes/signin.php'); ?>
		<!-- //signin -->
		<!-- write us -->
		<?php include('includes/write-us.php'); ?>
	</body>

	</html>
<?php } ?>