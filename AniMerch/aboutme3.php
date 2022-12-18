<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="UTF-8">
		<link href="styles/style.css" type="text/css" rel="stylesheet"/>
		<meta name="author" content="Raymond Ngo">
		<meta name="description" content="About Raymond">
		<meta name="keywords" content="About Me">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
        <title>Meet Raymond!</title>
    </head>


	<body>
	
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
		
		<section class="page_cont">
			<div class="profileContainer">
			<img class="profileImage" src="images/raymond.jpg" alt="Raymond" title="Raymond Ngo Wei Kiat">
			
			<h2 class="name">Raymond Ngo Wei Kia</h2>

			<p class="number">My Student ID is 101224830</p>

			<p class="course">I am a first year student of Swinburne University of Technology Sarawak Campus, who is pursuing the Bachelor in Computer Science majoring in Software Programming.</p>

			<p class="hometown">I'm from <b>Bintulu, Sarawak</b>.</p>

			<p class="hobbies">I enjoy <b>reading books</b> during my free time.</p>

			<p class="interests">c <strong>Shingeki no Kyojin</strong>.</p>
        
			<table class="profileTable">
				<tr>
					<th>Contribution</th>
					<th>Details</th>
				</tr>
				<tr>
					<td>Content</td>
					<td>Design the structure of homepage and product page.</td>
				</tr>
				<tr>
					<td>Model Kits</td>
					<td>In-charged of finding content for model kits section.</td>
				</tr>
			</table>

		<div class="profileFooter">
			<p>You are welcome to email me for more enquiries at:</p>
			<p><a href="mailto:101224830@students.swinburne.edu.my">101224830@students.swinburne.edu.my</a></p>
		</div>
		</div>
		
		<?php include_once("aboutme_aside.php");?>
		
	</section>
		
		<?php include_once("page_footer.php");?>
		
	</body>
</html>