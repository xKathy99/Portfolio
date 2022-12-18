

	
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
				$enquiry_id= $_POST['enquiryform_id'];
				$customerId="null";
				
				$stmt = $conn->prepare("INSERT INTO enquiryreplies(enquiryID, replyCustomerID,  replyDetails) 
										VALUES (?,?, ?)");
				
				$stmt->bind_param("iss", $enquiry_id,$customerId, $enquiry_details);

				$stmt->execute();

				header("Location:ViewEnquiries.php");
				$conn->close();
				
			}
			
		
?>
