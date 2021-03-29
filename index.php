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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	<link href="css/font-awesome.css" rel="stylesheet"> <!-- Custom Theme files -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<!-- Custom styles for this template -->

	<!--animate-->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->
</head>
<?php include('includes/header.php'); ?>

<body>

	<div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
		<!--Indicators-->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-1z" data-slide-to="1"></li>
			<li data-target="#carousel-example-1z" data-slide-to="2"></li>
		</ol>
		<!--/.Indicators-->
		<!--Slides-->
		<div class="carousel-inner" role="listbox">
			<!--First slide-->
			<div class="carousel-item active">
				<img class="d-block w-100" src="images/30.jpg" alt="First slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>...</h1>
					<p>...</p>
				</div>
			</div>
			<!--/First slide-->
			<!--Second slide-->
			<div class="carousel-item">
				<div class="carousel-caption d-none d-md-block">
					<h1>HERITAGE</h1>
					<p>...</p>
				</div>
				<img class="d-block w-100" src="images/31.png" alt="Second slide">

			</div>
			<!--/Second slide-->
			<!--Third slide-->
			<div class="carousel-item">
				<img class="d-block w-100" src="images/M1.jpg" alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>YATRA</h1>
					<p>...</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/33.jpg" alt="Four slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>...</h1>
					<p>...</p>
				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block w-100" src="images/34.jpg" alt="Fifth slide">
				<div class="carousel-caption d-none d-md-block">
					<h5>...</h5>
					<p>...</p>
				</div>
			</div>
			<!--/Third slide-->
		</div>
		<!--/.Slides-->
		<!--Controls-->
		<a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
		<!--/.Controls-->
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
<?php
if (isset($_SESSION['msg'])) {
	echo "<script>
	Swal.fire({
	title: 'Booked Successfully',
	text: 'Enjoy your Trip',
	imageUrl: 'https://unsplash.it/400/200',
	imageWidth: 400,
	imageHeight: 200,
	imageAlt: 'Custom image',
	})</script>";
	unset($_SESSION['msg']);
}

?>
<script>
	$(document).ready(function() {
		$('#pass').keyup(function() {
			$('#result').html(checkStrength($('#pass').val()))
		})

		function checkStrength(password) {
			var strength = 0
			if (password.length < 6) {
				$('#result').removeClass()
				$('#result').addClass('short text-danger')
				return 'Too short'
			}
			if (password.length > 7) strength += 1
			// If password contains both lower and uppercase characters, increase strength value.
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1
			// If it has numbers and characters, increase strength value.
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) strength += 1
			// If it has one special character, increase strength value.
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
			// If it has two special characters, increase strength value.
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
			// Calculated strength value, we can return messages
			// If value is less than 2
			if (strength < 2) {
				$('#result').removeClass()
				$('#result').addClass('weak text-danger')
				return 'Weak'
			} else if (strength == 2) {
				$('#result').removeClass()
				$('#result').addClass('good text-primary')
				return 'Good'
			} else {
				$('#result').removeClass()
				$('#result').addClass('strong text-success')
				return 'Strong'
			}
		}
	});
</script>

</html>