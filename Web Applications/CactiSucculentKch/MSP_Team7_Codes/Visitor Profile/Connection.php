<?php
$servername = "localhost";
$username = "root";
$password = "";

// Creating a connection
$conn = new mysqli($servername, $username, $password,"userlogindb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//Get data from editprofile
//$result = mysqli_query($conn, "select * from editprofile");/
//while($data = mysqli_fetch_assoc($result)){
  //  print_r($data);
//}


?>