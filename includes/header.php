<?php if ($_SESSION['login']) { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a href="index.html"><i class="fa fa-home"></i></a></li>
				<li class="prnt"><a href="profile.php">My Profile</a></li>
				<li class="prnt"><a href="cplogin.php">Change Password</a></li>
				<li class="prnt"><a href="tour-history.php">My Tour History</a></li>
			</ul>
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="tol">Welcome :</li>
				<li class="sig"><?php echo htmlentities($_SESSION['login']); ?></li>
				<li class="sigi"><a href="logout.php">/ Logout</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div><?php } else { ?>
	<div class="top-header">
		<div class="container">
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="hm"><a href="admin/">Admin Login</a></li>
			</ul>
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="text-light"><a href="#" data-toggle="modal" data-target="#myModal">Sign Up</a></li>
				<li class="text-light"><a href="#" data-toggle="modal" data-target="#myModal4">/ Sign In</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div class="container">
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php">KARNATAKA TOURISM </span></a>
		</div>
		<div style="width:200px;float:right" class="col-2">
			<div id="google_translate_element">
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s">
	<div class="container">
		<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="navbar navbar-expand-lg ">
						<ul class="nav navbar-nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="#">About</a></li>
							<li><a href="package-list.php">Select District</a></li>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Terms of Use</a></li>
							<li><a href="#">Contact Us</a></li>
							<?php if ($_SESSION['login']) { ?>
								<li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a> </li>

							<?php } else { ?>
								<li><a href="enquiry.php"> Enquiry </a> </li>
							<?php } ?>
							<div class="clearfix"></div>

							<script type="text/javascript">
								function googleTranslateElementInit() {
									new google.translate.TranslateElement({
										pageLanguage: 'en'
									}, 'google_translate_element');
								}
							</script>

							<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>

		<div class="clearfix"></div>
	</div>
</div>