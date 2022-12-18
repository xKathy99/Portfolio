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
			
	$create_username = $create_password = $confirm_password = "";
	$username_err = $password_err = $confirm_password_err = "";
			
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if (empty(trim($_POST["username"])))
		{
			$username_err = "Please enter a username.";
		}
		else
		{
			$query = "SELECT id FROM userTable WHERE username = ?";
			
			if ($stmt = mysqli_prepare($conn, $query))
			{
				mysqli_stmt_bind_param($stmt, "s", $param_username);						
				
				$param_username = trim($_POST["username"]);
						
				if (mysqli_stmt_execute($stmt))
				{
					mysqli_stmt_store_result($stmt);
					
					if (mysqli_stmt_num_rows($stmt) == 1)
					{
						$username_err = "This username is already taken.";
					}
					else
					{
						$create_username = trim($_POST["username"]);
					}
				}
				else
				{
					echo "Oops! Something went wrong. Please try again later.";
				}
				mysqli_stmt_close($stmt);
			}
		}
	
			
		if (empty(trim($_POST["pwd"])))
		{
			$password_err = "Please enter a password.";
		}
		elseif (strlen(trim($_POST["pwd"])) < 6)
		{
			$password_err = "Password must have at least 6 characters.";
		}
		else
		{
			$create_password = trim($_POST["pwd"]);
		}
			
		if (empty(trim($_POST["cpwd"])))
		{
			$confirm_password_err = "Please confirm password.";
		}
		else
		{
			$confirm_password = trim($_POST["cpwd"]);
		
			if (empty($password_err) && ($create_password != $confirm_password))
			{
				$confirm_password_err = "Password do not match.";
			}					
		}
			
		if (empty($username_err) && empty($password_err) && empty($confirm_password_err))
		{
			$query = "INSERT INTO userTable (username, password, privilege)
			VALUES (?, ?, 2)";
				
			if ($stmt = mysqli_prepare($conn, $query))
			{
				mysqli_stmt_bind_param($stmt, "ss", $param_username, 
				$param_password);
					
				$param_username = $create_username;
				$param_password = password_hash($create_password, PASSWORD_DEFAULT);
					
				if (mysqli_stmt_execute($stmt))
				{
					// Unset all of the session variables
					$_SESSION = array();
 
					// Destroy the session.
					session_destroy();
					header("location: login.php"); // Redirect to login page
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
		<meta name="description" content="Create User">
		<meta name="keywords" content="User Management, Create">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>User Management - Register</title>
	</head>
	
	<body class="manageBody">
		<?php include_once "management_header_nav.php"; ?> 
		<article class="manageContainer">
			<h1>Create User</h1>
			<form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<div class="formElement">
					<label for="username">USERNAME</label>
					<input type="text" id="username" name="username" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<?php echo $username_err; ?> 
				</div>
				
				<div class="formElement">
					<label for="pwd">PASSWORD</label>
					<input type="password" id="pwd" name="pwd" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<?php echo $password_err; ?>
				</div>
				
				<div class="formElement">
					<label for="cpwd">CONFIRM PASSWORD</label>
					<input type="password" id="cpwd" name="cpwd" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<?php $confirm_password_err; ?>
				</div>
			
				<input type="reset" value="Reset">
				<input type="submit" value="Register">
			</form>
		</article>
		<?php include_once "management_footer.php"?>
	</body>
</html>