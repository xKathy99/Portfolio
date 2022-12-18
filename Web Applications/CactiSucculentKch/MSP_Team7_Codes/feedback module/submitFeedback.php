<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Send Feedback</title>
		<link rel="stylesheet" href="../LoginModule/login_css.css">
	</head>
    
    <?php
        //connection to DB
        $connection = mysqli_connect("localhost", "root", "", "userlogindb");
        if (!$connection) {
            die("Failed ". mysqli_connect_error());
        }
        //create table for feedabck
        $sql = "CREATE TABLE IF NOT EXISTS `feedback` (
            `id` INT NOT NULL AUTO_INCREMENT , 
            `rating` VARCHAR(255) NOT NULL , 
            `feedback` LONGTEXT NOT NULL ,
            `replyfeedback` LONGTEXT NOT NULL , 
            `name` VARCHAR(255) NOT NULL , 
            `email` VARCHAR(255) NOT NULL , 
            `contact` VARCHAR(255) NOT NULL , 
            `datetime` VARCHAR(255) NOT NULL , 
            PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        
        if (mysqli_query($connection, $sql)) {
            // echo "A new feedback TABLE is successfully created!<br>";
        } 
        else {
            echo "Error: " . mysqli_error($connection);
        }
        //select whole feedback table
        $number=0;
        $result = mysqli_query($connection,"SELECT * FROM `feedback`;");
        while($row = mysqli_fetch_array($result)){
            $number = $row['id']+1;
            
        }
        // echo $number;
        // if the form is SET with POST method
        if (isset($_POST['feedback_form'])){
            $rt = $_POST['view'];
            $cmt = $_POST['comments'];
            if ($_POST["name"] == "" ){
                $nm = "Anonymous $number";
            }else{
                $nm = $_POST['name'];
            }
            if ($_POST["email"] == "" ){
                $em = "N/A";
            }else{
                $em = $_POST['email'];
            }
            if ($_POST["num"] == "" ){
                $nb = "N/A";
            }else{
                $nb = $_POST['num'];
            }
            echo '<h1 class="center"><b>Feedback Summary</b></h1>
            <div class="centerGray">';
            //define date time
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $datetime = date("Y-m-d H:i");   
            //insert data into table
            $sql = "INSERT INTO `feedback` (
                `rating`, `feedback`, `name`, `email`, `contact`,`datetime`) 
                VALUES ('$rt', '$cmt', '$nm', '$em', '$nb','$datetime')";
            if (mysqli_query($connection, $sql)) {
                //js alert msg
                echo 'Feedback submitted succesfully!<br>Thank you for your feedback.';
            } else {
                echo "Error: " . $query_insert . "<br>" . mysqli_error($connection);
            }
            
            // var_dump($_POST);
            echo '<p>Rating: '.$rt;
            echo '<p>Customer feedback: '.$cmt;
            echo '<p>Customer name: '.$nm;
            echo '<p>Customer email: '.$em;
            echo '<p>Customer Contact Number: '.$nb;
            echo '<a href="../LoginModule/homepage.php"><button type="button" class="button">Return to Home page</button></a>';
            echo '<a href="../feedback module/customer_view_feedback.php"><button type="button" class="button">View Customer Feedback</button></a>';
            echo '</div>';
        }
        else if (isset($_POST['reply_feedback'])){
            $oldfb = $_POST['oldfb'];
            $rpfb = $_POST['replyfb'];
            $addfb = $oldfb.' '.$rpfb;
            $id = $_POST['id'];
            echo ''.$id.' comment is: '.$addfb.'';
            $sql = "UPDATE `feedback` SET `replyfeedback` = '$addfb' WHERE `feedback`.`id` = '$id';";
            if (mysqli_query($connection, $sql)) {
                echo '<script>alert("reply sucessful")</script>';
                header("location: admin_view_feedback.php#".$id."");
            } else {
                echo "Error: " . $query_insert . "<br>" . mysqli_error($connection);
            }
        }
        else{
            // echo "nothing posted";
        }
        mysqli_close($connection);
    ?>
</html>


<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>