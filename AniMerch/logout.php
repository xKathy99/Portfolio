<?php
	// Initialize the session
	session_start();
 
	// Unset all of the session variables
	$_SESSION = array();
 
	// Destroy the session.
	session_destroy();
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Log Out">
		<meta name="keywords" content="Log Out">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Log Out</title>
	</head>
	
	<body class="manageBody" onload="init()">
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
	
		<article class="container">
			<h1>Log Out</h1>
			<p>You have been successfully logged out.</p>
		</article>
		
		<?php include_once("page_footer.php");?>
	</body>
</html>