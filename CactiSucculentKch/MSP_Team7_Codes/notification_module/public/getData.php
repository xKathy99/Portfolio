<?php
// Check connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userlogindb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * from `appointmentslot` where 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // output data of each row
    $data=[];
    while($row = $result->fetch_assoc()) {
        $userid=$row['customerID'];
        $date=$row['appointmentDate'];
        $time=$row['availableSlotFrom'];
         $flag=1;
        //echo $flag
                $sql2 = "INSERT INTO notification (`type`, `user_id`,`admin_id`,`description`,`status`) VALUES ('have a upcomming booking in 30 min',$userid,'44','have a upcomming booking in 30 min','false')";      
                $conn->query($sql2);
             
                array_push($data,array("user_id"=>$userid,"description"=>'have a upcomming booking in 30min',"admin_id"=>'44',"type"=>'have a upcomming booking in 30 min',"status"=>'false',"date"=>$date,"time"=>$time));
              
    }
     echo json_encode(["data"=>$data]);
}
else{
    $data=array('user'=>true,"new"=>"buy");

    echo json_encode(["data"=>$result->num_rows]);
}
$conn->close();       
?>