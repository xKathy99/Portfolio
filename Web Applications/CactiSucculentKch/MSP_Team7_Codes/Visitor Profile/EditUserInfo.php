<?php 

  include "Connection.php";
  error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Profile Page</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<?php include '../includefile/homeheader.php';?>
<!-- <link rel="stylesheet" href="managing.css"/> -->
<link rel="stylesheet" href="user.css"/>

<script src="./script.js" type="text/javascript"></script>
</head>


<h1 class="centertitle"><b>Edit Profile</b></h1>
<form class ="userinfo" action= "UserProfile.php" method="POST">
<input type="hidden" name="id" value=" <?php echo $_GET['id'];?> "/>

<?php //kx edit debug
  // echo 'user id: '. $_GET['id'];// for debug
  $userid = $_GET['id'];
  $connection = mysqli_connect("localhost", "root", "", "userlogindb");
  $result = mysqli_query($connection,"SELECT * FROM `userlogin` WHERE `id` LIKE '$userid';");
  $row = mysqli_fetch_array($result);
  
?>

<div class = "containeruser">

<table>
  <tr>
    <th>NAME </th>
    <td><input type="text" id="name" name="name"
  	placeholder="visitor's name" required value="<?php echo $row['name']; ?>"></td>
  </tr> 

  <tr>
    <th>EMAIL ADDRESS </th>
    <td><input type="email" id="email" name="email"
  	placeholder="visitor@yahoo.com" required value="<?php echo $row['email']; ?>">
  </td>
  </tr>

  <tr>
    </td>
    <th>PHONE NUMBER </th>
    <td><input type="tel" id="contact" name="contact" required value="<?php echo $row['contact']; ?>"
  	placeholder="+6012-345-6789" pattern="[0-9]{10,11}" title="10 or 11 numbers only"> 
    <!-- pattern="+[0-9]{3}-[0-9]{3}-[0-9]{4}" -->
  
  </td>
  </tr>

</table>
</div>

<div class= "centerbtn">
<!-- <button type= "reset" onclick="alert('Reset Data!')"class="buttons">Reset</button></a> -->
<a href="../LoginModule/send_code.php" ><button type= "button" class="buttons" style="background: #9b805b;">Reset Password</button></a>
<button type="submit" name = "submit" style="background: #4f7b68;">Save Changes</button>
</div>
<br>
<br>
</form>

        
</body>

</html>
<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>