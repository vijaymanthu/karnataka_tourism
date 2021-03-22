<?php
include './booked_insert.php';


?>


<!DOCTYPE HTML>
<html>

<head>
	<title>Package Details</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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
	<link rel="stylesheet" href="css/jquery-ui.css" />

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<script>
		new WOW().init();
	</script>
	<style>
		#gridview {
			text-align: center;
		}

		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}

		.heading {
			padding: 10px 10px;
			border-radius: 2px;
			color: #FFF;
			background: #6aadf1;
			margin-bottom: 10px;
			font-size: 1.5em;
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
	<!-- top-header -->
	<?php include('includes/header.php'); ?>
	<div class="banner-3">
		<div class="container">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Karnataka Tourism-Package Details</h1>
		</div>
	</div>
	<!--- /banner ---->
	<!--- selectroom ---->

	<div class="selectroom">
		<div class="container">
			<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
			<?php
			$pid = intval($_GET['pkgid']);
			$ptype = $_GET['ptype'];
			$sql = "SELECT p.* from packages p where p.p_id ='$pid'";
			$query = mysqli_query($conn, $sql);
			$cnt = 1;

			if (mysqli_num_rows($query) > 0) {
				while ($result = $query->fetch_assoc()) {	?>
					<div class="row">
						<div class="col-md-12 mb-3 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
							<h2 class="text-center"><?php echo htmlentities($result['pname']); ?></h2>
						</div>
					</div>
					<div class="selectroom_top">
						<?php
						$image_fetch = mysqli_query($conn, "SELECT image  from images where p_id='$pid'");
						while ($row = $image_fetch->fetch_assoc()) {
						?><div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
								<?php
								$imagepath = "uploads/images/$ptype/" . $row['image'] . "";

								?><img src="<?php echo $imagepath ?> ?>" class="img-responsive" alt="">
							</div>
						<?php
						}
						?>

						<p style="padding-top: 1%"><?php echo htmlentities($result['about_packages']); ?> </p>
						<div class="clearfix"></div>
					</div>
					<div id="gridview">
						<div class="heading">Image Gallery</div>
					</div>
					</form>
			<?php }
			} ?>


		</div>
	</div>
	<!--- /selectroom ---->
	<<!--- /footer-top ---->
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