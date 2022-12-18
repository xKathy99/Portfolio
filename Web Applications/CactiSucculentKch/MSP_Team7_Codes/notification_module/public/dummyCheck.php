<?php
session_start();
?>
<script>
    var conn = new WebSocket('ws://localhost:8080');
var flag=false
var data;
</script>
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
$sql = "SELECT * FROM demobooking";
$result = $conn->query($sql);

if(isset($_GET['submitBooking']))
{
    echo $_GET["timeslot"];

$userid=$_SESSION['user_id'];
$timeslot=$_GET['timeslot'];
$sql = "INSERT INTO demobooking (`timeSlot`, `user_id`) VALUES ('$timeslot',$userid)";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}


if(isset($_GET['updateBooking']))
{
    $_GET["timeslotupdate"];

$userid=$_SESSION['user_id'];
$id=$_GET['id'];
$timeslot=$_GET['timeslotupdate'];
$sql = "UPDATE demobooking SET timeSlot='$timeslot' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $sql2 = "INSERT INTO notification (`type`, `user_id`,`admin_id`,`description`,`status`) VALUES ('have been update a booking',$userid,'44','has been updated a booking slot $timeslot','false')";
    ?>
    <script>
        flag=true;
        data='have been update a booking'
    conn.onopen = function(e)
{
    console.log("Connection established!");
    conn.send(JSON.stringify({type:'have been update a booking',user_id:<?php echo $userid;?>,admin_id:'44',description:'has been updated a booking slot'+new Date('<?php echo $timeslot; ?>'),status:'false'}));
   
   
};
    </script>
    <?php
    if ($conn->query($sql2) === TRUE) {
        echo "Success";
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}

if(isset($_GET['BookingCancel']))
{
    echo "called";
$userid=$_SESSION['user_id'];
$id=$_GET['id'];

$sql3="SELECT * from demobooking WHERE id='$id'";
$sql = "DELETE from demobooking WHERE id='$id'";
$result2 = $conn->query($sql3);
$timeslot="";
if ($result2->num_rows > 0) {
    while($row3 = $result->fetch_assoc())
    $timeslot=$row3['timeSlot'];
}
echo $timeslot;
if ($conn->query($sql) === TRUE) {
    $sql2 = "INSERT INTO notification (`type`, `user_id`,`admin_id`,`description`,`status`) VALUES ('have been update a booking',$userid,'44','has been updated a booking slot $timeslot','false')";
    ?>
    <script>
        flag=true;
        data='have been cancelled a booking'
    conn.onopen = function(e)
{
    console.log("Connection established!");
    conn.send(JSON.stringify({type:'have been cancelled a booking',user_id:<?php echo $userid;?>,admin_id:'44',description:'has been cancelled a booking slot'+new Date('<?php echo $timeslot; ?>'),status:'false'}));   
   
};
    </script>
    <?php
    if ($conn->query($sql2) === TRUE) {
        echo "Success";
    } else {
      echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
    
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}
$conn->close();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Demo Booking</title>
        <link rel="stylesheet" href="notification_page.css">
    </head>
<body>
    <div class="container">
        <form action="" method="get">
            TimeSlot: <input type="datetime-local" name="timeslot"><br>
        <input type="submit" name="submitBooking">
        </form>
    </div>
    <div class="container">
        <div>
            Available Ids
        <?php 
         if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                ?>
                <h1><?php echo $row['id']; ?></h1>
            <?php
            } }
            ?>
        </div>
        <form action="" method="get">
        Id: <input type="number" name="id"><br>
            TimeSlot: <input type="datetime-local" name="timeslotupdate"><br>
        <input type="submit" name="updateBooking">
        </form>
        <form action="" method="get">
        Id: <input type="number" name="id"><br>
        <input type="submit" name="BookingCancel">
        </form>
    </div>
    <div id="notify" class="notify-block">
            <div style="display:flex;justify-content:space-between">
                <a id="notifytext" href="Notification_Page.php"></a>
                <button onclick="closeDiv()" style="outline:none;border:none;background-color:transparent">close</button>
            </div>
    </div>
</body>
<script src="ajax.js"></script>
<script>
       console.log("hello")
        startTimer();
    
conn.onmessage=(e)=>{
    const data=JSON.parse(e.data);
    
    if(Number(data.admin_id)==<?php echo $_SESSION['user_id'] ?>||Number(data.user_id)==<?php echo $_SESSION['user_id'] ?>)
{
    document.getElementById('notify').style.display="block";
console.log(e.data);
document.getElementById('notifytext').innerHTML=data.user_id+ " " + data.type;
}
}
const closeDiv=()=>{
    document.getElementById('notify').style.display="none";
}
if(flag==true){
    flag=false
    document.getElementById('notify').style.display="block";
    document.getElementById('notifytext').innerHTML="You " + data;

}
</script>
</html>
