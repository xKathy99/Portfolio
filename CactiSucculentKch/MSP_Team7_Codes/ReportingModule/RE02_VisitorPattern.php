<!DOCTYPE html>
<html>

	<head>
		<title>RE02_VisitorPattern</title>
		<link rel="stylesheet" href="ReportingModule_style.css">
	</head>
	
	
	
	<body>
	
		<header>
			<p> HEADER </p>
		</header>
		
		
		<div class="div_container_reporting">

		
			<form method="post" action="RE04_ResultVisitorPattern.php" >
				<h1>REPORTING: <br>Visitor Pattern</h1>
				
				<div class="div_center_reporting">
				<p>Show top 5 time slots with most visitors in the year
				<select name = "mostVisitedTime" onchange="this.form.submit()">
					<option value = "2018">2018</option>
					<option value = "2019">2019</option>
					<option value = "2020">2020</option>
					<option value = "2021">2021</option>
					<option value = "2022">2022</option>
				</select></p>
				</div>
				
				<table id="table_visitorpattern">
				  <tr>
					<th>Time</th>
					<th>Average Number of Visitors</th>
				  </tr>
				  <tr>
					<td>Time1</td>
					<td>Avg No. Visitors</td>
				  </tr>
				  <tr>
					<td>Time2</td>
					<td>Avg No. Visitors</td>
				  </tr>
				  <tr>
					<td>Time3</td>
					<td>Avg No. Visitors</td>
				  </tr>
				  <tr>
					<td>Time4</td>
					<td>Avg No. Visitors</td>
				  </tr>
				  <tr>
					<td>Time5</td>
					<td>Avg No. Visitors</td>
				  </tr>
				</table>
			</form>

			<a href="RE01_MostCrowdedSeason.php">
                <button type="button" class="button_green">
                    VIEW REPORTING MODULE
                </button>
            </a>

			<a href="../HomeModule/adminreport.php">
                <button type="button" class="button_red">
                    ADMIN HOMEPAGE
                </button>
            </a>

		</div>
		
		<footer>
			<p> FOOTER </p>
		</footer>
		
	</body>
	
</html> 

<?php

echo "<script src='../notification_module/public/notification_page.js'></script>";
echo "<script src='../notification_module/public/ajax.js'></script>";
include_once('../notification_module/public/popUp.php');

?>