<?php
// session_start();
?>

<style type="text/css">
    
.notify-block{
    font-size:20px;
    width:300px;
    border-radius: 10px;
    overflow: hidden;
    display:none;
    position:absolute;
    top:40px;
    right:40px;
    background-color:white;
    padding:2px;
    color:black;
    box-shadow: 5px 10px #08080848;
}
.notify-block div a{
    text-justify: inter-word;
    width:80%;
}
.notify-block div button{
    text-justify: inter-word;
    width:20%;
    cursor: pointer;
}
</style>
 <div id="notify" class="notify-block">
            <div style="display:flex;justify-content:space-between">
                <a id="notifytext" href="../notification_module/public/Notification_Page.php"></a>
                <button onclick="closeDiv()" style="outline:none;border:none;background-color:transparent;color:black;">close</button>
            </div>
    </div>
</body>
<script>
       console.log("hello")
        startTimer();
      var conn = new WebSocket('ws://localhost:8080');
      conn.onopen=()=>{
        console.log("Connection Established");
      }
conn.onmessage=(e)=>{
    const data=JSON.parse(e.data);
    console.log('<?php echo $_SESSION['user_id'] ?>')
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

</script>
<?php?>