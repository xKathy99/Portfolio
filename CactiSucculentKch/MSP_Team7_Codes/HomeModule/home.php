<!DOCTYPE html>
<html lang="en">

<head>
    <title>Succulent</title>
    <meta charset="utf-8">
    
    <!-- <link rel="stylesheet" href="home.css"> -->
    
    <!-- <script src="./script.js" type="text/javascript"></script> -->
</head>
<?php include '../includefile/homeheader.php';?>
<body>

</body>

<article>
    <div class="textbox">
        <img src="images/background.jpg" class="bg-img" alt="Background Image">
        <div class="center">TEXT HERE</div>
    </div>

    <br>  
    <br>
    <br>
    <br>
       
    <a class="body-content">Book now to secure your slots</a>
    <a class="button">          
		<button type="submit" name="button" class="bookingBtn">Book an Appointment</button>
	</a>
    <br>

</article>

<br>    
<br>
<br>
<br>

<?php
    // need admin login only can run this
    if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
        if($_SESSION['username'] == "admin"){
            echo '<a onclick="link" type="button" href="admin.php" class="buttonside">Admin View</a>';
        }
    }
?>
<?php include '../includefile/footer.php';?>

</html>