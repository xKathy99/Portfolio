<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Create Account Page</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
	<div id="message" >
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>
	<form action="createDB2.php" method="post">
		<div class="container">
			<h1>Sign Up</h1>
			<p>Please fill in this form to create an account.</p>
			<hr>

			<label for="email"><b>Email</b></label><label style="color:red;">* </label>
			<input type="email" placeholder="Enter Email" name="email" required>

			<label for="psw"><b>Password</b></label><label style="color:red;">* </label>
			<input type="password" placeholder="Enter Password" id="psw" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one UPPERCASE and lowercase letter, and at least 8 or more characters" required>

			<label for="psw-repeat"><b>Repeat Password</b></label><label style="color:red;">* </label>
			<input type="password" placeholder="Repeat Password" name="psw-repeat" id="confirm_password" required>

			<input type="checkbox" onclick="showPassword()">Show Password<br><br>

			<label for="Name"><b>Name</b></label><label style="color:red;">* </label>
			<input type="text" placeholder="Name" name="name" id="name" required>

			<label for="Contact"><b>Contact Number</b></label><label style="font-size: 10px;"> (Malaysia numbers only)</label><label style="color:red;">* </label>
			<input type="text" placeholder="Contact" name="contact" id="contact" pattern="[0-9]{10,11}" title="10 or 11 numbers only" required>

			<div style="font-size: 11px;">Required<label style="color:red;">* </label><br></div>
			<!--<label>
			<input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
			</label>-->

			<!-- <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p> -->
			
			<button type="submit" class="signupbtn" name="reg_user">Sign Up</button>
			<a href="login.php"><button type="button" class="cancelbtn1">Cancel</button></a>
			
		</div>
	</form>
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
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>