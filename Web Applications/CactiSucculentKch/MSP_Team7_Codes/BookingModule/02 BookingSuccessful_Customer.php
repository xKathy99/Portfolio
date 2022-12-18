<!DOCTYPE html>
<html>

	<head>
		<title>02 BookingSuccessful (Customer)</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="BookingModule_style.css">
	</head>
	
	
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	include_once '../LoginModule/createDB2.php';

	$connection = mysqli_connect($server_name, $user_name, $password, $dbname);
	if (!$connection) {
		die("Failed ". mysqli_connect_error());
	}
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 


	
	<body>
	
		<div class="div_container">
			
			<section class="section_bookingmodule">
			<article class="article_design">

				<div class = "div_title">
					<h1>BOOKING CONFIRMATION</h1>
				</div>
				
				<br>
				
					<h2>Your booking details:</h2>

<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php

	$currentselected = ""; 

	$sql = "SELECT * FROM `userlogindb`.`currentselection` WHERE 1";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result)){

		while($row=mysqli_fetch_array($result)){
			echo "=======================================================================<br><br>";
			echo "Date: $row[appointmentDate]<br>";
			echo "=======================================================================<br><br>";
			echo "From: $row[pickedSlotFrom] - $row[pickedSlotUntil]<br>";
			echo "=======================================================================<br><br>";
			echo "Name: $row[bookform_name]<br>";
			echo "=======================================================================<br><br>";
			echo "Bookform_number (ph): $row[bookform_number]<br>";
			echo "=======================================================================<br><br>";
			echo "Number of People: $row[bookform_numberofpeople]<br>";
			echo "=======================================================================<br><br>";

			$currentselected = $row['appointmentDate'];
		}

	}else{
		echo "result empty";
	}

?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 

				<div class="div_button">

					<form action="action_page.php" method="post">

						<button type="submit" class="button_green" name="BookingSuccessful_Customer_confirmBooking">CONFIRM BOOKING</button>				
						<button type="submit" class="button_green" name="BookingSuccessful_Customer_reschedule">RESCHEDULE</button>	
						<a href="../LoginModule/homepage.php">
							<button type="button" class="button_red" name="customer_home">Home</button>			
						</a>
					</form>

				</div>
				
			</article>

			</section>
			
		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>	
	</body>
	
</html> 

<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	mysqli_close($connection);
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>