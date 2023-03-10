<!DOCTYPE html>

<html lang="en">

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<meta name="author" content="Jake Chieng, Kathy Wong">
		<meta name="description" content="Enhancement page for JS">
		<meta name="keywords" content="Enhancement, JS">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Enhancement for JavaScript</title>
	</head>
	
	<body>
		
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
		
		<article class="container">
			<h1>Enhancement</h1>
			<section>
				<a target="_blank" href="confirm.php"><h2>Preview Page</h2></a>
				<p>To allow users to check their input, a preview page is added. After submitting the enquiry form, users are redirected to confirm.html in which
				their inputs are shown. Users can choose to confirm their submission by pressing the confirm submimt button or to cancel the </p>
				<p>To trigger get to the preview page, user would have to first fill up the required fields in enquiry.html then press the submit button.</p>
				<p>To implement this feature, sessionStorage is used to store the input values from enquiry.html then transfer them onto confirm.html</p>
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://www.w3schools.com/jsref/prop_win_sessionstorage.asp"><p>Window sessionStorage Property</p></a></li>
				</ul>
			</section>
			
			<section>
				<a target="_blank" href="index.php"><h2>Highlighting Current Page on Navigation Bar Using JavaScript</h2></a>
				<p>In the Navigation bar, the students have added an enhancement to highlight the current page on the menu.</p>
				<p>This enhancement goes beyond the basic requirements of the assignment and it is something extra.
				However, it does contribute to better usability and user experience because the web user can easily identify what page they are on, 
				by just glancing at the navigation menu.
				</p>
				<p>In order for this feature to be implemented:</p>
					<ol>
						<li>In the .js file, the object document.location obtains the current page URL and stores it into a variable hrefString.</li>
						<li>Then, the URL is split to be stored into an array.</li>
						<li>The .js code goes through the links in the navigation menu gets gets each link and compares it  with the current page URL.</li>
						<li>If the links match, then JavaScript would apply a class 'current' from .css to the link.</li>
						<li>In the .css file, all elements assigned to this class ???current??? are set with properties 
							that would make the button on the menu look like it is being highlighted (most notably, setting a different background-color
							compared to the color of the navigation bar.</li>
					</ol>
				
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://www.media-division.com/automatically_highlight_current_page_in/">
					<p>Automatically Highlight Current Page in Menu via Javascript</p></a></li>
				</ul>
			</section>
			
			
			<section>
				<a target="_blank" href="index.php"><h2>Slideshow</h2></a>
				<p>In the homepage, the first thing that user see is the banner of the homepage.</p>
				<p>User can directly see what event or sales is having in our website.</p>
				<p>The arrows and dots around the banner also can help to guide the user.</p>
				<p>
				A slideshow banner can let user to have a first look in our website.
				</p>
				<p>In order for this feature to be implemented:</p>
					<ol>
						<li>First, give each slide image a variable and create arrow also dots to control the images.</li>
						<li>Next, let the slide change when user click on the arrow and dots based on the variable in .js.</li>
						<li>In main .css, create transition effect when slide change.</li>
						<li>Arrow and dots color also will change when hover is on it.</li>
					</ol>
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://www.w3schools.com/howto/howto_js_slideshow.asp"><p>How To Create A Slideshow</p></a></li>
					<li><a target="_blank" href="https://www.youtube.com/watch?v=4YQ4svkETS0"><p>Simple JavaScript Slideshow in 5 Minutes</p></a>
					</li>	
				</ul>
			</section>
			
		</article>
		
		<?php include_once("page_footer.php");?>
		
	</body>
</html>