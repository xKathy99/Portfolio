<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Send Link</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
	<h1 class="centertitle">Send Reset Password Link</h1>

	
	<form action="send.php" method="get">
		<div class="container">
			<h2>Forget Password?</h2>
			<p>Recover your account by entering your registered email account.</p>
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" required>
			<button type="submit">Send</button>
			<button type="button" class="cancelbtn1" onclick="history.back()">Cancel</button>
		</div>
	</form>
</html>


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>