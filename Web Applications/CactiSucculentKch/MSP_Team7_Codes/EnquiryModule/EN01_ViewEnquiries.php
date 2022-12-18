<!DOCTYPE html>
<html>

	<head>
		<title>EN01 View Enquiries</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="EnquiryModule_style.css">
	</head>
	
	<body>
		<!-- <form > -->
			<div class="div_container">
			<article class="article_enquiry">
					<div class="div_left">
						<h1>FAQ/Enquiries</h1>
					</div>
					
					<div class="div_right">
						<div class="div_button">
							<a href="../EnquiryModule/EN02_SubmitEnquiry.php"><button type="button" class="button_green">ADD AN ENQUIRY</button></a>										
						</div>
					</div>
				
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
				
				<section class = "section_enquiries">
				
				<?php
					$user = 'root';
					$pass = '';
					$db = 'forenquiry';		
					// Database Connection
					$conn = new mysqli('localhost', $user, $pass, $db);
					
					if($conn->connect_error)
					{
						die('Connection Failed: '.$conn->connect_error);
					}
					
					else
					{						
						//$stmt = $conn->prepare("SELECT * FROM enquirytable");
						
						$result = $conn->query("SELECT * FROM enquirytable");
						
						
						if ($result->num_rows > 0)
						{
  						// output data of each row
							while($row = $result->fetch_assoc())
							{
								echo '<div class= "div_each_enquiry">';
								echo "Enquiry ID: ", $row["enquiryID"], "<br>";
								echo "Posted by (Customer ID): ",  $row["customerID"], "<br>";
								echo "<h2>".$row["enquirySubject"]."</h2>";
								echo substr($row["enquiryDetails"], 0, 80)."...". "<br>"; // Display first 80 char only
								//echo
								//	'<div class="div_button">
									//	<button type="submit" class="button_green" onClick="window.open("EN03_ViewThread.php?id=',$row["enquiryID"],')" >VIEW THREAD</button>												
									//</div>';
						?>
								<div class="div_button">
									<button type="submit" class="button_green"
									onClick="window.open('EN03_ViewThread.php?id=<?php echo $row["enquiryID"]; ?>', '_self')">VIEW THREAD</button>												
								</div>
							
						<?php
								echo '</div>';
								
							}
						}
						
						else
						{
							echo "No enquiries yet! Be the first to submit one :)";
						}
					}
					
					$conn->close();
				?>
				<!--
					<div class= "div_each_enquiry">
					
						<h2>Title</h2>
						<p>Enquiry details</p>
						<p>Posted by</p>
							
						<div class="div_button">
							<button type="submit" class="button_green">VIEW THREAD</button>												
						</div>
					</div>
					
					
				
					<div class= "div_each_enquiry">
					
						<h2>Title</h2>
						<p>Enquiry details</p>
						<p>Posted by</p>
							
						<div class="div_button">
							<button type="submit" class="button_green">VIEW THREAD</button>												
						</div>
					</div>
					-->
				</section>
			</article>
			</div>
		<!-- </form> -->
		
		<footer>
			<p> FOOTER </p>
		</footer>
		
		<!-- <script>
			function Change(url){
				window.href = "EN03_ViewThread.php?id=" + url;
			}				
		
		</script> -->
	</body>
	
</html> 

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>