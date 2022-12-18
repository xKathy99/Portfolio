<?php
session_start();
if(isset($_GET['submit']))
{
echo $_GET["Id"];
echo $_GET["email"];
$_SESSION['user_id']=$_GET["Id"];
header('Location: dummyCheck.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Notification</title>
        <link rel="stylesheet" href="notification_page.css">
    </head>
<body>
    <div class="container">
        <form action="" method="get">
            Id: <input type="number" name="Id"><br>
            E-mail: <input type="text" name="email"><br>
        <input type="submit" name="submit">
        </form>
    </div>
</body>
</html>