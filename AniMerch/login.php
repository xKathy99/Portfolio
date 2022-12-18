<?php
	require_once "database.php";
	
	createDB();
	createUserTable();
	masterUser();
	
	session_start();

	if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
	{
		header("location: view_enquiries.php");
		exit;
	}

	
	
	require_once "settings.php";
	
	$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	
	$login_username = $login_password = "";
	$username_err = $password_err = "";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		// Check if username is empty
		if(empty(trim($_POST["username"])))
		{
			$username_err = "Please enter username.";
		} 
		else
		{
			$login_username = trim($_POST["username"]);
		}
		
		 // Check if password is empty
		if(empty(trim($_POST["pwd"])))
		{
			$password_err = "Please enter your password.";
		} 
		else
		{
			$login_password = trim($_POST["pwd"]);
		}
		
		// Validate credentials
		if (empty($username_err) && empty($password_err))
		{
			// Prepare a select statement
			$query = "SELECT id, username, password, privilege FROM userTable WHERE username = ?";
        
			if($stmt = mysqli_prepare($conn, $query))
			{
				// Bind variables to the prepared statement as parameters
				mysqli_stmt_bind_param($stmt, "s", $param_username);
            
				// Set parameters
				$param_username = $login_username;
            
				// Attempt to execute the prepared statement
				if(mysqli_stmt_execute($stmt))
				{
					// Store result
					mysqli_stmt_store_result($stmt);
                
					// Check if username exists, if yes then verify password
					if(mysqli_stmt_num_rows($stmt) == 1)
					{                    
						// Bind result variables
						mysqli_stmt_bind_result($stmt, $id, $login_username, $hashed_password, $privilege);
					
						if(mysqli_stmt_fetch($stmt))
						{
							if(password_verify($login_password, $hashed_password))
							{
								// Password is correct, so start a new session
								session_start();
                            
								// Store data in session variables
								$_SESSION["loggedin"] = true;
								$_SESSION["id"] = $id;
								$_SESSION["username"] = $login_username;
								$_SESSION["privilege"] = $privilege;
                            
								// Redirect user to welcome page
								header("location: view_enquiries.php");
							} 
							else
							{
								// Display an error message if password is not valid
								$password_err = "The password you entered was not valid. " . $login_password . $hashed_password;
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

?>

<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Login">
		<meta name="keywords" content="Login">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Login</title>
	</head>
	
	<body onload="init()">
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
	
		<article class="container">
			<h1>Login</h1>	
			<form id="loginForm" action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
				<div class="formElement">
					<label for="username">USERNAME</label>
					<br>
					<input type="text" id="username" name="username" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $username_err ?></span>
				</div>
				
				<div class="formElement">
					<label for="pwd">PASSWORD</label>
					<br>
					<input type="password" id="pwd" name="pwd" onfocus="inputFocus(this)" onblur="inputBlur(this)"/>
					<span><?php echo $password_err ?></span>
				</div>
				
				<input type="reset" value="Reset">
				<input type="submit" value="Login">
			</form>
		</article>
		
		<?php include_once("page_footer.php");?>
	</body>
</html>