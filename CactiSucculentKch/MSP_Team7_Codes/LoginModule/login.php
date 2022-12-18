<!-- cacti succelent login page -->
<!DOCTYPE html> 
<html lang="en">
	<head>
		
		<title>Login Page</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="login_css.css">
	</head>
	<?php 
		// session_start(); 

		if (isset($_GET['logout'])) { //set by login.php?logout='1'
			session_destroy();
			unset($_SESSION['username']);
			header("location: login.php");//required to reset the $_GET['logout']
		}
	?>
	<body>
	<br>
	
	<div id="message" >
        <h3>Password must contain the following:</h3>
        <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
        <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
        <p id="number" class="invalid">A <b>number</b></p>
        <p id="length" class="invalid">Minimum <b>8 characters</b></p>
    </div>
	<form action="createDB2.php" method="post">
		<div class="imgcontainer">
			
			<img src="cacti_succulent.jpg" alt="Avatar" class="avatar">
			<span for="tname"><b><br>Cacti-Succulent</b></span>
		</div>

		<div class="container" style="padding-bottom: 0;">
			<label for="uname"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="username" id="username" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" id="psw" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one UPPERCASE and lowercase letter, and at least 8 or more characters" required>
			<input type="checkbox" onclick="showPassword()">Show Password<br><br>

			<button type="submit" name="login_user" onclick="checkAdmin()">Login</button>
			<p id="demo"></p>
		</div>
		<div class="containerCancel">
			<button type="button" class="cancelbtn" onclick="history.back()">Cancel</button>
			<span class="psw"><a href="send_code.php">Forgot password?</a></span>
		</div>
		<div class="container" style="text-align: center">
			<span class="register">New user? <a href="create_account.php">Register now.</a></span>
		</div>
		
		
	</form>
	<script src="validate.js"></script>
	<script>
		function checkAdmin() {			
			var username = document.getElementById("username").value;
			var password = document.getElementById("psw").value;			
			if (username == "admin" && password == "admin"){
				window.location.href = "createDB2.php?username=admin";//can go to admin page(why no posting?) decide to use get
			}
		}
		function showPassword() {
			var x = document.getElementById("psw");
			if (x.type === "password") {
				x.type = "text";
			} 
			else {
				x.type = "password";
			}
			// checkAdmin();
		}
		// username.onchange = checkAdmin;
		// password.onchange = checkAdmin;
	</script>
	</body>
</html>
<?php //include '../includefile/footer.php';?>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>