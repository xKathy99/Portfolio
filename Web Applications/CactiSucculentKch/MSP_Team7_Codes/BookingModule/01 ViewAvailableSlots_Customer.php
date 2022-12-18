
<!DOCTYPE html>
<html>
	<head>
		<title>00 Pre Log In to Booking (Customer)</title>
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

			<form action="action_page.php" method="post">
						
			<div class = "div_chosendatetime">
					<h1>BOOK A SLOT:</h1>
			</div>
			<br>

				<section>

					<h2>
						<label for="choose_date">
							Appointment Date
						</label>
					</h2>


<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	$sql = "SELECT * FROM `userlogindb`.`currentselection`"; 
	$currentSelection=mysqli_query($connection, $sql);

	if(mysqli_num_rows($currentSelection)>0){
		while($row=mysqli_fetch_array($currentSelection)){
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 

						<div class="div_left">
							<input type="date" id="choose_date" name="ViewAvailableSlots_Customer_date" 
							onchange="this.form.submit()" value=<?php echo $row['appointmentDate'];?> required>
						</div>

<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
		}
	}else{
		echo '<input type="date" id="choose_date" name="PreLogInBook_Customer_date" onchange="this.form.submit()" required>';
	}
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 

					</form>

					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
			
					<h2>Appointment Time</h2>
							
					<div id="div_timeslots">

						<form action="action_page.php" method="post">

						<p id="p_show_date"></p> 

<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	$sql = "SELECT * FROM `userlogindb`.`currentselection`"; 
	$currentSelection=mysqli_query($connection, $sql);

	if(mysqli_num_rows($currentSelection)==1){ // check if currentselection is selected 

		while($row=mysqli_fetch_array($currentSelection)){
			$currentDate = $row['appointmentDate'];
			$currentTimeSlot = $row['pickedSlotFrom'];
		}

		$sql2 = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `appointmentDate` LIKE '$currentDate'";
		$appointmentslot=mysqli_query($connection, $sql2);
		
		if(mysqli_num_rows($appointmentslot)!=5){ // if no availableSlot 
			
			$availableSlotArray = array(1,1,1,1,1);

			while($row=mysqli_fetch_array($appointmentslot)){
				switch($row['availableSlotFrom']){
					case '09:00:00':
						$availableSlotArray[0] = 0;
						break;
					case '11:00:00':
						$availableSlotArray[1] = 0;
						break;
					case '13:00:00':
						$availableSlotArray[2] = 0;
						break;
					case '15:00:00':
						$availableSlotArray[3] = 0;
						break;
					case '17:00:00':
						$availableSlotArray[4] = 0;
						break;
					default:
						echo "Something Went Wrong";
				}
			}

			// $i = 1;                       
			// foreach($availableSlotArray as $value){
			// 	echo "$i: $value<br>";
			// 	$i++;
			// }
			
			// IF AVAILABLE DISPLAY BUTTON
			if($availableSlotArray[0] == 1){
				if($currentTimeSlot=="09:00:00"){
					echo
					'<input type="radio" id="time1" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time1" checked required>';
				}else{
					echo
					'<input type="radio" id="time1" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time1" required>';
				}
				echo '<label for="time1">Available Time 1 (9:00-11:00)</label><br>';
			}
			if($availableSlotArray[1] == 1){
				if($currentTimeSlot=="11:00:00"){
					echo
					'<input type="radio" id="time2" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time2" checked required>';
				}else{
					echo
					'<input type="radio" id="time2" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time2" required>';
				}
				echo '<label for="time2">Available Time 2 (11:00-13:00)</label><br>';
			}
			if($availableSlotArray[2] == 1){
				if($currentTimeSlot=="13:00:00"){
					echo
					'<input type="radio" id="time3" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time3" checked required>';
				}else{
					echo
					'<input type="radio" id="time3" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time3" required>';
				}
				echo '<label for="time3">Available Time 3 (13:00-15:00)</label><br>';
			}
			if($availableSlotArray[3] == 1){
				if($currentTimeSlot=="15:00:00"){
					echo
					'<input type="radio" id="time4" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time4" checked required>';
				}else{
					echo 
					'<input type="radio" id="time4" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time4" required>';
				}
				echo '<label for="time4">Available Time 4 (15:00-17:00)</label><br>';
			}
			if($availableSlotArray[4] == 1){
				if($currentTimeSlot=="17:00:00"){
					echo
					'<input type="radio" id="time5" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time5" checked required>';
				}else{
					echo 
					'<input type="radio" id="time5" name="ViewAvailableSlots_Customer_time"onchange="this.form.submit()" value="time5" required>';
				}
				echo '<label for="time5">Available Time 5 (17:00-19:00)</label><br>';
			}

		}else{
			echo '<p>No available slots on this date! Please choose another day</p>';
		}		
	}		
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
						
						</form>														
					</div>

					<form action="action_page.php" name="view_schedule" method="post">

						<label for="bookform_name">Name: </label>
						<?php?>
						<input type="text" id="bookform_name" name="bookform_name" required>
						<br><br>
						
						<label for="bookform_number">Phone Number: </label>
						<input type="tel" id="bookform_number" name="bookform_number" required>
						<br><br>
						
						<label for="bookform_numberofpeople">Number of People Visiting (max. 5pax):</label>
						<input type="number" id="bookform_numberofpeople" name="bookform_numberofpeople" min="1" max="5" required>
						<br><br>
						
						<label for="bookform_additionalnotes">Additional Notes:</label>
						<input type="text" id="bookform_additionalnotes" name="bookform_additionalnotes" placeholder="Optional">
						<br><br>

						<div class="div_button">
							<button type="submit" class="button_green" name="ViewAvailableSlots_Customer_details">SUBMIT</button>
							<a href="../LoginModule/homepage.php">
								<button type="button" class="button_red" name="customer_home">Home</button>			
							</a>
						</div>
					</form>
					
					</article>

				</section>
			</div>

		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>
		
	</body>

