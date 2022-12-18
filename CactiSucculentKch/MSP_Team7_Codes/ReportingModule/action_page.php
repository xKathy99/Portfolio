<?php
session_start();
$server_name = "localhost";
$user_name = "root";
$password = "";
$dbname = "userlogindb";


$conn = mysqli_connect($server_name, $user_name, $password, $dbname);

if (!$conn) {
    die("Failed ". mysqli_connect_error());
}

if(isset($_POST['dropdown_monthyear'])){
    
    $chooseMonth = strtotime($_POST['dropdown_months']);
    $chooseYear = strtotime($_POST['dropdown_years']);

    if($_POST['dropdown_monthyear'] == "month"){ // show most crowded month 
        

        $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
        $result = mysqli_query($conn, $sql);
        
        while($row=mysqli_fetch_array($result)){
            $timestamp = strtotime($row['appointmentDate']);
            $daydb = date('l', $timestamp);
            $monthdb = date('F',$timestamp); 

            echo "$row[appointmentDate] - $daydb - $monthdb <br>";
        }

        $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result)>0){

            $month['January'] = 0;
            $month['Febuary'] = 0;
            $month['March'] = 0;
            $month['April'] = 0;
            $month['May'] = 0;
            $month['June'] = 0;
            $month['July'] = 0;
            $month['August'] = 0;
            $month['September'] = 0;
            $month['October'] = 0;
            $month['November'] = 0;
            $month['December'] = 0;
            $day['Monday'] = 0;
            $day['Tuesday'] = 0;
            $day['Wednesday'] = 0;
            $day['Thursday'] = 0;
            $day['Friday'] = 0;
            $day['Saturday'] = 0;
            $day['Sunday'] = 0;

            $chooseMonthFormat = date('F', $chooseMonth);

            foreach($month as $key => $value) {
                
                if($key == $chooseMonthFormat){

                    while($row=mysqli_fetch_array($result)){
                        $timestamp = strtotime($row['appointmentDate']);

                        $dayFormat = date('l', $timestamp);
                        $monthFormat = date('F',$timestamp); 
                        
                        if($monthFormat == $key){
                            
                            switch($dayFormat){
                                case "Monday":
                                    $day['Monday']++;
                                    break; 
                                case "Tuesday":
                                    $day['Tuesday']++;
                                    break; 
                                case "Wednesday":
                                    $day['Wednesday']++;
                                    break; 
                                case "Thursday":
                                    $day['Thursday']++;
                                    break; 
                                case "Friday":
                                    $day['Friday']++;
                                    break; 
                                case "Saturday":
                                    $day['Saturday']++;
                                    break; 
                                case "Sunday":
                                    $day['Sunday']++;
                                    break; 
                                default:
                                    echo "Something went wrong!";
                            }
                        }
                    }
                }
            }

            
            arsort($day); //reverse array order

            foreach($day as $key => $value){
                echo "Key=" . $key . ", Value=" . $value."<br>";
            }
            echo "<br>";
            
            $topFiveDay = array_slice($day, 0, 5, true); // choose top 5 value in array list

            foreach($topFiveDay as $key => $value){
                echo "Key=" . $key . ", Value=" . $value."<br>";
            }
        
            session_start();
            $_SESSION['pickedMonth'] = $chooseMonthFormat;
            $_SESSION['topFiveDay'] = $topFiveDay;

            // header('location: RE03_Month_MostCrowded.php');
            echo '<script>window.location.href = "RE03_Month_MostCrowded.php";</script>';
        }
 
    }


    if($_POST['dropdown_monthyear'] == "year"){

        $chooseYearFormat = $_POST['dropdown_years'];
        // echo $chooseYearFormat."<br>";

        if($_POST['dropdown_monthyear'] == "year"){ // show most crowded month 
            
            $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
            $result = mysqli_query($conn, $sql);
            
            while($row=mysqli_fetch_array($result)){
                $timestamp = strtotime($row['appointmentDate']);
                $yeardb = date('Y',$timestamp);
                $monthdb = date('F',$timestamp); 
                $daydb = date('l', $timestamp);

                echo "$row[appointmentDate] ===> $yeardb - $monthdb - $daydb<br>";
            }
            
            // echo "Year formated: $yeardb<br>";
            // echo "Month formated: $monthdb<br>";


            $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result)>0){
                
                $month['January'] = 0;
                $month['Febuary'] = 0;
                $month['March'] = 0;
                $month['April'] = 0;
                $month['May'] = 0;
                $month['June'] = 0;
                $month['July'] = 0;
                $month['August'] = 0;
                $month['September'] = 0;
                $month['October'] = 0;
                $month['November'] = 0;
                $month['December'] = 0;

                while($row=mysqli_fetch_array($result)){
                    
                    $timestamp = strtotime($row['appointmentDate']);
                    
                    $yearFormat = date('Y', $timestamp);
                    $monthFormat = date('F',$timestamp); 
    
                    // echo "Year formated: $yearFormat<br>";
                    // echo "chooseYearFormat formated: $chooseYearFormat<br>";
                
                    if($yearFormat == $chooseYearFormat){ // $yearFormat = appointmentDate year

                        echo "appointmentDate: $row[appointmentDate]<br>";
                        echo "monthFormat: $monthFormat<br>";
                        echo "yearFormat: $yearFormat<br>";
                        echo "chooseYearFormat: $chooseYearFormat<br>";
                        echo "==================================<br>";


                            
                        foreach($month as $key => $value){

                            // echo "Key: $key, Value: $value<br>";
                            
                            if($key == $monthFormat){
                                $month[$key]++;
                            }
                        }

                    }
                }


                echo "Before Sort:<br>";
                echo "=====================<br>";

                foreach($month as $key => $value){
                    echo "Key=" . $key . ", Value=" . $value."<br>";
                }


                echo "After Sort:<br>";
                echo "=====================<br>";

                arsort($month); //reverse array order

                foreach($month as $key => $value){
                    echo "Key=" . $key . ", Value=" . $value."<br>";
                }

                echo "Show Top 5:<br>";
                echo "=====================<br>";
                
                $topFiveMonth = array_slice($month, 0, 5, true);

                foreach($topFiveMonth as $key => $value){

                    echo "Key=" . $key . ", Value=" . $value."<br>";
                }



                // echo $chooseYearFormat;
                session_start();
                $_SESSION['asdasd'] = "asd";
                $_SESSION['pickedYear'] = $chooseYearFormat;
                $_SESSION['topFiveMonth'] = $topFiveMonth;

                // header('location: RE03_Year_MostCrowded.php');
                echo '<script>window.location.href = "RE03_Year_MostCrowded.php";</script>';
            }
        
        }

    }
}

