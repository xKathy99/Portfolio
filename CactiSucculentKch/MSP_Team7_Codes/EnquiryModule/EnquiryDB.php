<!DOCTYPE html>
<html lang="en">

	<head>
	
	</head>


	<?php

		$user = 'root';
		$pass = '';
		$db = 'forenquiry';	
		
		$query_createdb = "CREATE DATABASE IF NOT EXISTS $db";

		$conn = mysqli_connect('localhost', $user, $pass);     
		mysqli_query($conn, $query_createdb);
		
		// Database Connection
		$conn = new mysqli('localhost', $user, $pass, $db);
		if($conn->connect_error)
		{
			die('Connection Failed: '.$conn->connect_error);
		}
		else
		{
			/*
			$create_enquirydb_tables =  "CREATE TABLE IF NOT EXISTS `forenquiry`.`enquirytable`(
            `enquiryID` INT NOT NULL AUTO_INCREMENT , 
            `customerID` INT NOT NULL , 
            `enquirySubject` VARCHAR(255) ,
            `enquiryDetails` TEXT , 
            PRIMARY KEY (`enquiryID`)) ENGINE=InnoDB;"; */
			
			$create_enquirydb_enquirytable = "create table if not EXISTS enquirytable(
			enquiryID int PRIMARY KEY AUTO_INCREMENT,
			customerID VARCHAR(255),
			enquirySubject VARCHAR(255),
			enquiryDetails TEXT);";
			
			mysqli_query($conn, $create_enquirydb_enquirytable);
			
			$create_enquirydb_enquiryreplies = "create table if not EXISTS enquiryreplies(
			replyID int PRIMARY KEY AUTO_INCREMENT, 
            enquiryID int, 
            replyDetails TEXT,
            replyCustomerID VARCHAR(255));";
			
			mysqli_query($conn, $create_enquirydb_enquiryreplies);

			//foreign Key
			$create_linktables = "ALTER TABLE enquiryreplies ADD FOREIGN KEY (enquiryID) REFERENCES enquirytable(enquiryID);";
			mysqli_query($conn, $create_linktables);
		}
			
			
			if (isset($_POST['enquiryform_submit']))
			{
				
				$enquiry_title = $_POST['enquiryform_title'];
				$enquiry_details = $_POST['enquiryform_details'];
				
				
				session_start();
				$customername_loggedin = $_SESSION['username'];
				
				$stmt = $conn->prepare("INSERT INTO enquirytable(customerID, enquirySubject, enquiryDetails)
										VALUES (?, ?, ?)");
			
				$stmt->bind_param("sss", $customername_loggedin, $enquiry_title, $enquiry_details);

				$stmt->execute();
			
				echo $enquiry_title, $enquiry_details;
				
				$stmt->close();
				$conn->close();
			?>
				<script>
					window.open('EN01_ViewEnquiries.php', '_self');
				</script>
			<?php
				
			}
			
			
			elseif (isset($_POST['enquiryform_submitreply']))
			{
				
				$enquiryform_retrievedid = $_POST['enquiryform_userdetails'];
				$enquiryform_reply = $_POST['enquiryform_reply'];


				session_start();
				$customername_loggedin = $_SESSION['username'];
				
				$stmt = $conn->prepare("INSERT INTO enquiryreplies(enquiryID, replyCustomerID, replyDetails) 
										VALUES (?, ?, ?)");
			
				$stmt->bind_param("iss", $enquiryform_retrievedid, $customername_loggedin, $enquiryform_reply);

				$stmt->execute();
				
				/*
						
				$stmt = $conn->query("SELECT * FROM enquiryreplies WHERE enquiryID= $enquiryform_retrievedid");
				
				$alldata = $stmt->fetch_assoc();
				echo
					'<div class = "div_each_reply">';
				while($alldata = $stmt->fetch_assoc())
				{
					echo'
						<h3>', $alldata["replyDetails"],' </h3>
						<p>', $alldata["replyID"], '</p>
					';
				}
				
				*/
				
				
				// $alldata = $stmt->fetch_assoc();
				// print_r($alldata);
				
				//echo '</div>';
				
				$stmt->close();
				$conn->close();
				
				?>
				<script>
					window.open('EN03_ViewThread.php?id=<?php echo $enquiryform_retrievedid?>', '_self');
				</script>
			<?php
			}
			
			
			
		
	?>

</html>