// <?php
	// require_once "database.php";
	
	// createDB();
	// createProductTable();
	// defaultProductTable();
// ?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/CSS" href="styles/style.css">
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="Contact Us">
		<meta name="keywords" content="Enquiry, Contact Us">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Contact Us</title>
	</head>
	
	<body onload="init()">
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
	
		<article class="container">
			<h1>Contact Us</h1>	
			<form id="enquiryForm" method="post" action="enquiry_process.php" onsubmit="return validateForm();">
				<div class="formElement formSide">
					<label for="firstName">FIRST NAME*</label>
					<br>
					<input type="text" id="firstName" name="firstName" onfocus="inputFocus(this)" onblur="inputBlur(this)"> <!--maxlength="25", required-->
				</div>
				
				<div class="formElement formSide formRight">
					<label for="lastName">LAST NAME*</label>
					<br>
					<input type="text" id="lastName" name="lastName" onfocus="inputFocus(this)" onblur="inputBlur(this)"> <!--maxlength="25", required-->
				</div>
				
				<div class="formElement">
					<label for="email">EMAIL ADDRESS*</label>
					<br>
					<input type="text" id="email" name="email" onfocus="inputFocus(this)" onblur="inputBlur(this)"> <!--type="email", required-->
				</div>
				
				<div class="formElement">
					<label for="subject">SUBJECT*</label>
					<br>
					<input type="text" id="subject" name="subject" onfocus="inputFocus(this)" onblur="inputBlur(this)">
				</div>
				
				<fieldset>
					<legend>Address</legend>
						<div class="formElement">
							<label for="streetAddress">STREET ADDRESS*</label>
							<br>
							<input type="text" id="streetAddress" name="streetAddress" onfocus="inputFocus(this)" onblur="inputBlur(this)">  <!--maxlength="40", required-->
						</div>
						
						<div class="formElement">
							<label for="cityTown">CITY/TOWN*</label>
							<br>
							<input type="text" id="cityTown" name="cityTown" onfocus="inputFocus(this)" onblur="inputBlur(this)">  <!--maxlength="20", required-->
						</div>
						
						<div class="formElement formSide">
							<label for="state">STATE*</label>
							<br>
							<select id="state" name="state" onfocus="selectFocus(this)">
								<option value="none">Select State</option>
								<option>Johor</option>
								<option>Kedah</option>
								<option>Kelantan</option>
								<option>Kuala Lumpur</option>
								<option>Labuan</option>
								<option>Malacca</option>
								<option>Negeri Sembilan</option>
								<option>Pahang</option>
								<option>Perak</option>
								<option>Perlis</option>
								<option>Penang</option>
								<option>Putrajaya</option>
								<option>Sabah</option>
								<option>Sarawak</option>
								<option>Selangor</option>
								<option>Terengganu</option>
							</select>
						</div>
						
						<div class="formElement formSide formRight">
							<label for="postcode">POSTCODE*</label>
							<br>
							<input type="text" id="postcode" name="postcode" onfocus="inputFocus(this)" onblur="inputBlur(this)">  <!--pattern="[0-9]{5}", required-->
						</div>
				</fieldset>

				<div class="formElement">
					<label for="phoneNumber">PHONE NUMBER*</label>
					<br>
					<input type="text" id="phoneNumber" name="phoneNumber" placeholder="0123456789" onfocus="inputFocus(this)" onblur="inputBlur(this)"> <!--maxlength="10", required-->
				</div>
				
				<div class="formElement">
					<label for="product">PRODUCT*</label>
					<br>
					<select id="product" name="product" onchange="subjectChange()" onfocus="selectFocus(this)">
						<option value="none">Select Product</option>
						<?php
							require_once "settings.php";
				
							// Create connection
							$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
						
							if ($conn)
							{
								$query = "SELECT productname FROM productTable";
								$result = mysqli_query($conn, $query);
							
								if ($result && $result->num_rows > 0)
								{
									while ($row = $result->fetch_assoc())
									{
										echo "<option>" . $row["productname"] . "</option>";
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
				</div>
				
				<div class="formElement">
					<label for="comment">COMMENT</label>
					<br>
					<textarea name="comment" id="comment"></textarea>
				</div>
				
				<input type="reset" value="Reset">
				
				<input type="submit" value="Submit">
			</form>
		</article>
		
		<?php include_once("page_footer.php");?>
	</body>
</html>