<?php
	require_once "database.php";
	
	createDB();
	createEnquiryTable();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Enquiry Confirmation">
		<meta name="keywords" content="Enquiry, Confirmation">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Enquiry Confirmation</title>
	</head>
	
	<body onload="getEnquiry()">
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
		
		<article class="container">
			<?php
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$email = $_POST['email'];
				$subject = $_POST['subject'];
				$address = $_POST['address'];
				$city = $_POST['city'];
				$state = $_POST['state'];
				$postcode = $_POST['postcode'];
				$phonenum = $_POST['phonenum'];
				$product = $_POST['product'];
				$comment = $_POST['comment'];
			?>
		
			<?php
				require_once "settings.php";
				
				// Create connection
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				
				// Check connection
				if ($conn)
				{
					$query = "INSERT INTO enquiryTable(firstname, lastname, email,
						subject, address, city, state, postcode, phonenum,
						product, comment)
						VALUES ('$fname', '$lname', '$email', '$subject', 
						'$address', '$city', '$state', '$postcode', 
						'$phonenum', '$product', '$comment') ";
					$result = mysqli_query($conn, $query);
					
					if ($result)
					{
						$enquiryid = $conn->insert_id;
						$status = "Your enquiry has been submitted.";
					}
					else
					{
						$status = "Error: " . $query . "<br>" . $conn->error;
					}
					
					mysqli_close($conn);
				}
				else
				{
					echo "Unable to connect to database.";
				}
			?>
			<h1>Enquiry Submission ID: <span><?php echo $enquiryid; ?></span></h1>
			<h2>Submission Status: <span><?php echo $status; ?></span></h2>
			<table id="confirmTable">
				<tr><th>Item</th><th>Entered Value</th></tr>
				<tr><td>First Name</td><td><?php echo $fname; ?></td></tr>
				<tr><td>Last Name</td><td><?php echo $lname; ?></td></tr>
				<tr><td>Email</td><td><?php echo $email; ?></td></tr>
				<tr><td>Subject</td><td><?php echo $subject; ?></td></tr>
				<tr><td>Street Address</td><td><?php echo $address; ?></td></tr>
				<tr><td>City/Town</td><td><?php echo $city; ?></td></tr>
				<tr><td>State</td><td><?php echo $state; ?></td></tr>
				<tr><td>Postcode</td><td><?php echo $postcode; ?></td></tr>
				<tr><td>Phone Number</td><td><?php echo $phonenum; ?></td></tr>
				<tr><td>Product</td><td><?php echo $product; ?></td></tr>
				<tr><td>Comment</td><td><?php echo $comment; ?></td></tr>
			</table>
			<button type="button" id="returnHome" onclick="returnToHome()">Return to Homepage</button>
		</article>
		
		<?php include_once("page_footer.php");?>
	</body>
</html>