// if(isset($_POST['mostVisitedTime'])){

//     $sql = "SELECT * FROM `userlogindb`.`appointmentslot`";
//     $result = mysqli_query($conn, $sql);

//     if(mysqli_num_rows($result)>0){

//         $total_booked_amount['09:00:00'] = 0;
//         $total_booked_amount['11:00:00'] = 0;
//         $total_booked_amount['13:00:00'] = 0;
//         $total_booked_amount['15:00:00'] = 0;
//         $total_booked_amount['17:00:00'] = 0;    

//         $total_numberofpeople['09:00:00'] = 0;
//         $total_numberofpeople['11:00:00'] = 0;
//         $total_numberofpeople['13:00:00'] = 0;
//         $total_numberofpeople['15:00:00'] = 0;
//         $total_numberofpeople['17:00:00'] = 0;    


//         while($row=mysqli_fetch_array($result)){

//             $timestamp = strtotime($row['appointmentDate']); // return year from appointmentDate 
//             $yearFormat = date('Y', $timestamp); // 2018 / 2019 / 2020

//             // echo "$yearFormat - $_POST[mostVisitedTime]<br>";

//             echo "$row[appointmentDate] ===> Booked: $row[availableSlotFrom] - $row[availableSlotUntil] == Number of people: $row[bookform_numberofpeople]<br>";

//             if($yearFormat == $_POST['mostVisitedTime']){

//                 foreach($total_booked_amount as $key => $value){
    
//                     if($row['availableSlotFrom']==$key){
//                         $total_booked_amount[$key]++;
//                     }
    
//                 }

//                 foreach($total_numberofpeople as $key => $value){
    
//                     if($row['availableSlotFrom']==$key){
//                         $total_numberofpeople[$key]+=$row['bookform_numberofpeople'];
//                     }
//                 }
            
//             }
            
//         }


//         $array_booked_amount = [0,0,0,0,0];
//         $array_numberofpeople = [0,0,0,0,0];
//         $average_visitors = [
//             "09:00:00 - 11:00:00" => 0,
//             "11:00:00 - 13:00:00" => 0,
//             "13:00:00 - 15:00:00" => 0,
//             "15:00:00 - 17:00:00" => 0,
//             "17:00:00 - 19:00:00" => 0];

//         $i = 0;
//         foreach($total_booked_amount as $key => $value){
//             $array_booked_amount[$i]=$value;
//             $i++;
//         }

//         $i = 0;
//         foreach($total_numberofpeople as $key => $value){
//             $array_numberofpeople[$i]=$value;
//             $i++;
//         }

//         $i = 0;

//         foreach($average_visitors as $key => $value){
            
//             if($array_booked_amount[$i] != 0){
//                 $average_visitors[$key] = $array_booked_amount[$i]/$array_numberofpeople[$i];
//             }
            
//             echo "average_visitors[$key]: $average_visitors[$key]<br>";
//             echo "array_booked_amount: $array_booked_amount[$i], array_numberofpeople: $array_numberofpeople[$i]<br>";
//             echo "====================================<br>";

//             $i++;

//         }


//         echo "=====================<br>";
//         echo "Before Sort:<br>";
//         echo "=====================<br>";

//         foreach($total_booked_amount as $key => $value){
//             echo "From: $key, Booked amount: $value<br>";
//         }

//         echo "<br>";

//         echo "=====================<br>";        
//         echo "Before Sort:<br>";
//         echo "=====================<br>";

//         foreach($total_numberofpeople as $key => $value){
//             echo "Time: $key, Total number of people: $value<br>";
//         }


//         // session_start();

//         $_SESSION['array_booked_amount'] = $array_booked_amount;
//         $_SESSION['array_numberofpeople'] = $array_numberofpeople;
//         $_SESSION['average_visitors'] = $average_visitors;

//         // header('location: RE04_ResultVisitorPattern.php');
//         echo '<script>window.location.href = "RE04_ResultVisitorPattern.php";</script>';
//     }

// }


?>


