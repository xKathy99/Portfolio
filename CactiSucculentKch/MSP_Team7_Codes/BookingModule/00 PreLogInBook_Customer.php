<!DOCTYPE html>
<html>
	<head>
		<title>00 Pre Log In to Booking (Customer)</title>
		<link href="../notification_module/public/notification_page.css">
		
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
							<input type="date" id="choose_date" name="PreLogInBook_Customer_date" 
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
		$currentDate = "";
		while($row=mysqli_fetch_array($currentSelection)){
			$currentDate = $row['appointmentDate'];
		}

		$sql2 = "SELECT * FROM `userlogindb`.`appointmentslot` WHERE `appointmentDate` LIKE '$currentDate'";
		$appointmentslot=mysqli_query($connection, $sql2);
		
		if(mysqli_num_rows($appointmentslot)!=5){ // if no availableSlot 
			
			$avaliableSlotArray = array(1,1,1,1,1);

			while($row=mysqli_fetch_array($appointmentslot)){
				switch($row['availableSlotFrom']){
					case '09:00:00':
						$avaliableSlotArray[0] = 0;
						break;
					case '11:00:00':
						$avaliableSlotArray[1] = 0;
						break;
					case '13:00:00':
						$avaliableSlotArray[2] = 0;
						break;
					case '15:00:00':
						$avaliableSlotArray[3] = 0;
						break;
					case '17:00:00':
						$avaliableSlotArray[4] = 0;
						break;
					default:
						echo "Something Went Wrong";
				}
			}

			
			// $i = 1;                       
			// foreach($avaliableSlotArray as $value){
			// 	echo "$i: $value<br>";
			// 	$i++;
			// }
			
			// IF AVAILABLE DISPLAY BUTTON
			if($avaliableSlotArray[0] == 1){
				echo
				'<input type="radio" id="time1" name="availableTime" value="time1" required>				
				<label for="time1">Available Time 1 ( 9:00-11:00)</label><br>';
			}
			if($avaliableSlotArray[1] == 1){
				echo
				'<input type="radio" id="time2" name="availableTime" value="time2" required>
				<label for="time2">Available Time 2 (11:00-13:00)</label><br>';
			}
			if($avaliableSlotArray[2] == 1){
				echo
				'<input type="radio" id="time3" name="availableTime" value="time3" required>
				<label for="time3">Available Time 3 (13:00-15:00)</label><br>';
			}
			if($avaliableSlotArray[3] == 1){
				echo 
				'<input type="radio" id="time4" name="availableTime" value="time4" required>
				<label for="time4">Available Time 4 (15:00-17:00)</label><br>';
			}
			if($avaliableSlotArray[4] == 1){
				echo 
				'<input type="radio" id="time5" name="availableTime" value="time5" required>
				<label for="time5">Available Time 5 (17:00-19:00)</label><br>';
			}

				
			// session_start();

			if (!isset($_SESSION['username'])) { //username not set
				// unset($_SESSION['username']);

				echo '
					<div class="div_button">
						<button type="submit" class="button_green" name="PreLogInBook_Customer_time">LOGIN TO BOOK</button>
					</div>
				';
				
			}else{ // show button if not log in
				echo '
					<div class="div_button">
						<button type="submit" class="button_green" name="PreLogInBook_Customer_time">CONTINUE TO BOOK</button>
					</div>
				';
			}
		}else{
			echo '<p>No available slots on this date! Please choose another day</p>';
		}		
	}		
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
						
						</form>	

						</article>
					</div>

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

			$currentDate = "";

			while($row=mysqli_fetch_array($currentSelection)){
				echo "CurrentDate: ".$row['appointmentDate']."<br>";
				$currentDate = $row['appointmentDate'];
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
	

		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');


	mysqli_close($connection);
?>


<?php

echo "<script src='../notification_module/public/notification_page.js'></script>";
echo "<script src='../notification_module/public/ajax.js'></script>";
include_once('../notification_module/public/popUp.php');

?>

