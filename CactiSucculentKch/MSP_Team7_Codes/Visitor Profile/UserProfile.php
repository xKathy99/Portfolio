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
<link rel="stylesheet" href="../LoginModule/login_css.css">
<script src="./script.js" type="text/javascript"></script>
</head>

<div>
<?php 

if(isset($_POST['submit'])){
  $id = $_POST['id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $contact = $_POST['contact'];
  
  $sql= "UPDATE userlogin SET name = '".$name."' , email = '".$email."', 
  contact = '".$contact."' WHERE id = '".$id."'";
  
  $_SESSION['username'] = $email;
  if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . $conn->error;
  }

}
// copy from feedback form // kaixian edit start
if (isset($_SESSION['username']) && $_SESSION['username'] != 'admin' ){//if the user is logged in
  // var_dump($_SESSION);//kx debug
  $emailinput = $_SESSION['username'];
  $connection = mysqli_connect("localhost", "root", "", "userlogindb");
  $result = mysqli_query($connection,"SELECT * FROM `userlogin` WHERE `email` LIKE '$emailinput';");
  $row = mysqli_fetch_array($result);
  $contactinput = $row['contact'];
  $nameinput = $row['name'];
  $idinput = $row['id'];
}
else{
  $emailinput = 'error';
  $contactinput = 'error';
  $nameinput = 'error';
}
//kaixian edit end
?>


</div>

<h1 class="centertitle"><b>User Profile Page</b></h1>
<!-- <div class="content"> -->


<form class ="userinfo" action="EditUserInfo.php?id=<?php echo $idinput?>" method="post"> 
  <div class = "containeruser">
    <table class= "custom">
      <tr>
        
        <th>NAME</th>
      </tr>
      <br>
      <tr>  
        <td> 
        <!-- <input type="hidden" name="nameinput" value="<?php //echo $nameinput?>"> -->
          <?php 
          //echo $name
          echo $nameinput;
          ?>
        </td>
        <td>
          </td>
      </tr>
        
      <tr>
        <th>EMAIL ADDRESS</th>
      </tr>

      <tr>
        <td>
          <?php 
          // echo $email
          echo $emailinput;//kx edit
          ?>
      </td>
      </tr>

      <tr>
        <th>PHONE NUMBER</th>
      <tr>
        <td>
          <?php 
          // echo $contact
          echo $contactinput;//kx edit
          ?>
        </td>
      </tr>

    </table>
  </div>



  <div class= "centerbtn">
  <?php //echo 'user id: '.$idinput
  //kx edit debug?>
  <!-- kx edit below line -->
  <!-- <a href = "EditUserInfo.php?id=<?php //echo $idinput?>"><button type="button" class="buttons">Edit User Info</button></a> -->
  <button type="submit" name="edituser" class="buttons">Edit User Info</button></a>
  </div>
</form>

</div>
        
</body>


</html>
<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>