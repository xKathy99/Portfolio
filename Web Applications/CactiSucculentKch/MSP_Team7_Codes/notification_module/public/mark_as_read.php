<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "notification_module";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_REQUEST['id'];
$sql = "UPDATE notification SET status='true' WHERE id=".$id;
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }
$conn->close();
?>
