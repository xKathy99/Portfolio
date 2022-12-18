<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Account NOT Exist</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
    <body>
        <div class="centerGray">
            <!-- account exist go back to create or login -->
            <h1>Account DOES NOT exists please create an account OR Login Now.</h1><br>
            <a href="create_account.php"><button type="button" class="cancelbtn1">Create Account</button></a><br><br>
            <a href="login.php"><button type="button" class="button">Login Now</button></a><br><br></div>
        </div>
    </body>
    
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>