<?php include "Connection.php";
  error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>VisitorProfiles</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="managing.css">


<script src="./script.js" type="text/javascript"></script>
</head>

<header>
  <div class="header-wrapper">
  <div class="admin-wrapper">
    <a href="../HomeModule/admin.php" class="logo">CACTI SUCCULENT</a>
    <span>Admin</span>
  </div>
      <a href="../HomeModule/admin.php" class="profile_icon" img src="images/user1.png"></a>
  </div>
</header>


<body>
<div>
<?php
    if($_GET['id']!= null){
      $sql = "delete from userlogin where id = ".$_GET['id']."";
      $conn -> query($sql);
    }    
    $sql = "SELECT * FROM `userlogin`";
    if($_POST['search'] != null){
        $sql .= " where name = '".$_POST['search'] ."'" ;
    }
    $result = $conn->query($sql);
?>    
</div>

<!-- HTML  -->
<div class="contentadmin">
<h1>Visitor Profiles</h1>

<form action= "visitorprofiles.php" class = "search" method="POST" >
    <input type="text" name="search" placeholder="Search Visitor..." id = "searchbox">
</form>


<div class= "infos">
<table>
<thead>
  <tr>
    <th>NO.</th>
    <th>NAME</th>
    <th>LOGIN EMAIL</th>
    <th>PHONE NUMBER</th>    
    <th>DELETE</th>
  </tr>
</thead>  

<tbody>
<?php while ($row=$result ->fetch_assoc()){?>
  <tr>
    <td><?= $row['id'];?> </td> 
    <td><?= $row['name'];?> </td>
    <td><?= $row['email'];?> </td>
    <td><?= $row['contact'];?> </td>        
    <td><a href="visitorprofiles.php?id=<?php echo $row['id']; ?>"><button>Delete</button></a></td>      
    </td>      
  </tr>
<?php 



} ?>   
</tbody>
</table>

</div>
</div>

</body>
<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>
</html>
