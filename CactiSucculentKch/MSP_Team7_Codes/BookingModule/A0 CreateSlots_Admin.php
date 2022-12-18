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
					<h1>Manage Slots</h1>
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
						
						<button type="submit" class="button_red" name="cancelBooking_admin">
							CANCEL BOOKING
						</button>	

						<a href="../HomeModule/adminappointment.php">
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



<!DOCTYPE html>
<html>

	<head>
		<title>A0_REDO Update Slots (Create/Delete) Page (Admin)</title>
		<link rel="stylesheet" href="BookingModule_style.css">
	</head>
	
	
	
	<body>
		
		
		<div class="div_container">
		<article class="article_design">	
			<form action="/action_page.php">
			
			<div class = "div_title">
				<h1>Manage Slots</h1>
			</div>
			
			<br>
				<section class = "section_new">
			
						<h2><label for="choose_date">Date</label></h2>
					
						<div class="div_left">
							<input type="date" id="choose_date" name="choose_date">
						</div>
					
						<div class="div_right">
							<div class="div_button">
								<button type="button" class="button_green" onclick="toggleBookingTimes()">DISPLAY TIME SLOTS</button>
								<script src="Script.js"></script>
							</div>
						</div>	
				</section>

						<br>
						<br>
						<br>
						<br>
						<br>
						<br>
						<br>

				<section class = "section_new">
						<h1>Delete/Add Slots</h1>
						
							<div id="div_timeslots">
							<u><h2>Delete slots</h2></u>
								<div id="div_deleteslot"> 
									<p id="p_show_date"></p> 
									
									<input type="checkbox" id="slot1" name="slot1" value="slot1">
									<label for="slot1"> Slot1</label><br>
									<input type="checkbox" id="slot1" name="slot1" value="slot1">
									<label for="slot1"> Slot1</label><br>
									<input type="checkbox" id="slot1" name="slot1" value="slot1">
									<label for="slot1"> Slot1</label><br>
								</div>
								<br>
								<u><h2>Add new slots</h2></u>
									<div id="div_addnewslot">
										
										<div id="div_new_slot">
										<label for="addslot_form" id="addslotlabel_from">From </label>
										<input type="time" id="updateslot_start_time" name="updateslot_start_time">
											
										<label for="addslot_form" id="addslotlabel_to">to</label>
										<input type="time" id="updateslot_end_time" name="updateslot_end_time">
										<br>
										</div>
									</div>
								<button type="button" class="button_green" id= "button_addnewslot" onclick="addNewSlot()">ADD NEW SLOT</button>	
								<script src="Script.js"></script>	

							</div>			
				</section>
							
				<section class = "section_new">

					<div class="div_button">
						<button type="submit" class="button_green">SAVE CHANGES</button>												
					</div>
				</section>
				
			</form>
			</article>
		</div>
		
	
		<!-- add croll to top button -->
		
		<button onclick="topFunction()" id="myBtn" title="Go to top">Top ⇧</button>
		<script>
            // Get the button
            let mybutton = document.getElementById("myBtn");
    
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {scrollFunction()};
    
            function scrollFunction() {
                if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                    mybutton.style.display = "block";
                } 
                else {
                    mybutton.style.display = "none";
                }
            }
    
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
        </script>
		<!-- end scroll to top function -->
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