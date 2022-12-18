<!DOCTYPE html>

<html lang="en">

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<meta name="author" content="Jake Chieng, Kathy Wong">
		<meta name="description" content="Enhancement page">
		<meta name="keywords" content="Enhancement">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Enhancement</title>
	</head>
	
	<body>
		
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>

		<article class="container">
			<h1>Enhancement</h1>
			<section>
				<a target="_blank" href="index.php#FSNHF"><h2>Embedded YouTube Video</h2></a>
				<p>In the homepage, a YouTube video that shows the trailer of the upcoming Fate/Stay Night: Heaven's Feel III. spring song is embedded. By embedding
				this video, the user is able to understand that the collaboration is based on the upcoming movie. Besides, it is not taught in tutorial or lecture.</p>
				<p>This technique is beyond the basic requirement needed for a anime merchandise website as usually only when having a campaign, then additional
				content such video is added into the homepage.</p>
				<p>To implement this feature, the iframe tag is used with src attribute linking to the video. To autoplay the video upon visiting the website,
				"?autoplay" is added in the url link. In main.css, the width and height is set for the frame.</p>
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://support.google.com/youtube/answer/171780?hl=en"><p>Embed videos and playlists</p></a></li>
					<li><a target="_blank" href="https://www.w3schools.com/html/html_youtube.asp"><p>HTML YouTube Video</p></a></li>
				</ul>
			</section>
			
			<section>
				<a target="_blank" href="aboutme4.php#google_map_enhance"><h2>Embedded Google Map</h2></a>
				<p>In each of the students' About Me pages, there is a map embedded in the Aside (right side). This map shows the supposed location of the company's (AniMerch Co.) 
				current base of operations. The location for Swinburne Sarawak University of Technology was used. This specific enhancement was not mentioned nor taught,
				current base of operations. The location for Swinburne Sarawak University of Technology was used. This specific enhancement was not mentioned nor taught,
				but it can be easily learnt online.</p>
				<p>This enhancement goes beyond the basic requirements of the assignment because for a webpage selling anime merchandise, a Google Map is technically unneeded.
				<br/>
				<br/>
				However, the students had decided it would be a good idea to add more information regarding the company (opening and closing time, company contact
				information and address), and what more better place to put these information but as an Aside in the About Me pages for the students' profile?
				<br/>
				<br/>
				To justify the need for the use of this enhancement: it would be more convenient for the user navigating the webpage to see
				where the current base of operation of AniMerch Co. is located, without having to pull up another webpage just to Google the company's whereabouts.
				</p>
				<p>In order for this feature to be implemented, first the location of Swinburne Sarawak is searched on Google Map. Then, by choosing to share the location using
				embedding, the iframe code is copied and pasted into the students' .html page. Then, in main.css, the aspect ratio of the map and its size is done, 
				instead of writing inline css in the .html file.
				</p>
				<p>Now the web users can conveniently see the current location of Swinburne Sarawak without having to navigate out the page.
				</p>
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://www.ostraining.com/blog/coding/responsive-google-maps/"><p>Creating Responsive Maps on Any Website</p></a></li>
					<li><a target="_blank" href="https://www.labnol.org/internet/embed-responsive-google-maps/28333/"><p>How to Make Google Maps Embeds Responsive</p></a></li>
				</ul>
			</section>
			
			
			<section>
				<a target="_blank" href="index.php"><h2>Dropdown Menu: Using Lists Method</h2></a>
				<p>In the Navigation bar, the students have added an enhancement for drop-down menu to appear when hovering over a link.</p>
				<p>This enhancement goes beyond the basic requirements of the assignment technically it is not required. A navigation bar with all its links listed down 
				(from Products 1 to 4, and student's About Me 1 to 4) would have served the same purpose.</p>
				<br/>
				<br/>
				<p>
				However, having a drop-down menu would have been a good enhancement as it only reveals the links if the user is interested in that certain category (i.e: 
				Products-- for each product page, or Profile-- for each student's page).
				</p>
				<p>While not taught during class, what the students learnt during Lab 3 (Intro to CSS) can easily be implemented and advanced through this enhancement.</p>
				<p>In order for this feature to be implemented:</p>
					<ol>
						<li>First, a list is made with the following list items: Home, Products, Profile, and Contact Us</li>
						<li>Next, another list is nested within the first list, containing the links to each product and student profile page</li>
						<li>After that, it will be all manipulation through .css</li>
						<li>In main.css, all the list items are set to be inline with each other (This was learnt in Lab 3)</li>
						<li>The nested loops are then made to not display as a default</li>
						<li>Only upon hovering on the link (for example, Products), the nested list is displayed as a block</li>
						<li>Other styles are added such as changing the background color of the link upon hover, and also adding a box-shadow for aesthetic purposes only</li>
					</ol>
				<p>It can be said that this prevents the Navigation Bar from being cluttered with too many links at one time, unless required.
				</p>
				<p>References:</p>
				<ul>
					<li><a target="_blank" href="https://css-tricks.com/solved-with-css-dropdown-menus/"><p>Solved with CSS! Dropdown Menus</p></a></li>
					<li><a target="_blank" href="https://htmldog.com/techniques/dropdowns/"><p>CSS Dropdowns</p></a>
						<ul>
							<li><a target="_blank" href="https://htmldog.com/examples/dropdowns1/">Example 1</a></li>
							<li><a target="_blank" href="https://htmldog.com/examples/dropdowns2/">Example 2</a></li>
							<li><a target="_blank" href="https://htmldog.com/examples/dropdowns3/">Example 3</a></li>
						</ul>
					</li>	
				</ul>
			</section>
			
		</article>
		
		<?php include_once("page_footer.php");?>
		
	</body>
</html>