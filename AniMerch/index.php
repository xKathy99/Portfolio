<?php
	require_once "database.php";
	
	createDB();
	createProductTable();
	defaultProductTable();
	createEnquiryTable();
?>

<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<meta name="author" content="Raymond Ngo Wei Kiat">
	<meta name="description" content="Homepage">
	<meta name="keywords" content="AniMerch, Homepage">
	<script src="script/script.js"></script>
	<script src="script/enhancement.js"></script>
	<title>AniMerch - Homepage</title>
</head>

<body onload="highlightCurrentPage()">
	
	<?php include_once("page_header.php");?>
	
	<?php include_once("page_menu.php");?>
		
	<!--Slideshow, made by Raymond Ngo-->
	<div class="bannerContainer">
		<div class="banner fade">
			<div class="numbertext">1 / 3</div>
			<img class="s_img" src="images/slide1.jpg">
		</div>

		<div class="banner fade">
			<div class="numbertext">2 / 3</div>
			<img class="s_img" src="images/slide2.jpg">
		</div>

		<div class="banner fade">
			<div class="numbertext">3 / 3</div>
			<img class="s_img" src="images/slide3.jpg">
		</div>
	</div>

	<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
	<a class="next" onclick="plusSlides(1)">&#10095;</a>
	
	<div class="dotorder">
		<span class="dot" onclick="currentSlide(1)"></span> 
		<span class="dot" onclick="currentSlide(2)"></span> 
		<span class="dot" onclick="currentSlide(3)"></span> 
	</div>
		
	<article>
		<br><br><br><br>
		<h1 class="collection">Fate/Stay Night: Heaven's Feel Collaboration</h1>
			<div id="FSNHF">
				<p>In conjunction of the upcoming <em>Fate/Stay Night: Heaven's Feel III. spring song</em> movie, there would be a campaign in AniMerch in which special figures are featured.
				As the last movie of the trilogy approaches, what better way to appreciate the characters by getting their figures? Here is the trailer for the upcoming movie:</p>
				<iframe src="https://www.youtube.com/embed/GTA20VJeyYk?autoplay=1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
			
			<?php
				require_once "settings.php";
				
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				
				if ($conn)
				{
					$query = "SELECT id, productname, imagelink FROM productTable WHERE category ='1'";
					
					$result = mysqli_query($conn, $query);
					
					if ($result && $result->num_rows > 0)
					{
						$product_num = 0;
						echo "<div class='collection_img'>";
						
						while ($row = $result->fetch_assoc())
						{
							if ($product_num >= 4)
							{
								break;
							}
							echo "<div class='box'>";
							echo "<img src='" . $row["imagelink"] . "' alt='" .
							$row["productname"] . "' class='collection_merch'>";
							echo "<div class='cover'>";
							echo "<div class='text'><a href='product1.php#" . 
							$row["id"] . "' targer='_blank'>Details</a></div>";
							echo "</div></div>";
							$product_num += 1;
						}
					}
				}
			?>
			
		<br><br><br><br>
		<h1 class="collection">Model Kits</h1>
		<br><br><br>
			<?php
				require_once "settings.php";
				
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				
				if ($conn)
				{
					$query = "SELECT id, productname, imagelink FROM productTable WHERE category ='3'";
					
					$result = mysqli_query($conn, $query);
					
					if ($result && $result->num_rows > 0)
					{
						$product_num = 0;
						echo "<div class='collection_img'>";
						
						while ($row = $result->fetch_assoc())
						{
							if ($product_num >= 4)
							{
								break;
							}
							echo "<div class='box'>";
							echo "<img src='" . $row["imagelink"] . "' alt='" .
							$row["productname"] . "' class='collection_merch'>";
							echo "<div class='cover'>";
							echo "<div class='text'><a href='product3.php#" . 
							$row["id"] . "' targer='_blank'>Details</a></div>";
							echo "</div></div>";
							$product_num += 1;
						}
					}
				}
			?>
			
		<br><br><br>
		<h1 class="collection">Nendoroids</h1>
		<br><br><br>
			<?php
				require_once "settings.php";
				
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				
				if ($conn)
				{
					$query = "SELECT id, productname, imagelink FROM productTable WHERE category ='2'";
					
					$result = mysqli_query($conn, $query);
					
					if ($result && $result->num_rows > 0)
					{
						$product_num = 0;
						echo "<div class='collection_img'>";
						
						while ($row = $result->fetch_assoc())
						{
							if ($product_num >= 4)
							{
								break;
							}
							echo "<div class='box'>";
							echo "<img src='" . $row["imagelink"] . "' alt='" .
							$row["productname"] . "' class='collection_merch'>";
							echo "<div class='cover'>";
							echo "<div class='text'><a href='product2.php#" . 
							$row["id"] . "' targer='_blank'>Details</a></div>";
							echo "</div></div>";
							$product_num += 1;
						}
					}
				}
			?>
		<br><br><br>
	</article>
	
	<br>
		
		<?php include_once("page_footer.php");?>
		
	</body>
</html>