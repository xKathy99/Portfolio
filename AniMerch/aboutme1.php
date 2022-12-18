<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
		<link href="styles/style.css" type="text/css" rel="stylesheet"/>
		<meta name="author" content="Jake Chieng">
		<meta name="description" content="About Jake">
		<meta name="keywords" content="About Me">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
        <title>Meet Jake!</title>
    </head>


	<body>
		
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>

	<section class="page_cont">
		<div class="profileContainer">
			<img class="profileImage" src="images/jake.jpeg" alt="Jake" title="Jake Chieng Zen Yan">
			
			<h2 class="name">Jake Chieng Zen Yan</h2>

			<p class="number">My Student ID is 100083551</p>

			<p class="course">I am a third year student of Swinburne University of Technology Sarawak Campus, who is pursuing Bachelor of Engineering (Robotics and Mechatronics) (Honours) / Bachelor of Computer Science.</p>

			<p class="hometown">I'm from <b>Kuching, Sarawak</b>, the place where people are all about the local food. Speaking of which, I miss going out for food.</p>

			<p class="hobbies">I enjoy <b>gaming, reading, watching anime, videos</b>, basically <b>entertainment</b>. At this point, I enjoy even <em>human interactions</em> because of the movement restriction.</p>

			<p class="interests">Currently interested in <strong>learning how to lead a group</strong> because I am no good at it.</p>
        
			<table class="profileTable">
				<tr>
					<th>Contribution</th>
					<th>Details</th>
				</tr>
				<tr>
					<td>Leader</td>
					<td>Distributing task, editing and compiling webpages.</td>
				</tr>
				<tr>
					<td>Enquiry page and Disclaimer</td>
					<td>Made the "Contact Us" page and the disclaimer page</td>
				</tr>
				<tr>
					<td>Fate/Stay Night: Heaven's Feel Collaboration</td>
					<td>Find the content and embed the video.</td>
				</tr>
			</table>

		<div class="profileFooter">
			<p>You are welcome to email me for more enquiries at:</p>
			<p><a href="mailto:100083551@students.swinburne.edu.my">100083551@students.swinburne.edu.my</a></p>
		</div>
		</div>
		
	<?php include_once("aboutme_aside.php");?>

	</section>
		
	<?php include_once("page_footer.php");?>
		
	</body>
</html>