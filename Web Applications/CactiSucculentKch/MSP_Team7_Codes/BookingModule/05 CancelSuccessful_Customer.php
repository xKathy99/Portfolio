<!DOCTYPE html>
<html>
	<link rel="stylesheet" href="../notification_module/public/notification_page.css">
	<head>
		<title>05 CancellationSuccessful (Customer)</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="BookingModule_style.css">
	</head>



	<body>	
		
		<div class="div_container">
			<br>
			<article class="article_design">	
			<h1>CANCELLATION SUCCESSFUL</h1>
			
			
			<section class="section_bookingmodule">
				<h2>Your booking was cancelled!</h2>
				
				<div class="div_button">
					<a href="../LoginModule/homepage.php">
						<button type="button" class="button_green">BACK TO HOME</button>												
					</a>
				</div>
				<div class="div_button">

					<a href="../notification_module/public/Notification_Page.php">
						<button type="button" class="button_green">Go to Notifications</button>	
					</a>

				</div>
			</section>
			</article>
		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>
		<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>
	</body>
	
</html> 


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>
