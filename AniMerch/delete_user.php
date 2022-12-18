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
	
	require_once "settings.php";
	
	$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	$delete_username = $delete_password = "";
	$username_err = $password_error = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (trim($_POST["username"]) == "none")
		{
			$username_err = "Please enter a username.";
		}
		elseif ((trim($_POST["username"])) == "owner")
		{
			$username_err = "This user cannot be deleted.";
		}
		else
		{
			$delete_username = (trim($_POST["username"]));
		}
		
		if (empty(trim($_POST["pwd"])))
		{
			$password_error = "Please enter the password.";
		}
		else
		{
			$delete_password = trim($_POST["pwd"]);
		}
		
		if (empty($username_err) && empty($password_err))
		{
			
			// Prepare a select statement
			$query = "SELECT id, username, password FROM userTable WHERE username = ?";
        
			if($stmt = mysqli_prepare($conn, $query))
			{
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
            
				// Set parameters
				$param_username = $delete_username;
            
				// Attempt to execute the prepared statement
				if (mysqli_stmt_execute($stmt))
				{
					// Store result
					mysqli_stmt_store_result($stmt);
                
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1)
					{                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $delete_username, $hashed_password);
						if(mysqli_stmt_fetch($stmt))
						{
							if(password_verify($delete_password, $hashed_password))
							{
								// Password is correct, so delete this account
								$query = "DELETE FROM userTable WHERE username = ?";
			
								if ($stmt = mysqli_prepare($conn, $query))
								{
									mysqli_stmt_bind_param($stmt, "s", $param_username);
				
									$param_username = $delete_username;
				
									if (mysqli_stmt_execute($stmt))
									{
										header("location: view_users.php");
									}
									else
									{
										echo "Oops! Something went wrong. Please try again later.";
									}
				
									mysqli_stmt_close($stmt);
								} 
							else
							{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid.";
							}
						}
					} 
					else
					{
						// Display an error message if username doesn't exist
						$username_err = "No account found with that username.";
					}
				} 
				else
				{
					echo "Oops! Something went wrong. Please try again later.";
				}

				// Close statement
				mysqli_stmt_close($stmt);
			}
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
		<meta name="description" content="Delete User">
		<meta name="keywords" content="User Management, Delete">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>User Management - Delete</title>
	</head>
	
	<body class="manageBody">
		<?php include_once "management_header_nav.php"; ?> 
		<article class="manageContainer">
			<h1>Delete User</h1>
			<!--For owner only, can delete other account by filling the going to delete username and password-->
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
					<label for="pwd">PASSWORD</label>
					<input type="password" id="pwd" name="pwd" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $password_error; ?></span>
				</div>
				
				<input type="reset" value="Reset">
				<input type="submit" value="Delete User">
			</form>
		</article>
		
		<?php include_once "management_footer.php"; ?> 
	</body>
</html>