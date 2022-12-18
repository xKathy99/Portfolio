<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8">
        <link href="styles/style.css" type="text/css" rel="stylesheet"/>
		<meta name="author" content="Natasya">
		<meta name="description" content="About Natasya">
		<meta name="keywords" content="About Me">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Meet Natasya!</title>
    </head>


	<body>
		
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
		
		<section class="page_cont">
			<div class="profileContainer">
				<img class="profileImage" src="images/NatProfile.jpg" alt="me">

			<h2 class="name">Natasya Binti Abdullah</h2>

			<p class="number">My student ID is 101231869</p>

			<p class="course">I am a first year student of Swinburne University of Technology Sarawak Campus, who is pursuing the Bachelor in Information and Communication Technology majoring in Network Technology.</p>

			<p class="hometown">I'm from <b>Kuching, Sarawak</b>.</p>

			<p class="hobbies">I enjoy <b>reading books</b> during my free time.</p>

			<p class="interests">I have an interest in learning <b>Network Technologies</b>. As day goes by, our technology in the world grows fast so therefore, we really need to get ourselves prepared for many kinds of smart technologies coming.</p>
        
			<table class="profileTable">
				<tr>
					<th>Contribution</th>
					<th>Details</th>
				</tr>
				<tr>
					<td>Create profile pages for team members</td>
					<td>Build profile page for every members to introduce themselves in the website.</td>
				</tr>
				<tr>
					<td>Seasonal Special Limited Items</td>
					<td>Find content for the section.</td>
				</tr>
			</table>

			<div class="profileFooter">
				<p>You are welcome to email me for more enquiries at:</p>
				<p><a href="mailto:101231869@students.swinburne.edu.my">101231869@students.swinburne.edu.my</a></p>
			</div>
		</div>
		
		
		<?php include_once("aboutme_aside.php");?>
		
		</section>
		
		<?php include_once("page_footer.php");?>
		
	</body>
</html>