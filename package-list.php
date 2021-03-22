<?php
session_start();
error_reporting(0);
include('includes/db.php');
?>
<!DOCTYPE HTML>
<html>

<head>
	<title>Package List</title>
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
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->
	<style>
		h3 a {
			font-family: 'Times New Roman', Times, serif;
			color: #4CB320;
			margin: 5px;
		}
	</style>
</head>

<body>
	<?php include('includes/header.php'); ?>

	<!--- rooms ---->
	<div class="rooms">
		<div class="container">
			<div class="room-bottom">
				<label class="text-success h3" for="district">District</label>
				<select class="form-control" style="margin-bottom: 30px;" name="district" id="district">
					<option value="" selected>SELECT District</option>
					<?php
					$fetch_dst = mysqli_query($conn, "SELECT * FROM district");
					while ($row = $fetch_dst->fetch_assoc()) {
					?>
						<option value="<?php echo $row['id'] ?>"><?php echo $row['dist_name'] ?></option>
					<?php
					}
					?>
				</select>
				<div id="menu">
					<h3><a href="#" id="heritagepackage">Heritage Places</a>
						<a href="#" id="pinicpackages">Picnic Places</a>
						<a href="#" id="yatrapackage">Yatra Places</a>
						<a href="#" id="Trekingpackage">Treking Places</a>
					</h3>
				</div>
				<div id="placebody"></div>


			</div>
		</div>
	</div>
	<!--- /rooms ---->

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
	<!-- //write us -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(function() {
			var dist_id = "";
			$('#menu').prop('hidden', true);
			$('#placebody').prop('hidden', true);
			$('#district').change(function() {
				$('#menu').prop('hidden', false);
				$('#placebody').prop('hidden', false);

				dist_id = $(this).val();
				// $.ajax({
				// 	url: 'heritage.php',
				// 	type: 'post',
				// 	data: {
				// 		dist_id: dist_id
				// 	},
				// 	success: function(data) {
				// 		console.log(data);
				// 	}

				// });
			});
			$(document).on('click', '#heritagepackage', function(e) {
				e.preventDefault();
				var body = $('#placebody').empty();
				var ptype = "Heritage";
				// $.ajax({
				// 	url: 'heritage.php',
				// 	type: 'post',
				// 	data: {
				// 		dist_id: dist_id,
				// 		ptype: 'Heritage'
				// 	},


				// });
				console.log(dist_id);
				body.load('ptype.php', {
					dist_id: dist_id,
					ptype: ptype
				});



			});
			$(document).on('click', '#pinicpackages', function(e) {
				e.preventDefault();
				var body = $('#placebody').empty();
				var ptype = "Picnic";
				// $.ajax({
				// 	url: 'heritage.php',
				// 	type: 'post',
				// 	data: {
				// 		dist_id: dist_id,
				// 		ptype: 'Heritage'
				// 	},


				// });
				console.log(dist_id);
				body.load('ptype.php', {
					dist_id: dist_id,
					ptype: ptype
				});
			});
			$(document).on('click', '#Trekingpackage', function(e) {
				e.preventDefault();
				var body = $('#placebody').empty();
				var ptype = "Trecking";
				// $.ajax({
				// 	url: 'heritage.php',
				// 	type: 'post',
				// 	data: {
				// 		dist_id: dist_id,
				// 		ptype: 'Heritage'
				// 	},


				// });
				console.log(dist_id);
				body.load('ptype.php', {
					dist_id: dist_id,
					ptype: ptype
				});


			});
			$(document).on('click', '#yatrapackage', function(e) {
				e.preventDefault();
				var body = $('#placebody').empty();
				var ptype = "Yatra";
				// $.ajax({
				// 	url: 'heritage.php',
				// 	type: 'post',
				// 	data: {
				// 		dist_id: dist_id,
				// 		ptype: 'Heritage'
				// 	},


				// });
				console.log(dist_id);
				body.load('ptype.php', {
					dist_id: dist_id,
					ptype: ptype
				});
			});
		});
	</script>
</body>

</html>