<?php

if (isset($_POST['save'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email_id'];
	$mobile_no = $_POST['mobile_no'];
	$pass = $_POST['pass'];
	$cpass = $_POST['cpass'];
	$flag = true;
	if ($pass  != $cpass) {
		$flag = false;
		echo "<script>Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Invalid Password!',
  footer: '<a href>Password Should be Match</a>'
});
              //window.location='./index.php'
              </script>";
	}
	if ($flag) {
		$sql = "insert into register(fname,lname,mobile_no,password,email_id) values('$fname','$lname','$mobile_no','$pass','$email')";
		$res = mysqli_query($conn, $sql);
		if ($res) {
			echo "<script>Swal.fire({
  position: 'top',
  icon: 'success',
  title: 'Successfully Registered',
  showConfirmButton: true,
  timer: 1500
});
              //window.location='./index.php'
              </script>";
		} else {
			echo mysqli_error($conn);
		}
	}
}


?>


<!--Javascript for check email availabilty-->
<script>
	function checkAvailability() {

		$("#loaderIcon").show();
		jQuery.ajax({
			url: "check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			success: function(data) {
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content m-2 p-2">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title  text-danger">Create Account</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="post">
					<div class="form-group row">
						<label for="email" class="col-4 col-sm-4">Name</label>
						<input type="text" class="form-control col-sm-3 col-3" required id="fname" name="fname" placeholder="First Name" />&nbsp;
						<input type="text" class="form-control col-sm-4 col-4" required id="lname" name="lname" placeholder="Last Name" />

					</div>
					<div class="form-group row">
						<label for="type" class="col-4 col-sm-4">Mobile Number</label>
						<input class="form-control col-sm-7 col-7" required pattern="[7-9]{1}[0-9]{9}" title="Phone number with 7-9 and remaing 9 digit with 0-9" type="text" name="mobile_no">

					</div>

					<div class="form-group row">
						<label for="email" class="col-4 col-sm-4">Email</label>
						<input type="email" class="form-control col-sm-7 col-7" required id="email" name="email_id" placeholder="Email" />
					</div>


					<div class="form-group row">
						<label for="type" class="col-4 col-sm-4">Password</label>
						<input class="form-control col-sm-7 col-7" type="password" required name="pass" id="pass">
						<label id="message1" class="col-4 col-sm-4 text-danger"></label>

					</div>
					<div class="form-group row">
						<strong style="margin-left:20px" id="result"></strong>
					</div>
					<div class="form-group row">
						<label for="type" class="col-4 col-sm-4"> Confirm Password</label>
						<input class="form-control col-sm-7 col-7" type="text" name="cpass" required id="cpass">
						<label id="message2" class="col-7 col-sm-7 text-danger"></label>

					</div>


					<div class="form-group">
						<button class="btn btn-success offset-4" id="save" name="save">Register</button>
						<a href="" class="h6 offset-1 text-primary" data-toggle="modal" data-target="#myModal4" data-dismiss="modal">Back To Login</a>
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