</html> 
	
<?php

	// DUMMY CODE FOR DEBUGGING ++++++++++++++++++++++++++++++++++++

	// ================ CURRENT SELECTED ======================\
	echo "===========================================================<br>";

	$sql = "SELECT * FROM `userlogindb`.`currentselection`"; 
	$currentSelection=mysqli_query($connection, $sql);

		if(mysqli_num_rows($currentSelection)==1){ // check if currentselection is selected 


			while($row=mysqli_fetch_array($currentSelection)){

				echo "CurrentDate: $row[appointmentDate]<br>";
				echo "PickedSlotFrom: $row[pickedSlotFrom]<br>";
				echo "PickedSlotUntil: $row[pickedSlotUntil]<br>";
			}

			$sql = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `appointmentDate` LIKE '$currentDate'";
			$result_appointmentslot=mysqli_query($connection, $sql);
			
			echo "Rows (currentselected = appointmentdate): ".mysqli_num_rows($result_appointmentslot)."<br>";
		}else{
			echo "Current Selection has not pick the date yet"."</br>";
		}

	echo "===========================================================<br>";
	//===============================================================

		$sql = "SELECT * FROM `userlogindb`.`appointmentslot`"; 
		$appointmentslot=mysqli_query($connection, $sql);
			if($appointmentslot){

				$i = 1;
				while($row=mysqli_fetch_array($appointmentslot)){
					echo "Date $i: $row[appointmentDate] From: $row[availableSlotFrom] - $row[availableSlotUntil]<br>";
					$i++;
				}

			}else{

				echo "Appointmentslot date no result: "."<br>";

			}
			echo "========================================================"."<br>";

	
		$sql = "SELECT * FROM `userlogindb`.`currentselection`"; 
		$currentSelection=mysqli_query($connection, $sql);
	
	//===============================================================
	

	mysqli_close($connection);
?>




<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>