
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
			<article class="article_design">

			<section class="section_bookingmodule">
			
				<div class = "div_title">
					<h1>BOOKING INFORMATION</h1>
				</div>
				
				<br>
				
					<h2>Your booking details:</h2>

<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 

<?php


	$sql = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE 1";
	$result = mysqli_query($connection,$sql);

	if(mysqli_num_rows($result)){

		while($row=mysqli_fetch_array($result)){

			echo '<form action="action_page.php" name="view_schedule" method="post">';

			echo "
				ID: $row[id]<br>
				=======================================================================<br><br>
				Appointment Date: $row[appointmentDate]<br>
				=======================================================================<br><br>
				Time: $row[availableSlotFrom] - $row[availableSlotUntil]<br>
				=======================================================================<br><br>
				Bookform Name: $row[bookform_name]<br>
				=======================================================================<br><br>
				Bookform Number: $row[bookform_number]<br>
				=======================================================================<br><br>
				Number of people: $row[bookform_numberofpeople]<br>
				=======================================================================<br><br>
				Remarks: $row[bookform_additionalnotes]<br>
				=======================================================================<br><br>
			";
?>

					<div class="div_button">

						<input type="hidden" name="cancelBookingID" value=<?php echo $row['id']?>>
						
						<button type="submit" class="button_red" name="cancelBooking">
							CANCEL BOOKING
						</button>	

						<a href="../LoginModule/homepage.php">
							<button type="button" class="button_green" name="BookingSuccessful_Customer_confirmBooking">
								BACK TO HOME
							</button>				
						</a>

					</div>
				</form>
<?php

		}

	}else{
		echo "result empty";
	}
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 



			</section>
			</article>
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