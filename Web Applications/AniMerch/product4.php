<?php
	require_once "database.php";
	
	createDB();
	createProductTable();
	defaultProductTable();
?>
<!DOCTYPE html>

<html lang="en">

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<meta name="author" content="Natasya">
		<meta name="description" content="Special Limited Items">
		<meta name="keywords" content="Seasonal, Speacial, Limited">
		<script src="script/script.js"></script>
		<script src="script/enhancement.js"></script>
		<title>Seasonal Special Limited Items</title>
	</head>
	
	<body>
		<?php include_once("page_header.php");?>
	
		<?php include_once("page_menu.php");?>
		
		<article>
			<h1 class="collection">Seasonal Special Limited Items</h1>
			<?php
				require_once "settings.php";
				
				$conn = @mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
				
				if ($conn)
				{
					$query = "SELECT id, productname, source, sourcelink, 
					description, status, price, imagelink 
					FROM productTable WHERE category='4'";
					
					$result = mysqli_query($conn, $query);
					
					if ($result && $result->num_rows > 0)
					{
						$product_num = 0;
						echo "<div class='productContainer'>";
						while ($row = $result->fetch_assoc())
						{
							echo "<div class='productTable' id='" . $row["id"] . "'>";
							echo "<div class='productImage'>";
							echo "<a target='_blank' href='" . $row["imagelink"] . "'>";
							echo "<img src='" . $row["imagelink"] . "' alt='" . 
							$row["productname"] . "' title='" . $row["productname"] . "'>";
							echo "</a></div>";
							
							echo "<div class='description'>";
							echo "<p class='productName'>" . $row["productname"] . "</p>";
							echo "<p class='productSource'>Source: <a href='" . 
							$row["sourcelink"] . "'>" . $row["source"] . "</a></p>";
							echo "<p>" . $row["description"] . "</p></div>";
							
							echo "<div class='details'>";
							echo "<p class='price'>" . $row["status"] . ": " . $row["price"] .
							"</p><br>";
							echo "<a class='formButton submitButton' 
							onclick='transferProductName(" . $product_num . ")'><p>Enquiry</p></a></a>";
							echo "</div></div>";
							
							$product_num += 1;
						}
						echo "</div>";
					}
					else
					{
						echo "0 results";
					}
					
					mysqli_close($conn);
				}
				else
				{
					echo "Unable to connect to the database.";
				}
			?>
		</article>
		
		<?php include_once("page_footer.php");?>
	</body>
</html>