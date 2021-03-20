<?php
session_start();
if (isset($_POST['login'])) {

	$email = $_POST['email_id'];
	$_SESSION['email'] = $email;
	$pass = $_POST['pass'];
	$sql = "Select * from register where email_id='$email' and password = '$pass'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		$_SESSION['login'] = $email;
		echo "<script>;
              window.location='package-details.php'
              </script>";
	} else {
		echo mysqli_error($conn);
	}
}
?>

<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 style="color:red" class="modal-title text-danger">Login </h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="post">
					<div class="form-group">
						<label for="email" class="col-3 col-sm-3">Email</label>
						<input type="email" name="email_id" placeholder="example@gmail.com" id="email" class="col-8 col-sm-8 form-control" required="">
					</div>
					<div class="form-group">
						<label for="password" class="col-3 col-sm-3">Password</label>
						<input type="password" name="password" placeholder="****" class="col-8 col-sm-8 form-control" id="password" required="">
					</div>
					<div class="form-group">

					</div>
					<br />
					<div class="form-group ">
						<button class="btn btn-primary" name="login">Login</button>
						<a href="" class="offset-1 text-success h6" data-toggle="modal" data-target="#myModal" data-dismiss="modal">Click Here To Register</a>

					</div>
					<div class="form-group ">
						<a class=" text-prmary h6" href="forgetPassword.php">Forget Password?</a>

					</div>
				</form>

			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>