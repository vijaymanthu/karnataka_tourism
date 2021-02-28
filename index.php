<?php
session_start();
error_reporting(0);
include('includes/db.php');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Karnataka Tourism</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.css" rel="stylesheet"> <!-- Custom Theme files -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<!-- Custom styles for this template -->

	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->
</head>

<body>
	<?php include('includes/header.php'); ?>
	<div class="banner">
		<div class="container">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> Karnatak Tourism </h1>
		</div>
	</div>







	<!---holiday---->
	<div class="container">
		<div class="holiday">





			<h3>Package List</h3>


			<?php $sql = "SELECT * from packages order by rand() limit 4";
			$query = mysqli_query($conn, $sql);
			// $query->execute();

			$cnt = 1;
			if (mysqli_num_rows($query) > 0) {
				while ($result = $query->fetch_assoc()) {	?>
					<div class="rom-btm">
						<div class="col-md-3 room-left wow fadeInLeft animated" data-wow-delay=".5s">
							<img src="<?php
										$arr = explode("../", htmlentities($result['image']));
										$imagepath = $arr[1];

										echo $imagepath ?>" class="img-responsive" alt="">
						</div>
						<div class="col-md-6 room-midle wow fadeInUp animated" data-wow-delay=".5s">
							<h4>Package Name: <?php echo htmlentities($result['pname']); ?></h4>
							<!-- <h6>Package Type : <?php echo htmlentities($result['PackageType']); ?></h6> -->
							<p><b>Package Location :</b> <?php echo htmlentities($result['PackageLocation']); ?></p>
							<p><b>Package Description :</b> <?php echo htmlentities($result['description']); ?></p>
							<!-- <p><b>Features</b> <?php echo htmlentities($result['ackageFetures']); ?></p> -->
						</div>
						<div class="col-md-3 room-right wow fadeInRight animated" data-wow-delay=".5s">
							<h5>Rupees <?php echo htmlentities($result['price']); ?></h5>
							<a href="package-details.php?pkgid=<?php echo htmlentities($result['p_id']); ?>" class="view">Details</a>
						</div>
						<div class="clearfix"></div>
					</div>

			<?php }
			} ?>


			<div><a href="package-list.php" class="view">View More Packages</a></div>
		</div>
		<div class="clearfix"></div>
	</div>




	<?php include('includes/footer.php'); ?>
	<!-- signup -->
	<?php include('includes/signup.php'); ?>
	<!-- //signu -->
	<!-- signin -->
	<?php include('includes/signin.php'); ?>
	<!-- //signin -->
	<!-- write us -->
	<?php include('includes/write-us.php'); ?>
	<!-- //write us -->
</body>

</html>