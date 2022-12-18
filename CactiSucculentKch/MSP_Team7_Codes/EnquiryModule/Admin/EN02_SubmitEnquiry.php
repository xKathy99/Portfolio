<!DOCTYPE html>
<html>

	<head>
		<title>Reply Enquiries</title>
		<?php include '../../includefile/homeheader.php';?>
		
		<link rel="stylesheet" href="EnquiryModule_style.css">
	</head>
	
	
	
	<body>
	
		<header>
			<p> HEADER </p>
		</header>
		
		
		<div class="div_container">
			<article class="article_enquiry">
				<h1>Reply Enquiry</h1>
				
				<section class = "section_enquiries">
				
					<div class = "div_equiry_form">
			
						<form action="EnquiryDB.php" method="post">
								<label for="enquiryform_title">UserId: </label>
								<input type="text" value="<?php echo $_REQUEST['id'] ?>" readonly id="enquiryform_id" name="enquiryform_id">
								<br><br>
								
								<label for="enquiryform_title">Subject: </label>
								<input type="text" id="enquiryform_title" name="enquiryform_title">
								<br><br>
								
								<label for="enquiryform_details">Reply Details: </label>
								<textarea id="enquiryform_details" name="enquiryform_details" rows="4"> </textarea>
								<br><br>
								
								<div class="div_button">
									<button type="submit" class="button_green" name="enquiryform_submit">SUBMIT Reply</button>												
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
