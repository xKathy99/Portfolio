<?php
	// Initialize the session
	session_start();
 
	// Check if the user is logged in, if not then redirect to login page
	if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
	{
		header("location: login.php");
		exit;
	}
	
	if ($_SESSION["privilege"] != "1")
	{
		$message = "This account is not authorized to access this module.";
		echo "<script type='text/javascript'>alert('$message'); window.location.href='view_enquiries.php'; </script>";
		exit;
	}
	
	// Include config file
	require_once "settings.php";
 
	$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	// Define variables and initialize with empty values
	$username = $new_password = $confirm_password = "";
	$username_err = $new_password_err = $confirm_password_err = "";
 
	// Processing form data when form is submitted
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (trim($_POST["username"]) == "none")
		{
			$username_err = "Please select an username.";
		}
		else
		{
			$username = trim($_POST["username"]);
		}
 
		// Validate new password
		if(empty(trim($_POST["new_password"])))
		{
			$new_password_err = "Please enter the new password.";     
		} 
		elseif (strlen(trim($_POST["new_password"])) < 6)
		{
			$new_password_err = "Password must have atleast 6 characters.";
		} 
		else
		{
			$new_password = trim($_POST["new_password"]);
		}
    
		// Validate confirm password
		if (empty(trim($_POST["confirm_password"])))
		{
			$confirm_password_err = "Please confirm the password.";
		} 
		else
		{
			$confirm_password = trim($_POST["confirm_password"]);
			if(empty($new_password_err) && ($new_password != $confirm_password))
			{
				$confirm_password_err = "Password did not match.";
			}
		}
        
		// Check input errors before updating the database
		if(empty($new_password_err) && empty($confirm_password_err) && empty($username_err))
		{
			// Prepare an update statement
			$query = "UPDATE userTable SET password = ? WHERE username = ?";
        
			if($stmt = mysqli_prepare($conn, $query))
			{
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_username);
            
				// Set parameters
				$param_password = password_hash($new_password, PASSWORD_DEFAULT);
				$param_username = $username;
            
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt))
				{
					// Password changed successfully. Redirect back to view user page.
					header("location: view_users.php");
				} 
				else
				{
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
		}
    
		// Close connection
		mysqli_close($conn);
	}
?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Edit User">
		<meta name="keywords" content="User Management, Edit">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>User Management - Edit</title>
	</head>
	
	<body class="manageBody">
		<?php include_once "management_header_nav.php"; ?> 
		<article class="manageContainer">
			<h1>Edit User - Change Password</h1>
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<div class="formElement">
				
					<label for="username">USERNAME</label>
					<select name="username" id="username" onfocus="selectFocus(this)">
						<option value="none">Choose to Edit</option>
						<?php
							require_once "settings.php";
				
							// Create connection
							$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
						
							if ($conn)
							{
								$query = "SELECT id, username FROM userTable";
								$result = mysqli_query($conn, $query);
							
								if ($result && $result->num_rows > 0)
								{
									while ($row = $result->fetch_assoc())
									{
										echo "<option>" .
										$row["username"] . "</option>";
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
					<span><?php echo $username_err; ?></span>
				</div>
				
				<div class="formElement">
					<label for="new_password">NEW PASSWORD</label>
					<input type="password" id="new_password" name="new_password" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $new_password_err; ?></span>
				</div>
				
				<div class="formElement">
					<label for="confirm_password">CONFIRM PASSWORD</label>
					<input type="password" id="confirm_password" name="confirm_password" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $confirm_password_err; ?></span>
				</div>
				
				<input type="reset" value="Reset">
				<input type="submit" value="Change Password">
			</form>
		</article>
		<?php include_once "management_footer.php"?>
	</body>
</html>