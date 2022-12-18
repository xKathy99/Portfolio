<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 
<?php
	include_once '../LoginModule/createDB2.php';

	$connection = mysqli_connect($server_name, $user_name, $password, $dbname);
	if (!$connection) {
		die("Failed ". mysqli_connect_error());
	}

	
    $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
    $result = mysqli_query($connection, $sql);

    if(mysqli_num_rows($result)>0){

        $total_booked_amount['09:00:00'] = 0;
        $total_booked_amount['11:00:00'] = 0;
        $total_booked_amount['13:00:00'] = 0;
        $total_booked_amount['15:00:00'] = 0;
        $total_booked_amount['17:00:00'] = 0;    

        $total_numberofpeople['09:00:00'] = 0;
        $total_numberofpeople['11:00:00'] = 0;
        $total_numberofpeople['13:00:00'] = 0;
        $total_numberofpeople['15:00:00'] = 0;
        $total_numberofpeople['17:00:00'] = 0;    


        while($row=mysqli_fetch_array($result)){

            $timestamp = strtotime($row['appointmentDate']); // return year from appointmentDate 
            $yearFormat = date('Y', $timestamp); // 2018 / 2019 / 2020

            if($yearFormat == $_POST['mostVisitedTime']){

                foreach($total_booked_amount as $key => $value){
    
                    if($row['availableSlotFrom']==$key){
                        $total_booked_amount[$key]++;
                    }
    
                }

                foreach($total_numberofpeople as $key => $value){
    
                    if($row['availableSlotFrom']==$key){
                        $total_numberofpeople[$key]+=$row['bookform_numberofpeople'];
                    }
                }
            
            }
            
        }

        $array_booked_amount = [0,0,0,0,0];
        $array_numberofpeople = [0,0,0,0,0];
        $average_visitors = [
            "09:00:00 - 11:00:00" => 0,
            "11:00:00 - 13:00:00" => 0,
            "13:00:00 - 15:00:00" => 0,
            "15:00:00 - 17:00:00" => 0,
            "17:00:00 - 19:00:00" => 0];

        $i = 0;
        foreach($total_booked_amount as $key => $value){
            $array_booked_amount[$i]=$value;
            $i++;
        }

        $i = 0;
        foreach($total_numberofpeople as $key => $value){
            $array_numberofpeople[$i]=$value;
            $i++;
        }

        $i = 0;

        foreach($average_visitors as $key => $value){
            
            if($array_booked_amount[$i] != 0){
                $average_visitors[$key] = $array_booked_amount[$i]/$array_numberofpeople[$i];
            }
            $i++;
        }        
	}
?>
<!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> <!-- --> 



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
<?php

	switch($_POST['mostVisitedTime']){
		case "2018":
			echo '				
			<option value = "2018" selected>2018</option>
			<option value = "2019">2019</option>
			<option value = "2020">2020</option>
			<option value = "2021">2021</option>
			<option value = "2022">2022</option>
			';
			break; 
		case "2019":
			echo '				
			<option value = "2018">2018</option>
			<option value = "2019" selected>2019</option>
			<option value = "2020">2020</option>
			<option value = "2021">2021</option>
			<option value = "2022">2022</option>
			';
			break; 
		case "2020":
			echo '				
			<option value = "2018">2018</option>
			<option value = "2019">2019</option>
			<option value = "2020" selected>2020</option>
			<option value = "2021">2021</option>
			<option value = "2022">2022</option>
			';
			break; 
		case "2021":
			echo '				
			<option value = "2018">2018</option>
			<option value = "2019">2019</option>
			<option value = "2020">2020</option>
			<option value = "2021"selected>2021</option>
			<option value = "2022">2022</option>
			';
			break; 
		case "2022":
			echo '				
			<option value = "2018">2018</option>
			<option value = "2019">2019</option>
			<option value = "2020">2020</option>
			<option value = "2021">2021</option>
			<option value = "2022"selected>2022</option>
			';
			break; 
		default:
			echo "Something went wrong!";
		}
?>

				</select></p>
				</div>
				
				<table id="table_visitorpattern">
					<tr>
						<th>Time</th>
						<th>Booked Amount:</th>
						<th>Number of People:</th>
						<th>Average Number of Visitors</th>
					</tr>

<?php 
// session_start();

// $_SESSION['array_booked_amount'][$i];
// $_SESSION['array_numberofpeople'][$i];

$i = 0;




foreach($average_visitors as $key => $value){
	// echo "average_visitors: $key - $value<br>";
	// echo $_SESSION['array_booked_amount'][$i]."<br>";
	// echo $_SESSION['array_numberofpeople'][$i]."<br>";
?>

	<tr>
		<td>Time: <?php echo $key?></td>
		<td>Amount: <?php echo $array_booked_amount[$i]?></td>
		<td>Total: <?php echo $array_numberofpeople[$i]?></td>
		<td>Avg No. Visitors: <?php echo $value?></td>
	</tr>

<?php
	$i++;
}

?>

				</table>
			</form>

			<a href="RE01_MostCrowdedSeason.php">
                <button type="button" class="button_green">
                    VIEW MOST CROWDED SEASON
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