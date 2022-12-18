<!DOCTYPE html>
<html>

	<head>
		<title>EN03 View Thread</title>
		<?php include '../includefile/homeheader.php';?>
		<link rel="stylesheet" href="EnquiryModule_style.css">
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

	</head>
	
	
	
	<body>		
			<?php
				
				session_start();
				
				$user = 'root';
				//error_reporting(0);
				$pass = '';
				$db = 'forenquiry';	
				//echo "Hello world";
		
				// Database Connection
				$conn = new mysqli('localhost', $user, $pass, $db);
				if($conn->connect_error)
				{
					die('Connection Failed: '.$conn->connect_error);
				}
				
				else
				{
					/*
					if ($_GET['id'] != NULL)
					{
						$_SESSION['session_id'] = $_GET['id'];
					}
					 
					$fetched_enquiryid = $_SESSION['session_id'];
					*/
					
					$fetched_enquiryid = $_GET['id'];
					
					$result = $conn->query("SELECT * FROM enquirytable WHERE enquiryID= $fetched_enquiryid");

					$row = $result->fetch_assoc();
					
					echo
					'<div class="div_container">
				
						<section class= "section_enquirythread">';
						
						echo
							'<article class="article_enquiry">';
					
							echo
								'<h1>Enquiry Title: ', $row["enquirySubject"],'</h1>';
						
							echo
								$row["enquiryDetails"];
						
							echo
								'<p>Posted by: ', $row["customerID"], '</p>';

					}
					?>
						<!-- echo
								'-->
					<section class = "section_enquiry_replies">
					<?php
						
						$result_showreplies = $conn->query("SELECT * FROM enquiryreplies WHERE enquiryID=$fetched_enquiryid");

						if ($result_showreplies->num_rows > 0)
						{
							while($replies_row = $result_showreplies->fetch_assoc())
							{
								echo
								'<div class = "div_each_reply">',
											'<h3>', $replies_row["replyCustomerID"], ' says:','</h3>',
											'<p>', $replies_row["replyDetails"], '</p>',
										'</div>';
							}
						}
					
					?>
					</section>
								
								<!--
								<section class = "section_enquiry_replies">
									<div class = "div_each_reply" id= "div_id_each_reply">
										<h3>Username Reply</h3>
										<p>Reply Details</p>
									</div>
								</section>
								-->
							
								<section>
									<div class = "div_reply_enquiry">
										<form action="EnquiryDB.php" method="post">
											<label for="enquiryform_reply">Leave a reply: </label>
											<textarea id="enquiryform_reply" name="enquiryform_reply" rows="2"> </textarea>
										
										
										<div id="div_tohide" style="display: none;">
											<input type="number" name="enquiryform_userdetails" id="div_tohide" value="<?php echo $fetched_enquiryid?>">									
										</div>				
										
										<div class="div_button">
											<button type="submit" class="button_green" name="enquiryform_submitreply"
											onClick="window.open('EnquiryDB.php', '_self')">SUBMIT REPLY</button>												
										</div>
									
										</form>
									</div>
								</section>
							
							</article>
						</section>
			
					</div>
				
				<!--';-->
			<!--}-->

		<!--?>-->
		<footer>
			<p> FOOTER </p>
		</footer>
		
		
		<!--
		
		<script>
			function passIDandComment(passedid)
			{
				alert($("#enquiryform_reply").val())
				$.ajax({
					type: "POST",
					url: "EnquiryDB.php",
					data:{id:passedid, comment:$("#enquiryform_reply").val()},
					success: function(data){
						document.getElementById('div_id_each_reply').innerHTML=data;
					}
					
					//#-> take the whole value from the id
				})
			}
		</script>
		-->
	
	</body>
	
</html> 

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>