
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname="userlogindb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM notification Order By id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Notification</title>
        <link rel="stylesheet" href="notification_page.css">
    </head>
<body>
    <div class="container">
        <div class="notification-header">
            <h1>Notification</h1>
        </div>
        <div class="notification-body">
         <?php 
         if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row['user_id']==$_SESSION['user_id']||$row['admin_id']==$_SESSION['user_id']){
                    $id=$row['user_id'];
                    $sql2="Select * from userlogin where id=$id";
                    $result2 = $conn->query($sql2);
                     while($row2 = $result2->fetch_assoc()) 
                        $username=$row2['email'];

         ?>   
            <div class="notification-component" id=<?php echo "comp".$row['id'] ?>>
                <div class="notification-context">
                    <div class="notification-text" id=<?php echo "context".$row['id'] ?> style=<?php echo $style=$row['status']=="false" ? "font-weight:bold" : "font-weight:normal" ?> >
                    <?php echo $data= $_SESSION['user_id']==$row['user_id']? "Your ".$row['type'] : $username." ".$row['type'] ?>
                    </div>
                    <div class="notification-read">
                        <button class="mark-as-read" onclick="mark_as_read(<?php echo $row['id'] ?>)">
                            Mark As Read
                        </button>
                        <button class="view-description" id="<?php echo 'show'.$row['id'] ?>" onclick="show_details(<?php echo $row['id'] ?>)">
                            View Details
                        </button>
                        <button class="view-description" id="<?php echo "hide".$row['id'] ?>" style="display: none;" onclick="hide_details(<?php echo $row['id'] ?>)">
                            Close
                        </button>
                        
                    </div>
                </div>
                <div class="notification-delete">
                    <button class="delete-notification" onclick="deleteNotification(<?php echo $row['id']?>)">
                        <img src="https://www.freeiconspng.com/uploads/remove-icon-png-26.png" width="60px" height="60px"/>
                    </button>
                </div>
            </div>
            <div class="notification-component-details" id=<?php echo $row['id'] ?>>
                <p class="description-paragrapgh">
                <?php echo $data= $_SESSION['user_id']==$row['user_id']? "Your ".$row['description'] : $_SESSION['user_id']." ".$row['description'] ?>
                    </p>
            </div>
            <?php }
        } }
            else {
            ?>
            <div class="nothing-here">Nothing Here</div>
            <?php } ?>
        </div>
    </div>
    <div id="notify" class="notify-block">
            <div style="display:flex;justify-content:space-between">
                <a id="notifytext" href="Notification_Page.php"></a>
                <button onclick="closeDiv()" style="outline:none;border:none;background-color:transparent">close</button>
            </div>
    </div>
</body>
<script src="notification_page.js"></script>

<script>
     var conn = new WebSocket('ws://localhost:8080');
     console.log("hello")

function getDataUsingAjax(){
  console.log("hello")
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        console.log(this.responseText)
        const data=JSON.parse(this.responseText);
      console.log(data);


     
      if(data.data==false){
        console.log("no data found");
      }
      else{
            let timediff;
            function getMinDiff(startDate, endDate) {
            const msInMinute = 60 * 1000;

                return Math.round((startDate - endDate)/msInMinute);
                
                }

                data.data.map(d=>{
                    timediff=getMinDiff(new Date(d.date+"T"+d.time),new Date())
                console.log(timediff)
                
                if(timediff>=30 && timediff<=31)
                conn.send(JSON.stringify(data))
                })
                
      }
      
    }
  xmlhttp.open("GET", "getData.php");
  xmlhttp.send();
}
const startTimer=()=>{
//    getDataUsingAjax();
const timer=setInterval(getDataUsingAjax,1000*60)
}
     startTimer();
conn.onmessage=(e)=>{
    const data=JSON.parse(e.data);
    
   if(Number(data.admin_id)==<?php echo $_SESSION['user_id']?>)
{
    document.getElementById('notify').style.display="block";
console.log(e.data);
document.getElementById('notifytext').innerHTML='<?php echo $_SESSION['username']?>'+ " " + data.type;
}
else if(Number(data.user_id)==<?php echo $_SESSION['user_id']?>){
    document.getElementById('notify').style.display="block";
console.log(e.data);
document.getElementById('notifytext').innerHTML= "Your " + data.type;
}
}
const closeDiv=()=>{
    document.getElementById('notify').style.display="none";
}
const deleteNotification=(id)=>{
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
      console.log(this.responseText);
      document.getElementById('comp'+id).remove();
    }
  xmlhttp.open("GET", "deleteNotification.php?id="+id);
  xmlhttp.send();
}
</script>
</html>
