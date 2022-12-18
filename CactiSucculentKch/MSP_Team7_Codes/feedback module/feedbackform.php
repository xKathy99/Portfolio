<!DOCTYPE html>
<html>
    <head>
        <title>Feedback Form</title>
        <?php include '../includefile/homeheader.php';?>
        <link rel="stylesheet" href="../LoginModule/login_css.css">

    </head>
    <h1 class="centertitle"><b>Feedback Form</b></h1>
    <form class="feedback" action="submitFeedback.php" method="post">


        <div class="containerFeedback">

			<h3>Please help us to serve you better by taking a couple of minutes.</h3>
            <span class="blue">How satisfied were you with our Service?  </span>
            <span style="color:red; font-size: 11px;">* Requried </span>
            <br>
            <br>
            <ul>
                
                <li><input type="radio" name="view" value="excellent" id="excellent" required> 
                    <label for="excellent">excellent</label>
                    <div class="check"></div>
                </li>
                <li><input type="radio" name="view" value="good" id="good"> 
                    <label for="good"> good</label>
                    <div class="check"></div>
                </li>
                <li><input type="radio" name="view" value="neutral" id="neutral">
                    <label for="neutral">neutral</label>
                    <div class="check"></div>
                </li>
                <li><input type="radio" name="view" value="poor" id="poor"> 
                    <label for="poor">poor</label>
                    <div class="check"></div>
                </li>
                <li><input type="radio" name="view" value="awful" id="awful"> 
                    <label for="awful">awful</label>
                    <div class="check"></div>
                </li>
                
            </ul>	  
            <p  class="blue">If you have specific feedback, please write to us...</p>
            <br>
			<textarea placeholder="Additional comments..." class="comments" name="comments" required=""></textarea>
            <br>
            <br>
            <label>Optional <span style="font-size: 60%;">(leave empty to submit Anonymously)</span></label>
            <br>
            <div style="width: 100%">
                <?php 
                    // session_start();
                    if (isset($_SESSION['username']) && $_SESSION['username'] != 'admin' ){//if the user is logged in
                        $emailinput = $_SESSION['username'];
                        $connection = mysqli_connect("localhost", "root", "", "userlogindb");
                        $result = mysqli_query($connection,"SELECT * FROM `userlogin` WHERE `email` LIKE '$emailinput';");
                        $row = mysqli_fetch_array($result);
                        $contactinput = $row['contact'];
                        $nameinput = $row['name'];
                    }
                    else{
                        $emailinput = '';
                        $contactinput = '';
                        $nameinput = '';
                    }
                    ?>
                    <input type="text" placeholder="Name" id="name" name="name" value="<?php echo $nameinput;?>" />
                    <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $emailinput;?>"/>
                    <input type="text" placeholder="Contact Number" id="contact" name="num" pattern="[0-9]{10,11}" title="At 10 or 11 numbers" value="<?php echo $contactinput;?>" /><br>
            </div>          
			<button class="centerbtn" style="background-color: darkolivegreen;" type="submit" name="feedback_form" >Submit Feedback</button>
            <a href="../HomeModule/home.php"><button type="button" class="centerbtn">Return to Home page</button></a>
		</div>
    </form>
</html>

<?php
		echo "<script src='../notification_module/public/notification_page.js'></script>";
		echo "<script src='../notification_module/public/ajax.js'></script>";
		include_once('../notification_module/public/popUp.php');
		?>