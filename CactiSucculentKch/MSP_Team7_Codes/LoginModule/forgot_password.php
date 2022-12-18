<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Reset Password</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
	<h1 class="centertitle">Change Password</h1>
	<div id="message" >
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>
	
	<?php 
		$mail=$_GET['getemail'];
		// echo "The mail is $mail<br>" ;
	?>
	<form method="post" action="createDB2.php?getemail=<?= $mail?>">
		<div class="container">
			
			<label for="newPassword"><b>New Password:</b></label>
			<input type="password" placeholder="Enter Password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one UPPERCASE and lowercase letter, and at least 8 or more characters" required>

			<label for="confirmPassword"><b>Confirm Password:</b></label>
			<input type="password" id="confirm_password" name="confirm_password" placeholder="Retype Password" title="Confirm new password" />
			<input type="checkbox" onclick="showPassword()">Show Password<br><br>

			<button type="submit" name="change_psw">Change Password</button>
			
			<button type="button" class="cancelbtn1" >Cancel</button>
		</div>
	</form>
	
	<!-- ----------------------------------------------- -->
	<script>
		var password = document.getElementById("psw"), confirm_password = document.getElementById("confirm_password");
		
		function validatePassword() {
			if (password.value != confirm_password.value) {
				confirm_password.setCustomValidity("Passwords Don't Match");
			}
			else {
				confirm_password.setCustomValidity("");
			}
			if (password.value < 6) {
				confirm_password.setCustomValidity("Passwords too short");
			}
		}
		password.onchange = validatePassword;
		confirm_password.onkeyup = validatePassword;
	</script> 
	<script src="validate.js"></script>
	<script>
		function showPassword() {
			var x = document.getElementById("psw");
			var y = document.getElementById("confirm_password");
			if (x.type === "password" & y.type === "password") {
				x.type = "text";
				y.type = "text";
			} 
			else {
				x.type = "password";
				y.type = "password";
			}
		}
	</script>
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>