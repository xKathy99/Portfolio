<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	include_once '../LoginModule/createDB2.php';
	session_start();
	$connection = mysqli_connect($server_name, $user_name, $password, $dbname);
	if (!$connection) {
		die("Failed ". mysqli_connect_error());
	}
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 


<!DOCTYPE html>
<html>

	<head>
		<title>RE01_MostCrowdedSeason</title>
		<link rel="stylesheet" href="ReportingModule_style.css">
	</head>
	
	
	
	<body>
	
		<header>
			<p> HEADER </p>
		</header>
		
		
		
		<div class="div_container_reporting">
		


			<form action="action_page.php" method="post">

				<h1>REPORTING: <br>Most Crowded Season</h1>
				
				<div class="div_center_reporting">
				<p>Show top 5 most crowded days
				
				<!--
				<select name = "dropdown_datemonth">
					<option value = "date">Day</option>
					<option value = "month">Month</option>
				</select>
				-->
				
				in the
				

				<select name ="dropdown_monthyear" id ="dropdown_monthyear" onChange="update_monthyear()">
					<option value = "month" selected>Month</option>
					<option value = "year">Year</option>
				</select>
				
				<div id="div_updatechoice_monthyear">
				<select name = "dropdown_months" id="dropdown_months" onChange="this.form.submit()">
						<option value="">--- Choose month ---</option>
						<option value = "jan">January</option>
						<option value = "feb">February</option>
						<option value = "march">March</option>
						<option value = "apr">April</option>
						<option value = "may">May</option>
						<option value = "jun">June</option>
						<option value = "jul">July</option>
						<option value = "aug">August</option>
						<option value = "sept">September</option>
						<option value = "oct">October</option>
						<option value = "nov">November</option>
						<option value = "dec">December</option>
					</select> </p>
					<input type="hidden" name="dropdown_years" value=0>
				</div>
								
				<!--
				<select name = "dropdown_year">
					<option value = "2018">2018</option>
					<option value = "2019">2019</option>
					<option value = "2020">2020</option>
					<option value = "2021">2021</option>
					<option value = "2022">2022</option>
				</select></p>
				-->
				</div>
				
				<table id="table_mostcrowdedseason">
<?php 
// session_start();

echo $_SESSION['pickedMonth'];
?>
					<tr>
						<th><?php echo "Month: ".$_SESSION['pickedMonth']?></th>
						<th>Booked Amount</th>
					</tr>

<?php


foreach($_SESSION['topFiveDay'] as $key => $value){
	echo "
	<tr>
		<td>$key</th>
		<td>$value</th>
	</tr>
	";
}



?>


				</table>
			</form>

			<a href="RE02_VisitorPattern.php">
                <button type="button" class="button_green">
                    VIEW VISITOR PATTERN
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
		
		<script type="text/javascript">
			
			function update_monthyear()
			{
				var target_select = document.getElementById('dropdown_monthyear');
				var target_option = target_select.options[target_select.selectedIndex];

				var chosen_option = target_option.value;
				console.log(chosen_option);
						
				if (chosen_option=='month')
				{
					var x = 
					'<select name = "dropdown_months" id="dropdown_months" onChange="this.form.submit()">' +
						'<option value="">--- Choose month ---</option>' +
						'<option value = "jan">January</option>' +
						'<option value = "feb">February</option>' +
						'<option value = "march">March</option>' +
						'<option value = "apr">April</option>' +
						'<option value = "may">May</option>' +
						'<option value = "jun">June</option>' +
						'<option value = "jul">July</option>' +
						'<option value = "aug">August</option>' +
						'<option value = "sept">September</option>' +
						'<option value = "oct">October</option>' +
						'<option value = "nov">November</option>' +
						'<option value = "dec">December</option>' +
					'</select> </p>' +
					'<input type="hidden" name="dropdown_years" value=0>'
					;


					document.getElementById("div_updatechoice_monthyear").innerHTML = "of <br>" + x;
				}
				
				else if (chosen_option=='year')
				{
					var x = 
					'<select name ="dropdown_years" id="dropdown_years" onChange="this.form.submit()">' +
						'<option value="">--- Choose year ---</option>' +
						'<option value = "2018">2018</option>' +
						'<option value = "2019">2019</option>' +
						'<option value = "2020">2020</option>' +
						'<option value = "2021">2021</option>' +
						'<option value = "2022">2022</option>' +
					'</select> </p>' +
					'<input type="hidden" name="dropdown_months" value=0>'
					;
					document.getElementById("div_updatechoice_monthyear").innerHTML = "of <br>" + x;
				}
				
				else
				{
					document.getElementById("div_updatechoice_monthyear").innerHTML = "";
				}

				this
			}
		</script>
		
		
		
		
	</body>
	
</html> 
















<?php

mysqli_close($connection);
?>



<?php

echo "<script src='../notification_module/public/notification_page.js'></script>";
echo "<script src='../notification_module/public/ajax.js'></script>";
include_once('../notification_module/public/popUp.php');

?>