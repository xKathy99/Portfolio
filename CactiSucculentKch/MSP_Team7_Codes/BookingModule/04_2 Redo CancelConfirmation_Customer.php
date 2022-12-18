
<!DOCTYPE html>
<html>

	<head>
		<title>04 CancelSuccessful (Customer)</title>
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
				<h1>CANCELLATION CONFIRMATION</h1>
				

			</div>
			<h1>APPOINTMENT DETAILS:</h1>

			<br>
				<p> Are you sure you want to cancel? </p>
				<p> ================================ </p>

<?php

// session_start();

// echo $_SESSION['userAppointmentDelete'];

$sql = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `id` LIKE '$_SESSION[userAppointmentDelete]'"; // appointment ID
$result = mysqli_query($connection,$sql);

if(mysqli_num_rows($result)==1){
	while($row=mysqli_fetch_array($result)){
		echo "Appointment Date: $row[appointmentDate]<br><br>";
		echo "Time: $row[availableSlotFrom] - $row[availableSlotUntil]<br><br>";
		echo "Bookform Name: $row[bookform_name]<br><br>";
		echo "Bookform Number: $row[bookform_number]<br><br>";
		echo "Number of people: $row[bookform_numberofpeople]<br><br>";
		echo "Remarks: $row[bookform_additionalnotes]<br><br>";
	}
}

?>
				<div class="div_button">
					<form action="action_page.php" method="post">
						<button type="submit" class="button_green" name="cancelBooking_confirm" >CONFIRM</button>						
						<button type="submit" class="button_red" name="cancelBooking_cancel">CANCEL</button>						
					</form>
				</div>
			</section>
			</article>
		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>	
	</body>
	
</html> 


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>