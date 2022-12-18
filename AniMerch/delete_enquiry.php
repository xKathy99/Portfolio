<?php
	// Initialize the session
	session_start();
 
	// Check if the user is logged in, if not then redirect him to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
	{
		header("location: login.php");
		exit;
	}
	
	// Include config file
	require_once "settings.php";
 
	$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	$enquiry_id = $password = "";
	$enquiry_err = $password_error = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		
		if ($_POST["enquiry_id"] == "none")
		{
			$enquiry_err = "Please choose an enquiry.";
		}
		else
		{
			$enquiry_id = $_POST["enquiry_id"];
		}
		
		if (empty(trim($_POST["pwd"])))
		{
			$password_error = "Please enter the password.";
		}
		else
		{
			$password = trim($_POST["pwd"]);
		}
		
		if (empty($enquiry_err) && empty($password_err))
		{
			$query = "SELECT username, password FROM userTable WHERE username = ?";
			
			if ($stmt = mysqli_prepare($conn , $query))
			{
				mysqli_stmt_bind_param($stmt, "s", $param_username);
				
				$param_username = $_SESSION["username"];
				
				if (mysqli_stmt_execute($stmt))
				{
					mysqli_stmt_store_result($stmt);
					
					if (mysqli_stmt_num_rows($stmt) == 1)
					{
						mysqli_stmt_bind_result($stmt, $_SESSION["username"] ,$hashed_password);
						
						if (mysqli_stmt_fetch($stmt))
						{
							if (password_verify($password, $hashed_password))
							{
								$query = "DELETE FROM enquiryTable WHERE id = ?";
								
								if ($stmt = mysqli_prepare($conn, $query))
								{
									mysqli_stmt_bind_param($stmt, "s", $param_id);
				
									$param_id = $enquiry_id;
				
									if (mysqli_stmt_execute($stmt))
									{
										header("location: view_enquiries.php");
									}
									else
									{
										echo "Oops! Something went wrong. Please try again later.";
									}
				
									mysqli_stmt_close($stmt);
								}
							}
							else
							{
								$password_err = "The password you entered was not valid.";
							}
						}
					}
				}
				else
				{
					echo "Something went wrong. Please try again later.";
				}
				
				mysqli_stmt_close($stmt);
			}
			
		}
	}
	mysqli_close($conn);
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Delete Enquiry">
		<meta name="keywords" content="Enquiry Management, Delete">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Enquiry Management - Delete</title>
	</head>
	
	<body class="manageBody">
		<?php include_once "management_header_nav.php"; ?> 
		
		<article class="manageContainer">
		<h1>Delete Enquiry</h1>
			<!--For owner only, can delete other account by filling the going to delete username and password-->
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<div class="formElement">
					<label for="enquiry_id">ENQUIRY</label>
					<select name="enquiry_id" id="enquiry_id">
						<option value="none">Choose to Delete</option>
						<?php
							require_once "settings.php";
				
							// Create connection
							$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
						
							if ($conn)
							{
								$query = "SELECT id, firstname, lastname, subject FROM enquiryTable";
								$result = mysqli_query($conn, $query);
							
								if ($result && $result->num_rows > 0)
								{
									while ($row = $result->fetch_assoc())
									{
										echo "<option value='" . $row["id"] . "'>" .
										$row["firstname"] . ", " . $row["lastname"] . 
										" --> " . $row["subject"] ."</option>";
									}
								}
								else
								{
									echo "0 results";
								}
								mysqli_close($conn);
							}
							else
							{
								echo "Unable to connect to the database.";
							}
						?>
					</select>
					<span><?php echo $enquiry_err; ?></span>
				</div>
				
				<div class="formElement">
					<label for="pwd">ACCOUNT PASSWORD</label>
					<input type="password" id="pwd" name="pwd" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $password_error; ?></span>
				</div>
				
				<input type="reset" value="Reset">
				<input type="submit" value="Delete Product">
			</form>
		</article>
		<?php include_once "management_footer.php"?>
	</body>
	
</html>