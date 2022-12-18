<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Account Created Successfully</title>
		<link rel="stylesheet" href="login_css.css">
	</head>
    <body>
        <div class="centerGray">
            <h1>The account has been Created sucessfully!</h1><br>
            <a href="login.php"><button type="button" class="button">Proceed to login page</button></a>
            <br><br>
        </div>
    </body>
    
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>