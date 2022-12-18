<!DOCTYPE html>
<html>

	<head>
		<title>EN02 Submit Enquiries</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="EnquiryModule_style.css">
	
	</head>
	
	<body>
		<br>
		<br>
		<br>
		<br>
		<br>
		<div class="div_container">
			<article class="article_enquiry">
				<h1>Add an Enquiry</h1>
				
				<section class = "section_enquiries">
				
					<div class = "div_equiry_form">
			
						<form action="EnquiryDB.php" method="post">
								<label for="enquiryform_title">Subject: </label>
								<input type="text" id="enquiryform_title" name="enquiryform_title">
								<br><br>
								
								<label for="enquiryform_details">Details: </label>
								<textarea id="enquiryform_details" name="enquiryform_details" rows="4"> </textarea>
								<br><br>
								
								<div class="div_button">
									<button type="submit" class="button_green" name="enquiryform_submit">SUBMIT ENQUIRY</button>												
								</div>
						</form>
						</div>
				</section>
			</article>
		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>
		
	</body>
	
</html> 

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>