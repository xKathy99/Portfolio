<?php
	// Initialize the session
	session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
	{
		header("location: login.php");
		exit;
	}
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="View Enquiries">
		<meta name="keywords" content="Enquiry Management, View">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Enquiry Management</title>
	</head>
	
	<body class="manageBody">
		<?php include_once "management_header_nav.php"; ?> 
		
		<article class="manageContainer">
			<h1>Enquiry Table</h1>
			<?php
				require_once "settings.php";
				
				// Create connection
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				// Check connection
				if (!$conn) 
				{
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "SELECT id, firstname, lastname, email, subject, address, city, state, postcode, phonenum, product, comment FROM enquiryTable";
				$result = $conn->query($sql);

				if ($result && $result->num_rows > 0) 
				{
					echo "<table>";
					echo "<tr><th>Enquiry ID</th>";
					echo "<th>First Name</th>";
					echo "<th>Last name</th>";
					echo "<th>Email</th>";
					echo "<th>Subject</th>";
					echo "<th>Address</th>";
					echo "<th>City</th>";
					echo "<th>State</th>";
					echo "<th>Postcode</th>";
					echo "<th>Phone Number</th>";
					echo "<th>Product</th>";
					echo "<th>Comments</th></tr>";
					// output data of each row
					while($row = $result->fetch_assoc()) 
					{
						echo "<tr><td>" . $row["id"] . "</td>" . 
						"<td>" . $row["firstname"] . "</td>" . 
						"<td>" . $row["lastname"] . "</td>" .
						"<td>" . $row["email"] . "</td>"  .
						"<td>" .$row["subject"] . "</td>"  .
						"<td>" .$row["address"] . "</td>" . 
						"<td>" . $row["city"] . "</td>" . 
						"<td>" . $row["state"] . "</td>"  .
						"<td>" .$row["postcode"] . "</td>" . 
						"<td>" .$row["phonenum"] . "</td>" . 
						"<td>" . $row["product"] . "</td>" .  
						"<td>" .$row["comment"]. "</td>"  . "</tr>";
					}
					echo "</table>";
				} 
				else 
				{
					echo "0 results";
				}				

				mysqli_close($conn);
			?>
			
		</article>
		<?php include_once "management_footer.php"; ?> 
	</body>
</html>